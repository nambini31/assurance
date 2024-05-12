<?php

namespace App\Controllers\menuiserie\gestion;

use App\Controllers\BaseController;
use App\Models\menuiserie\gestion\CategorieModel;

class GestionCont extends BaseController
{
    public function index()
    {
        return view('menuiserie/gestion/index');
    }
}
