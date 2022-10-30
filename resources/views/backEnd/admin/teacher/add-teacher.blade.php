@extends('backEnd.admin.master')
@section('content')
    <div class="row">
        <div id="allTeachers">
            <h6 class="mb-0 text-uppercase">All Teacher Information</h6>
            <hr />
            <div class="card">
                <div class="card-body">
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
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>

                            </thead>
                            <tbody id="teacherTable">
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
        <div id="addTeacher">
            <div class="col-xl-9 mx-auto">
                <h3 class="text-success">{{ session('message') }}</h3>
                <h6 class="mb-0 text-uppercase">Add Teacher</h6>
                <hr />
                <form id="addTeacher" method="POST" enctype="multipart/form-data">
                    <div id="addTeacherErrorCard">
                    </div>
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
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Your Name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Phone No</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone No">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Email Address</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" placeholder="Email Address"
                                            name="email">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputAddress4" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea name="address" class="form-control" rows="3" placeholder="Address" name="address"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputAddress4" class="col-sm-3 col-form-label">Upload Image:</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image" id="teacherImage" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" id="add-teacher-btn"
                                            class="btn btn-primary px-5">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Teacher Modal --}}
        <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Teacher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="editTeacher" method="POST" enctype="multipart/form-data">
                            {{-- <div id="addTeacherErrorCard">
                            </div> --}}
                            <input type="hidden" name="id" id="teacherId">
                            <div id="editTeacherErrorCard">
                            </div>
                            <div class="card" id="editTeacherCard">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="card-title d-flex align-items-center">
                                            <h5 class="mb-0">Teacher Info Edit Form </h5>
                                        </div>
                                        <hr />
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">Enter Your
                                                Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" id="teacherName"
                                                    class="form-control" placeholder="Enter Your Name">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Phone No</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="phone" id="teacherPhone"
                                                    class="form-control" placeholder="Phone No">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Email
                                                Address</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" placeholder="Email Address"
                                                    id="teacherEmail" name="email">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputAddress4" class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea id="teacherAddress" class="form-control" rows="3" placeholder="Address" name="address"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputAddress4" class="col-sm-3 col-form-label">Profile
                                                Picture:</label>
                                            <div class="col-sm-9">
                                                <img src="" alt="" id="oldImage" style="height: 100px; width:100px">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputAddress4" class="col-sm-3 col-form-label">Upload
                                                Image:</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="image" id="teacherImage"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <button type="submit" id="edit-teacher-btn"
                                                    class="btn btn-primary px-5">Save Changes</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="modal-footer">

                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> --}}
                </div>
            </div>
        </div>


    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {

            fetchTeachers();

            function fetchTeachers() {

                //console.log("Hello");

                $.ajax({
                    type: "GET",
                    url: "/teachers",
                    dataType: "json",
                    success: function(response) {

                        $("#teacherTable").html("")
                        //
                        $.each(response.teachers, function(key, item) {
                            //imageUrl = item.image;
                            $("#teacherTable").append(
                                '<tr>\
                                                            <td>' + (key + 1) + '</td>\
                                                            <td>' + item.name + '</td>\
                                                            <td>' + item.phone + '</td>\
                                                            <td>' + item.email + '</td>\
                                                            <td>' + item.address + '</td>\
                                                            <td><img src="../' + item.image + '" style="height:80px; width:80px; "></td>\
                                                            <td><button value=' + item.id + ' type="button" class="edit-teacher-btn btn btn-sm btn-info">Edit</button></td>\
                                                            <td> <button value=' + item.id + ' type="button" class="delete_btn btn btn-sm btn-danger">Delete</button></td>\
                                                            </tr>');

                            //data-bs-toggle="modal" data-bs-target="#exampleModal"
                        });
                    }
                });
            }

            //Add Teacher
            $(document).on('submit', '#addTeacher', function(e) {

                e.preventDefault();

                let formData = new FormData($("#addTeacher")[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/teachers/store",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        if (response.status == 200) {


                            $("#addTeacherErrorCard").html("");
                            $("#addTeacherErrorCard").removeClass("card bg-danger");
                            $("#addTeacherErrorCard").append(
                                "<div class='alert border-0 bg-light-success alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-success'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-success'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );

                            //After submit Emptying input
                            $("#addTeacher").find("input").val("");
                            $("#addTeacher").find("textarea").val("");

                            fetchTeachers();



                        } else {


                            $("#addTeacherErrorCard").html("");
                            $("#addTeacherErrorCard").addClass("card bg-danger");
                            $("#addTeacherErrorCard").append(
                                "<div id='addTeacherErrorCardBody' class='card-body'></div>"
                            );
                            $("#addTeacherErrorCardBody").append(
                                "<ul id='addTeacherErrorList' class='list-group list-group-flush'></ul>"
                            )


                            $.each(response.errors, function(key, err_values) {
                                $('#addTeacherErrorList').append(
                                    "<li class='list-group-item bg-transparent text-white'>" +
                                    err_values + '</li>')
                            });


                        }
                    }
                });
            });


            //edit teacher
            $(document).on('click', '.edit-teacher-btn', function(e) {
                e.preventDefault();

                let teacherId = $(this).val();
                // console.log(teacherId);
                $("#editTeacherModal").modal('show');

                $.ajax({
                    type: "GET",
                    url: "/teachers/edit/" + teacherId,

                    success: function(response) {

                        if (response.status == 200) {

                            $("#editTeacherCard").removeClass('d-none');
                            $("#editTeacher").find("input").val("");
                            $("#editTeacher").find("textarea").val("");
                            $("#teacherName").val(response.teacher.name);
                            $("#teacherEmail").val(response.teacher.email);
                            $("#teacherPhone").val(response.teacher.phone);
                            $("#teacherAddress").val(response.teacher.address);
                            //$("#oldImage").src(response.teacher.image);
                            $("#oldImage").attr("src", '../'+response.teacher.image);
                            $("#teacherId").val(response.teacher.id);

                        } else {

                            $("#editTeacherCard").addClass('d-none');
                            $("#editTeacherErrorCard").html("");
                            $("#editTeacherErrorCard").removeClass("card bg-danger");
                            $("#editTeacherErrorCard").append(
                                "<div class='alert border-0 bg-light-danger alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-danger'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-danger'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );
                        }
                    }
                });


            });

        });
    </script>
@endsection
