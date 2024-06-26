<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // $courses = Course::all(); // get all courses
        // $courses = Course::onlyTrashed()->get(); // get only trashed courses
        // $courses = Course::withTrashed()->get(); // get all courses including trashed courses
        $courses = Course::withTrashed()->get();
        if ($courses->isEmpty()) {
            return response()->json([
                'message' => 'No courses found'
            ]);
        }
        return response()->json([
            'courses' => $courses,
            'message' => 'Retrieved successfully'
        ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $validatedData = $request->validated();
        
        if ($request->hasFile('image') && $request->file('image')){
            $imagePath = $request->file('image')->store('public/uploads');
            $imagePath = str_replace('public/', '', $imagePath);
        } 
        else {
            $imagePath = null;
        }
        $course = Course::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'image' => $imagePath,
            'price' => $validatedData['price'],
            'type' => $validatedData['type']
        ]);
        return response()->json([
            'course' => $course,
            'message' => 'Course created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ]);
        }
        return response()->json([
            'course' => $course,
            'message' => 'Retrieved successfully'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateData(CourseRequest $request, string $id)
    {
        
        $validatedData = $request->validated();

        $course = Course::find($id);
        $course->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'type' => $validatedData['type']
        ]);
        if ($request->hasFile('image') && $request->file('image')) {
            $imagePath = $request->file('image')->store('public/uploads');
            $imagePath = str_replace('public/', '', $imagePath);
            $course->update([
                'image' => $imagePath
            ]);
        } else {
            $imagePath = null;
        }
        return response()->json([
            'course' => $course,
            'message' => 'Course updated successfully'
        ]);
        
    }


    public function destroy(string $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ]);
        }
        $course->delete();
        return response()->json([
            'message' => 'Course deleted successfully'
        ]);
    }
    public function restore(string $id)
    {
        $course = Course::withTrashed()->find($id);
        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ]);
        }
        $course->restore();
        return response()->json([
            'message' => 'Course restored successfully'
        ]);
    }
    public function DeleteAndRestore(string $id)
    {
        $course = Course::withTrashed()->find($id);
        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ]);
        }
        if ($course->trashed()) {
            $course->restore();
            return response()->json([
                'message' => 'Course restored successfully'
            ]);
        }
        $course->delete();
        return response()->json([
            'message' => 'Course deleted successfully'
        ]);
    }
    
}
