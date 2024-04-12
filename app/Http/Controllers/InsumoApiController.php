<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;

class InsumoApiController extends Controller
{

    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $insumos = Insumo::all();

            return response()->json($insumos);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
            'imagen' => 'nullable|image|mimes:jpg,png|max:2048', // Cambiar 'required' a 'nullable'
            'nombre' => 'required',
            'cantidad_disponible' => 'required|numeric',
            'unidad_medida' => 'required',
            'precio_unitario' => 'required|numeric',
            'activo' => 'boolean'
        ]);
    
        // Obtener la imagen del cuerpo de la solicitud
        $image = $request->file('imagen');
    
        // Verificar si se proporcionó una imagen
        if ($image) {
            // Generar un nombre único para la imagen usando la marca de tiempo actual
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Mover la imagen a la carpeta "public/img/InsumoIMG" dentro del directorio público
            $image->move(public_path('img/InsumoIMG'), $imageName);
        } else {
            // Si no se proporciona una imagen, asignar null al campo 'imagen'
            $imageName = null;
        }
    
        // Crear una instancia del modelo Insumo con los demás datos del formulario
        $insumo = new Insumo([
            'nombre' => $request->input('nombre'),
            'cantidad_disponible' => $request->input('cantidad_disponible'),
            'unidad_medida' => $request->input('unidad_medida'),
            'precio_unitario' => $request->input('precio_unitario'),
            'activo' => $request->input('activo'),
            'imagen' => $imageName, // Asignar el nombre de la imagen o null
        ]);
    
        // Guardar el nuevo insumo en la base de datos
        $insumo->save();
    
        // Devolver una respuesta de éxito
        return response()->json(['message' => 'Insumo creado exitosamente'], 201);
    }
    
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $insumo = Insumo::findOrFail($id);

        return response()->json($insumo);
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
    $request->validate([
        'imagen' => 'nullable|image|mimes:jpg,png|max:2048',
        'nombre' => 'required',
        'cantidad_disponible' => 'required|numeric',
        'unidad_medida' => 'required',
        'precio_unitario' => 'required|numeric',
        'activo' => 'boolean'
    ]);

    // Obtener el insumo existente por su ID
    $insumo = Insumo::findOrFail($id);

    // Procesar la imagen si se proporciona una nueva
    if ($request->hasFile('imagen')) {
        $image = $request->file('imagen');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/InsumoIMG'), $imageName);
        // Eliminar la imagen anterior si existe
        if ($insumo->imagen) {
            unlink(public_path('img/InsumoIMG/' . $insumo->imagen));
        }
        $insumo->imagen = $imageName;
    }

    // Actualizar los demás campos del insumo
    $insumo->nombre = $request->input('nombre');
    $insumo->cantidad_disponible = $request->input('cantidad_disponible');
    $insumo->unidad_medida = $request->input('unidad_medida');
    $insumo->precio_unitario = $request->input('precio_unitario');
    $insumo->activo = $request->input('activo');

    // Guardar los cambios
    $insumo->save();

    return response()->json(['message' => 'Insumo actualizado exitosamente'], 200);
}







    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $url = 'http://127.0.0.1:8000/api/insumos/' . $id; // URL de la API

        $response = Http::tiemeout(60)->delete($url); // Realizar la solicitud DELETE a la API

        if ($response->successful()) {
            $responseData = $response->json(); // Obtener los datos JSON de la respuesta

            // Verificar si la clave 'activo' existe en la respuesta
            if (isset($responseData['activo'])) {
                // Obtener el estado actual del insumo en la respuesta
                $isActive = $responseData['activo'];

                if ($isActive) {
                    $message = 'Insumo desactivado exitosamente';
                } else {
                    $message = 'Insumo activado exitosamente';
                }

                // Redireccionar a la lista de insumos con mensaje de éxito
                return redirect()->route('insumo.index')->with('success', $message);
            } else {
                // Manejar el caso en que la clave 'activo' no exista en la respuesta
                $errorMessage = 'La respuesta de la API no contiene la clave "activo"';

                // Redireccionar con mensaje de error
                return redirect()->back()->withError($errorMessage);
            }
        } else {
            // Manejar el caso en que la solicitud no sea exitosa
            $errorMessage = $response->body();

            // Redireccionar con mensaje de error
            return redirect()->back()->withError($errorMessage);
        }
    }
}
