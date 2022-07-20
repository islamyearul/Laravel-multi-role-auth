@extends('backend.layouts.adminmaster')
@section('title')
    <h3>Permission</h3>
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
                        <div class="col-md-9 text-left">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <span class="text-center text-uppercase font-weight-bold h5 px-3 text-secondary ">Permission
                                    </span>
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#">Permission</a></li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-3">
                            <div class="text-right"> <a href="{{ route('admin-permission.create') }}"
                                    class="btn btn-primary">Create Permission</a> </div>
                        </div>
                    </div>
                    <hr>
                    <hr><br>
                    <div class="">
                        <table id="datatable_example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Permission Name</th>
                                    <th scope="col">Permission Guard Name</th>
                                    <th scope="col">Permission Group Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Permissions as $Permission)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $Permission->name }}</td>
                                        <td>{{ $Permission->guard_name }}</td>
                                        <td>{{ $Permission->group_name }}</td>
                                        <td>
                                            <a href="{{ route('admin-permission.edit', $Permission->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('admin-permission.destroy', $Permission->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="show_confirm btn btn-danger bg-danger">Delete</button>
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

@section('script')
@include('backend.partials.datatable-script')
@endsection