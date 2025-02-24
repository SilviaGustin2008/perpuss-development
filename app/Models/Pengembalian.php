<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengembalian extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengembalians';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','pinjam_id', 'tgl_kembali', 'denda'];
    public function pinjam(): BelongsTo
    {
        return $this->belongsTo(Pinjam::class);
    }
}
