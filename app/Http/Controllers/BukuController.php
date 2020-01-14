<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function uploadFile(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpg,png,jpeg'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            //MENYIMPAN FILE KE DALAM FOLDER PUBLIC (note: sesuai disk dari filesystem)
            //DALAM HAL INI KE storage_path
            $file->storeAs(
                'public/buku/', $filename
            );
            return response()->json(['Upload Success']);
        }
    }

    public function readFile()
    {
        $files = scandir(storage_path('app/public'));
        $allFile = array_diff($files, ['.', '..', '.gitignore']);
        return response()->json($allFile, 200);
    }
}
