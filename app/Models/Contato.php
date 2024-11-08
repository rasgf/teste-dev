<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'telefone',
        'idade',
        'cep',
        'rua',
        'numero',
        'complemento',
        'cidade',
        'estado'
    ];
}
