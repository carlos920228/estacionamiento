<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estacionamiento;
use App\Models\Entradas;
use App\Models\Costos;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
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
      $ingresos=Entradas::join('estacionamientos', 'entradas.estacionamientos_id', '=', 'estacionamientos.id')
      ->groupBy('estacionamientos.nombre')
      ->whereDate('salida', $hoy)
      ->select('estacionamientos.nombre', DB::raw('SUM(total) as total'))
      ->get();

      //echo $ingresos;
      return Inertia::render('Ingresos',['ingresos'=>$ingresos]);
    }
    public function vehiculos(){
      $carbon = new \Carbon\Carbon();
      $hoy=$carbon->now()->toDateString();
      $ingresos2=Entradas::join('estacionamientos', 'entradas.estacionamientos_id', '=', 'estacionamientos.id')
      ->groupBy("entradas.tipo",'estacionamientos.nombre')
      ->whereDate('salida', $hoy)
      ->select('estacionamientos.nombre','entradas.tipo', DB::raw('Count(tipo) as total'))
      ->orderBy('estacionamientos.nombre')->get();
      $estacionamientos=estacionamiento::where('activo','Sí')->get();
      $moto=[];
      $carro=[];
      $camioneta=[];
      $tipo=['Camioneta','Coche','Moto'];
      foreach($tipo as $key => $value2) {
          foreach ($estacionamientos as $key => $value) {
              $ingresos=Entradas::whereDate('salida', $hoy)
              ->where([
                'estacionamientos_id' =>$value['id'],
                'tipo' => $value2])->get()->count();
              switch($value2){
                case('Moto'):
                array_push($moto,$ingresos);
                break;
                case('Coche'):
                array_push($carro,$ingresos);
                break;
                case('Camioneta'):
                array_push($camioneta,$ingresos);
                break;
                default:
                break;
              }
          }
    }
      return Inertia::render('Vehiculos',['vehiculos'=>$ingresos2,'estacionamientos'=>$estacionamientos,'camioneta'=>$camioneta
      ,'coche'=>$carro,'moto'=>$moto]);
    }
    public function hora(){
      $carbon = new \Carbon\Carbon();
      $hoy=$carbon->now()->toDateString();
      $estacionamientos=estacionamiento::where('activo','Sí')->get();
      $horas=['00','01','02','03','04','05','06','07','08','09','10',
      '11','12','13','14','15','16','17','18','19','20','21','22','23','24'];
      
      $ocupacion=[];
      foreach($horas as $key => $hour){
      foreach ($estacionamientos as $key => $value) {
        $ingresos2=DB::table('entradas')
      ->whereDate('salida', $hoy)
      ->where('estacionamientos_id',$value['id'])
      ->select(DB::raw('DATE_FORMAT(salida,"%H") as hora,count(*) as total'))
      ->groupBy('hora')->get();
      array_push($ocupacion,$ingresos2);
    }
  }
    return Inertia::render('Hora',['estacionamientos'=>$estacionamientos]);

    }
}
