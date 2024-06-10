<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return response()->json(['ok' => true, 'data' => $vehiculos, 'message' => 'Lista de vehículos']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|unique:vehiculos',
            'color' => 'required',
            'modelo' => 'required',
            'chasis' => 'required|unique:vehiculos'
        ]);

        $vehiculo = Vehiculo::create($request->all());

        return response()->json(['ok' => true, 'data' => $vehiculo, 'message' => 'Vehículo registrado exitosamente']);
    }

    public function show($id)
    {
        $vehiculo = Vehiculo::find($id);
        if ($vehiculo) {
            return response()->json(['ok' => true, 'data' => $vehiculo, 'message' => 'Detalles del vehículo']);
        } else {
            return response()->json(['ok' => false, 'message' => 'Vehículo no encontrado'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'placa' => 'unique:vehiculos,placa,' . $id,
            'chasis' => 'unique:vehiculos,chasis,' . $id
        ]);

        $vehiculo = Vehiculo::find($id);
        if ($vehiculo) {
            $vehiculo->update($request->all());
            return response()->json(['ok' => true, 'data' => $vehiculo, 'message' => 'Vehículo actualizado exitosamente']);
        } else {
            return response()->json(['ok' => false, 'message' => 'Vehículo no encontrado'], 404);
        }
    }

    public function destroy($id)
    {
        $vehiculo = Vehiculo::find($id);
        if ($vehiculo) {
            $vehiculo->delete();
            return response()->json(['ok' => true, 'message' => 'Vehículo eliminado exitosamente']);
        } else {
            return response()->json(['ok' => false, 'message' => 'Vehículo no encontrado'], 404);
        }
    }

}
