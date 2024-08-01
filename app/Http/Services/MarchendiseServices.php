<?php

namespace App\Http\Services;

use App\Http\Requests\MarchendiseRequest;
use App\Models\Marchendise;

class MarchendiseServices
{
    public function storeNewMarchendise(MarchendiseRequest $request)
    {
        $Marchendise = $request->all();
        $Marchendise['employee_id'] = $request->user()?->id;
        $data = Marchendise::create($Marchendise);
        $res['name'] = $data->name;

        return $res;
    }

    public function showMarchendiseDetail($id)
    {
        $Marchendise = Marchendise::findOrFail($id);

        return $Marchendise;
    }

    public function update(MarchendiseRequest $request, $id)
    {
        $data = Marchendise::findOrFail($id);
        $data->name = $request->name;
        $data->date_start = $request->date_start;
        $data->date_end = $request->date_end;
        $data->quota = $request->quota;
        $data->point = $request->point;
        $data->employee_id = $request->user()?->id;
        $data->save();

        return true;
    }

    public function delete($id)
    {
        $data = Marchendise::findOrFail($id);
        $data->delete();

        return true;
    }
}
