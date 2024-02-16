@extends('layouts.frontend')
@section('title','customer')

@section('content')
<style>
    img:hover{
        width: 100px;
        height: 150px;
    }
</style>
<div class="container-fluid">
@if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    
    @endif
        </div>
                <div class="row-cols-1">
                    <div class="col-lg-16">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Customer Registration</h6>
                            </div>
                            <div class="card-body">
                            
                                <form action="{{route('customerregister')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label for="name" class="my-custom-label">Name:<span class="text-danger">*</span></label>
                                    <input id="name" name="name" class="form-control" value="{{$record->name}}" readonly>
                                    <label for="name" class="my-custom-label">Address:<span class="text-danger">*</span></label>
                                    <input id="name" name="address" class="form-control" value="{{ optional ($records)->address ?? '' }}">
                                    <label for="name" class="my-custom-label">Email:<span class="text-danger">*</span></label>
                                    <input id="name" name="email" class="form-control" value="{{$record->email}}" readonly>
                                    <label for="name" class="my-custom-label">contact no:<span class="text-danger">*</span></label>
                                    <input id="name" name="contact" class="form-control" value="{{ optional($records)->contact ?? '' }}" required>  <br>
                                    <label for="photo" class="my-custom-label">Photo:</label>
                                    @if($records)
                                        <img src="{{asset('storage/' . $records->photo)}}" alt="" srcset=""  width="50px">
                                    <br>
                                    <label for="photo" class="my-custom-label"> Citizenship Photo:</label>
                                    <img src="{{asset('storage/' . $records->citizenship)}}" alt="" srcset=""  width="50px">
                                    


                                    @else
                                    <input id="photo" name="photo" type="file" class="form-control"required>
                                    <label for="photo" class="my-custom-label"> Citizenship Photo:</label>
                                    <input id="photo" name="citizenship" type="file" class="form-control" required>

                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    @endif
                                
                                    <!-- <button type="submit" class="btn btn-primary mt-3">Submit</button> -->
                                </form>
                            </div>
                        </div>

                    </div>  

@endsection


