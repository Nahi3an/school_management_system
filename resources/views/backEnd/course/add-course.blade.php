@extends('backEnd.master')

@section('content')
    <div class="row">
        {{-- All Course Section --}}
        <div id="allCoursesSection">
            <h6 class="mb-0 text-uppercase">All Course Information</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div id="updateCourseErrorCard">

                    </div>
                    <h5 class="text-success">{{ session('message') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>sl No.</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>

                            </thead>
                            <tbody id="courseTable">
                                {{-- @php $i = 1;@endphp --}}
                                {{-- @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->phone }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->address }}</td>
                                <td><img src="{{ asset($teacher->image) }}" style="height: 70px; width:60px"></td>
                                <td>
                                    <a href="{{ route('edit.teacher', ['id' => $teacher->id]) }}"
                                        class="btn btn-sm btn-primary mb-1">Edit</a>
                                    <form action="{{ route('delete.teacher') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $teacher->id }}" name="id">
                                        <input type="submit" value="Delete" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete This Record?')">
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add  Course --}}
        <div id="addCourseSection">
            <div class="col-xl-9 mx-auto">

                <h6 class="mb-0 text-uppercase">Add Teacher</h6>
                <hr />
                <form id="addCourse" method="POST" enctype="multipart/form-data">
                    <div id="addCourseErrorCard">
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Course Registration Form </h5>
                                </div>
                                <hr />
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Course Category
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="form-check-label col-sm-3 col-form-label" for="flexCheckDefault" >Default checkbox</label>

                                    <div class="col-sm-9">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Course Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="course_title" class="form-control"
                                            placeholder="Enter Course Title">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputAddress4" class="col-sm-3 col-form-label">Course Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="course_description" class="form-control" rows="3" placeholder="Address" name="address"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Slug</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="slug" class="form-control"
                                            placeholder="Course Slug  (optional)">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Course Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Enter Course Price"
                                            name="course_price">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputAddress4" class="col-sm-3 col-form-label">Upload Display Image:</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="course_image" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" id="addCourseBtn" class="btn btn-primary px-5">Add
                                            Course</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
