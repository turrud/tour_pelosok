<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;

class PageHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homes = Home::with(['homeImages', 'taghomes'])->get();
        return view('frontend.home.index', compact('homes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mencari Home berdasarkan ID dan mengambil relasi homeImages yang diurutkan berdasarkan order_number
        $home = Home::with(['homeImages' => function ($query) {
            $query->orderBy('order_number'); // Mengurutkan gambar berdasarkan order_number
        }])->findOrFail($id);

        return view('frontend.home.show', compact('home'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}