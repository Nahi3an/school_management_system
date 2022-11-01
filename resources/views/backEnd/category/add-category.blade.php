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
                                    {{-- <th>Edit</th>
                                    <th>Delete</th> --}}

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
        {{-- Add Category Section --}}

        <div id="addCategorySection">
            <div class="col-xl-9 mx-auto">

                <h6 class="mb-0 text-uppercase">Add Course Category</h6>
                <hr />
                <form id="addCategoryForm" enctype="multipart/form-data">
                    <div id="addCategoryErrorCard">

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="card-title d-flex align-items-center">
                                    <h5 class="mb-0">Cateogry Registration Form </h5>
                                </div>
                                <hr />
                                <div class="row mb-3">
                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Category
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
                                        <button type="submit" id="addCategoryBtn" class="btn btn-primary px-5">Add
                                            Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit Category Section --}}

        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Category Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form id="updateCategoryForm" enctype="multipart/form-data">

                            <div id="editCategoryErrorCard">
                            </div>
                            <input type="hidden" name="id" id="categoryId">
                            <div class="card" id="editCategoryCard">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="card-title d-flex align-items-center">
                                            <h5 class="mb-0">Category Info Edit Form </h5>
                                        </div>
                                        <hr />
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">Category
                                                Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="categoryName" name="category_name"
                                                    class="form-control" placeholder="Enter Category Name">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputAddress4" class="col-sm-3 col-form-label">Display Image</label>
                                            <div class="col-sm-9">
                                                <img src="" alt="" id="oldImage"
                                                    style="height: 100px; width:100px">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputAddress4" class="col-sm-3 col-form-label">Upload Image:</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="category_image" id="uploadImage"
                                                    class="form-control">
                                            </div>
                                        </div>




                                        <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <button type="submit" id="updateCategoryBtn"
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

        {{-- Delete Modal --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <input type="hidden" id="deleteCategoryId">
                        <h5 class="modal-title text-white">Are You Sure You Want To Delete?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-dark" id="finalCategoryDeleteBtn">Yes</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {


            //All Category
            fetchCategories();

            function fetchCategories() {

                $.ajax({
                    type: "GET",
                    url: "/categories",
                    dataType: "json",
                    success: function(response) {

                        if (response.status == 200) {

                            $('#categoryTable').html("");

                            $.each(response.categories, function(key, item) {

                                let status = "";
                                let statusBtn = "";
                                if (item.status == 1) {
                                    status = "Available";
                                    btnClass = "btn-danger";
                                } else {
                                    status = "Unavaible";
                                    btnClass = "btn-warning";

                                }

                                $("#categoryTable").append(
                                    '<tr>\
                                                                                            <td>' + (key + 1) + '</td>\
                                                                                            <td>' + item.category_name + '</td>\
                                                                                            <td><img src="../' + item
                                    .category_image + '"style="height:80px; width:80px; "></td>\
                                                                                            <td><b>' + status + '</b></td>\
                                                                                            <td><button value=' + item.id +
                                    ' type="button" class="categoryStatusBtn btn btn-sm ' +
                                    btnClass + '">Change Status</button>\
                                                                                            <button value=' + item.id + ' type="button" class="editCategoryBtn btn btn-sm btn-info">Edit</button>\
                                                                                           <button value=' + item.id + ' type="button" class="deleteCategoryBtn btn btn-sm btn-danger">Delete</button></td>\
                                                                                        </tr>');
                            });

                        }
                    }
                });
            }

            //Add Category
            $(document).on('submit', '#addCategoryForm', function(e) {

                e.preventDefault();

                let formData = new FormData($('#addCategoryForm')[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/categories/store",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        //console.log(response);

                        if (response.status == 200) {

                            $("#addCategoryErrorCard").html("");
                            $("#addCategoryErrorCard").removeClass("card bg-danger");
                            $("#addCategoryErrorCard").append(
                                "<div class='alert border-0 bg-light-success alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-success'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-success'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );

                            $("#addCategoryForm").find("input").val("");
                            // $("#addCategory").find("textarea").val("");

                        } else {


                            $("#addCategoryErrorCard").html("");
                            $("#addCategoryErrorCard").addClass("card bg-danger");
                            $("#addCategoryErrorCard").append(
                                "<div id='addCategoryErrorCardBody' class='card-body'></div>"
                            );

                            $("#addCategoryErrorCardBody").append(
                                "<ul id='addCategoryErrorList' class='list-group list-group-flush'></ul>"
                            );

                            $.each(response.errors, function(key, error) {
                                $('#addCategoryErrorList').append(
                                    "<li class='list-group-item bg-transparent text-white'>" +
                                    error + '</li>')
                            });



                        }
                    }
                });

            });

            //Change Status
            $(document).on('click', '.categoryStatusBtn', function() {

                let categoryId = $(this).val();

                //console.log(categoryId);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/categories/status/" + categoryId,
                    dataType: "json",
                    success: function(response) {

                        if (response.status == 200) {
                            fetchCategories();
                            $("#updateCategoryErrorCard").html("");
                            // $("#updateCategoryErrorCard").removeClass("card bg-danger");
                            $("#updateCategoryErrorCard").append(
                                "<div class='alert border-0 bg-light-success alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-success'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-success'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );

                        } else {

                            $("#updateCategoryErrorCard").html("");
                            //$("#updateCategoryErrorCard").removeClass("card bg-danger");
                            $("#updateCategoryErrorCard").append(
                                "<div class='alert border-0 bg-light-danger alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-danger'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-danger'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );
                            s
                        }
                    }
                });
            });

            //Edit Category
            $(document).on('click', '.editCategoryBtn', function() {

                let categoryId = $(this).val();
                $("#uploadImage").val("");

                $.ajax({
                    type: "GET",
                    url: "/categories/edit/" + categoryId,
                    dataType: "json",
                    success: function(response) {

                        //console.log(response);
                        $('#editCategoryModal').modal('show');

                        if (response.status == 200) {

                            $("#editCategoryCard").removeClass('d-none');

                            $("#categoryName").val(response.category.category_name);
                            $("#oldImage").attr("src", '../' + response.category
                                .category_image);
                            $("#categoryId").val(response.category.id);



                        } else {

                            $("#editCategoryCard").addClass('d-none');
                            $("#editCategoryErrorCard").html("");
                            $("#editCategoryErrorCard").removeClass("card bg-danger");
                            $("#editCategoryErrorCard").append(
                                "<div class='alert border-0 bg-light-danger alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-danger'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-danger'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );
                        }
                    }
                });
            });

            //Update Category
            $(document).on('submit', '#updateCategoryForm', function(e) {

                e.preventDefault();

                let categoryId = $("#categoryId").val();
                let formData = new FormData($('#updateCategoryForm')[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({

                    type: "POST",
                    url: "/categories/update/" + categoryId,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        console.log(response);
                        if (response.status == 200) {

                            $("#editCategoryModal").modal('hide');
                            $("#updateCategoryErrorCard").html("");
                            $("#updateCategoryErrorCard").removeClass("card bg-success");
                            $("#updateCategoryErrorCard").append(
                                "<div class='alert border-0 bg-light-success alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-success'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-success'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );

                            fetchCategories();

                        } else if (response.status == 400) {

                            $("#editCategoryErrorCard").html("");
                            $("#editCategoryErrorCard").addClass("card bg-danger");
                            $("#editCategoryErrorCard").append(
                                "<div id='editCategoryErrorCardBody' class='card-body'></div>"
                            );
                            $("#editCategoryErrorCardBody").append(
                                "<ul id='editCategoryErrorList' class='list-group list-group-flush'></ul>"
                            )

                            $.each(response.errors, function(key, err_values) {
                                $('#editCategoryErrorList').append(
                                    "<li class='list-group-item bg-transparent text-white'>" +
                                    err_values + '</li>')
                            });
                        }
                    }
                });



            });

            //Delete  Category Modal
            $(document).on('click', '.deleteCategoryBtn', function(e) {

                e.preventDefault();

                let categoryId = $(this).val();

                $("#deleteModal").modal('show');
                $("#deleteCategoryId").val(categoryId);


            });

            //Delete Category Fianl

            $(document).on('click', '#finalCategoryDeleteBtn', function(e) {

                e.preventDefault();

                let categoryId = $("#deleteCategoryId").val();

                //  console.log(categoryId);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({

                    type: "POST",
                    url: "/categories/delete/" + categoryId,

                    success: function(response) {

                        //console.log(response);
                        $("#deleteModal").modal('hide');
                        if (response.status == 200) {


                            $("#updateCategoryErrorCard").html("");
                            $("#updateCategoryErrorCard").removeClass("card bg-success");
                            $("#updateCategoryErrorCard").append(
                                "<div class='alert border-0 bg-light-danger alert-dismissible fade show py-2'><div class='d-flex align-items-center'><div class='fs-3 text-danger'><i class='bi bi-check-circle-fill'></i></div><div class='ms-3'><div class='text-danger'>" +
                                response.message +
                                "</div></div></div> <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
                            );
                            //alert(response.message);
                            fetchCategories();
                        } else {

                            $("#updateCategoryErrorCard").html("");
                            $("#updateCategoryErrorCard").removeClass("card bg-success");
                            $("#updateCategoryErrorCard").append(
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
