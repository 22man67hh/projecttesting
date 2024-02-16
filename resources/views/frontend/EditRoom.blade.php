@extends('blank')
@section('title','Add Room')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
                <div class="row-cols-1">
                    <div class="col-lg-14">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">ADD ROOM </h6>
                            </div>
                           
                                            <div class="card-body">
                                            <form action="{{ route('rooms.update', $owners->id) }}" method="post" enctype="multipart/form-data">
                                   

                                    @csrf
                                    @method('PUT')
                                    <label for="name" class="my-custom-label"> Owner Name:<span class="text-danger">*</span></label>
                                    <input id="name" name="name" class="form-control" value="{{$owners->name}}">
                                    <label for="name" class="my-custom-label">Room Address:<span class="text-danger">*</span></label>
                                    <input id="name" name="address" class="form-control" value="{{$owners->address}}">
                                    <label for="name" class="my-custom-label">Owner Email:<span class="text-danger">*</span></label>
                                    <input id="name" name="email" class="form-control" value="{{$owners->email}} ">
                                    <label for="name" class="my-custom-label">Owner contact no:<span class="text-danger">*</span></label>
                                    <input id="name" name="contact" class="form-control" value="{{$owners->contact}} ">
                                    <label for="name" class="my-custom-label">Rent price:<span class="text-danger">*</span></label>
                                    <input id="name" name="rent" class="form-control" value="{{$owners->rent}}">
                                    <label for="name" class="my-custom-label">Room quantity:<span class="text-danger">*</span></label>
                                    <input type="number"  name="quantity" class="form-control" value="{{$owners->quantity}}">
                                    <label for="name" class="my-custom-label">Rent price Type:<span class="text-danger">*</span></label>
                                   <select name="type" id="" class="my-custom-label"required>
                                   <option value="" selected></option>
                                    <option value="Negotiable" {{$owners->type=='Negotiable'?'selected' : ''}}>Negotiable</option>
                                    <option value="Fixed" {{$owners->type=='Fixed' ? 'selected':''}}>Fixed</option>
                                   </select>
                                   <br>

                                    <label for="name" class="my-custom-label">Available Services:<span class="text-danger">*</span></label>
                                    <textarea name="services" class="form-control" id="" cols="20" rows="8" >{{$owners->services}}</textarea>
                                     <br>
                                    <label for="photo" class="my-custom-label">Room Photo:<span class="text-danger">*</span></label>
                                    @if ($owners->photos->count() > 0)
                                    <div class="row" id="photo-container">
    @foreach ($owners->photos as $photo)
        <div class="col-md-4 mb-3">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/' . $photo->photo_path) }}" class="card-img-top" alt="Photo">
                <div class="card-body">            
    <button  class="btn btn-danger delete-photo" data-photo-id="{{$photo->id}}">Delete</button>
                </div>
            </div>
        </div>
    @endforeach
</div>

   
@else
    <p>No photos available</p>
@endif
    <input id="photo" name="photo[]" type="file" class="form-control" multiple>

                                    <label for="photo" class="my-custom-label">Room video:<span class="text-danger">*</span></label>
                                    @if($owners->room_video)

                                    <video  controls>
                                    <source src="{{ asset('storage/' . $owners->room_video) }}" type="video/mp4">
                                    
                                    Your browser does not support the video tag.
    </video>
    @endif
    <input id="video" name="room_video" type="file" class="form-control" accept="video/*">
                                    <button type="submit" class="btn btn-primary mt-3">Edit</button>
                                </form>
                            </div>
                  

                        </div>
                      
                    </div>  
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.delete-photo').click(function () {
            var photoId = $(this).data('photo-id');
            console.log(photoId);
            if (confirm('Are you sure you want to delete this photo?')) {
                $.ajax({
                    url: "{{ url('delete') }}" + '/' + photoId, // Concatenate photoId directly
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        $('#photo-container').find('[data-photo-id="' + photoId + '"]').closest('.col-md-4').remove();
                    },
                    error: function (xhr) {
                        alert('Error while deleting');
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

@endsection

