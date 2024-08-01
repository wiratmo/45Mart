<?php

namespace App\Http\Controllers\api;

use App\Exceptions\InputException;
use App\Exceptions\NotFoundDataWithIdException;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberPointRequest;
use App\Http\Services\MemberPointServices;
use App\Http\Validations\MemberPointValidation;
use App\Models\MemberPoint;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class MemberPointController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $res = MemberPoint::all();
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

    public function show(MemberPointServices $services, MemberPointValidation $validation, $id)
    {
        try {
            $req = $validation->idIsNumber($id);
            $res = $services->showMemberPointDetail($req);
            return response()->json([
                'success' => true,
                'message' => 'Detail Marchendise Data',
                'data' => $res
            ],200);
        } catch (NotFoundDataWithIdException $th) {
            return response()->json([
                'success' => false,
                'message' => 'data not found',
            ], 404);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                'success' => false,
                'message' => 'data not found'
            ],404);
        } catch (Throwable $th){
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function store(MemberPointServices $services, MemberPointValidation $validation, MemberPointRequest $request): JsonResponse
    {
        try {
            $req = $validation->valid($request);
            $services->storeNewMemberPoint($req);
            return response()->json([
                'success' => true,
                'message' => "Member Point succesfully created{}"
            ],201);
        } catch (InputException $th) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Errors',
                'error' => $th->getMessages()
            ],400);
        } catch (QueryException $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Query cant execute',
                'error' => $th->errorInfo[2]
            ],400);
        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json([
                'success'=> false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
