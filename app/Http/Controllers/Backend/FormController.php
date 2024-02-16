<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\customer;
use App\Models\room;
use App\models\User;
use Carbon\Carbon;
use App\Models\RoomPhoto;
use Illuminate\Http\Request;
use App\Notifications\roomNotification;
use Illuminate\Support\Facades\Notification;

class FormController extends Controller
{

    public function registerpage()
    {
        return view('auth/register');
    }
    public function loginpage()
    {
        return view('auth/login');
    }
    public function landregister()
    {
        return view('landlord');
    }
    public function customregister()
    {
        return view('customer');
    }

    public function index()
    {
        $data['records']=customer::paginate(15);
        return view('users',compact('data'));
    }
    // room display
    
    public function Display()
    {
        $data['records']=room::paginate(15);
        return view('viewRoom',compact('data'));
    }
   
    // customer data store
    public function customerentry(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'contact' => 'required|string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'citizenship' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
           
        ]);
        $validatedData['booking'] = 0;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        // Handle cphoto upload
        if ($request->hasFile('citizenship')) {
            $cphotoPath = $request->file('citizenship')->store('photos', 'public');
            $validatedData['citizenship'] = $cphotoPath;
        }
        $customer=new customer($validatedData);
        $customer->customer_id = auth()->id();
        $customer->save();
        
        return redirect('/home')->with('success', 'customer entry added successfully!');
    }

// trying database notification
public function enterRoom(Request $request)
{

    try {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'contact' => 'required|string',
            'rent' => 'required|string',
            'type' => 'required|string',
            'quantity' => 'required|string',
            'services'=>'required|string',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each photo
            'room_video' => 'mimetypes:video/*|max:30720', // Validate the video file
        ]);

        // Create a new Room instance and fill it with validated data
        $room = new Room([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'email' => $validatedData['email'],
            'contact' => $validatedData['contact'],
            'rent' => $validatedData['rent'],
            'type' => $validatedData['type'],
            'quantity' => $validatedData['quantity'],
            'services' => $validatedData['services'],
            'room_video' => $request->file('room_video')->store('videos', 'public'), // Store video path
            
        ]);
// passing user id to the foreign key owner_id
       $room->owner_id=auth()->user()->id;
        // Save the room to the database
        $room->save();

        // Handle room photos
        $photoPaths = [];
        foreach ($request->file('photo') as $photo) {
            $photoPath = $photo->store('roomphotos', 'public');
            $photoPaths[] = ['photo_path' => $photoPath]; // Create an array for each photo path
        }

        // Attach photo paths to the room
        $room->photos()->createMany($photoPaths);
 // Handle room video
 $videoPath = $request->file('room_video')->store('videos', 'public');
 $room->update(['room_video' => $videoPath]);

        // Success message
        $currentTime = Carbon::now();
        $user = User::where('id', '!=', auth()->user()->id)->get();
        Notification::send($user,new roomNotification($request->address,$currentTime));
        return redirect('/home')->with('success', 'Room added successfully!');
    } catch (\Exception $e) {
        if (strpos($e->getMessage(), 'Integrity constraint violation: 1452') !== false) {
            // Display a custom message for the specific error
            return redirect('/home')->with('error', 'Error adding room:  Email not found Please create an account first.');
        }
        // Error message
        return redirect('/home')->with('error', 'Error adding room: ' . $e->getMessage());
    }

}





  
//     public function enterRoom(Request $request)
//     {
//         try {
//             // Validate the form data
//             $validatedData = $request->validate([
//                 'name' => 'required|string',
//                 'address' => 'required|string',
//                 'email' => 'required|email|unique:rooms,email',
//                 'contact' => 'required|string',
//                 'rent' => 'required|string',
//                 'type' => 'required|string',
//                 'quantity' => 'required|string',
//                 'services'=>'required|string',
//                 'photo.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each photo
//                 'room_video' => 'mimetypes:video/*|max:30720', // Validate the video file
//             ]);
    
//             // Create a new Room instance and fill it with validated data
//             $room = new Room([
//                 'name' => $validatedData['name'],
//                 'address' => $validatedData['address'],
//                 'email' => $validatedData['email'],
//                 'contact' => $validatedData['contact'],
//                 'rent' => $validatedData['rent'],
//                 'type' => $validatedData['type'],
//                 'quantity' => $validatedData['quantity'],
//                 'services' => $validatedData['services'],
//                 'room_video' => $request->file('room_video')->store('videos', 'public'), // Store video path
//             ]);
    
//             // Save the room to the database
//             $room->save();
    
//             // Handle room photos
//             $photoPaths = [];
//             foreach ($request->file('photo') as $photo) {
//                 $photoPath = $photo->store('roomphotos', 'public');
//                 $photoPaths[] = ['photo_path' => $photoPath]; // Create an array for each photo path
//             }
    
//             // Attach photo paths to the room
//             $room->photos()->createMany($photoPaths);
//      // Handle room video
//      $videoPath = $request->file('room_video')->store('videos', 'public');
//      $room->update(['room_video' => $videoPath]);

//             // Success message
//             return redirect('/home')->with('success', 'Room added successfully!');
//         } catch (\Exception $e) {
//             if (strpos($e->getMessage(), 'Integrity constraint violation: 1452') !== false) {
//                 // Display a custom message for the specific error
//                 return redirect('/home')->with('error', 'Error adding room:  Email not found Please create an account first.');
//             }
//             // Error message
//             return redirect('/home')->with('error', 'Error adding room: ' . $e->getMessage());
//         }
    
// }
    public function AddRoom() {
        return view('room');
        
    }
    public function view($id){
        $record=room::find($id);
        return view('view', compact('record'));
    }
}    