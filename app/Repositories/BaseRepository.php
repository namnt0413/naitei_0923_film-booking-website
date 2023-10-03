<?php

namespace App\Repositories;

interface BaseRepository
{
    public function getAll();
    public function getOne($id);
    public function insert($data);
    public function update($model, $data);
    public function delete($model);
}
