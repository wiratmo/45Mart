<?php
namespace App\Http\Services;

use App\Http\Requests\StoreRequest;
use App\Models\Store;

class StoreServices
{
    public function storeNewCategory(StoreRequest $request)
    {
        $category = $request->all();
        $category['employee_id'] = $request->user()?->id;
        $data = Store::create($category);
        $res['name'] = $data->name;
        $res['category_id'] = $data->category_id;

        return $res;
    }

    public function showCategoryDetail($id)
    {
        $category = Store::findOrFail($id);

        return $category;
    }

    public function update(StoreRequest $request, $id)
    {
        $data = Store::findOrFail($id);
        $data->category_id = $request->category_id;
        $data->name = $request->name;
        $data->floor_position = $request->floor_position;
        $data->store_position = $request->store_position;
        $data->employee_id = $request->user()?->id;
        $data->save();

        return true;
    }

    public function delete($id)
    {
        $data = Store::findOrFail($id);
        $data->delete();

        return true;
    }
}
