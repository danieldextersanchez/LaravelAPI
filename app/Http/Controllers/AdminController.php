<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Http\Resources\Admin as AdminResource;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
  
    public function index()
    {
        $admin = Admin::paginate(15);
        return AdminResource::collection($admin);
    }

 

    public function store(Request $request)
    {    
        $request->validate([
            'username' => 'required|string|unique:admin',
            'email' => 'required|string|email|unique:admin',
            'password' => 'required|string'
        ]);
           try{
            DB::table('admin')->insert(
                [
                    'username' => $request->username,
                    'email' => $request->email, 
                    'password' => bcrypt($request->password),
                    'created_at'  => $current_time = Carbon::now()->toDateTimeString(),
                    'updated_at'  => $current_time = Carbon::now()->toDateTimeString()
                ]
            );
            return response()->json([
                'message' => 'Successfully created user!'
            ], 201);
           }catch(\Illuminate\Database\QueryException $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 409);
           }
    }

    public function show($id)
    {
        $article =  Admin::findOrFail($id);
        return new AdminResource($article);
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['username', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function signedinuser(Request $request)
    {
        return response()->json($request->user());
    }
    
}
