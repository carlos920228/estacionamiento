<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estacionamiento;
use App\Models\Entradas;
use App\Models\Costos;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
class EntradasController extends Controller
{
    public function index()
    {
      $entradas=Entradas::where('total',null)->get();
      return Inertia::render('MostrarEntradas',['entradas'=>$entradas]);
    }


    public function create()
    {
    $estacionamiento=estacionamiento::where('activo','Sí')->get();
    $costos=Costos::all();
      return Inertia::render('CrearEntrada',['estacionamientos'=>$estacionamiento, 'costos'=>$costos]);
    }

    public function store(Request $request)
    {
          $carbon = new \Carbon\Carbon();
          $request['entrada']=$carbon->now();
          
          Entradas::create($request->all());
          return Redirect::route('entradas.index');
    }


    public function show($id)
    {
        
    }


    public function edit($id)
    {
        $entradas=Entradas::findOrFail($id);
        $carbon = new \Carbon\Carbon();
          $entradas['salida']=$carbon->now()->toDateTimeString();
          $en=new \Carbon\Carbon($entradas->entrada);
          $sa=new \Carbon\Carbon($entradas->salida);
          $horasCobrar = $en->diffInMinutes($sa);
          if($horasCobrar<60){
              $entradas['total']=$entradas->costo;
          }else{
              
              $entradas['total']=ceil($horasCobrar/60)*$entradas->costo;
          }
          
        return Inertia::render('EditarEntrada',['entradas'=>$entradas]);
    }

    public function update(Request $request, $id)
    {
      
      $entrada=Entradas::findOrFail($id);
      $entrada->update($request->all());
      $entrada->save();
      return Redirect::route('entradas.index');
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
    public function ingresos(){
      $carbon = new \Carbon\Carbon();
      $hoy=$carbon->now()->toDateString();
      $ingresos=Entradas::groupBy('estacionamientos_id')
      ->whereDate('salida', $hoy)
      ->selectRaw('estacionamientos_id, sum(total) as total')
      ->get();
      //echo $ingresos;
      return Inertia::render('Ingresos',['ingresos'=>$ingresos]);
    }
}
