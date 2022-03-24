<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;
     /**
     * filllable
     *
     * @var array
     */
    protected $fillable = [
        'judul_buku', 'author', 'sinopsis', 'tanggal_terbit'
    ];
}
