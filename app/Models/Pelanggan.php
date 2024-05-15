<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'pelanggan';

    public function kartu() {
        return $this->belongsTo(Kartu::class);
    }
}
