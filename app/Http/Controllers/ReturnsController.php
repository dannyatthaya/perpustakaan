<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Returns;
use Auth;

class ReturnsController extends Controller
{
    public function all() {
    	return Returns::with('books')->with('user')->get();
    }

    public function show($id) {
    	return Returns::find($id);
    }

    public function showPerUser() {
        $id = Auth::user()->id;
        return Returns::whereUserId($id)->with('books')->with('user')->get();
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
