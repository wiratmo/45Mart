<?php

namespace App\Http\Validations;

use App\Exceptions\InputException;
use App\Exceptions\NotFoundDataWithIdException;
use App\Http\Requests\MyRequest;

class MyValidation
{
    public function valid(MyRequest $request){
        $validate = $request->validator;

        if($validate->fails()){
            throw new InputException($validate->errors());
        }

        return $request;
    }

    public function idIsNumber($id){
        if(!preg_match('/^\d+$/',$id)){
            throw new NotFoundDataWithIdException("Data Not Found", 404);
        }
        return $id;
    }
}
