<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResidueType;
use App\Pin;
use JavaScript;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $residue_types = ResidueType::all()->sortBy('name');
        return view('index', compact('residue_types'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMap()
    {
        $pins = Pin::where('collected', false)->with('location')->get();
        $residue_types = ResidueType::all()->sortBy('name');

        JavaScript::put([
            'pins' => $pins
        ]);

        return view('map', compact('residue_types'));
    }
}
