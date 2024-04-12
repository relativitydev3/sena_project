<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\Categorium;
use App\Models\Insumo;
use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    function __construct()
    {

        $this->middleware('permission:productos', ['only' => ['create', 'store', 'destroy', 'edit', 'update', 'index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::with('insumos')->paginate(10);
        // Recorrer la colección de productos y calcular la cantidad de insumos
        foreach ($productos as $productoPer) {
            $cantidadInsumos = count($productoPer->insumos);

            // Agregar un campo 'personalizado' al producto si tiene 3 o más insumos
            $productoPer->personalizado = $cantidadInsumos >= 3;
        }
        return view('producto.index', compact('productos', 'productoPer'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();

        // Obtén las categorías disponibles (nombre y ID) desde el modelo de Categoría
        $categorias = Categorium::pluck('nombre', 'id');

        // Obtén los insumos disponibles (nombre y ID) desde el modelo de Insumo
        $insumos = Insumo::pluck('nombre', 'id');

        return view('producto.create', compact('producto', 'categorias', 'insumos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'image|mimes:jpg,png|max:2048',
            'nombre' => 'required|unique:productos,nombre',
            'precio' => 'required',
            'descripcion' => 'required',
            'categorias_id' => 'required',
            'insumos' => 'required|array', // Validar que se envíen los insumos como un array
            //  'cantidad_utilizada' => 'required|array' // Validar que se envíen las cantidades utilizadas como un array    
        ]);

        $producto = new Producto();

        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categorias_id = $request->input('categorias_id');
        $producto->descripcion = $request->input('descripcion');
        $producto->activo = true; // Establecer el valor de "activo" como true
        //  $cantidadUtilizada = $request->input('cantidad_utilizada');

        // Verificar si se ha enviado una imagen
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la imagen a la carpeta "img" dentro del directorio público
            $image->move(public_path('img/ProductosIMG'), $imageName);

            // Asignar la ruta de la imagen al modelo
            $producto->imagen = 'img/ProductosIMG/' . $imageName;
        } else {
            // Si no se ha enviado una imagen, establecer la ruta del logo predeterminado
            $producto->imagen = 'img/logo.png';
        }

        // Guardar el registro en la base de datos
        $producto->save();

        /// Obtener los insumos seleccionados del formulario
        $insumos = $request->input('insumos');

        // Iterar los insumos y actualizar la cantidad utilizada
        foreach ($insumos as $insumoId) {
            $insumo = Insumo::find($insumoId);
            if ($insumo) {
                $insumo->save();
            }
        }
        // Asociar los insumos al producto a través de la relación de muchos a muchos
        $producto->insumos()->attach($insumos);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categorium::pluck('nombre', 'id');
        // Obtén los insumos disponibles (nombre y ID) desde el modelo de Insumo
        $insumos = Insumo::pluck('nombre', 'id');
        return view('producto.edit', compact('producto', 'categorias', 'insumos'));
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
        // Buscar el producto existente en la base de datos
        $producto = Producto::find($id);

        // Verificar si el producto se encontró
        if (!$producto) {
            return view('error')->with('message', 'El producto no existe');
            // return redirect()->route('productos.index')->with('error', 'El producto no existe');
        }
        //  Validar los datos de entrada
        $request->validate(Producto::$rulesUpdate);

        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('imagen')) {
            // Obtener el archivo de imagen
            $image = $request->file('imagen');

            // Generar un nombre único para la imagen usando la marca de tiempo actual
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la nueva imagen a la carpeta "img" dentro del directorio público
            $image->move(public_path('img/ProductosIMG'), $imageName);

            // Eliminar la imagen anterior si existe
            if ($producto->imagen) {
                $oldImagePath = public_path('img/ProductosIMG') . '/' . $producto->imagen;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Actualizar la ruta de la imagen en el modelo
            $producto->imagen = 'img/ProductosIMG/' . $imageName;
        }

        // Actualizar los atributos del producto
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $activo = $request->input('activo') == 1 ? true : false; // Guarda el estado como true o false según si se seleccionó o no el checkbox
        $producto->categorias_id = $request->input('categorias_id');

        // Guardar los cambios en la base de datos
        $producto->save();

        // Sincronizar los insumos en la tabla pivot
        $insumos = $request->input('insumos');

        $producto->insumos()->sync($insumos);
        // Redireccionar a la página de índice de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {
        try {
            $producto = Producto::find($id);

            if (!$producto) {
                return redirect()->route('productos.index')
                    ->with('error', 'El producto no existe');
            }
            // Obtener el nuevo estado del insumo
            $nuevoEstado = !$producto->activo;

            // Actualizar el estado del insumo
            $producto->activo = $nuevoEstado;
            // Cambia el estado del producto según el valor recibido del formulario
            // $producto->activo = $request->estado;

            $producto->save();

            return redirect()->route('productos.index')
                ->with('success', 'Estado del producto actualizado correctamente');
        } catch (QueryException $e) {
            return redirect()->route('productos.index')
                ->withErrors(['error' => 'No se puede actualizar el estado del producto debido a un error', $e]);
        }
    }
}
