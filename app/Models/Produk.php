<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'produk';

    public function jenis_produk() {
        return $this->belongsTo(JenisProduk::class);
    }
}
