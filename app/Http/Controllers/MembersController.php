<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function all() {
    	return User::all()->where('role', 1);
    }

    public function show($id) {
    	return User::find($id);
    }

    public function store(Request $request) {
    	return User::create($request->all());
    }

    public function update($id, Request $request) {
    	$user = User::find($id);
    	$user->update($request->all());
    	return $user;
    }

    public function delete($id) {
    	$user = User::find($id);
    	$user->delete();
    	return 204;
    }
}
