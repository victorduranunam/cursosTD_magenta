<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Division;
class DivisionController extends Controller
{
    //Prueba -> Funciona!
    public function index()
    {
        $users = Division::all()->first();
        return view("pages.home")
            ->with("users",$users)
            ->with("warning", '1');
    }

}
