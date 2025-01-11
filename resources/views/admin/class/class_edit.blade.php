@extends('admin.layout')
@section('content')


<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Class</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Class</li>
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
        <div class="alert alert-success">{{session('success')}}</div>
      @endif
            <div class="card-header">
              <h3 class="card-title">Add Class</h3>
            </div>


            <form action="{{route('class.update')}}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$class->id}}">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Class</label>
                  <input type="name" name="name" class="form-control" id="exampleInputEmail1"
                    value="{{ old('name', $class->name) }}" placeholder="Enter Academic Year">
                </div>
                @error('name')
          <p class="text-danger">{{ $message }}</p>
          </p>
        @enderror
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Class</button>
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
  $(function () {
    bsCustomFileInput.init();
  });
</script>

@endsection