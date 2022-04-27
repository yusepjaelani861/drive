<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function index()
    {
        return view('files.upload');
    }

    public function get(Request $request)
    {
        $file = Files::where('short_url', $request->short_url)->first();
        if ($file == null) {
            return redirect('/');
        } else {
        $file->increment('download_count', 1);

        return Storage::disk('public')->download($file->short_url . '.' . $file->extension, $file->title);
        }
    }

    public function list()
    {
        $user = Auth::user();

        return view('files.list', compact('user'));
    }

    public function view(Request $request)
    {
        $file = Files::where('short_url', $request->short_url)->first();
        $background_colors = array('#282E33', '#25373A', '#164852', '#495E67', '#FF3838');
        $count = count($background_colors) - 1;
        $i = rand(0, $count);
        $rand_background = $background_colors[$i];
        
        $files = Files::paginate(8);

        return view('files.view', compact('file', 'rand_background', 'files'));
    }

    public function multistore(Request $request)
    {
        $files = $request->file();
        $user = Auth::user();
        $count = 0;
        foreach ($files as $file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $mime_type = $file->getMimeType();
            $size = $file->getSize();
            $short_url = substr(md5(microtime()), rand(0, 26), 5);
            $upload = File::put(public_path('get/' . $short_url . '.' . $extension), File::get($file));
            $original_url = url('get/' . $short_url . '.' . $extension);
            $file = Files::create([
                'user_id' => $user->id,
                'title' => $filename,
                'short_url' => $short_url,
                'original_url' => $original_url,
                'mime_type' => $mime_type,
                'size' => $size,
                'extension' => $extension,
            ]);
            $count++;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Uploaded ' . $count . ' files successfully',
        ]);
    }

    public function delete(Request $request)
    {
        $file = Files::where('short_url', $request->short_url)->first();
        $data = Storage::disk('ftp')->delete('get/' . $file->title);
        $file->delete();

        return redirect()->route('files.list');
    }

    public function embed(Request $request)
    {
        $file = Files::where('short_url', $request->short_url)->first();

        return view('files.embed', compact('file'));
    }
}
