<?php

namespace App\Http\Controllers\lms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

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
    
    $allcoursesLists = Course::join('course_enrollments', 'courses.category_id', '=', 'course_enrollments.course_id')
    ->where('course_enrollments.user_id', Auth::user()->id)
    ->selectRaw('MIN(courses.id) as id, courses.name, courses.description,courses.category_id')
    ->groupBy('courses.name', 'courses.description','courses.category_id')
    ->orderByRaw('MIN(courses.id) DESC')
    ->get();

    return view('lms.allcourses',compact('allcoursesLists'));
}
public function coursesByid(Request $request,$id)
{
    try {
        // Decrypt the encrypted ID
        $decryptedId = Crypt::decrypt($id);
// echo $decryptedId;die;
        // Debugging output
        $decryptedId =explode('.',$decryptedId);
        $courseID=$decryptedId[0];
        $courseName=$decryptedId[1];
        $categoryId=$decryptedId[2];

        $courseLists=Course::where('name',$courseName)->where('category_id',$categoryId)->get();
    //    echo '<pre>'; print_r($courseList);
    //     die;
return view('lms.course',compact('courseLists'));
        // You can then use $decryptedId to fetch the course details
        // $course = Course::findOrFail($decryptedId);
        // return view('course_detail', compact('course'));
    } catch (\Exception $e) {
        // Handle decryption failure (e.g., invalid or tampered ID)
        return abort(404, 'Invalid ID');
    }
}
public function allCourseList(Request $request)
{
    $courseLists = Course::with('category')->orderBy('id', 'desc')->paginate(2);

    return view('lms.allCourseList',compact('courseLists'));
}
public function addCoursedata(Request $request)
{
    $validateData=$request->validate([
        'name'=>'required|string|max:255',
        'video_path'=> 'nullable|string|required_without:pdf_path',
        'pdf_path'=> 'nullable|string|required_without:video_path',
        'category_id'=>'required',
        'description'=>'required'
        // G/EgZ8men?e!F^2
    ]);
    try {
        $categoryId = Crypt::decrypt($validateData['category_id']);
    } catch (\Exception $e) {
        // Handle decryption failure (invalid/tampered data)
        return redirect()->back()->withErrors('Invalid category selection.');
    }

    $course = Course::create([
        'name'         => $validateData['name'],
        'video_path'   => $validateData['video_path'],
        'pdf_path'     => $validateData['pdf_path'],
        'category_id'  => $categoryId,
        'description'  => $validateData['description'],
    ]);
    // return redirect()->route('allCourseList')->with('success', 'Course added successfully!');
    // Session::flash('success', 'This is a message!'); 

    return   redirect('allCourseList')->with('success', 'Course added successfully!'); 

// print_r($request->all());die;
}
public function getCourses()
{
    $courses = Course::with('category')->select('id', 'name', 'video_path', 'pdf_path', 'category_id', 'description');
    
    return DataTables::of($courses)
        ->addColumn('category_name', function($course) {
            return $course->category->name;
        })
        ->rawColumns(['video_path', 'pdf_path'])
        ->make(true);
}
}
