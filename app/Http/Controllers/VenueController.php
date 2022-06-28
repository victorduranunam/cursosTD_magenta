<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::all();
        return view("pages.view-venues")
            ->with("venues",$venues);
    }
}
