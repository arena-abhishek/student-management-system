@extends('admin.layout')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Announcement Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Announcement Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">

                        <div class="card card-primary">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <div class="card-header">
                                <h3 class="card-title">Add Announcement </h3>
                            </div>


                            <form action="{{ route('announcement.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Message
                                        </label>
                                        <input type="name" name="message" class="form-control" id="exampleInputEmail1"
                                            placeholder="Write message">
                                        @error('message')
                                            <p class="text-danger">{{ $message }}</p>
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            Brodcast To
                                        </label>
                                        <select name="type" id=""
                                            class="
                                       form-control">
                                            <option value="all" disabled selected>Select List</option>
                                            <option value="student">student</option>
                                            <option value="teacher">teacher</option>
                                            <option value="parent">parent</option>
                                        </select>
                                        @error('message')
                                            <p class="text-danger">{{ $message }}</p>
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>




                </div>

            </div>
        </section>

    </div>
@endsection
@section('customJs')
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
