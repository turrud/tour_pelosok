<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\TagPackage;
use Illuminate\Http\Request;

class PackageSearchController extends Controller
{
    // Menampilkan form pencarian
    public function index(Request $request)
    {
        // Ambil semua tag untuk ditampilkan di menu
        $tags = TagPackage::all();

        // Jika ada filter tag, ambil package yang sesuai dengan tag
        $tagId = $request->input('tag');
        $packages = $tagId && $tagId !== 'all'
            ? Package::whereHas('tagpackages', function ($query) use ($tagId) {
                $query->where('id', $tagId);
            })->get()
            : Package::all();

        return view('frontend.explore.package.index', [
            'tags' => $tags,
            'packages' => $packages,
            'selectedTag' => $tagId,
        ]);
    }

    public function show(string $id)
    {
        // Mencari Home berdasarkan ID dan mengambil relasi homeImages yang diurutkan berdasarkan order_number
        $package = Package::with(['packageImages' => function ($query) {
            $query->orderBy('order_number'); // Mengurutkan gambar berdasarkan order_number
        }])->findOrFail($id);

        return view('frontend.explore.package.show', compact('package'));
    }
}