@extends('backEnd.admin.master')
@section('content')
    <h6 class="mb-0 text-uppercase">All Teacher Information</h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <h5 class="text-success">{{ session('message') }}</h5>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>sl No.</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1;@endphp
                        @foreach ($teachers as $teacher)
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
                        @endforeach


                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
