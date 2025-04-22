<?php

namespace App\Http\Controllers;

use Validator, Redirect, Response, File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\FileUpload;
use fro_medias;

use Users;
use Auth;

class FileController extends Controller
{

    public function index()
    {
        return view('fileupload.index');
    }

    public function fileUploader(Request $request)
    {
        try {
            $request->validate([
                'aoeName' => 'required|string',
                'mobileNumber' => 'required|string',
                'file' => 'required|file',
                'source' => 'required|string',
            ]);

            $aoeName = $request->aoeName;
            $mobileNumber = $request->mobileNumber;
            $source = $request->source;

            $file = $request->file('file');
            $original_filename = $file->getClientOriginalName();
            $hashed_filename = hash('md5', time() . $original_filename) . '.' . $file->getClientOriginalExtension();

            Storage::put('uploads/' . $hashed_filename, file_get_contents($file->getRealPath()));

            $fileUpload = new FileUpload();
            $fileUpload->aoe_name = $aoeName;
            $fileUpload->mobile = $mobileNumber;
            $fileUpload->source = $source;
            $fileUpload->original_name = $original_filename;
            $fileUpload->storage_name = $hashed_filename;
            $fileUpload->save();

            return response()->json(['message' => $original_filename . ' uploaded successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to upload ' . $original_filename], 400);
        }
    }
    public function filelist()
    {
        $filedata = FileUpload::orderBy('created_at', 'desc')->get();

        return view('fileupload.file-list', compact('filedata'));
    }

    public function getFile($filename)
    {
        try {
            $file = FileUpload::where('storage_name', $filename)->first();
            if ($file) {
                $original_filename = $file->original_name;
                $filePath = storage_path('app/uploads/' . $filename);
                return response()->download($filePath, $original_filename);
            } else {
                abort(404, 'File not found');
            }
        } catch (\Throwable $th) {
            abort(404, 'File not found');
        }
    }
    public function statefunction()
    {

        $curl = curl_init();

        $postData = json_encode([
            "action" => "state"
        ]);

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://vcredil.com/eoffice-apis/root/listing.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: d5baad86d889077e3d4d47e1d6169867'
            ],
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
            echo $response;
        }

        curl_close($curl);
    }
    public function districtfunction($s_code)
    {
        $curl = curl_init();

        // Prepare the JSON payload with variable interpolation
        $payload = json_encode(array(
            'action' => 'district',
            'state_code' => $s_code
        ));

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://vcredil.com/eoffice-apis/root/listing.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: d5baad86d889077e3d4d47e1d6169867'
            ),
        ));

        $response = curl_exec($curl);

        // Check for errors
        if (curl_errno($curl)) {
            echo 'Error:' . curl_error($curl);
        } else {
            echo $response;
        }

        curl_close($curl);
    }

    // Route::get('/fileshow/{filename}', function ($filename) {
    //     $filefound = FileUpload::where('storage_name', $filename)->value('original_name');
    //     $filePath = storage_path('app/uploads/' . $filefound);
    //     if (file_exists($filePath)) {
    //         return response()->file($filePath);
    //     } else {
    //         abort(404, 'File not found');
    //     }
    // });
}
