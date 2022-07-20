@extends('backend.layouts.adminmaster')
@section('title')
    <h3>Users</h3>
@endsection
@section('styles')
    @include('backend.partials.datatable-css')
@endsection
@section('content')
    <!-- Blank Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="row">
                        <div class="col-md-10 text-left">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <span class="text-center text-uppercase font-weight-bold h5 px-3 text-secondary ">Users
                                    </span>
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-2">
                            <div class="text-right"> <a href="{{ route('admin-user.create') }}"
                                    class="btn btn-primary">Create User</a> </div>
                        </div>
                    </div>
                    <hr>
                    <hr><br>
                    <div class="">
                        <table id="datatable_example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Assign Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Users as $User)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $User->name }}</td>
                                        <td>{{ $User->email }}</td>
                                        <td>
                                            @foreach ($User->roles as $role)
                                                <span class="badge badge-info">{{$role->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="text-nowrap">
                                                <a href="{{ route('admin-user.edit', $User->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <form action="{{ route('admin-user.destroy', $User->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger bg-danger show_confirm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
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

@section('script')
@include('backend.partials.datatable-script')
@endsection