<?php

namespace App\Http\Controllers;

use App\Models\StudentCourse;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentCourses = StudentCourse::all();
        if ($studentCourses->isEmpty()) {
            return response()->json([
                'message' => 'No student courses found'
            ]);
        }
        return response()->json([
            'studentCourses' => $studentCourses,
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required',
            'course_id' => 'required'
        ]);
        $studentCourse = StudentCourse::create($validatedData);
        return response()->json([
            'studentCourse' => $studentCourse,
            'message' => 'Student course created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $studentCourse = StudentCourse::find($id);
        if (!$studentCourse) {
            return response()->json([
                'message' => 'Student course not found'
            ]);
        }
        return response()->json([
            'studentCourse' => $studentCourse,
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getStudentCourses(string $id)
    {
        $studentCourses = StudentCourse::with('course', 'student')
            ->where('student_id', $id)->get();
        
        if ($studentCourses->isEmpty()) {
            return response()->json([
                'message' => 'No student courses found for the given student',
            ], 404);
        }

        return response()->json([
            'studentCourses' => $studentCourses,
            'message' => 'Student courses retrieved successfully',
        ]);
    }
}
