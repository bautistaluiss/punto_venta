<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
class ClienteController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Clientes=Cliente::all();
        return view("Clientes.Clientes",['clientes'=>$Clientes]);
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

      session()->flash('message', 'created');
      $this->validate($request,[
          //los nombres son los de los name de las inputs de la vista.
        'nombre' => 'required|regex:/^[A-Z,a-z, ,á,é,í,ó,ú,ü,ñ,Ñ]+$/|between:3,30',
        'primer_apellido' => 'required|regex:/^[A-Z,a-z, ,á,é,í,ó,ú,ü,ñ,Ñ]+$/|between:3,25',
        'segundo_apellido' => 'required|regex:/^[A-Z,a-z, ,á,é,í,ó,ú,ü,ñ,Ñ]+$/|between:3,25',
        ]);

        $cliente= new Cliente();
        $cliente->nombre=$request->nombre;
        $cliente->primer_apellido=$request->primer_apellido;
        $cliente->segundo_apellido=$request->segundo_apellido;

     $cliente->save();
     return redirect('/clientes');
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      session()->flash('message', 'updated');
      $this->validate($request,[
          //los nombres son los de los name de las inputs de la vista.
        'nombre' => 'required|regex:/^[A-Z,a-z, ,á,é,í,ó,ú,ü,ñ,Ñ]+$/|between:3,30',
        'primer_apellido' => 'required|regex:/^[A-Z,a-z, ,á,é,í,ó,ú,ü,ñ,Ñ]+$/|between:3,25',
        'segundo_apellido' => 'required|regex:/^[A-Z,a-z, ,á,é,í,ó,ú,ü,ñ,Ñ]+$/|between:3,25',
        ]);

        $Cliente= Cliente::findOrFail($request->id);
        $Cliente->update($request->all());
       return redirect('/clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Cliente= Cliente::findOrFail($id);
        $Cliente->delete();
       return redirect('/clientes');
    }
}
