@extends('backend.layouts.adminmaster')
@section('title')
    <h3>Role Create</h3>
@endsection
@section('admin-content')
    <div class="container-fluid pt-4 px-4 ">
        <div class="row  g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="row">
                        <p class="text-center text-uppercase font-weight-bold h5">Role Create</p>
                        <div class="col-md-10 text-left">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin-role.index') }}">Roles</a></li>
                                    <li class="breadcrumb-item"><a href="#">Roles Create</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div><hr> <hr><br>
                    
                    <form action="{{ route('admin-role.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="" aria-describedby="">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Permission</label>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                                <label class="form-check-label" for="checkPermissionAll">All</label>
                            </div>
                            <hr>
                            <hr><br>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($Permission_Groups as $Group)
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" name="" class="form-check-input"
                                                id="{{ $i }}management" value="{{ $Group->name }}"
                                                onclick="checkPermissionByGrouup('role-{{ $i }}-management-checkbox', this)">

                                            <label class="form-check-label"
                                                for="{{ $i }}management">{{ $Group->name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 role-{{ $i }}-management-checkbox">
                                        @php
                                            $Permissions = App\Models\User::getPermissionByGroupName($Group->name);
                                            $y = 1;
                                        @endphp
                                        @foreach ($Permissions as $Permission)
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" name="permission[]" class="form-check-input"
                                                    id="checkPermission{{ $Permission->id }}"
                                                    value="{{ $Permission->name }}">
                                                <label class="form-check-label"
                                                    for="checkPermission{{ $Permission->id }}">{{ $Permission->name }}</label>
                                            </div>
                                            @php
                                                $y++;
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                                @php
                                    $i++;
                                @endphp
                                <hr>
                                <hr><br>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-info ">Create Role</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#checkPermissionAll').click(function() {
                if ($(this).is(':checked')) {
                    $('input[type=checkbox]').prop('checked', true);
                } else {
                    $('input[type=checkbox]').prop('checked', false);
                }
            });
        });
    </script>
    <script>
   
            function checkPermissionByGrouup(Classname, CheckThis) {
                const GroupIDname =  $("#"+CheckThis.id);
                const ClassCheckBox = $('.'+Classname+' input');

                if (GroupIDname.is(':checked')) {
                    ClassCheckBox.prop('checked', true);
                } else {
                    ClassCheckBox.prop('checked', false);
                }

            }
    </script>
@endsection
