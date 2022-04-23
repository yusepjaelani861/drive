<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $file_upload = $request->file('fileUpload');
        if ($request->hasFile('fileUpload')) {
            $file_name = $file_upload->getClientOriginalName();
            // $files = file_put_contents(public_path('storage/files/' . $file_name), file_get_contents($file_upload->getRealPath()));
            $files = Storage::disk('ftp')->put('get/' . $file_name, file_get_contents($file_upload->getRealPath()));
            // $url_file = url('storage/files/' . $file_name);
            $url_file = 'https://cdn.mitehost.my.id/'.Storage::disk('ftp')->url('get/' . $file_name);
            $file_size = $file_upload->getSize();
            $file_mime = $file_upload->getMimeType();
            $file_extension = $file_upload->getClientOriginalExtension();

            $user = $request->user();

            $file = Files::create([
                'user_id' => $user->id,
                'title' => $file_name,
                'original_url' => $url_file,
                'short_url' => base_convert($url_file, 10, 36),
                'mime_type' => $file_mime,
                'extension' => $file_extension,
                'size' => $file_size,
            ]);
            
            return response()->json([
                'success' => true,
                'file' => $file,
                'message' => $url_file,
            ]);
        } else {
            return response()->json([
                'error' => 'No file selected',
                'message' => 'Please select a file',
            ]);
        }
    }

    public function getFile(Request $request)
    {
        $file = Files::where('short_url', $request->short_url)->first();
        if ($file) {
            $header = [
                'Content-Type' => $file->mime_type,
                'Content-Disposition' => 'inline; filename="' . $file->title . '"',
                'Content-Transfer-Encoding' => 'binary',
                'Content-Length' => $file->size,
            ];

            Files::where('short_url', $request->short_url)->increment('download_count');
            if ($file->mime_type == 'audio/mpeg') {
                return view('files.embed', compact('file'));
            } else if ($file->mime_type == 'video/mp4') {
                return view('files.embed', compact('file'));
            } else {
                return response()->download(public_path('storage/files/'.$file->title), $file->title, $header);
            }

        } else {
            return response()->json(['error' => 'File not found']);
        }
    }

    public function downloadFile(Request $request)
    {
        $file = Files::where('short_url', $request->short_url)->first();
        if ($file) {
            
            $url = $file->original_url;
            return Storage::disk('ftp')->download('get/' . $file->title);
        } else {
            return response()->json(['error' => 'File not found']);
        }
    }
}
