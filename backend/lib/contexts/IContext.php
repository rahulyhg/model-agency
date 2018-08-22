<?php

namespace backend\lib\contexts;


interface IContext
{
    public function getMap();
    public function getName($id);
    public function canDelete($id, &$error);
}