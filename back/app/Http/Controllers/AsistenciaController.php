<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Personal;
use App\Http\Requests\StoreAsistenciaRequest;
use App\Http\Requests\UpdateAsistenciaRequest;

class AsistenciaController extends Controller
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
     * @param  \App\Http\Requests\StoreAsistenciaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAsistenciaRequest $request)
    {
        //
        $personal=Personal::where('ci',$request->ci)->get();
        if(sizeof($personal)==1){
            $asistencia=new Asistencia();
            $asistencia->fecha=$request->fecha;
            $asistencia->hora=$request->hora;
            $asistencia->personal_id=$personal[0]->id;
            $asistencia->save();
            return $asistencia;
        }
        else{
            return response()->json(['message' => 'No Se encuentra registrado'], 500);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAsistenciaRequest  $request
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAsistenciaRequest $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
}
