<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;
use App\Models\lista_recetas_producto;
use App\Models\Producto;
use App\Models\Salida;

use App\Http\Controllers\Lista_Receta_ProductoController;


class RecetaController extends Controller
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
        $Receta = Receta::all();
        RecetaController::Recalcular_listas();
    
        return view('Receta',compact('Receta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Receta.crear');
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
            'nombre'=> 'required',
            'categoria_receta'=> 'required',
            'numero_porciones' => 'required|numeric',
            'unidad_porcion' => 'required',
            'cantidad_porcion' => 'required|numeric',
            'precio_porcion' => 'required|numeric'
        ]);


        $RecetaNew = new Receta();
        $RecetaNew->nombre = $request->nombre;
        $RecetaNew->categoria_receta = $request->categoria_receta;
        $RecetaNew->numero_porciones = $request->numero_porciones;
        $RecetaNew->unidad_porcion = $request->unidad_porcion;
        $RecetaNew->cantidad_porcion = $request->cantidad_porcion;
        $RecetaNew->precio_porcion = $request->precio_porcion;

        $RecetaNew->costo_porcion = 0;
          
        $RecetaNew->costo_receta = 0;
    
        $RecetaNew->utilidad_porcion = 0;

        $RecetaNew->margen_utilidad_porcion = 0;

        $RecetaNew->save();

        return back()->with('mensaje', 'Se agrego la receta correctamente.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Producto = Producto::all();
        $lista_recetas_producto = lista_recetas_producto::all();
        $Receta = Receta::findOrFail($id);
        RecetaController::Recalculo();
        return view('Receta.ver',compact('Producto','Receta','lista_recetas_producto'));
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
        $lista_recetas_producto = lista_recetas_producto::all();
        $Salida = Salida::all();
        foreach($lista_recetas_producto as $item){
            if ($item -> id_receta == $id){

                $item->delete();

            }
        }
        foreach($Salida as $item){
            if ($item -> id_receta == $id){

                $item->delete();

            }
        }

        $RecetaEliminar = Receta::findOrFail($id);
        $RecetaEliminar->delete();
        
        return back()->with('mensaje', 'Receta eliminada');
    }
    public function Recalculo(){
        $Receta = Receta::all();
        $lista_recetas_producto = lista_recetas_producto::all();
        foreach($Receta as $itemReceta){

            $itemReceta -> costo_receta = 0;
            foreach($lista_recetas_producto as $item_lista){
                if($item_lista -> id_receta == $itemReceta -> id){
                    $itemReceta -> costo_receta = $item_lista -> costo_receta_producto + $itemReceta -> costo_receta;
                }
            }
        $itemReceta -> costo_porcion = $itemReceta -> costo_receta / $itemReceta -> numero_porciones;
        
        $itemReceta -> utilidad_porcion = $itemReceta ->precio_porcion - $itemReceta ->costo_porcion;

        $itemReceta -> margen_utilidad_porcion = ($itemReceta -> utilidad_porcion / $itemReceta ->precio_porcion)*100;

        $itemReceta -> save();
        }
    }

    public function Recalcular_listas(){

        $lista = lista_recetas_producto::all();
        
        foreach($lista as $ListaNew){

            $Producto = Producto::findOrFail($ListaNew -> id_ingrediente);

            $ListaNew->fu_unidad = ($Producto -> valor_unitario / ($ListaNew->fu_utilizable / 100));
            $ListaNew->costo_receta_producto = $ListaNew->fu_unidad * $ListaNew->cantidad_ingrediente;
            $ListaNew-> save();
            }
    }
}
