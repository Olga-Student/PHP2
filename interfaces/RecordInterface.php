<?php

namespace app\interfaces;

interface RecordInterface
{
    public static function getAll();

    public static function getById($id);

    public function delete();

    public static function getTableName();

    public function apDate();

    public function insert();
}