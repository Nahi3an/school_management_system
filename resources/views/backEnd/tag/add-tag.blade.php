@extends('backEnd.master')
@section('content')
    <div class="row">
        <div id="allTagSection">
            <h6 class="mb-0 text-uppercase">All Tag Information</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div id="updateTagErrorCard">


                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>sl No.</th>
                                    <th>Tag Name</th>
                                    <th>Action</th>
                                    {{-- <th>Edit</th>
                                    <th>Delete</th> --}}

                                </tr>

                            </thead>
                            <tbody id="tagTable">
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
        {{-- Add Category Section --}}

        <div id="addTagSection">
            <div class="col-xl-9 mx-auto">

                <h6 class="mb-0 text-uppercase">Add Tag</h6>
                <hr />
                <form id="addTagForm">
                    <div id="addTagErrorCard">

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Tag Registration Form </h5>
                                </div>
                                <hr />
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Tag
                                        Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="tag_name" class="form-control"
                                            placeholder="Enter Tag Name">
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" id="addTagBtn" class="btn btn-primary px-5">Add
                                            Tag</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Tag Section --}}

        <div class="modal fade" id="editTagModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Tag </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="updateTagForm">

                            <div id="editTagErrorCard">
                            </div>
                            <input type="hidden" name="id" id="tagId">
                            <div class="card" id="editTagCard">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="card-title d-flex align-items-center">
                                            <h5 class="mb-0">Tag Info Edit Form </h5>
                                        </div>
                                        <hr />
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">Tag
                                                Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="tagName" name="tag_name" class="form-control"
                                                    placeholder="Enter Tag Name">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <button type="submit" id="updateTagBtn" class="btn btn-primary px-5">Save
                                                    Changes</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        {{-- Delete Modal --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">Are You Sure You Want To Delete?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <form id="deleteTagForm">
                            <input type="hidden" id="deleteTagId" name="tag_id">
                            <button type="submit" class="btn btn-dark" id="finalCategoryDeleteBtn">Yes</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {

            //All Tag
            fetchTags();

            function fetchTags() {

                $.ajax({
                    type: "GET",
                    url: "/tags",
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {

                            $("#tagTable").html("");

                            $.each(response.tags, function(key, item) {

                                $("#tagTable").append(
                                    '<tr>\
                                                <td>' + (key + 1) + '</td>\
                                                <td>' + item.tag_name + '</td>\
                                                <td><button value=' + item.id +
                                    ' type="button" class="editTagBtn btn btn-sm btn-info">Edit</button><button value=' +
                                    item.id + ' type="submit" type="button" class="deleteTagBtn btn btn-sm btn-danger">Delete</button>\
                                                </td>\
                                            </tr>');
                            });
                        }
                    }
                });


            }

            //Add Tag
            $(document).on('submit', '#addTagForm', function(e) {

                e.preventDefault();

                let formData = new FormData($('#addTagForm')[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/tags/store",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {



                        if (response.status == 200) {

                            $("#addTagErrorCard").html("");
                            $("#addTagErrorCard").removeClass("card bg-danger");
                            $("#addTagErrorCard").append(
                                "<div class='alert border-0 bg-light-success alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-success'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-success'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );

                            $("#addTagForm").find("input").val("");
                            fetchTags();


                        } else {


                            $("#addTagErrorCard").html("");
                            $("#addTagErrorCard").addClass("card bg-danger");
                            $("#addTagErrorCard").append(
                                "<div id='addTagErrorCardBody' class='card-body'></div>"
                            );

                            $("#addTagErrorCardBody").append(
                                "<ul id='addTagErrorList' class='list-group list-group-flush'></ul>"
                            );

                            $.each(response.errors, function(key, error) {
                                $('#addTagErrorList').append(
                                    "<li class='list-group-item bg-transparent text-white'>" +
                                    error + '</li>')
                            });



                        }
                    }
                });

            });


            //Edit Tag
            $(document).on('click', '.editTagBtn', function(e) {

                e.preventDefault();
                //console.log(e);

                $("#editTagModal").modal('show');
                $("#editTagErrorCard").html("");
                let tagId = $(this).val();
                $("#tagId").val(tagId);

                $.ajax({
                    type: "GET",
                    url: "/tags/" + tagId + "/edit",
                    dataType: "json",
                    success: function(response) {


                        if (response.status == 200) {

                            $("#tagName").val(response.tag.tag_name)

                        }
                    }
                });
            });

            //Update Tag
            $(document).on('submit', '#updateTagForm', function(e) {

                e.preventDefault();
                //console.log(e);

                let tagId = $("#tagId").val();

                let formData = new FormData($("#updateTagForm")[0]);

                //CONVERTING POST TO PUT
                formData.append('_method', 'PUT');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/tags/" + tagId,
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        if (response.status == 200) {

                            $("#editTagModal").modal('hide');
                            $("#updateTagErrorCard").html("");
                            $("#updateTagErrorCard").removeClass("card bg-danger");
                            $("#updateTagErrorCard").append(
                                "<div class='alert border-0 bg-light-success alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-success'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-success'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );

                            $("#updateTagForm").find("input").val("");
                            fetchTags();


                        } else {


                            $("#editTagErrorCard").html("");
                            $("#editTagErrorCard").addClass("card bg-danger");
                            $("#editTagErrorCard").append(
                                "<div id='editTagErrorCardBody' class='card-body'></div>"
                            );

                            $("#editTagErrorCardBody").append(
                                "<ul id='addTagErrorList' class='list-group list-group-flush'></ul>"
                            );

                            $.each(response.errors, function(key, error) {
                                $('#addTagErrorList').append(
                                    "<li class='list-group-item bg-transparent text-white'>" +
                                    error + '</li>')
                            });



                        }
                    }
                });
            });

            $(document).on('click', '.deleteTagBtn', function(e) {

                e.preventDefault();
                let tagId = $(this).val();
                $("#deleteTagId").val(tagId);
                $("#deleteModal").modal('show');



            });

            $(document).on('submit', '#deleteTagForm', function(e) {

                e.preventDefault();

                $("#deleteModal").modal('hide');

                let tagId = $("#deleteTagId").val();


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/tags/" + tagId,
                    dataType: "json",
                    success: function(response) {

                        if (response.status == 200) {

                            $("#updateTagErrorCard").html("");
                            $("#updateTagErrorCard").removeClass("card bg-danger");
                            $("#updateTagErrorCard").append(
                                "<div class='alert border-0 bg-light-success alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-success'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-success'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );

                      
                            fetchTags();



                        }
                    }
                });
            });

        });
    </script>
@endsection
