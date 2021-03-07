<?php

namespace app\interfaces;

interface ModelInterface
{
    public function getAll();

    public function getById($id);

    public function delete();

    public function getTableName();

    public function apDate();

    public function insert();
}