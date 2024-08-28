<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salida;
use App\Models\Receta;
use App\Models\Producto;
use App\Models\Entrada;
use App\Models\lista_recetas_producto;

class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $Salida = Salida::all();
        $Receta = Receta::all();
        SalidaController::Recalcular_valor();
        return view('Salida',compact('Salida','Receta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_receta'=> 'required',
            'cantidad_recetas'=> 'required',
            'cantidad_porciones' => 'required|numeric'
        ]);

        $SalidaNew = new Salida();
        $Receta = Receta::findOrFail($request->id_receta);
        $Lista = lista_recetas_producto::all();
        $SalidaNew->id_receta = $request -> id_receta;
        $SalidaNew->nombre_receta = $Receta -> nombre;
        $SalidaNew->cantidad_recetas = $request -> cantidad_recetas;
        $SalidaNew->cantidad_porciones = $request -> cantidad_porciones;
        $SalidaNew->save();

        foreach($Lista as $ListaItem){
            if($ListaItem -> id_receta == $Receta -> id){
                $Producto = Producto::findorfail($ListaItem -> id_ingrediente);
                $Producto -> cantidad = $Producto -> cantidad - ($ListaItem ->cantidad_ingrediente * $SalidaNew->cantidad_recetas);
                $Producto -> valor_actual = $Producto -> cantidad * $Producto -> valor_unitario;
                $Producto->valor_unitario = $Producto -> valor / $Producto -> cantidad;
                $Producto -> save();
            }
        }


        SalidaController::Recalcular_valor();
        return back()->with('mensaje', 'Se genero la salida correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $SalidaEliminar = Salida::findOrFail($id);
        $SalidaEliminar->delete();
        
        return back()->with('mensaje', 'Salida eliminada');
    }

    public function Recalcular_valor()
    {
        $Entrada = Entrada::all();
        $Producto = Producto::all();
        // se debe sumar el valor de todas las entradas registradas hasta el momento con un producto en especifico

        foreach($Producto as $itemProducto)
        {
            $itemProducto -> valor = 0;
            $itemProducto->valor_unitario = 0;
            foreach($Entrada as $itemEntrada)
            {
                if($itemEntrada->id_producto == $itemProducto -> id)
                {
                    $itemProducto -> valor = $itemEntrada->valor + $itemProducto -> valor;
                }
            }
            if ($itemProducto->valor == 0)
            {
                $itemProducto->valor_unitario = 0;
            } 
            else
            {
                $itemProducto->valor_unitario = $itemProducto->valor / $itemProducto->cantidad_total ;
            }
            
            $itemProducto->valor_actual = $itemProducto->valor_unitario * $itemProducto->cantidad;
            $itemProducto -> save();
        }
    }
}
