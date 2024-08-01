<?php

namespace App\Http\Services;

use App\Http\Requests\DetailUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    public function storeNewUser(UserRegisterRequest $request)
    {
        $user = $request->all();
        $user['password'] = Hash::make($user['password']);
        $data = User::create($user);
        $res['token'] = $data->createToken('API_TOKEN')->plainTextToken;
        $res['name'] = $data->name;

        return $res;
    }

    public function loginUser(UserLoginRequest $request)
    {
        Auth::attempt($request->only(['email', 'password']));
        $user = Auth::user();
        $res['token'] = $user->createToken("API_TOKEN")->plainTextToken;
        $res['name'] = $user->name;

        return $res;
    }

    public function completedUserData(DetailUserRequest $request)
    {
        $id = $request->user()->id;
        $data = User::findOrFail($id);
        $data->dob = $request->dob;
        $data->gender = $request->gender;
        $data->identity_type = $request->indentity_type;
        $data->identity_number = $request->identity_number;
        $data->address = $request->address;
        $data->phone = $request->phone;

        $data->save();
    }
}
