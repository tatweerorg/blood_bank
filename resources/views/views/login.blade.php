@extends('layouts.main')

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
                    <a href="{{ route('password.request') }}"> هل نسيت كلمة السر؟</a>

                    @error('Password')
                        <div class="error" style="color:red;">{{ $message }}</div>
                    @enderror
                </div>

                <a href="{{ route('roles') }}">انشاء حساب </a>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary">تسجيل الدخول</button>
            </form>
        </div>
    </section>
@endsection
