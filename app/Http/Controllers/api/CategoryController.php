<?php

namespace App\Http\Controllers\api;

use App\Exceptions\InputException;
use App\Exceptions\NotFoundDataWithIdException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryServices;
use App\Http\Validations\CategoryValidation;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Throwable;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $res = Category::all();
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
    public function store(CategoryValidation $categoryValidation, CategoryRequest $request, CategoryServices $services): JsonResponse
    {
        try {
            $req = $categoryValidation->valid($request);
            $res = $services->storeNewCategory($req);
            return response()->json([
                'success' => true,
                'message' => "Category {$res['name']} with point criteria {$res['point_criteria']} succesfully created",
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
    public function show(CategoryServices $services, CategoryValidation $categoryValidation, $id): JsonResponse
    {
        try {
            $req = $categoryValidation->idIsNumber($id);
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

    public function update(CategoryServices $services, CategoryValidation $categoryValidation, CategoryRequest $request, $id)
    {
        try {
            $id = $categoryValidation->idIsNumber($id);
            $req = $categoryValidation->valid($request);
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

    public function delete(CategoryServices $services, CategoryValidation $categoryValidation, $id)
    {
        try {
            $id = $categoryValidation->idIsNumber($id);
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
