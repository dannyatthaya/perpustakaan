<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Borrows;
use Auth;

class BorrowsController extends Controller
{
    public function all() {
    	return Borrows::all();
    }

    public function show($id) {
    	return Borrows::find($id);
    }

    public function showPerUser() {
        $id = Auth::user()->id;
        return Borrows::whereUserId($id)->get();
    }

    public function store(Request $request) {
    	return Borrows::create($request->all());
    }

    public function update($id, Request $request) {
    	$pinjam = Borrows::find($id);
    	$pinjam->update($request->all());
    	return $pinjam;
    }

    public function delete($id) {
    	$pinjam = Borrows::find($id);
    	$pinjam->delete();
    	return 204;
    }
}
