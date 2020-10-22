<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

class AllRouteTest extends TestCase
{
    use RefreshDatabase;
    protected $admin;

    public function setUp(): void
    {
        parent::setUp();
        $this->admin = User::find(1);
        if(!$this->admin){
            $this->admin = User::factory()->create();
        }
    }

    /**
     * test all route
     *
     * @group route
     */
    public function testAllRoute()
    {
        $routeCollection = Route::getRoutes();
        $this->withoutEvents();
        $blacklist = [
            'url/that/not/tested',
            'login', 'forgot-password', '/'
        ];
        $dynamicReg = "/{\\S*}/"; //used for omitting dynamic urls that have {} in uri (http://laravel-tricks.com/tricks/adding-a-sitemap-to-your-laravel-application#comment-1830836789)
        $this->actingAs($this->admin);

        foreach ($routeCollection as $route) {
            try {
                if (
                    !strstr($route->action['prefix'] ?? null, 'api') &&
                    !preg_match($dynamicReg, $route->uri()) &&
                    !strstr($route->action['controller'], 'Laravel') &&
                    !strstr($route->action['controller'], 'Livewire') &&
                    !strstr($route->action['controller'], 'Illuminate') &&
                    in_array('GET', $route->methods()) &&
                    !in_array($route->uri(), $blacklist)
                ) {
                    // dd($route->action);
                    $start = $this->microtimeFloat();
                    fwrite(STDERR, print_r('test ' . $route->uri() . "\n", true));
                    $response = $this->call('GET', $route->uri());
                    $end   = $this->microtimeFloat();
                    $temps = round($end - $start, 3);
                    fwrite(STDERR, print_r('time: ' . $temps . "\n", true));
                    $this->assertLessThan(15, $temps, "too long time for " . $route->uri());
                    $this->assertEquals(200, $response->getStatusCode(), $route->uri() . " failed to load");
                }
            } catch (\Exception $e) {
                dump($e->getMessage());
                dd($route->action);
            }
        }
    }


    public function microtimeFloat()
    {
        list($usec, $asec) = explode(" ", microtime());

        return ((float) $usec + (float) $asec);
    }
}
