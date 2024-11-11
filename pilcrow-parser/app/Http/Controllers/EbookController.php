<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;

class EbookController extends Controller
{
    public function show(Request $request)
    {
        $zipPath = $request->file('epub_file')->getRealPath();
        $zip = new ZipArchive;

        if ($zip->open($zipPath) === TRUE) {
            // Extract the content of XHTML doc
            $titlepageContent = $zip->getFromName('titlepage.xhtml');
            $stylesheetContent = $zip->getFromName('stylesheet1.css');
            $zip->close();

            return view('ebook.show', [
                'titlepageContent' => $titlepageContent,
                'stylesheetContent' => $stylesheetContent,
            ]);
        } else {
            return response()->json(['error' => 'Failed to open EPUB file'], 500);
        }
    }
}
