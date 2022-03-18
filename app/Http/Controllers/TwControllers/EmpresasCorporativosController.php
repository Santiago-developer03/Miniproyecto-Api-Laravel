<?php

namespace App\Http\Controllers\TwControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmpresasCorporativosResource;
use App\tw_empresas_corporativos;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpresasCorporativosController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $empresas = tw_empresas_corporativos::all();

        return response([ 'empresas' => 
        EmpresasCorporativosResource::collection($empresas), 
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
            'S_RazonSocial' => 'required|max:150',
            'S_RFC' => 'required|max:13',
            'S_Pais' => 'required|max:75',
            'S_Estado' => 'required|max:75',
            'S_Municipio' => 'required|max:75',
            'S_ColoniaLocalidad' => 'required|max:75',
            'S_Domicilio' => 'required|max:100',
            'S_CodigoPostal' => 'required|max:5',
            'S_UsoCFDI' => 'required|max:45',
            'S_UrlRFC' => 'required',
            'S_UrlActaConstitutiva' => 'required',
            'S_Activo' => 'required|max:1',
        ]);

        if ($validation->fails()) {
            return response(['error' => $validation->errors(), 
                'message' => 'Validacion Fallida. Compruebe los datos!'
            ], 400);
        }

        $data = tw_empresas_corporativos::create($request->all());

        return response(['data' => new EmpresasCorporativosResource($data), 
                'message' => 'Los datos se ha creado correctamente!'
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tw_empresas_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   

        try {
            $exception = tw_empresas_corporativos::findOrFail($request->empresas);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => 'Datos no encontrado'], 404);
        }

        return response(['empresas' => new EmpresasCorporativosResource($exception), 
                'message' => 'Datos recuperados con éxito!'
            ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tw_empresas_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tw_empresas_corporativos $empresas)
    {
        $validate = $request->all();

        $validation = Validator::make($validate, [
            'S_RazonSocial' => 'required|max:150',
            'S_RFC' => 'required|max:13',
            'S_Pais' => 'required|max:75',
            'S_Estado' => 'required|max:75',
            'S_Municipio' => 'required|max:75',
            'S_ColoniaLocalidad' => 'required|max:75',
            'S_Domicilio' => 'required|max:100',
            'S_CodigoPostal' => 'required|max:5',
            'S_UsoCFDI' => 'required|max:45',
            'S_UrlRFC' => 'required',
            'S_UrlActaConstitutiva' => 'required',
            'S_Activo' => 'required|max:1',
        ]);  

        if ($validation->fails()) {
            return response(['error' => $validation->errors(), 
                'message' => 'Validacion Fallida. Compruebe los datos!'
            ], 400);
        }

        $empresas->update($request->all());

        return response(['empresas' => new EmpresasCorporativosResource($empresas), 
                'message' => 'Los datos se han actualizado correctamente!'
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tw_empresas_corporativos  $tw_corporativos
     * @return \Illuminate\Http\Response
     */
    public function destroy(tw_empresas_corporativos $empresas)
    {
        $empresas->delete();

        return response([
            'message' => 'Los datos se han eliminado con éxito!'
        ], 200);
    }
}
