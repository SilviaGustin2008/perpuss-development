<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class Kategori extends Model
{
    use HasFactory, softDeletes;

    protected $table='kategoris';
    protected $primaryKey='id';
    protected $fillable=['id','nama','deskripsi'];
}
