@extends('frontEnd.master')
@section('title')
    Teacher Login
@endsection
@section('content')
    <div class="container">
        <div class="col-md-4 offset-md-4 login-form" style="margin-top:100px; margin-bottom:50px">
            <div class="heading_main text_align_center">
                <h2><span>Teacher </span>Login</h2>
            </div>

            <h3 class="text-danger text-ce">{{ session('message') }}</h3>

            <form method="POST" action="{{ route('teacher.login') }}">
                <!-- Email input -->
                @csrf
                <div class="form-outline mb-2">
                    <label class="form-label" for="form2Example1">Email address</label>
                    <input type="email" id="form2Example1" class="form-control" name="email"
                        placeholder="Enter Your Email" />

                </div>

                <!-- Password input -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="form2Example2">Password</label>
                    <input type="password" id="form2Example2" class="form-control" name="password"
                        placeholder="Enter Your Password" />

                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-2">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example34" />
                            <label class="form-check-label" for="form2Example34"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Simple link -->
                        <a href="#">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-block mb-2 mt-2">Log In</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Don't Have An Account?</p>
                    {{-- <p>Or Sign Up With:</p>
                    <button type="button" class="btn btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>

                    <button type="button" class="btn btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>

                    <button type="button" class="btn btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>

                    <button type="button" class="btn btn-floating mx-1">
                        <i class="fab fa-github"></i>
                    </button> --}}
                </div>
            </form>

        </div>
    </div>
@endsection
