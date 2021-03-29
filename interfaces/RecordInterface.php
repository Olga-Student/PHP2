<?php

namespace app\interfaces;

interface RecordInterface
{
    public static function getAll(array $ids = []);

    public static function getById($id);

    public function delete();

    public static function getTableName();

}