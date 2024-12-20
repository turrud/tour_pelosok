<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageOrderController extends Controller
{
    public function index()
    {
        $paket = Paket::all();
        return view('frontend.explore.order.index', compact('paket'));
    }

}