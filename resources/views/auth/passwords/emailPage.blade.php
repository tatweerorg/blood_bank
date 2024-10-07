@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                    @csrf
    <div class="form-group">
        <label for="email">{{ __('Email Address') }}</label>
        <input id="email" type="email" name="email" >

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        {{ __('Send Password Reset Link') }}
    </button>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
