<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //Importamos la herramienta softdeletes para borrado lógico

class Equipo extends Model
{
    use HasFactory, SoftDeletes; //La activamos dentro de la clase

    protected $fillable = ['marca', 'modelo', 'estado'];
}