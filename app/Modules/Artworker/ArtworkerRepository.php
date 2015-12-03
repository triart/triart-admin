<?php
namespace App\Modules\Artworker;

use App\Models\Artworker;
use App\Modules\CrudContract;

class ArtworkerRepository implements CrudContract
{
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

    public function delete($model)
    {
        return $model->delete();
    }
}