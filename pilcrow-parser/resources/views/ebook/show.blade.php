<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPUB Content</title>
    <style>
        {!!  $stylesheetContent !!}
    </style>
</head>
<body>
    {!! $b64_titlepageContent = base64_encode("<html>\n<body>\n<p>Hello!</p>\n</body>\n</html>") !!}
    {!! $dataUrl = 'data:text/html;base64,' . $b64_titlepageContent !!}
    <iframe src="{{ $dataUrl }}" width="100%" height="500px"></iframe>
    {{-- <div class="epub-content"> --}}
        
        {!! dd(base64_decode($b64_titlepageContent)) !!}
    {{-- </div> --}}
</body>
</html>