<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

/**
 * Class InsumoController
 * @package App\Http\Controllers
 */
class InsumoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:insumos', ['only' => ['create', 'store', 'destroy', 'edit', 'update', 'index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insumos = Insumo::paginate();

        return view('insumo.index', compact('insumos'))
            ->with('i', (request()->input('page', 1) - 1) * $insumos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insumo = new Insumo();
        return view('insumo.create', compact('insumo'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Insumo::$rules);

        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('imagen')) {
            // Obtener el archivo de imagen
            $image = $request->file('imagen');

            // Generar un nombre único para la imagen usando la marca de tiempo actual
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la imagen a la carpeta "public/img/InsumoIMG" dentro del directorio público
            $image->move(public_path('img/InsumoIMG'), $imageName);

            // Crear el nuevo registro en la base de datos con la ruta de la imagen y el valor "activo" establecido en true
            Insumo::create([
                'imagen' => 'img/InsumoIMG/' . $imageName,
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'activo' => true, // Establecer el valor "activo" en true
                'cantidad_disponible' => $request->input('cantidad_disponible') * 3,
                // 'unidad_medida' => $request->input('unidad_medida') Version que recibe el selector de unidad de medida del insumo
                'unidad_medida' => 'Bolsas',
                'precio_unitario' => $request->input('precio_unitario'),
            ]);
        } else {
            // Si no se ha enviado una imagen, crear el registro sin el campo de imagen y con el valor "activo" establecido en true
            Insumo::create([
                'imagen' => 'img/logo.png', // Ruta del logo predeterminado
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'activo' => true, // Establecer el valor "activo" en true
                'cantidad_disponible' => $request->input('cantidad_disponible') * 3,
                // 'unidad_medida' => $request->input('unidad_medida') Version que recibe el selector de unidad de medida del insumo
                'unidad_medida' => 'Bolsas',
                'precio_unitario' => $request->input('precio_unitario'),
            ]);
        }

        return redirect()->route('insumo.index')
            ->with('success', 'Insumo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $insumo = Insumo::find($id);

        return view('insumo.show', compact('insumo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Buscar el insumo por su ID
        $insumo = Insumo::find($id);

        return view('insumo.edit', compact('insumo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate(Insumo::$rulesUpdate);

        // Obtener el insumo por su ID
        $insumo = Insumo::find($id);

        // Verificar si se encontró el insumo
        if (!$insumo) {
            return redirect()->back()->with('error', 'El insumo no existe');
        }

        // Obtener el valor del checkbox de estado "activo"
        $activo = $request->has('activo') ? true : false;

        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('imagen')) {
            // Obtener el archivo de imagen
            $image = $request->file('imagen');

            // Generar un nombre único para la imagen usando la marca de tiempo actual
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la imagen a la carpeta "public/img/InsumoIMG" dentro del directorio público
            $image->move(public_path('img/InsumoIMG'), $imageName);

            // Eliminar la imagen anterior si existe
            if ($insumo->imagen) {
                $oldImagePath = public_path('img/InsumoIMG') . '/' . $insumo->imagen;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Actualizar el campo 'imagen' del modelo con la nueva ruta de la imagen
            $insumo->imagen = 'img/InsumoIMG/' . $imageName;
        }

        // Actualizar los demás campos del insumo
        $insumo->nombre = $request->input('nombre');
        $insumo->cantidad_disponible = $request->input('cantidad_disponible') * 3;
        $insumo->precio_unitario = $request->input('precio_unitario');

        // Guardar los cambios en la base de datos
        $insumo->save();

        return redirect()->route('insumo.index')
            ->with('success', 'Insumo actualizado correctamente');
    }
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        // Buscar el insumo por ID
        $insumo = Insumo::find($id);

        // Verificar si se encontró el insumo
        if (!$insumo) {
            return redirect()->back()->with('error', 'El insumo no existe');
        }

        // Obtener el nuevo estado del insumo
        $nuevoEstado = !$insumo->activo;

        // Actualizar el estado del insumo
        $insumo->activo = $nuevoEstado;
        $insumo->save();

        // Obtener los productos relacionados con el insumo
        $productosRelacionados = $insumo->productos;

        // Actualizar el estado de los productos relacionados
        foreach ($productosRelacionados as $producto) {
            $producto->activo = $nuevoEstado;
            $producto->save();
        }

        // Redireccionar a la lista de insumos con mensaje de éxito
        return redirect()->route('insumo.index')->with('success', 'Insumo y productos relacionados actualizados exitosamente');
    }
}
