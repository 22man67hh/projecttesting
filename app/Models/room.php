<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Room extends Model
{
    
    use HasFactory,Notifiable;

    protected $fillable = ['name', 'address', 'email', 'contact','services','rent','type','quantity', 'room_video','owner_id'];

    public function photos()
    {
        return $this->hasMany(RoomPhoto::class);
    }
    public function book()
    {
        return $this->hasMany(Book::class, 'room_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
   
}

class RoomPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['photo_path'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
