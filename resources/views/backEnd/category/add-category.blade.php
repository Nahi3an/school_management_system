@extends('backEnd.master')
@section('content')
    <div class="row">
        <div id="allCategoriesSection">
            <h6 class="mb-0 text-uppercase">All Course Category Information</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div id="updateCategoryErrorCard">


                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>sl No.</th>
                                    <th>Category Name</th>
                                    <th>Display Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>

                            </thead>
                            <tbody id="categoryTable">
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
        <div id="addCategorySection">
            <div class="col-xl-9 mx-auto">

                <h6 class="mb-0 text-uppercase">Add Course Category</h6>
                <hr />
                <form id="addCategory" method="POST" enctype="multipart/form-data">
                    <div id="addCategoryrErrorCard">
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Cateogry Registration Form </h5>
                                </div>
                                <hr />
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Enter Category
                                        Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="category_name" class="form-control"
                                            placeholder="Enter Category Name">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputAddress4" class="col-sm-3 col-form-label">Upload Image:</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="category_image" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" id="addCategoryBtn"
                                            class="btn btn-primary px-5">Add Category</button>
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
    {{-- <script>
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
                            let status = "";
                            let statusBtn = "";
                            if (item.status == 1) {
                                status = "Permited";
                                statusBtn = "Restrict";
                                btnClass = "btn-danger";
                            } else {
                                status = "Restricted";
                                statusBtn = "Permit";
                                btnClass = "btn-warning";

                            }

                            $("#teacherTable").append(
                                '<tr>\
                                                    <td>' + (key + 1) + '</td>\
                                                    <td>' + item.name + '</td>\
                                                    <td>' + item.phone + '</td>\
                                                    <td>' + item.email + '</td>\
                                                    <td>' + item.address + '</td>\
                                                    <td><img src="../' + item.image + '"style="height:80px; width:80px; "></td>\
                                                    <td><b>' + status + '</b></td>\
                                                    <td><button value=' + item.id +
                                ' type="button" class="teacherStatusBtn btn btn-sm ' +
                                btnClass + ' ">' +
                                statusBtn + '</button></td>\
                                                    <td><button value=' + item.id + ' type="button" class="edit-teacher-btn btn btn-sm btn-info">Edit</button></td>\
                                                    <td> <button value=' + item.id + ' type="button" class="deleteTeacherBtn btn btn-sm btn-danger">Delete</button></td>\
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

            //Change Status
            $(document).on('click', '.teacherStatusBtn', function(e) {

                e.preventDefault();

                let teacherId = $(this).val();
                console.log(teacherId);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/teachers/status/" + teacherId,
                    success: function(response) {

                        console.log(response);

                        if (response.status == 200) {
                            fetchTeachers();



                            // $("#editTeacherCard").addClass('d-none');
                            $("#updateTeacherErrorCard").html("");
                            $("#updateTeacherErrorCard").removeClass("card bg-danger");
                            $("#updateTeacherErrorCard").append(
                                "<div class='alert border-0 bg-light-success alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-success'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-success'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );


                        } else {

                            $("#updateTeacherErrorCard").html("");
                            $("#updateTeacherErrorCard").removeClass("card bg-danger");
                            $("#updateTeacherErrorCard").append(
                                "<div class='alert border-0 bg-light-danger alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-danger'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-danger'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );
                        }
                    }
                });


            });
            //edit teacher
            $(document).on('click', '.edit-teacher-btn', function(e) {

                e.preventDefault();
                $("#editTeacherErrorCard").html("");

                $("#uploadImage").val("")

                let teacherId = $(this).val();

                $("#editTeacherModal").modal('show');

                $.ajax({
                    type: "GET",
                    url: "/teachers/edit/" + teacherId,

                    success: function(response) {



                        if (response.status == 200) {

                            $("#editTeacherCard").removeClass('d-none');

                            $("#teacherName").val(response.teacher.name);
                            $("#teacherEmail").val(response.teacher.email);
                            $("#teacherPhone").val(response.teacher.phone);
                            $("#teacherAddress").val(response.teacher.address);
                            $("#oldImage").attr("src", '../' + response.teacher.image);
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

            //Update teacher
            $(document).on('submit', '#updateTeacherForm', function(e) {

                e.preventDefault();

                let teacherId = $("#teacherId").val();
                //console.log("hello");

                let editFormData = new FormData($("#updateTeacherForm")[0]);


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/teachers/update/" + teacherId,
                    data: editFormData,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        if (response.status == 200) {

                            $("#editTeacherModal").modal('hide');
                            $("#updateTeacherErrorCard").html("");
                            $("#updateTeacherErrorCard").removeClass("card bg-success");
                            $("#updateTeacherErrorCard").append(
                                "<div class='alert border-0 bg-light-success alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-success'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-success'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );
                            //alert(response.message);
                            fetchTeachers();
                        } else if (response.status == 400) {

                            $("#editTeacherErrorCard").html("");
                            $("#editTeacherErrorCard").addClass("card bg-danger");
                            $("#editTeacherErrorCard").append(
                                "<div id='editTeacherErrorCardBody' class='card-body'></div>"
                            );
                            $("#editTeacherErrorCardBody").append(
                                "<ul id='editTeacherErrorList' class='list-group list-group-flush'></ul>"
                            )

                            $.each(response.errors, function(key, err_values) {
                                $('#editTeacherErrorList').append(
                                    "<li class='list-group-item bg-transparent text-white'>" +
                                    err_values + '</li>')
                            });

                        } else {


                        }
                    }
                });
            });

            //delete Modal
            $(document).on('click', '.deleteTeacherBtn', function(e) {
                e.preventDefault();

                let teacherId = $(this).val();

                $("#deleteModal").modal('show');
                $("#deleteTeacherId").val(teacherId);



            });

            //Delete final
            $(document).on('click', '#finalTeacherDeleteBtn', function(e) {

                e.preventDefault();
                $("#deleteModal").modal('hide');
                let teacherId = $("#deleteTeacherId").val();
                console.log(teacherId);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: "/teachers/delete/" + teacherId,
                    success: function(response) {

                        if (response.status == 200) {


                            $("#updateTeacherErrorCard").html("");
                            $("#updateTeacherErrorCard").removeClass("card bg-success");
                            $("#updateTeacherErrorCard").append(
                                "<div class='alert border-0 bg-light-danger alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-danger'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-danger'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );
                            //alert(response.message);
                            fetchTeachers();
                        } else {

                            $("#updateTeacherErrorCard").html("");
                            $("#updateTeacherErrorCard").removeClass("card bg-success");
                            $("#updateTeacherErrorCard").append(
                                "<div class='alert border-0 bg-light-danger alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-danger'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-danger'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );
                        }
                    }
                });
            });

        });
    </script> --}}
@endsection
