<x-front.app
title="Home"
description=""
keywords=""
>
    {{ Route::currentRouteName() }}
    <div>
        {{ url()->current() }}
    </div>
</x-front.app>