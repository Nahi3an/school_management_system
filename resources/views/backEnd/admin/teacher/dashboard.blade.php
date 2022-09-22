@extends('backEnd.admin.master')
@section('content')
    <h3>Welcome {{ Session::get('teacherName') }}</h3>
@endsection
