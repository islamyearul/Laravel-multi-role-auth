@extends('backend.layouts.adminmaster')
@section('title')
    <h3>User Edit</h3>
@endsection
@section('admin-content')
    <div class="container-fluid pt-4 px-4 ">
        <div class="row  g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="row ">
                        <div class="col-md-10 text-left">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <span class="text-center text-uppercase font-weight-bold h5 px-3 text-secondary ">User
                                        Edit -{{ $User->name }} </span>
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin-user.index') }}">Users</a></li>
                                    <li class="breadcrumb-item"><a href="#">Edit User</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <hr>
                    <hr><br>
                    <form action="{{ route('admin-user.update', $User->id) }}" method="Post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{$User->name}}">
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="" value="{{$User->email}}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="" >
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Assign Role</label>
                            <select name="roles[]" id="" class="form-control select2" multiple>
     
                                @foreach ($Roles as $Role)
                                    <option value="{{ $Role->id }}" {{$User->hasRole($Role->name) ? 'selected' : ''}}>{{ $Role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info ">Update User</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
   
@endsection
