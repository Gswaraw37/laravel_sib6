<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kartu extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'kartu';

    public $timestamps = false;

    public function pelanggan() {
        return $this->hasMany(Pelanggan::class);
    }
}
