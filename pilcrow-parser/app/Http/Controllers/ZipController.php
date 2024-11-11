<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;

class ZipController extends Controller
{
    public function readZipFile(Request $request)
    {
        $zipPath = $request->file('zip_file')->getRealPath();

        $zip = new ZipArchive;
        if ($zip->open($zipPath) === TRUE) {
            $fileNames = [];
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileNames[] = $zip->getNameIndex($i);
            }
            $zip->close();
            return response()->json($fileNames);
        } else {
            return response()->json(['error' => 'Failed to open ZIP file'], 500);
        }
    }
}