@extends('layouts.app')

@section('header')
    Two Factor Authentication
@endsection

@section('content')
    <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <form action="/user/two-factor-authentication" method="post">
                                    @csrf
                                    @if(auth()->user()->two_factor_secret)
                                        @method('delete')
                                        <button class="btn btn-block btn-outline-danger" type="submit">Disable</button>
                                    @else
                                        <button class="btn btn-block btn-outline-success" type="submit">Enable</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert {{ session('status') == 'two-factor-authentication-disabled' ? 'alert-danger' : 'alert-success' }} " role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->user()->two_factor_secret)
                            <div class="pb-3">
                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </div>
@endsection
