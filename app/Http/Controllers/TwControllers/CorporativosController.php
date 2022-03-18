<?php

namespace App\Http\Controllers\TwControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CorporativosResource;
use App\tw_corporativos;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CorporativosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corporativa = tw_corporativos::all();

        return response(['corporativa' => 
        CorporativosResource::collection($corporativa), 
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
            'S_NombreCorto' => 'required|max:45',
            'S_NombreCompleto' => 'required|max:75',
            'S_LogoURL' => 'required',
            'S_DBName' => 'required|max:45',
            'S_DBUsuarios' => 'required|max:45',
            'S_DBPassword' => 'required|max:150',
            'S_SystemUrl' => 'required',
            'S_activo' => 'required|max:1',
            'users_id' => 'required'
        ]);

        if ($validation->fails()) {
            return response(['error' => $validation->errors(), 
                'message' => 'Validacion Fallida. Compruebe los datos!'
            ], 400);
        }

        $data = tw_corporativos::create([
            'S_NombreCorto' => $request->S_NombreCorto,
            'S_NombreCompleto' => $request->S_NombreCompleto,
            'S_LogoURL' => $request->S_LogoURL,
            'S_DBName' => $request->S_DBName,
            'S_DBUsuarios' => $request->S_DBUsuarios,
            'S_DBPassword' => bcrypt($request->S_DBPassword),
            'S_SystemUrl' => $request->S_SystemUrl,
            'S_activo' => $request->S_activo,
            'users_id' => $request->users_id,
        ]);

        return response(['data' => new CorporativosResource($data), 
                'message' => 'La corporativa se ha creado correctamente!'
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tw_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {           
        try {
            $exception = tw_corporativos::findOrFail($request->corporativa);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => 'Corporativa no encontrada'], 404);
        }
        
       return response(['corporativa' => new CorporativosResource($exception), 
                'message' => 'Datos recuperados con éxito!'
            ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tw_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tw_corporativos $corporativa)
    {
        $validate = $request->all();

        $validation = Validator::make($validate, [
            'S_NombreCorto' => 'required|max:45',
            'S_NombreCompleto' => 'required|max:75',
            'S_LogoURL' => 'required',
            'S_DBName' => 'required|max:45',
            'S_DBUsuarios' => 'required|max:45',
            'S_DBPassword' => 'required|max:150',
            'S_SystemUrl' => 'required',
            'S_activo' => 'required|max:1',
        ]);  

        if ($validation->fails()) {
            return response(['error' => $validation->errors(), 
                'message' => 'Validacion Fallida. Compruebe los datos!'
            ], 400);
        }

        $corporativa->update($request->all());

        return response(['corporativa' => new CorporativosResource($corporativa), 
                'message' => 'La corpotativa se ha actualizado correctamente!'
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tw_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function destroy(tw_corporativos $corporativa)
    {
        $corporativa->delete();

        return response([
            'message' => 'La corpotativa se ha eliminado con éxito!'
        ], 200);
    }
}
