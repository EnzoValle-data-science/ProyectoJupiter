<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Producto;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');              //Todos los metodos accedidos deben estar con autenticacion
    }

    public function index()
    {
        
        $Entradas = Entrada::all();
        EntradaController::Recalcular_valor();
        //$Producto = Producto::all();
    
        return view('Entrada',compact('Entradas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Producto = Producto::all();
        return view('Entrada.create',compact('Producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)     //modifica el valor y la cantidad del producto 
    {


        $request->validate([
            'id_producto'=> 'required',
            'descripcion'=> 'required',
            'cantidad' => 'required|numeric',
            'unidad_medida' => 'required',
            'valor' => 'required|numeric'
        ]);


        $ProductoPorId = Producto::findOrFail($request->id_producto);
        $EntradaNew = new Entrada();
        $EntradaNew->id_producto = $request->id_producto;
        $EntradaNew->cantidad = $request->cantidad;
        $EntradaNew->nombre_producto = $ProductoPorId->nombre;
        $EntradaNew->unidad_medida = $request->unidad_medida;
        if($EntradaNew->unidad_medida == "kg" || $EntradaNew->unidad_medida == "l")
        {
            $ProductoPorId->cantidad = ($request->cantidad * 1000) + $ProductoPorId->cantidad;
            $ProductoPorId->cantidad_total = ($request->cantidad * 1000) + $ProductoPorId->cantidad_total;
        }
        else
        {
            $ProductoPorId->cantidad = $request->cantidad + $ProductoPorId->cantidad;
            $ProductoPorId->cantidad_total = $request->cantidad + $ProductoPorId->cantidad_total;
        }
        $ProductoPorId->valor = $request->valor + $ProductoPorId->valor;
        $EntradaNew->descripcion = $request->descripcion;
        $EntradaNew->valor = $request->valor;
        $EntradaNew->autor = $request->autor;
        $EntradaNew->id_autor =$request->id_autor;
        $ProductoPorId->valor_unitario =  $ProductoPorId->valor / $ProductoPorId->cantidad_total;
        $ProductoPorId->valor_actual = $ProductoPorId->valor_unitario * $ProductoPorId->cantidad;
        $ProductoPorId->save();
        $EntradaNew->save();
        return back()->with('mensaje', 'Se genero la entrada correctamente.');

        return $request;    
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
        $EntradaEliminar = Entrada::findOrFail($id);
        $Producto = Producto::findOrFail($EntradaEliminar->id_producto);

        if($EntradaEliminar->unidad_medida == "kg" || $EntradaEliminar->unidad_medida == "l")
        {
            $Producto->cantidad = $Producto->cantidad - $EntradaEliminar->cantidad * 1000;
            $Producto->cantidad_total = $Producto->cantidad_total - $EntradaEliminar->cantidad * 1000;
        }
        else
        {
            $Producto->cantidad = $Producto->cantidad - $EntradaEliminar->cantidad;
            $Producto->cantidad_total = $Producto->cantidad_total - $EntradaEliminar->cantidad;
        }
        $Producto->valor = $Producto->valor - $EntradaEliminar->valor;
        $EntradaEliminar->delete();
        $Producto->save();
        return back();
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
