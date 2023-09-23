<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    
    public function index()
    { $sections=sections::all();
        return view('sections.sections',compact('sections'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description'=>'required'
        ],[

            'section_name.required' =>'le champs est vide',
            'description.required' =>'le champs est vide',
            'section_name.unique' =>'la section existe deja',
         ]);

            sections::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'Created_by' => (Auth::user()->name),

            ]);

            session()->flash('Add','la section est ajoute avec succée');
            return redirect('/sections');
        

        }

    
    public function show(sections $sections)
    {
        //
    }

    
    public function edit(sections $sections)
    {
        //
    }

    
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[

            'section_name.required' =>'le champs name est vide',
            'description.required' =>'le champs description est vide',
            'section_name.unique' =>'la section existe deja',

        ]);

        $sections = sections::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        session()->flash('edit','modifier avec succé');
        return redirect('/sections');
    }
    

   
    public function destroy(Request $request)
    {
        $id = $request->id;
        sections::find($id)->delete();
        session()->flash('delete','la section est supprimee');
        return redirect('/sections');
    }
}