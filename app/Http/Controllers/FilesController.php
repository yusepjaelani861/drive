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

    public function get(Request $request)
    {
        $file = Files::where('short_url', $request->short_url)->first();
        if ($file == null) {
            return redirect('/');
        } else {
        $url = $file->original_url;

        $file->increment('download_count', 1);

        return response()->streamDownload(function () use ($file, $url) {
            header('Content-Type: '.$file->mime_type);
            header('Content-Length: '.$file->size);
            header('Content-Disposition: attachment; filename="'.$file->title);
            readfile($url);
        }, $file->title);
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

    public function download(Request $request)
    {
        $file = Files::where('short_url', $request->short_url)->first();
	$header = [
            'Content-Type' => $file->mime_type,
            'Content-Disposition' => 'attachment; filename="' . $file->title . '"',
            'Accept' => '*/*',
        ];

        $file->increment('download_count');
        // return Storage::disk('ftp')->download('get/' . $file->title, $file->title);
        // return redirect($file->original_url);
	$client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $file->original_url, [
            'headers' => $header,
        ]);
        return $response->getBody();
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
            $original_url = 'https://cdn.mitehost.my.id/'.Storage::disk('ftp')->putFileAs('get', $file, $short_url . '.' . $extension);
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

    public function delete(Request $request)
    {
        $file = Files::where('short_url', $request->short_url)->first();
        $data = Storage::disk('ftp')->delete('get/' . $file->title);
        $file->delete();

        return redirect()->route('files.list');
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
            } else if ($file->mime_type == 'image/png') {
                return view('files.embed', compact('file'));
            } else {
                return Storage::disk('ftp')->download('get/' . $file->short_url, $file->title, $header);
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
            $file->increment('download_count', 1);
            return Storage::disk('ftp')->download('get/' . $file->short_url, $file->title);
        } else {
            return response()->json(['error' => 'File not found']);
        }
    }
}
