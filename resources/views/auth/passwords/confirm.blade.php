@extends('layouts.login_app')

@section('page')
    Confirm Password
@endsection

@section('content')
    <p class="login-box-msg">Please confirm your password before continuing.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Confirm password</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <p class="mt-3 mb-1">
        <a href=" {{ route('twoFactor') }}">Back</a>
    </p>
@endsection

@section('script')

@endsection
