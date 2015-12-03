<?php
namespace App\Modules;

interface CrudContract
{
    public function getList($num = null);
    public function findById($id);
    public function create(array $data);
    public function update($model, array $data);
    public function delete($model);
}
