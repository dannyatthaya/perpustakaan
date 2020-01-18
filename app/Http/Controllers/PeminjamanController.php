<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peminjaman;

class PeminjamanController extends Controller
{
    public function all() {
    	return Peminjaman::all();
    }

    public function show($id) {
    	return Peminjaman::find($id);
    }

    public function store(Request $request) {
    	return Peminjaman::create($request->all());
    }

    public function update($id, Request $request) {
    	$pinjam = Peminjaman::find($id);
    	$pinjam->update($request->all());
    	return $pinjam;
    }

    public function delete($id) {
    	$pinjam = Peminjaman::find($id);
    	$pinjam->delete();
    	return 204;
    }
}
