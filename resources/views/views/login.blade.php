    @extends('layouts.main')
@section('content')
  <section class="login-section">
        <div class="container">
            <h2>تسجيل الدخول</h2>
            <form action="{{ route('login') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-primary">تسجيل الدخول</button>
                </div>
                <a href="{{ route('roles') }}">انشاء حساب ؟</a>
            </form>
        </div>
    </section>
@endsection
