<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lista_recetas_producto;
use App\Models\Producto;
class Lista_Receta_ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'id_ingrediente'=> 'required',
            'cantidad_ingrediente' => 'required|numeric',
            'unidad_medida_ingrediente' => 'required',
            'unidad_medida_rendimiento' => 'required',
            'fu_utilizable' => 'required|numeric'
            
        ]);

        $ListaNew = new lista_recetas_producto();
        $Producto = Producto::findOrFail($request -> id_ingrediente);
        $ListaNew->id_receta = $request -> id_receta;
        
        $ListaNew->id_ingrediente = $request -> id_ingrediente;
        $ListaNew->nombre_ingrediente = $Producto -> nombre;

        $ListaNew->unidad_medida_ingrediente = $request -> unidad_medida_ingrediente;
        if($ListaNew->unidad_medida_ingrediente == "kg" || $ListaNew->unidad_medida_ingrediente == "l"){
        $ListaNew->cantidad_ingrediente = $request -> cantidad_ingrediente * 1000;
        }
        else{
        $ListaNew->cantidad_ingrediente = $request -> cantidad_ingrediente;
        }

        //falta unidad para Fu
        $ListaNew->fu_utilizable = $request -> fu_utilizable;
        $ListaNew->unidad_medida_rendimiento = $request -> unidad_medida_rendimiento;
        $ListaNew->fu_unidad = ($Producto -> valor_unitario / ($ListaNew->fu_utilizable / 100));
        $ListaNew->costo_receta_producto = $ListaNew->fu_unidad * $ListaNew->cantidad_ingrediente;
        $ListaNew->save();
        return back()->with('mensaje', 'Se agrego el producto a la receta correctamente.');
    }

    public function Recalcular_listas(){

        $lista = lista_recetas_producto::all();
        
        foreach($lista as $Listanew){
            $ListaNew->fu_unidad = 0;
            $ListaNew->costo_receta_producto = 0;

            $ListaNew->fu_unidad = ($Producto -> valor_unitario / ($ListaNew->fu_utilizable / 100));
            $ListaNew->costo_receta_producto = $ListaNew->fu_unidad * $ListaNew->cantidad_ingrediente;
            }
            return "a";
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
        //
    }
}
