<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout($subdomain, CartService $cartService)
    {
        if(!$cartService->all()) abort(500);
        return view("front.checkout");
    }

    public function proccess($subdomain, CartService $cartService)
    {
        if(!$cartService->all()) abort(500);
        $cartService->clear();
        return redirect()->route('front.thanks', $subdomain);
    }

    public function tanks($subdomain, CartService $cartService)
    {
        // if(!$cartService->all()) abort(500);
        // $cartService->clear();
        return redirect()->route('front.thanks', $subdomain);
    }


}
