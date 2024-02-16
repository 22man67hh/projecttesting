@extends('layouts.backend')
@section('title','Add Room')

@section('content')
<div class="container-fluid">
                <div class="row-cols-1">
                    <div class="col-lg-10">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">ADD ROOM </h6>
                            </div>
                            <div class="card-body">
                                <form action="{{route('enterRoom')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label for="name" class="my-custom-label"> Owner Name:<span class="text-danger">*</span></label>
                                    <input id="name" name="name" class="form-control" required>
                                    <label for="name" class="my-custom-label">Room Address:<span class="text-danger">*</span></label>
                                    <input id="name" name="address" class="form-control" require>
                                    <label for="name" class="my-custom-label">Owner Email:<span class="text-danger">*</span></label>
                                    <input id="name" name="email" class="form-control" require>
                                    <label for="name" class="my-custom-label">Owner contact no:<span class="text-danger">*</span></label>
                                    <input id="name" name="contact" class="form-control" require>
                                    <label for="name" class="my-custom-label">Rent price:<span class="text-danger">*</span></label>
                                    <input id="name" name="rent" class="form-control" required>
                                    <label for="name" class="my-custom-label">Room quantity:<span class="text-danger">*</span></label>
                                    <input type="number" id="name" name="quantity" class="form-control" required min=1>
                                    <label for="name" class="my-custom-label">Rent price Type:<span class="text-danger">*</span></label>
                                   <select name="type" id="" class="my-custom-label"required>
                                   <option value="" selected></option>
                                    <option value="Negotiable">Negotiable</option>
                                    <option value="Fixed">Fixed</option>
                                   </select>
                                   <br>

                                    <label for="name" class="my-custom-label">Available Services:<span class="text-danger">*</span></label>
                                    <textarea name="services" class="form-control" id="" cols="20" rows="8" require placeholder="Provide a services "></textarea>
                                     <br>
                                    <label for="photo" class="my-custom-label">Room Photo:<span class="text-danger">*</span></label>
                                    <input id="photo" name="photo[]" type="file" class="form-control" multiple>
                                    <label for="photo" class="my-custom-label">Room video:<span class="text-danger">*</span></label>
                                    <input id="video" name="room_video" type="file" class="form-control" accept="video/*">
                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>  
@endsection


