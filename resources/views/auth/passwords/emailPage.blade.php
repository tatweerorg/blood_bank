@extends('layouts.main')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
<div class="container perint">
    <div class="row maindiv">
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header " >اعادة ضبط كلمة المرور</div>
                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    @if($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                      </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">البريد الالكتروني</label>
                            <input id="email" type="email" name="email" class="form-control " >

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary submit">
                            ارسال
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
