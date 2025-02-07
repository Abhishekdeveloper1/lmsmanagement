<?php

namespace App\Http\Controllers\lms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
   

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'video' => 'nullable|mimes:mp4,mov,avi|max:51200', // 50MB max
        'pdf' => 'nullable|mimes:pdf|max:10240', // 10MB max
    ]);

    // Check and upload video if provided
    $videoPath = $request->hasFile('video') 
        ? $request->file('video')->store('videos', 'private')
        : null;

    // Check and upload pdf if provided
    $pdfPath = $request->hasFile('pdf') 
        ? $request->file('pdf')->store('pdfs', 'private')
        : null;

    // Store the course details with the paths
    Course::create([
        'name' => $request->title,
        'video_path' => $videoPath, // Will be null if no video is uploaded
        'pdf_path' => $pdfPath, // Will be null if no pdf is uploaded
        'category_id' => 3,
        'description' => 'xyz',
    ]);

    return back()->with('success', 'Course uploaded successfully!');
}

    public function store_1(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'video' => 'nullable|mimes:mp4,mov,avi|max:51200', // 50MB max
        'pdf' => 'nullable|mimes:pdf|max:10240', // 10MB max
    ]);

    $videoPath = $request->file('video') ? $request->file('video')->store('videos', 'private') : null;
    $pdfPath = $request->file('pdf') ? $request->file('pdf')->store('pdfs', 'private') : null;
// print_r($pdfPath);die;
dd([
    'videoPath' => $videoPath,
    'pdfPath' => $pdfPath,
]);
    Course::create([
        'name' => $request->title,
        // 'video_path' => $videoPath,
        // 'pdf_path' => $pdfPath,
        'video_path' => $videoPath ? storage_path("app/private/{$videoPath}") : null,
        'pdf_path' => $pdfPath ? storage_path("app/private/{$pdfPath}") : null,
    
        'category_id'=>3,
        'description'=>'xyz'
    ]);

    return back()->with('success', 'Course uploaded successfully!');
}

public function showPdfqqq($filename)
{
    // Path to the file stored in the 'private' disk
    $filePath = 'pdfs/' . $filename;

    // Check if the file exists in the 'private' disk
    if (Storage::disk('private')->exists($filePath)) {
        // return response()->file(Storage::disk('private')->path($filePath));
                return response()->file(Storage::disk('private')->path($filePath));
                // response()->file(Storage::disk('private')->path($filePath));

        $var= response()->file(Storage::disk('private')->path($filePath));
        // echo $var;die;

    }

    // Return a 404 response if the file doesn't exist
    abort(404, 'File not found.');
}
public function showPdf111111($filename)
{
    // Path to the file stored in the 'private' disk
    $filePath = 'pdfs/' . $filename;
// echo $filePath;die;
    // Check if the file exists in the 'private' disk
    if (Storage::disk('private')->exists($filePath)) {
        // Return a view and pass the file path to the view
        return view('showpdf', compact('filePath'));
    }

    // Return a 404 response if the file doesn't exist
    abort(404, 'File not found.');
}
public function listPdfs()
{
    // Get all courses that have a PDF file
    $courses = Course::whereNotNull('pdf_path')->get();

    return view('list', compact('courses'));
}

public function showPdfqqqqqqq($filename)
{
    $filePath = "pdfs/{$filename}";

    if (!Storage::disk('private')->exists($filePath)) {
        abort(404, 'File not found.');
    }

    return response()->file(Storage::disk('private')->path($filePath), [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . $filename . '"'
    ]);
}
public function showPdf($filename)
{
    $filePath = "pdfs/{$filename}";

    if (!Storage::disk('private')->exists($filePath)) {
        abort(404, 'File not found.');
    }

    return response()->file(Storage::disk('private')->path($filePath), [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline', // Ensures the file opens in the browser
        'X-Content-Type-Options' => 'nosniff', // Helps prevent download options
    ]);
}

public function allcourses(Request $request)
{

    return view('lms.allcourses');
}

}
