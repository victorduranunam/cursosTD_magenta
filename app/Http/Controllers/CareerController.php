<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::all();
        return view("pages.view-career")
            ->with("careers",$careers);
    }
}
