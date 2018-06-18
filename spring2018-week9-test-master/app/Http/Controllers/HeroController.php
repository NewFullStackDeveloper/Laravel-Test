<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeroController extends Controller
{
    //
    public function show($hero_slug)
    {
        $hero = \App\Hero::where('slug', $hero_slug)->first();

        if (!$hero) {
            abort(404, 'Hero not found');
        }

        $view = view('hero/show');
        $view->hero = $hero;
        return $view;
    }

    public function index()
    {
        // select all heroes from table ordered by id, there is no name column and ASC
        $heroes = \App\Hero::orderBy('hero_id','ASC')->get();
        
        // prepare the view
        $view = view('/hero/index');
        
        // insert the selected heroes into the view
        $view->heroes = $heroes;
        
        // return the view
        return $view;
    }
}
