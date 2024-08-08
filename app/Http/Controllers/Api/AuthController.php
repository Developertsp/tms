<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($request->id),
            ],
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }

        try {
            $user = ($request->id) ? User::find($request->id) : new User();

            $isExistingUser = $user->exists;

            $user->name = $request->name;
            $user->email = $request->email;
            $user->scope = 2;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->created_by = 2;
            // $oldComPicPath = $user->com_pic;
            // $oldUserPicPath = $user->user_pic;

            // if ($request->hasFile('com_pic')) {
            //     if ($request->id && $oldComPicPath) {
            //         Storage::disk('public')->delete($oldComPicPath);
            //     }

            //     $comPic = $request->file('com_pic');
            //     $comPicPath = $comPic->store('com_pics', 'public');
            //     $user->com_pic = $comPicPath;
            // }

            // if ($request->hasFile('user_pic')) {
            //     if ($request->id && $oldUserPicPath) {
            //         Storage::disk('public')->delete($oldUserPicPath);
            //     }

            //     $userPic = $request->file('user_pic');
            //     $userPicPath = $userPic->store('user_pics', 'public');
            //     $user->user_pic = $userPicPath;
            // }

            $save = $user->save();

            $message = $isExistingUser ? 'User updated successfully' : 'User Register successfully';
            return response()->json(['status' => 'success', 'message' => $message, 'data' => $save]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error storing user', 'error' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()]);
        }

        try {

            $credentials = $request->only('email', 'password');
            $user = User::where('email', $credentials['email'])->first();

            if ($user) {
                if (Auth::attempt($credentials)) {
                    $token = $user->createToken('MyApp')->plainTextToken;
                    return response()->json(['status' => 'success', 'message' => 'User successfully logged in', 'token' => $token]);
                } else {
                    return response()->json(['status' => 'invalid', 'message' => 'Invalid Credentails or Contact to Admin']);
                }
            } else {
                return response()->json(['status' => 'invalid', 'message' => 'User does not exist'], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error retrieving users',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
