<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class customer extends Model
{
  
    protected $table = 'customers';
    protected $fillable = ['name', 'address', 'email', 'contact','photo', 'citizenship','customer_id','booking'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
  
    public function rbook()
    {
        return $this->hasMany(Book::class, 'c_id');
    }
}
