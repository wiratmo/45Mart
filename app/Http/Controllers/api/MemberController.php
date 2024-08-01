<?php

namespace App\Http\Controllers\api;

use App\Exceptions\InputException;
use App\Http\Controllers\Controller;
use App\Http\Requests\DetailUserRequest;
use App\Http\Services\UserServices;
use App\Http\Validations\UserValidation;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $res = User::all();
            return response()->json([
                'success' => true,
                'message' => 'get all data',
                'data' => $res
            ],200);
        } catch (QueryException $th) {
            return response()->json([
                'success' => false,
                'message' => 'Query cant execute',
                'error' => $th->errorInfo[2]
            ],500);
        }
    }

    public function store(UserValidation $validation, DetailUserRequest $request, UserServices $services): JsonResponse
    {
        try {
            $req = $validation->valid($request);
            $res = $services->completedUserData($req);
            return response()->json([
                'success' => true,
                'message' => "Detail Data User succesfully updated",
            ],201);
        } catch (InputException $th) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Errors',
                'error' => $th->getMessages()
            ],400);
        } catch (QueryException $th) {
            return response()->json([
                'success' => false,
                'message' => 'Query cant execute',
                'error' => $th->errorInfo[2]
            ],400);
        } catch (\Exception $th) {
            return response()->json([
                'success'=> false,
                'message' => $th
            ], 500);
        }
    }
}
