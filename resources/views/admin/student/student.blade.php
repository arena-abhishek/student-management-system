@extends('admin.layout')
@section('content')


<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Student</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Create Student</li>
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
              <h3 class="card-title">Add Student </h3>
            </div>


            <form action="{{ route('student.store') }}" method="post">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="academic_year_id">Select Academic Year</label>
                    <select name="academic_year_id" class="form-control">
                      <option value="">Select Academic Year</option>
                      @foreach ($academic_years as $academic_year) 
              <option value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
            @endforeach
                    </select>
                    @error('academic_year_id')
            <p class="text-danger">{{ $message }}</p>
          @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="class_id">Select Class</label>
                    <select name="class_id" class="form-control">
                      <option value="">Select Class</option>
                      @foreach ($classes as $class) 
              <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
                    </select>
                    @error('class_id')
            <p class="text-danger">{{ $message }}</p>
          @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="admission_date">Admission Date</label>
                    <input type="date" name="admission_date" class="form-control">
                    @error('admission_date')
            <p class="text-danger">{{ $message }}</p>
          @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="name">Student Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Student Name">
                    @error('name')
            <p class="text-danger">{{ $message }}</p>
          @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="father_name">Student's Father Name</label>
                    <input type="text" name="father_name" class="form-control"
                      placeholder="Enter Student's Father Name">
                    @error('father_name')
            <p class="text-danger">{{ $message }}</p>
          @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="mother_name">Student's Mother Name</label>
                    <input type="text" name="mother_name" class="form-control"
                      placeholder="Enter Student's Mother Name">
                    @error('mother_name')
            <p class="text-danger">{{ $message }}</p>
          @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" class="form-control">
                    @error('dob')
            <p class="text-danger">{{ $message }}</p>
          @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="mobno">Mobile Number</label>
                    <input type="text" name="mobno" class="form-control" placeholder="Enter Mobile Number">
                    @error('mobno')
            <p class="text-danger">{{ $message }}</p>
          @enderror
                  </div>
                  <div class="form-group col-md-4">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter Email Address">
                    @error('email')
            <p class="text-danger">{{ $message }}</p>
          @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="password">Create Password</label>
                    <input type="text" name="password" class="form-control" placeholder="Enter Password">
                    @error('password')
            <p class="text-danger">{{ $message }}</p>
          @enderror
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add Student</button>
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