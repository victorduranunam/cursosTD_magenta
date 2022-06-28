<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Division;
class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::all();
        return view("pages.view-divisions")
            ->with("divisions",$divisions)
            ->with("danger", 'Prueba de mensaje');
    }

}
