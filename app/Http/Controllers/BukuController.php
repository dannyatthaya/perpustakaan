<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Buku;

class BukuController extends Controller
{
    public function all() {
    	return Buku::all();
    }

    public function show($id) {
    	return Buku::find($id);
    }

    public function store(Request $request) {
    	return Buku::create($request->all());
    }

    public function update($id, Request $request) {
    	$buku = Buku::find($id);
    	$buku->update($request->all());
    	return $buku;
    }

    public function delete($id) {
    	$buku = Buku::find($id);
    	$buku->delete();
    	return 204;
    }
}
