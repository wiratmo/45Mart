<?php

namespace App\Http\Controllers\api;

use App\Exceptions\InputException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Services\UserServices;
use App\Http\Validations\UserValidation;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View{

        return view('components.user.login');
    }

    public function register(UserRegisterRequest $request, UserValidation $userValidation, UserServices $userService):JsonResponse{

        try {
            $req = $userValidation->valid($request);
            $res = $userService->storeNewUser($req);
            return response()->json([
                'success' => true,
                'message' => 'User is created',
                'data' => $res
            ], 201);
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
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login(UserLoginRequest $request, UserValidation $userValidation, UserServices $userService): JsonResponse{

        try {
            $req = $userValidation->valid($request);
            $res = $userService->loginUser($req);
            return response()->json([
                'success' => true,
                'message' => 'User Berhasil Login',
                'data' => $res
            ], 200);

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
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


}
