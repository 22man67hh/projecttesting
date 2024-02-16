@extends('layouts.frontend')
@section('title','Add Room')

@section('content')

<div>
<style>
    img:hover {
        width: 400px;
        height: 420px;
    }
</style>
<script>
function bookroom() {
    confirm("Are you sure you want to book this room,if you click yes your information will be sent to the landlord of the room/flat.")
}

</script>
        <h1>Record Details of that room</h1>
        <p>Owner id: {{ $record->id }}</p>
        <p>Owner Name: {{ $record->name }}</p>
        <p>Room Address: {{ $record->address }}</p>
        <p>Owner Email: {{ $record->email }}</p>
        <p>Owner Contact: {{ $record->contact }}</p>
        <p>Rent Price: {{ $record->rent }}</p>
        <p>Rent Price Type: {{ $record->type }}</p>
        <p>Quantity: {{ $record->quantity }}</p>
        <div>
        <label for="">Room video</label>
        <div>
      @if($record->room_video)
        {{-- Display the video player --}}
        <video width="320" height="240" controls>
            <source src="{{ asset('storage/' . $record->room_video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @else
        {{-- Show a message if no video available --}}
        No video available
    @endif
    </div> 
<label for=""> Room Images:</label>
<div>
@if ($record->photos->count() > 0)
    <div>
        @foreach ($record->photos as $photo)
            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Photo" width="100">
        @endforeach
        </div>
    </div>
@else
    <p>No photos available</p>
@endif
</div>   
<p>Available Services:{{ $record->services}}</p>
<td>
    <a href="{{ route('home')}}" class="btn btn-success">Go Back</a>
</td>
<br>
<td>
    @if($book->contains('id',$record->id))
        <button type="submit" class="btn btn-success" disabled>Your Room </button>
    @else
        <form action="{{ route('Book', ['id' => auth()->user()->id, 'rid' => $record->id])}}" method="post">
            @csrf
            <button type="submit" class="btn btn-success" onclick="bookroom()">Book Room</button>
        </form>
    @endif
</td>
        @endsection