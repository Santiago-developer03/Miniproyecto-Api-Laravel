<?php

namespace App\Http\Controllers\TwControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContratosCorporativosResource;
use App\tw_contratos_corporativos;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContratosCorporativosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos = tw_contratos_corporativos::all();

        return response(['documentos' => 
        ContratosCorporativosResource::collection($contratos), 
        'message' => 'Datos recuperado con éxito!'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validate = $request->all();
       
        $validation = Validator::make($validate, [
            'D_FechaInicio' => 'required',
            'D_FechaFin' => 'required',
            'URLContrato' => 'required',
        ]);

        if ($validation->fails()) {
            return response(['error' => $validation->errors(), 
                'message' => 'Validacion Fallida. Compruebe los datos!'
            ], 400);
        }

        $data = tw_contratos_corporativos::create($request->all());

        return response(['data' => new ContratosCorporativosResource($data), 
                'message' => 'Los datos se ha creado correctamente!'
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tw_contratos_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        try {
            $exception = tw_contratos_corporativos::findOrFail($request->contratos);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => 'Corporativa no encontrada'], 404);
        }
        
        return response(['contratos' => new ContratosCorporativosResource($exception), 
                'message' => 'Datos recuperados con éxito!'
            ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tw_contratos_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tw_contratos_corporativos $contratos)
    {
        $validate = $request->all();

        $validation = Validator::make($validate, [
            'D_FechaInicio' => 'required',
            'D_FechaFin' => 'required',
            'URLContrato' => 'required',
        ]);  

        if ($validation->fails()) {
            return response(['error' => $validation->errors(), 
                'message' => 'Validacion Fallida. Compruebe los datos!'
            ], 400);
        }

        $contratos->update($request->all());

        return response(['contratos' => new ContratosCorporativosResource($contratos), 
                'message' => 'Los datos se han actualizado correctamente!'
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tw_documentos_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function destroy(tw_contratos_corporativos $contratos)
    {
        $contratos->delete();

        return response([
            'message' => 'Los datos se han eliminado con éxito!'
        ], 200);
    }
}
