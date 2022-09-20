@extends('frontEnd.master')
@section('title')
    Register
@endsection
@section('content')
    <div class="col-md-7 offset-md-3 login-form register-form" style="margin-top:100px; margin-bottom:50px">
        <form>

            <div class="row mb-2">
                <div class="col">
                    <!-- First Name input -->
                    <div class="form-outline">
                        <label class="form-label" for="form3Example1">First name</label>
                        <input type="text" id="form3Example1" class="form-control" placeholder="First Name" />

                    </div>
                </div>
                <div class="col">
                    <!-- First Name input -->
                    <div class="form-outline">
                        <label class="form-label" for="form3Example2">Last name</label>
                        <input type="text" id="form3Example2" class="form-control" placeholder="Last Name" />

                    </div>
                </div>
            </div>
            <!-- Address input -->
            <div class="form-outline mb-2">
                <label class="form-label" for="form3Example2">Address</label>
                <textarea class="form-control" placeholder="Enter Your Address" rows="3"></textarea>
            </div>

            <div class="row mb-2">
                <div class="col">
                    <!-- Email input -->
                    <div class="form-outline">
                        <label class="form-label" for="form2Example1">Email address</label>
                        <input type="email" id="form2Example1" class="form-control" placeholder="Enter Your Email" />
                    </div>
                </div>
                <div class="col">
                    <!-- Phone Number input -->
                    <div class="form-outline ">
                        <label class="form-label" for="form2Example1">Phone Number</label>
                        <input type="text" id="form2Example1" class="form-control"
                            placeholder="Enter Your Phone Number" />
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <!-- Password input -->
                    <div class="form-outline">
                        <label class="form-label" for="form2Example2">Password</label>
                        <input type="password" id="form2Example2" class="form-control" placeholder="Enter Your Password" />

                    </div>
                </div>
                <div class="col">
                    <!--Confirm Password input -->
                    <div class="form-outline">
                        <label class="form-label" for="form2Example2">Confirm Password</label>
                        <input type="password" id="form2Example2" class="form-control"
                            placeholder="Re-Enter Your Password" />

                    </div>
                </div>
            </div>
            <!-- 2 column grid layout for inline styling -->


            <!-- Submit button -->
            <div style="text-align: center">
                <button type="submit" class="btn mb-2 mt-2" style="width: 55%;">Sign Up</button>
            </div>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Already Have An Account? <a href="{{ route('student.login') }}">Login</a></p>
                <p>Or Log In With:</p>
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
                </button>
            </div>
        </form>

    </div>
@endsection
