<?php

namespace App\Http\Controllers\api;

use App\Exceptions\InputException;
use App\Exceptions\NotFoundDataWithIdException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Services\StoreServices;
use App\Http\Validations\StoreValidation;
use App\Models\Store;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class StoreController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $res = Store::all();
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
    public function store(StoreValidation $storeValidation, StoreRequest $request, StoreServices $services): JsonResponse
    {
        try {
            $req = $storeValidation->valid($request);
            $res = $services->storeNewCategory($req);
            return response()->json([
                'success' => true,
                'message' => "Store {$res['name']} succesfully created",
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
    public function show(StoreServices $services, StoreValidation $storeValidation, $id): JsonResponse
    {
        try {
            $req = $storeValidation->idIsNumber($id);
            $res = $services->showCategoryDetail($req);
            return response()->json([
                'success' => true,
                'message' => 'Detail Category Data',
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

    public function update(StoreServices $services, StoreValidation $storeValidation, StoreRequest $request, $id)
    {
        try {
            $id = $storeValidation->idIsNumber($id);
            $req = $storeValidation->valid($request);
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

    public function delete(StoreServices $services, StoreValidation $storeValidation, $id)
    {
        try {
            $id = $storeValidation->idIsNumber($id);
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
