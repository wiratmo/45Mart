<?php

namespace App\Http\Services;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryServices
{
    public function storeNewCategory(CategoryRequest $request)
    {
        $category = $request->all();
        $category['employee_id'] = $request->user()?->id;
        $data = Category::create($category);
        $res['name'] = $data->name;
        $res['point_criteria'] = $data->point_criteria;

        return $res;
    }

    public function showCategoryDetail($id)
    {
        $category = Category::findOrFail($id);

        return $category;
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = Category::findOrFail($id);
        $data->name = $request->name;
        $data->point_criteria = $request->point_criteria;
        $data->employee_id = $request->user()?->id;
        $data->save();

        return true;
    }

    public function delete($id)
    {
        $data = Category::findOrFail($id);
        $data->delete();

        return true;
    }
}
