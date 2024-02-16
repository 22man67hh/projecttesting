@extends('layouts.backend')
@section('title','users')

@section('content')
  
<style>
    img:hover {
        width: 400px;
        height: 420px;
    }
</style>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                </nav>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Photo</th>
                                            <th>Citizenship</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Photo</th>
                                            <th>Citizenship</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($data['records'] as $index=>$record)
                                        <tr>
                                            <td>{{$record->name}}</td>
                                            <td>{{$record->address}}</td>
                                            <td>{{$record->email}}</td>
                                            <td>{{$record->contact}}</td>
                                            <td> @if($record->photo)
                                            <img src="{{ asset('storage/' . $record->photo) }}" alt="Customer Photo" width="50">
                                             @else
                                                No Photo
                                                 @endif</td>
                                                 <td> @if($record->citizenship)
                                                 <img src="{{ asset('storage/'. $record->citizenship)}}" alt="Customer Citizenship" width="50">
                                             @else
                                                No Photo
                                                 @endif
                                                </td>
                                        </tr>
                                      @endforeach
                            
                                </table>
                            </div>
                        </div>
                   
@endsection
