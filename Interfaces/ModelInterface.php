<?php


interface ModelInterface
{
    public function getAll();

    public function getById($id);

    public function delete($id);

    public function getTableName();

}