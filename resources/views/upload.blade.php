<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Course Files</title>
</head>
<body>

    <h2>Upload Course Video & PDF</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <label for="title">Course Title:</label>
        <input type="text" name="title" required>
        <br><br>

        <label for="video">Upload Video (MP4, AVI, MOV - Max: 50MB):</label>
        <input type="file" name="video" accept="video/*">
        <br><br>

        <label for="pdf">Upload PDF (Max: 10MB):</label>
        <input type="file" name="pdf" accept="application/pdf">
        <br><br>

        <button type="submit">Upload</button>
    </form>

</body>
</html>
