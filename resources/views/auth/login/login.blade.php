@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <section class="login-section">
        <div class="container">
            <h2>تسجيل الدخول</h2>

            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif

            @if(session('error'))
                <p style="color:red">{{ session('error') }}</p>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="login-form">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="Email" value="{{ old('Email') }}" >
                    @error('Email')
                        <div class="error" style="color:red;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" id="password" name="Password" >
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
