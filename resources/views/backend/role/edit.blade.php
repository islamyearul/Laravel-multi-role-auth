@extends('backend.layouts.adminmaster')
@section('title')
    <h3>Role Edit</h3>
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
                                    <span class="text-center text-uppercase font-weight-bold h5 px-3 text-secondary ">Role
                                        Edit -{{ $Role->name }} </span>
                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin-role.index') }}">Roles</a></li>
                                    <li class="breadcrumb-item"><a href="#">Edit Role</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <hr>
                    <hr><br>
                    <form action="{{ route('admin-role.update', $Role->id) }}" method="Post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="" aria-describedby=""
                                value="{{ $Role->name }}">
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
                                @php
                                    $Permissions = App\Models\User::getPermissionByGroupName($Group->name);
                                    $y = 1;
                                @endphp
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" name="" class="form-check-input"
                                                id="{{ $i }}management" value="{{ $Group->name }}"
                                                onclick="checkPermissionByGrouup('role-{{ $i }}-management-checkbox', this)"
                                                {{ App\Models\User::roleHasPermission($Role, $Permissions) ? 'checked' : '' }}>

                                            <label class="form-check-label"
                                                for="{{ $i }}management">{{ $Group->name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9 role-{{ $i }}-management-checkbox">

                                        @foreach ($Permissions as $Permission)
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" name="permission[]"
                                                    onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}management', {{ count($Permissions) }})"
                                                    {{ $Role->hasPermissionTo($Permission->name) ? 'checked' : '' }}
                                                    class="form-check-input" id="checkPermission{{ $Permission->id }}"
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
                        <button type="submit" class="btn btn-info ">Update Role</button>
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
        function checkPermissionByGrouup(Classname, CheckThis) {
            const GroupIDname = $("#" + CheckThis.id);
            const ClassCheckBox = $('.' + Classname + ' input');

            if (GroupIDname.is(':checked')) {
                ClassCheckBox.prop('checked', true);
            } else {
                ClassCheckBox.prop('checked', false);
            }
            implementAllcheckedss();
        }

        function checkSinglePermission(GroupClassName, GroupId, TotalPermission) {
            const ClassCheckBox = $('.' + GroupClassName + ' input');
            const GroupIDname = $("#" + GroupId);

            if ($("." + GroupClassName + ' input:checked').length == TotalPermission) {
                GroupIDname.prop('checked', true);
            } else {
                GroupIDname.prop('checked', false);
            }
            implementAllcheckedss();
        }
        function implementAllcheckedss(){
            const Totalpermission = {{count($permissions)}};
            const TatalpermissionGroup = {{count($Permission_Groups)}};
   

            if($('input[type="checkbox"]:checked').length >= (Totalpermission + TatalpermissionGroup) ){
                $('#checkPermissionAll').prop('checked', true);      
              } else {
                $('#checkPermissionAll').prop('checked', false);
              }
        }
    </script>
@endsection
