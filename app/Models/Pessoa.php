<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    public $table = "pessoa";
    public $timestamps = false;
    protected $primaryKey = "codigo_pessoa";

    protected $fillable = [
        "nome_pessoa",
        "senha_pessoa"
    ];
}
