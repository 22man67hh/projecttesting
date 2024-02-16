@extends('layouts.backend')
@section('title','customer')

@section('content')
<div class="container-fluid">
                <div class="row-cols-1">
                    <div class="col-lg-10">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Customer Registration</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{route('customerregister')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label for="name" class="my-custom-label">Name:<span class="text-danger">*</span></label>
                                    <input id="name" name="name" class="form-control">
                                    <label for="name" class="my-custom-label">Address:<span class="text-danger">*</span></label>
                                    <input id="name" name="address" class="form-control">
                                    <label for="name" class="my-custom-label">Email:<span class="text-danger">*</span></label>
                                    <input id="name" name="email" class="form-control">
                                    <label for="name" class="my-custom-label">contact no:<span class="text-danger">*</span></label>
                                    <input id="name" name="contact" class="form-control">

                                    <br>
                                    <label for="photo" class="my-custom-label">Photo:</label>
                                    <input id="photo" name="photo" type="file" class="form-control">
                                    <label for="photo" class="my-custom-label"> Citizenship Photo:</label>
                                    <input id="photo" name="citizenship" type="file" class="form-control">



                                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                </form>
                            </div>
                        </div>

                    </div>  

@endsection


