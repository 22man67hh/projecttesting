<?php
namespace App\Http\Controllers\frontend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Models\customer;
use Carbon\Carbon;
use App\Models\room;
use App\Models\photo;
use App\Models\RoomPhoto;
use App\Models\user;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Notifications\RoomBookedNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    
    public function user()
    {
        if (auth()->check()) {
            if (auth()->user()->isadmin == 1) {
                return view('home');
            } else {
                $id = auth()->user()->id; // Get the user's ID
                // $email=auth()->user()->email;// new added
                $data['records'] = room::all();
                // $datas['records']=book::all();// new added

                return view('blank', compact('data','id'));
            }
        } else {
            return redirect()->route('login');
        }
    }
    
    public function gharbeti(){
        $data['records'] = room::paginate(15);
        return view('blank', compact('data'));
    }
    public function roomDetail($id){
        $book = room::where('owner_id', auth()->user()->id)->get();// new added
        $record=room::find($id);
        return view('frontend.roomDetail', compact('record','book'));
    }

    public function AddRoom($id=null) {
        $owner=null;
        if($id){
            $customers = user::with('customer')->find($id);
            
            if($customers){
                $owner = $customers->customer;
                $data['records'] = room::paginate(15);
                // dd($owner);
                if(!$owner || empty($owner->name)){
                    return redirect()->route('customer',['id'=>$id])->with('message','Please complete the required fields before adding a room.');
                }
            }
        }
        return view('frontend.room', compact('owner','data'));
    }
    public function customregister($id)
    {if (!auth()->check()) {
        return redirect()->route('login');
    }
        $record=user::with('customer')->find($id);
        $records=$record->customer;
       
        return view('frontend.customer',compact('record','records'));
    }

public function roomBook(Request $request , $id,$rid){
$exist=Book::where('c_id',$id)->where('room_id',$rid)->first();
if($exist){
    return redirect()->route('home')->with('error','You have already booked this room.');
}
$record=room::find($rid);    
$customers = user::with('customer')->find($id);
$owner = $customers->customer;   
if (!$owner || empty($owner->name) || empty($owner->contact) || empty($owner->photo) || empty($owner->citizenship)) {
    // dd('All fields are filled. Redirecting to frontend.book');
    return redirect()->route('customer',['id'=>$id])->with(compact('owner'))->with('message', 'Please complete the required fields before booking.');
} 
$booking=$owner->booking;
if($booking >= 3){
    return redirect()->route('home')->with('error','Only 3 room can be booked on one day');
}

$notifications="Someone has been booked your room please click on this to take an action";
$notification=new Book();
$notification->notification=$notifications;
$notification->c_id=$owner->id;
$notification->room_id=$record->id;
$notification->save();


//new added
$currentTime = Carbon::now();
$room = room::with('user')->find($rid);
$bookie=$room->user;
$userId=$bookie->id;
$book = Room::where('owner_id', $userId)->get();
// dd($book);
Notification::send($book,new RoomBookedNotification('Someone has been booked your room please click on this to take an action',$currentTime,$owner->id));

return view('frontend.book');

}
//booking user
public function booking($id,$rid){
    $roomrecording= Book::with('room')->where('room_id',$rid)->first();
    $roomrecord=$roomrecording->room;
    $customerrecording=user::with('customer')->find($id);
    $customerrecord=$customerrecording->customer;
    $data['records'] = room::paginate(15);
    return view('frontend.booking',compact('customerrecord','roomrecord','data'));
}
public function yourStat($id){
    $roomrecording=User::with('customer')->find($id);
    $roomrecord=$roomrecording->customer;
   $roomId=$roomrecord->id;
    $yourroom['records']=Room::where('owner_id',$roomId)->get();
  
    $BookRoom=Book::where('c_id',$roomId)->get()->first();
    // dd($BookRoom);
    // dd($yourroom);
    $data['records'] = room::all();
    return view('frontend.yourStat',compact('data','yourroom','BookRoom'));
}

public function EditRoom($id) {
    $owners = Room::find($id); 
    $data['records'] = room::paginate(15);
    return view('frontend.EditRoom', compact('owners','data')); 
}
public function update(Request $request, $id) {
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string',
        'address' => 'required|string',
        'email' => 'required|email',
        'contact' => 'required|string',
        'rent' => 'required|numeric',
        'quantity' => 'required|integer',
        'type' => 'required|string|in:Negotiable,Fixed',
        'services' => 'required|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        'room_video' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:20480', 
    ]);

    try {
  
        $room = Room::findOrFail($id);

      
        $room->name = $request->name;
        $room->address = $request->address;
        $room->email = $request->email;
        $room->contact = $request->contact;
        $room->rent = $request->rent;
        $room->quantity = $request->quantity;
        $room->type = $request->type;
        $room->services = $request->services;

        // Update room photo if a new photo is uploaded
        if ($request->hasFile('photo')) {
            $photoPaths = [];
            foreach ($request->file('photo') as $photo) {
                $photoPath = $photo->store('roomphotos', 'public'); 
                $photoPaths[] = ['photo_path' => $photoPath];
            }
            $room->photos()->createMany($photoPaths);
        }

        // Update room video if a new video is uploaded
        if ($request->hasFile('room_video')) {

            if ($room->room_video) {
                Storage::disk('public')->delete($room->room_video);
            }
            $videoPath = $request->file('room_video')->store('videos'); 
            $room->room_video = $videoPath;
        }

        // Save the updated room details
        $room->save();

        return redirect()->route('yourStat', ['id' => auth()->user()->id])->with('success', 'Room updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update room. ' . $e->getMessage());
    }
}



public function deletephoto(RoomPhoto $photo){
//    $photo=RoomPhoto::find($photo);
   if (!$photo) {
    return response()->json(['error' => 'Photo not found'], 404);
}
   Storage::delete($photo->photo_path);
    $photo->delete();
    return redirect()->back()->with('success','photo deleted success');

}

}
