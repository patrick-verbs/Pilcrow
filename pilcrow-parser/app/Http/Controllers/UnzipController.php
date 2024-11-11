<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;

class UnzipController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function upload(Request $request){
        // dd($request->all());
        // dd($request->file('zip_file')->getRealPath());
        
        $zip = new ZipArchive();
        
        if ($zip->open($request->zip_file) === TRUE) {
            // To Do: check OS in case of formatting differences (e.g. carriage return vs. new line)
            // Build list of file names
            $fileNames = [];
            for ($i = 0; $i < $zip->numFiles; $i++) {
            // foreach ($fileNames as $file) {
                // $fileNames[] = $zip->getNameIndex($file);
                $fileNames[] = $zip->getNameIndex($i);
            }
            return response()->json($fileNames);
            
            // Extract contents
            // mkdir($dirName, 0777, true); BAD: macOS converts ".epub" directories into files
            $dirName = "uploads/{$request->zip_file->getClientOriginalName()}";
            $dirName = substr($dirName, -5, 5) === strtolower(".epub")
                ? substr($dirName, 0, strlen($dirName) - 5)
                : (substr($dirName, -4, 4) === strtolower(".zip")
                    ? substr($dirName, 0, strlen($dirName) - 4)
                    : $dirName);
            // TO DO: Refactor the above with regex? May not be more efficient.
            // See:
            //   https://www.php.net/manual/en/function.preg-match.php
            //   https://stackoverflow.com/questions/2305362/php-search-string-with-wildcards
            $zip->extractTo($dirName);

            // TO DO: Add simplified EPUB validation
            // For requirements, see: https://www.w3.org/TR/epub-33/#sec-container-file-and-dir-structure
            // Scope: For now, only implement enough validation to assist with actual text parsing

            $zip->close();

            return redirect()->back()->with('message', 'successfully uploaded');
        } else {
            // return response()->json(['error' => 'Failed to open ZIP file'], 500);
            return redirect()->back()->with('message', 'Failed to open ZIP file');
        }
    }

    public function show() {
        $files = scandir(('uploads/images'));
        return view('show', compact('files'));
    }
}
