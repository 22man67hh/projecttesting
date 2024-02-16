@extends('blank')
@section('title','Booking')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Hello, this is Customer Detail who have booked your Room</h3>
                <div class="card-text">
                    <p><strong>Booker Name:</strong> {{ $customerrecord->name }}</p>
                    <p><strong>Booker Address:</strong> {{ $customerrecord->address}}</p>
                    <p><strong>Booker Email:</strong> {{ $customerrecord->email}}</p>
                    <p><strong>Booker photo:</strong><img src="{{asset('storage/' . $customerrecord->photo)}}" alt="" srcset=""width="150px"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Hello, this is Room Detail booked by booker</h3>
                <p><strong>Owner Name:</strong> {{ $roomrecord->name}}</p>
                <p><strong>Room Location:</strong> {{ $roomrecord->address}}</p>
                <p><strong>Rent charge:</strong> {{ $roomrecord->rent}}</p>
                <p><strong>Room type:</strong> {{ $roomrecord->type}}</p>
                <strong>Video of Room: <br></strong><video width="320" height="240" controls>
                    <source src="{{ asset('storage/' . $roomrecord->room_video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
    <div id="chat">
    <div id="chat-box">
    <ion-icon name="chatbubble-outline" style="width: 35px; height: 35px;"></ion-icon>
    <a href="{{ route('Chatifyuser',['id' => $customerrecord->id])}}">
    <button>Chat Now</button>
</a>
</div>
 </div>

 <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection