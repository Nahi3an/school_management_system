@extends('backEnd.admin.master')
@section('content')
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <h3 class="text-success">{{ session('message') }}</h3>
            <h6 class="mb-0 text-uppercase">Add Teacher Form</h6>
            <hr />
            <form action="{{ route('new.teacher') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <h5 class="mb-0">Teacher Registration Form </h5>
                            </div>
                            <hr />
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Enter Your Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="inputEnterYourName"
                                        placeholder="Enter Your Name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Phone No</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="form-control" id="inputPhoneNo2"
                                        placeholder="Phone No">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Email Address</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="inputEmailAddress2"
                                        placeholder="Email Address" name="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputAddress4" class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" class="form-control" id="inputAddress4" rows="3" placeholder="Address"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputAddress4" class="col-sm-3 col-form-label">Upload Image:</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" id="" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary px-5">Register</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
