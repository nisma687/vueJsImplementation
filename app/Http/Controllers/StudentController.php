<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Requests\UserRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $students = Student::all();
        
        return response()->json([
            'students' => $students,
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
    public function store(UserRequest $request)
    {
        $validatedData=$request->validated();
        $password=bcrypt($validatedData['password']);
        $user=User::create([
            'name'=>$validatedData['name'],
            'email'=>$validatedData['email'],
            'password'=>$password
        ]);
        return response()->json($user,201);
        
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            $token = JWTAuth::attempt($credentials);
            if (!$token) {
                return response()->json(['error' => 'Invalid Credentials'], 400);
            }
           
        } 
        catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
        return response()->json(['token' => $token], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
