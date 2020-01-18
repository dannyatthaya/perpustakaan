<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengembalian;

class PengembalianController extends Controller
{
    public function all() {
    	return Pengembalian::all();
    }

    public function show($id) {
    	return Pengembalian::find($id);
    }

    public function store(Request $request) {
    	return Pengembalian::create($request->all());
    }

    public function update($id, Request $request) {
    	$kembali = Pengembalian::find($id);
    	$kembali->update($request->all());
    	return $kembali;
    }

    public function delete($id) {
    	$kembali = Pengembalian::find($id);
    	$kembali->delete();
    	return 204;
    }
}
