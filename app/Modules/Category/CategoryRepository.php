<?php
namespace App\Modules\Category;

use App\Models\Category;
use App\Modules\CrudContract;

class CategoryRepository implements CrudContract
{
    public function getList($num = null)
    {
        $query = Category::orderBy('name', 'asc');
        return !empty($num) ? $query->simplePaginate($num) : $query->get();
    }

    public function findById($id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        $category = new Category();
        $category->name = $data['name'];

        if (!$category->save()) {
            return false;
        }

        return $category;
    }

    public function update($model, array $data)
    {
        $category = new Category();
        $category->name = $data['name'];

        if (!$category->save()) {
            return false;
        }

        return $category;
    }

    public function delete($model)
    {
        return $model->delete();
    }
}