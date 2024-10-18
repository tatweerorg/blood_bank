@extends('layouts.main')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<section class="login-section">
    <div class="container">
        <h2>تسجيل الدخول</h2>




        <form action="{{ route('login.post') }}" method="POST" class="login-form">
            @csrf
            @if(session('success'))
            <p class="alert alert-success ">{{ session('success') }}</p>
            @endif
            @if(session('error'))
            <p class="alert alert-danger ">{{ session('error') }}</p>
            @endif
            <!-- Email -->
            <div class="form-group">
                <label for="email" >البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
                @error('Email')
                <div class="error" style="color:red;">{{ $message }}</div>
                @enderror
            </div>

           


                <div class="form-group">
                    <label for="password" >كلمة المرور</label>
                    <input type="password" id="password" name="password" >
                    @error('Password')
                        <div class="error" style="color:red;">{{ $message }}</div>
                    @enderror
                    <a href="{{ route('password.request') }}" class="create_account_tag">هل نسيت كلمة السر؟</a>

                </div>

                <a href="{{ route('roles') }}" class="create_account_tag"> انشاء حساب </a>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary">تسجيل الدخول</button>
            </form>
        </div>
    </section>
@endsection
