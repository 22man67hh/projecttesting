@extends('blank')
@section('title', 'YourStat')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <h1>Your Status</h1>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Booked Room</h3>
                <div class="card-text">
                    <p>Please visit your booking within 1 day</p>
                    @if($BookRoom)
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Owner Name</th>
                                <th scope="col">Owner Email</th>
                                <th scope="col">Room Location</th>
                                <th scope="col">Owner Contact</th>
                                <th scope="col">Rent Price</th>
                                <th scope="col">Action</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$BookRoom->room->name}}</td>
                                <td>{{$BookRoom->room->email}}</td>
                                <td>{{$BookRoom->room->address}}</td>
                                <td>{{$BookRoom->room->contact}}</td>
                                <td>{{$BookRoom->room->email}}</td>
                               
                                <td>
                                <a href="{{ route('Chatifyuser',['id' => $BookRoom->room->user->id])}}">
                                    <button class="btn btn-primary">Chat with Owner</button>
                                    </a>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                    @else
                        <p class="bg-danger text-white"> You didn't have any  Booked room</p>
                    @endif
                </div>
            </div>
        </div>
<br>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Your Room</h3>
                <div class="card-text">
                    @if($yourroom)
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Owner Name</th>
                                    <th scope="col">Owner Email</th>
                                    <th scope="col">Room Location</th>
                                    <th scope="col">Owner Contact</th>
                                    <th scope="col">Rent Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($yourroom['records'] as $room)
                                <tr>
                                    <td>{{$room->name}}</td>
                                    <td>{{$room->email}}</td>
                                    <td>{{$room->address}}</td>
                                    <td>{{$room->contact}}</td>
                                    <td>{{$room->rent}}</td>
                                    <td>
                                        <a href="{{route('EditRoom',['id'=>$room->id])}}">
                                        <button class="btn btn-primary">Edit</button>
                                        </a>
                                        <form action="">
                                            @csrf
                                        <button class="btn btn-danger">Rented</button>
                                      
                                        </form>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="bg-danger text-white"> You didn't have any room</p>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
@endsection
