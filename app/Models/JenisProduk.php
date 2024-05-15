<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisProduk extends Model
{
    use HasFactory;

    // panggil kolom yang dilindungi di table (sesuai dengan yang ada di dalam table)
    protected $guarded = [
        'id'
    ];

    // panggil nama table yang akan digunakan
    protected $table = 'jenis_produk';

    public function produk() {
        return $this->hasMany(Produk::class);
    }
}
