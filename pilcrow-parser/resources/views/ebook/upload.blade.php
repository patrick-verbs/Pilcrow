<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload EPUB File</title>
</head>
<body>
    <form action="{{  url('/show-epub') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="epub_file" required>
        <button type="submit">Upload EPUB</button>
    </form>
</body>
</html>