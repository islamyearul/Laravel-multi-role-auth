@extends('backend.layouts.adminmaster')
@section('title')
    <h3>permission Create</h3>
@endsection
@section('admin-content')
    <div class="container-fluid pt-4 px-4 ">
        <div class="row  g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="row">

                        <div class="col-md-10 text-left">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <span
                                        class="text-center text-uppercase font-weight-bold h5 px-3 text-secondary ">permission
                                        - Create </span>

                                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin-permission.index') }}">permission</a></li>
                                    <li class="breadcrumb-item"><a href="#">permission Create</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <hr>
                    <hr><br>

                    <form action="{{ route('admin-permission.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Guard Name</label>
                            <input type="text" name="guard_name" class="form-control" id="" value="web"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Group Name</label>
                            <input type="text" list="cars" name="group_name" class="form-control" />
                            <datalist id="cars">
                                @foreach ($permission_groups as $Group)
                                        <option value="{{ $Group->name }}">{{ $Group->name }}</option>
                                @endforeach

                            </datalist>
                        </div>
                        <button type="submit" class="btn btn-info ">Create permission</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
@endsection
