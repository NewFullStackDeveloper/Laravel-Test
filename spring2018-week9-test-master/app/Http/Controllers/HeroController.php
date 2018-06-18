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

//LAst question:
    public function create()
    {
        
        $hero= new Hero();

        $view = view('hero/create');
        $view->hero = $hero;
        return $view;
    }

    public function store(Request $request, $id = null)
    {
        $this->validate($request, [
            'description' => 'required|min:10',
            'subject' => 'required'
        ]);

        if ($hero) {
            $hero = Hero::findOrFail($id);
        } else {
            $hero = new Hero();
        }        

        $hero->fill([
            'description' => $request->input('description'),
            'subject' => $request->input('subject')
        ]);

        // save the hero into the database (
        $hero->save();

        // flash a success message
        session()->flash('success_message', 'Success!');
 
        // redirect to detail of hero using the AutoIncremented id
        return redirect()->action('HeroController@edit', ['id' => $hero->id]);
    }
}
