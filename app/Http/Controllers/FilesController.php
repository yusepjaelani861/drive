<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function index()
    {
        return view('files.upload');
    }

    public function list()
    {
        $user = Auth::user();

        return view('files.list', compact('user'));
    }

    public function view(Request $request)
    {
        $file = Files::where('short_url', $request->short_url)->first();
        $files = Files::all()->take(4);

        return view('files.view', compact('file', 'files'));
    }

    public function download(Request $request)
    {
        $file = Files::where('short_url', $request->short_url)->first();
        $file->increment('download_count', 1);
        return Storage::disk('ftp')->download('get/' . $file->title, $file->title);
        // return redirect($file->original_url);
        // return Storage::disk('ftp')->download('get/' . $file->title);

    }

    public function store(Request $request)
    {
        $file_upload = $request->file('fileUpload');
        if ($request->hasFile('fileUpload')) {
            $file_name = $file_upload->getClientOriginalName();
            // $files = file_put_contents(public_path('storage/files/' . $file_name), file_get_contents($file_upload->getRealPath()));
            // $filename = base_convert($file_name, 30, 36);
            $files = Storage::disk('ftp')->put('get/' . $file_name, file_get_contents($file_upload->getRealPath()));
            // $url_file = url('storage/files/' . $file_name);
            $url_file = 'https://cdn.mitehost.my.id/'.Storage::disk('ftp')->url('get/' . $file_name);
            $file_size = $file_upload->getSize();
            $file_mime = $file_upload->getMimeType();
            $file_extension = $file_upload->getClientOriginalExtension();
            $short_url = base_convert($url_file, 20, 36);

            $user = $request->user();
            $file_name = $file_upload->getClientOriginalName();
            $file = Files::create([
                'user_id' => $user->id,
                'title' => $file_name,
                'original_url' => $url_file,
                'short_url' => $short_url,
                'mime_type' => $file_mime,
                'extension' => $file_extension,
                'size' => $file_size,
            ]);
            
            return response()->json([
                'success' => true,
                'file' => $file,
                'message' => route('files.download', $short_url),
            ]);
        } else {
            return response()->json([
                'error' => 'No file selected',
                'message' => 'Please select a file',
            ]);
        }
    }
}
