<?php

namespace App\Interfaces;

interface BaseRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($model, array $data);
    public function delete($id);
}
