<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'vehiculos';

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'placa',
        'color',
        'modelo',
        'chasis'
    ];

    // Si deseas desactivar los timestamps (created_at, updated_at), puedes hacerlo así:
    // public $timestamps = false;
}
