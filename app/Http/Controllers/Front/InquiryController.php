<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Loader\ProtectedPhpFileLoader;

class InquiryController extends Controller
{
    public function show()
    {
        //todo get inquiry from session
        $inquiry = $this->getInquiry();
        return view('front.inquiry.show', compact('inquiry'));
    }

    protected function  getInquiry()
    {
        return request()->session()->get('inquiry');
    }

    protected  function setInquiry($inquiry)
    {
        request()->session()->put('front.inquiry', $inquiry);
        return $this;
    }
}
