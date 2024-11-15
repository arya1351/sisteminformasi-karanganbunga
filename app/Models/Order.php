<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'produk_id', 'alamat', 'no_telepon', 'qty', 'total_price', 'status', 'no_resi', 'selling'];

    
}
