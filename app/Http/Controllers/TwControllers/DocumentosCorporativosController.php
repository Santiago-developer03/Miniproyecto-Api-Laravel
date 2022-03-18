<?php

namespace App\Http\Controllers\TwControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentosCorporativosResource;
use App\tw_documentos_corporativos;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentosCorporativosController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = tw_documentos_corporativos::all();

        return response(['documentos' => 
        DocumentosCorporativosResource::collection($documentos), 
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
            'S_Nombre' => 'required|max:45',
            'N_Obligatorio' => 'required|max:1',
            'S_Descripcion' => 'required',
        ]);

        if ($validation->fails()) {
            return response(['error' => $validation->errors(), 
                'message' => 'Validacion Fallida. Compruebe los datos!'
            ], 400);
        }

        $data = tw_documentos_corporativos::create($request->all());

        return response(['data' => new DocumentosCorporativosResource($data), 
                'message' => 'Los datos se ha creado correctamente!'
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tw_documentos_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        try {
            $exception = tw_documentos_corporativos::findOrFail($request->documentos);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => 'Datos no encontrado'], 404);
        }
        
        return response(['documentos' => new DocumentosCorporativosResource($exception), 
                'message' => 'Datos recuperados con éxito!'
            ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tw_documentos_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tw_documentos_corporativos $documentos)
    {
        $validate = $request->all();

        $validation = Validator::make($validate, [
            'S_Nombre' => 'required|max:45',
            'N_Obligatorio' => 'required|max:1',
            'S_Descripcion' => 'required',
        ]);  

        if ($validation->fails()) {
            return response(['error' => $validation->errors(), 
                'message' => 'Validacion Fallida. Compruebe los datos!'
            ], 400);
        }

        $documentos->update($request->all());

        return response(['documentos' => new DocumentosCorporativosResource($documentos), 
                'message' => 'Los datos se han actualizado correctamente!'
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tw_documentos_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function destroy(tw_documentos_corporativos $documentos)
    {
        $documentos->delete();

        return response([
            'message' => 'Los datos se han eliminado con éxito!'
        ], 200);
    }
}
