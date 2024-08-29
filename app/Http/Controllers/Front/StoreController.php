<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index($subdomain){
        dd(Store::whereSubdomain($subdomain)->first());
    }
}
