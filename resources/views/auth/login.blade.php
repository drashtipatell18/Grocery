@extends('layouts.app')
@section('content')
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="../../assets/images/logo.svg">
                        </div>
                        <h6 class="font-weight-light">Login</h6>
                        <form class="pt-3">
                            <div class="form-group">
                                <label>Moblie Number</label>
                                <input type="number" class="form-control form-control-lg" name="mobile_no"
                                    placeholder="Phone & Moblie Number ">
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                    href="../../index.html">SIGN IN</a>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                                </div>
                                <a href="#" class="auth-link text-primary">Forgot password?</a>
                            </div>
                            <div class="mb-2 d-grid gap-2">
                                <a href="{{ url('auth/google') }}" class="btn btn-block btn-google auth-form-btn">
                                    <img src="{{ asset('assets/images/google.png') }}" alt="Google Icon" class="me-2 mb-1"
                                        style="width: 20px; height: 20px;">
                                    Sign up with your Google account
                                </a>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    </div>
@endsection
