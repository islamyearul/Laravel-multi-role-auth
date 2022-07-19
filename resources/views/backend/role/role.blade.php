@extends('backend.layouts.adminmaster')
@section('title')
    <h3>Role</h3>
@endsection
@section('content')
    <!-- Blank Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="row">
                        <p class="text-center text-uppercase font-weight-bold h5">Role</p>
                        <div class="col-md-10 text-left">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#">Roles</a></li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-2">
                            <div class="text-right"> <a href="{{ route('admin-role.create') }}"
                                    class="btn btn-primary">Create Role</a> </div>
                        </div>
                    </div><hr> <hr><br>
                    
                    <div class="">
                        <table id="" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a href="{{ route('admin-role.edit', $role->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('admin-role.destroy', $role->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger bg-danger">Delete</button>
                                            </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blank End -->
@endsection
