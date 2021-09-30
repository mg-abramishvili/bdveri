<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request) {
        if($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('tmp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);

            return $folder;
        }

        return '';
    }

    public function delete(Request $request) {
        //
    }

    public function temp_files_index(Request $request) {
        return TemporaryFile::all();
    }

    public function temp_files_delete($id, Request $request) {
        $file = TemporaryFile::find($id);
        $file->delete();
        unlink(public_path('temp_uploads/' . $file->folder . '/' . $file->filename));
        rmdir(public_path('temp_uploads/' . $file->folder));
    }
}
