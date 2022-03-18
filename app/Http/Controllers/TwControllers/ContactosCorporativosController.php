<?php

namespace App\Http\Controllers\TwControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactosCorporativosResource;
use App\tw_contactos_corporativos;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactosCorporativosController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactos = tw_contactos_corporativos::all();

        return response([ 'contactos' => 
        ContactosCorporativosResource::collection($contactos), 
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
            'S_Puesto' => 'required|max:45',
            'S_Comentarios' => 'required|max:45',
            'N_Portafolio' => 'required',
            'N_Telefonofijo' => 'required|max:12',
            'N_TelefonoMovil' => 'required|max:12',
            'S_Email' => 'required|max:45',
        ]);

        if ($validation->fails()) {
            return response(['error' => $validation->errors(), 
                'message' => 'Validacion Fallida. Compruebe los datos!'
            ], 400);
        }

        $data = tw_contactos_corporativos::create($request->all());

        return response(['data' => new ContactosCorporativosResource($data), 
                'message' => 'Los datos se ha creado correctamente!'
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tw_contactos_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        try {
            $exception = tw_contactos_corporativos::findOrFail($request->contactos);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => 'Datos no encontrado'], 404);
        }
        
        return response(['empresas' => new ContactosCorporativosResource($exception), 
                'message' => 'Datos recuperados con éxito!'
            ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tw_contactos_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tw_contactos_corporativos $contactos)
    {
        $validate = $request->all();

        $validation = Validator::make($validate, [
            'S_Nombre' => 'required|max:45',
            'S_Puesto' => 'required|max:45',
            'S_Comentarios' => 'required|max:45',
            'N_Portafolio' => 'required',
            'N_Telefonofijo' => 'required|max:12',
            'N_TelefonoMovil' => 'required|max:12',
            'S_Email' => 'required|max:45',
        ]);  

        if ($validation->fails()) {
            return response(['error' => $validation->errors(), 
                'message' => 'Validacion Fallida. Compruebe los datos!'
            ], 400);
        }

        $contactos->update($request->all());

        return response(['contactos' => new ContactosCorporativosResource($contactos), 
                'message' => 'Los datos se han actualizado correctamente!'
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tw_contactos_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function destroy(tw_contactos_corporativos $contactos)
    {
        $contactos->delete();

        return response([
            'message' => 'La corpotativa se ha eliminado con éxito!'
        ], 200);
    }
}
