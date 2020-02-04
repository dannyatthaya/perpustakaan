<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Returns;

class ReturnsController extends Controller
{
    public function all() {
    	return Returns::all();
    }

    public function show($id) {
    	return Returns::find($id);
    }

    public function store(Request $request) {
    	return Returns::create($request->all());
    }

    public function update($id, Request $request) {
    	$kembali = Returns::find($id);
    	$kembali->update($request->all());
    	return $kembali;
    }

    public function delete($id) {
    	$kembali = Returns::find($id);
    	$kembali->delete();
    	return 204;
    }
}
