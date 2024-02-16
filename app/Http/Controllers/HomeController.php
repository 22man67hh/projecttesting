<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\landlord;

use App\Models\room;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->isadmin == 1) {
                return view('home');
            } else {
                $id = auth()->user()->id; // Get the user's ID
                $user=User::find($id);// new added
                $data['records'] = room::paginate(15);
                $book = room::where('owner_id', auth()->user()->id)->get();
                return view('blank', compact('data','id','user','book'));
            }
        } else {
            return redirect()->route('login');
        }

        // new added

    }
    
 
}
