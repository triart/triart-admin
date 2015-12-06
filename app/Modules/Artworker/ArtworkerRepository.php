<?php
namespace App\Modules\Artworker;

use App\Models\Artworker;
use App\Modules\CrudContract;

class ArtworkerRepository implements CrudContract
{
    public function search($q = '')
    {
        $query = Artworker::where('username','LIKE', '%'.$q.'%')->orWhere('name','LIKE', '%'.$q.'%');
        return !empty($num) ? $query->simplePaginate($num) : $query->get();
    }

    public function getList($num = null)
    {
        $query = Artworker::orderBy('name', 'asc');
        return !empty($num) ? $query->simplePaginate($num) : $query->get();
    }

    public function findById($id)
    {
        return Artworker::find($id);
    }

    public function create(array $data)
    {
        $artworker = new Artworker();
        $artworker->username = $data['username'];
        $artworker->name = $data['name'];
        $artworker->profile_picture = $data['profile_picture'];
        $artworker->description = $data['description'];
        $artworker->location = $data['location'];

        if (!$artworker->save()) {
            return false;
        }

        return $artworker;
    }

    public function update($model, array $data)
    {
        $model->username = $data['username'];
        $model->name = $data['name'];
        $model->profile_picture = $data['profile_picture'];
        $model->description = $data['description'];
        $model->location = $data['location'];

        if (!$model->save()) {
            return false;
        }

        return $model;
    }

    public function delete($model)
    {
        return $model->delete();
    }
}