<?php
namespace App\Module\Art;

use App\Models\Art;

class ArtRepository implements CrudContract
{
    public function getList($num = null)
    {
        $query = Art::orderBy('name', 'asc');
        return !empty($num) ? $query->paginate($num) : $query->get();
    }

    public function findById($id)
    {
        return Art::find($id);
    }

    public function create(array $data)
    {
        $art = new Art();
        $art->currency = $data['currency'];
        $art->price = $data['price'];
        $art->title = $data['title'];
        $art->description = $data['description'];
        $art->size = $data['size'];
        $art->image_url = $data['image_url'];
        $art->thumbnail_url = $data['thumbnail_url'];
        $art->sold = $data['sold'];

        if (!$art->save()) {
            return false;
        }

        return $art;
    }

    public function update($model, array $data)
    {
        $art->currency = $data['currency'];
        $art->price = $data['price'];
        $art->title = $data['title'];
        $art->description = $data['description'];
        $art->size = $data['size'];
        $art->image_url = $data['image_url'];
        $art->thumbnail_url = $data['thumbnail_url'];
        $art->sold = $data['sold'];

        if (!$art->save()) {
            return false;
        }

        return $art;
    }

    public function delete($model)
    {
        return $model->delete();
    }

}