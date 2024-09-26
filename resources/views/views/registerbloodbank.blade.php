@extends('layouts.main')

@section('content')
    <section class="register-section">
        <div class="container">
            <h2>إنشاء حساب جديد</h2>

            @if(session('success'))
                <p>{{ session('success') }}</p>
            @endif

            <form action="{{ route('register.bloodbank.post') }}" method="POST" class="register-form">
                @csrf

                <!-- Username -->
                <div class="form-group">
                    <label for="username">اسم المستخدم</label>
                    <input type="text" id="username" name="Username" value="{{ old('Username') }}">
                    @error('Username')
                        <div class="error" style="color:red;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="Email" value="{{ old('Email') }}">
                    @error('Email')
                        <div class="error" style="color:red;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" id="password" name="Password">
                    @error('Password')
                        <div class="error" style="color:red;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- UserType (hidden field or dropdown if needed) -->
                <input type="hidden" name="UserType" value="BloodCenter"> <!-- You can change this or use a dropdown for role selection -->

                <!-- Submit Button -->
                <button type="submit" class="btn-primary">تسجيل</button>
            </form>
        </div>
    </section>
@endsection
