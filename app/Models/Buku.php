<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\softDeletes;

class Buku extends Model
{
    use HasFactory,softDeletes;

    protected $table='bukus';
    protected $primaryKey='id';
    protected $fillable=['id', 'kategori_id', 'judul', 'penulis', 'penerbit', 'isbn', 'tahun', 'jumlah'];

    public function kategori():BelongsTo
    {
        return $this->belongsTo(kategori::class);
    }
}
