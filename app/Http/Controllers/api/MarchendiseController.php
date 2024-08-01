<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exceptions\InputException;
use App\Exceptions\NotFoundDataWithIdException;
use App\Http\Requests\MarchendiseRequest;
use App\Http\Services\MarchendiseServices;
use App\Http\Validations\MarchendiseValidation;
use App\Models\Marchendise;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Throwable;

class MarchendiseController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $res = Marchendise::all();
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
    public function store(MarchendiseValidation $MarchendiseValidation, MarchendiseRequest $request, MarchendiseServices $services): JsonResponse
    {
        try {
            $req = $MarchendiseValidation->valid($request);
            $res = $services->storeNewMarchendise($req);
            return response()->json([
                'success' => true,
                'message' => "Marchendise {$res['name']} succesfully created",
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
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function show(MarchendiseServices $services, MarchendiseValidation $MarchendiseValidation, $id): JsonResponse
    {
        try {
            $req = $MarchendiseValidation->idIsNumber($id);
            $res = $services->showMarchendiseDetail($req);
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

    public function update(MarchendiseServices $services, MarchendiseValidation $MarchendiseValidation, MarchendiseRequest $request, $id)
    {
        try {
            $id = $MarchendiseValidation->idIsNumber($id);
            $req = $MarchendiseValidation->valid($request);
            $services->update($req, $id);
            return response()->json([
                'success' => true,
                'message' => 'successfully updated'
            ]);
        } catch (NotFoundDataWithIdException $th) {
            return response()->json([
                'success' => false,
                'message' => 'data not found',
            ], 404);
        } catch (InputException $th) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Errors',
                'error' => $th->getMessages()
            ],400);
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

    public function delete(MarchendiseServices $services, MarchendiseValidation $MarchendiseValidation, $id)
    {
        try {
            $id = $MarchendiseValidation->idIsNumber($id);
            $services->delete($id);
            return response()->json([
                'success' => true,
                'message' => 'successfully updated'
            ]);
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
}
