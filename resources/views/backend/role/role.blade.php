@extends('backend.layouts.adminmaster')
@section('title')
    <h3>Role</h3>
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
                                    <span class="text-center text-uppercase font-weight-bold h5 px-3 text-secondary ">Role
                                    </span>
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#">Roles</a></li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-2">
                            <div class="text-right">
                                @can('role-create')
                                    <a href="{{ route('admin-role.create') }}" class="btn btn-primary">Create Role</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <hr>
                    <hr><br>
                    <div class="">
                        <table id="datatable_example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">Permission</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge badge-info">{{ $permission->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="text-nowrap">
                                                @can('role-edit')
                                                    <a href="{{ route('admin-role.edit', $role->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                @endcan
                                                @can('role-delete')
                                                    <form action="{{ route('admin-role.destroy', $role->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger bg-danger show_confirm">Delete</button>
                                                    </form>
                                                @endcan
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
