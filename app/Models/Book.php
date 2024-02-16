<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\customer;
use App\Models\room;
class Book extends Model
{
    use HasFactory;
    protected $table='books';
    protected $fillable=['c_id','room_id','notification'];

    

public function customer(){
return $this->belongsTo(customer::class,'c_id');
 }
 public function room(){
    return $this->belongsTo(Room::class,'room_id');
 }
}
