<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Books;

class BooksController extends Controller
{
    public function all() {
    	return Books::all();
    }

    public function show($id) {
    	return Books::find($id);
    }

    public function store(Request $request) {
        $image = $request->image;
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $imageName = $request->input('cover');
        Storage::disk('public')->put($imageName, base64_decode($image));

    	return Books::create($request->all());
    }

    public function update($id, Request $request) {
    	$buku = Books::find($id);
    	$buku->update($request->all());
    	return $buku;
    }

    public function delete($id) {
    	$buku = Books::find($id);
    	$buku->delete();
    	return 204;
    }
}
