<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class landlord extends Model
{
    protected $table = 'landlords';
    protected $fillable = [
        'name', 'address', 'email', 'contact', 'street', 'house', 'type', 'photo', 'citizenship',
    ];
    use HasFactory;
}
 