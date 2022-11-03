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
                                    <th>Course Title</th>
                                    <th>Course Category</th>
                                    <th>Course Description</th>
                                    <th>Course Requirements</th>
                                    <th>Course Image</th>
                                    <th>Course Instructor</th>
                                    <th>Course Tags</th>
                                    <th>Slug</th>
                                    <th>Price</th>
                                    <th>Action</th>

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

                <h6 class="mb-0 text-uppercase">Add Course Information</h6>
                <hr />
                <form id="addCourseForm" enctype="multipart/form-data">

                    <div id="addCourseErrorCard">
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Course Registration Form </h5>
                                </div>
                                <hr />

                                <input type="hidden" id="teacherId" name="teacher_id"
                                    value="{{ Session::get('teacherId') }}">
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
                                    <label class="form-check-label col-sm-3 col-form-label" for="flexCheckDefault">Select
                                        Tags
                                    </label>

                                    <div class="col-sm-9">
                                        @foreach ($tags as $tag)
                                            <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                                                style="margin-right: 5px" name="tags[]"><label
                                                class="form-check-label">{{ $tag->tag_name }}</label>
                                        @endforeach
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
                                        <textarea name="course_description" id="editorCourseDescription" class="form-control"
                                            placeholder="Enter Course Description"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputAddress4" class="col-sm-3 col-form-label">Course Requirements</label>
                                    <div class="col-sm-9">
                                        <textarea name="course_requirement" id="editorCourseRequirement" class="form-control"
                                            placeholder="Enter Course Requirements"></textarea>
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
                                        <button type="submit" id="addCourseBtn" class="btn btn-sm btn-primary px-5">Add
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

@section('scripts')
    <script>
        $(document).ready(function() {

            //All Course

            fetchCourses();

            function fetchCourses() {

                $.ajax({
                    type: "GET",
                    url: "/courses",
                    dataType: "json",
                    success: function(response) {

                        console.log(response.courseTags);

                        $("#courseTable").html("");

                        $.each(response.courses, function(key, item) {

                            let courseTag = "";

                            $.each(response.courseTags[key], function(key, tag) {

                                courseTag = courseTag  + tag.tag_name + " ";

                            });
                            console.log(courseTag);


                            $("#courseTable").append(
                                '<tr>\
                                            <td>' + (key + 1) + '</td>\
                                            <td>' + item.course_title + '</td>\
                                            <td>' + item.category_name + '</td>\
                                            <td>' + item.course_description + '</td>\
                                            <td>' + item.course_requirements + '</td>\
                                            <td><img src="../' + item.course_image + '"style="height:80px; width:80px; "></td>\
                                            <td>' + item.teacher_name + '</td>\
                                            <td>' + courseTag + '</td>\
                                            <td>' + item.slug + '</td>\
                                            <td>' + item.course_price + '</td>\
                                            <td>\
                                               <button value=' + item.id +
                                ' type="button" class="editCourseBtn btn btn-sm btn-info">Edit</button><button value=' +
                                item.id + ' type="button" class="deleteCourseBtn btn btn-sm btn-danger">Delete</button>\
                                            </td>\
                                         </tr>');

                            //data-bs-toggle="modal" data-bs-target="#exampleModal"
                        });

                    }
                });


            }


            //Add Course
            $(document).on('submit', '#addCourseForm', function(e) {

                e.preventDefault();

                let formData = new FormData($("#addCourseForm")[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/courses/store",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        if (response.status == 200) {


                            $("#addCourseErrorCard").html("");
                            $("#addCourseErrorCard").removeClass("card bg-danger");
                            $("#addCourseErrorCard").append(
                                "<div class='alert border-0 bg-light-success alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-success'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-success'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );

                            //After submit Emptying input
                            $("#addCourseForm").find("input").val("");
                            $("#addCourseForm").find("textarea").val("");

                            //fetchTeachers();



                        } else {


                            $("#addCourseErrorCard").html("");
                            $("#addCourseErrorCard").addClass("card bg-danger");
                            $("#addCourseErrorCard").append(
                                "<div id='addCourseErrorCardBody' class='card-body'></div>"
                            );
                            $("#addCourseErrorCardBody").append(
                                "<ul id='addCourseErrorList' class='list-group list-group-flush'></ul>"
                            )


                            $.each(response.errors, function(key, err_values) {
                                $('#addCourseErrorList').append(
                                    "<li class='list-group-item bg-transparent text-white'>" +
                                    err_values + '</li>')
                            });


                        }
                    }
                });

            });
        });
    </script>
@endsection
