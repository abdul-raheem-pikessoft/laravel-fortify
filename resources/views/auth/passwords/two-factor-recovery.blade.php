@extends('layouts.login_app')

@section('page')
    Recovery Code
@endsection

@section('content')
    <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf
        <div class="input-group mb-3">
            <input id="recovery_code" type="recovery_code" class="form-control @error('recovery_code') is-invalid @enderror" name="recovery_code" required autocomplete="current-code">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('recovery_code')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">submit</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <p class="mt-3 mb-1">
        <a href=" {{ route('login') }}" class="float-left">Login</a>
    </p>
@endsection()

@section('script')

@endsection
