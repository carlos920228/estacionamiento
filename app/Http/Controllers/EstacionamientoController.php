<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estacionamiento;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
class EstacionamientoController extends Controller
{

    public function index()
    {
      $estacionamiento=estacionamiento::all();
      return Inertia::render('Mostrar',['estacionamientos'=>$estacionamiento]);
    }


    public function create()
    {
      return Inertia::render('Crear');
    }


    public function store(Request $request)
    {
          $request->validate([
            'nombre'=>'required|max:255'
          ]);
          estacionamiento::create($request->all());
          return Redirect::route('estacionamiento.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $estacionamiento=estacionamiento::findOrFail($id);
        
        return Inertia::render('Editar',['estacionamiento'=>$estacionamiento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'nombre'=>'required|max:255'
      ]);
      $estacionamiento=estacionamiento::findOrFail($id);
      $estacionamiento->update($request->all());
      return Redirect::route('estacionamiento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estacionamiento=estacionamiento::findOrFail($id);
        $estacionamiento->activo="No";
        $estacionamiento->save();
        return Redirect::route('estacionamiento.index');
    }
  
}
