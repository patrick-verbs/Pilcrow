<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read ZIP File Contents</title>
    <!-- Include JSZip Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
</head>
<body>
    <h1>Select an EPUB File to Read</h1>
    <input type="file" id="epubFileInput" accept=".zip,.epub">
    <div id="epubContent"></div>

    <h2>EPUB Content</h2>
    {{-- @foreach($xhtmlFiles as $xhtml)
    <div>
        {!! $xhtml !!}
    </div>
    @endforeach --}}

    <h2>File List</h2>
    <ul id="fileList"></ul>

    <script>
        document.getElementById('epubFileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const arrayBuffer = e.target.result;
                    JSZip.loadAsync(arrayBuffer).then(function(zip) {
                        const epubContent = document.getElementById('epubContent');
                        epubContent.innerHTML = ''; // Clear previous content

                        const imageMap = {};

                        // Extract and process all files
                        const filePromises = [];
                        zip.forEach(function (relativePath, zipEntry) {
                            if (zipEntry.name.match(/\.(jpeg|jpg|png|gif)$/)) {
                                // Handle image files
                                const promise = zipEntry.async('blob').then(function(blob) {
                                    const url = URL.createObjectURL(blob);
                                    imageMap[zipEntry.name] = url;
                                });
                                filePromises.push(promise);
                            }
                        });

                        // Process XHTML files after images have been processed
                        Promise.all(filePromises).then(function() {
                            zip.forEach(function (relativePath, zipEntry) {
                                if (zipEntry.name.match(/\.(xhtml|html|htm)$/)) {
                                // if (zipEntry.name.endsWith('.xhtml' || '.htm')) {
                                    zipEntry.async('string').then(function(content) {
                                        // Replace image src attributes with Blob URLs
                                        Object.keys(imageMap).forEach(function(imageName) {
                                            const regex = new RegExp(imageName, 'g');
                                            content = content.replace(regex, imageMap[imageName]);
                                        });

                                        const div = document.createElement('div');
                                        div.innerHTML = content;
                                        epubContent.appendChild(div);
                                    });
                                }
                            });
                        });
                    }).catch(function(err) {
                        console.error("Failed to read EPUB file:", err);
                    });
                };
                reader.readAsArrayBuffer(file);
            }
        });
    </script>
    {{-- <script>
        document.getElementById('epubFileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const arrayBuffer = e.target.result;
                    JSZip.loadAsync(arrayBuffer).then(function(zip) {
                        const fileList = document.getElementById('fileList');
                        fileList.innerHTML = ''; // Clear the list
                        zip.forEach(function (relativePath, zipEntry) {
                            const li = document.createElement('li');
                            li.textContent = zipEntry.name;

                            zipEntry.async('text').then(function(content) {
                                const pre = document.createElement('pre');
                                pre.textContent = content;
                                li.appendChild(pre);
                            });

                            fileList.appendChild(li);
                        });
                    }, function (e) {
                        console.error("Error reading zip file:", e);
                    });
                };
                reader.readAsArrayBuffer(file);
            }
        });
    </script> --}}
</body>
</html>
