<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Tymon\JWTAuth\Exceptions\JWTException;
// use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $users = User::all();
        
        return response()->json([
            'users' => $users,
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
    

     public function store(Request $request){}
    public function register(UserRequest $request)
{
    $validatedData = $request->validated();
    if ($request->hasFile('profile_picture')) {
        
        $profilePicturePath = $request->file('profile_picture')->store('public/uploads');
      
        $profilePicturePath = str_replace('public/', '', $profilePicturePath);
    } else {
        $profilePicturePath = null;
    }

    $password = bcrypt($validatedData['password']);
    
 
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => $password,
        'profile_picture' => $profilePicturePath,
    ]);

    return response()->json($user, 201);
}

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            $token = Auth::attempt($credentials);
          
            if (!$token) {
                return response()->json(['error' => 'Invalid Credentials'], 400);
            }
           
        } 
        catch (Exception $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
        $user = Auth::user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
    }
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function getCurrentUser()
    {
        $user = Auth::user();
        return response()->json($user);
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
    public function updateData(UserRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $user = User::find($id);
        $user->update($validatedData);
        return response()->json([
            'user' => $user,
            'message' => 'User updated successfully'
        
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
