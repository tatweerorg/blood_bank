<header class="header">
    <div class="container">
        <h1 class="headertitle">
            <img src="{{ asset('images/logo.png') }}" alt="logo">
            <span>دَمُك حياة</span>
        </h1>
        <nav class="navbar">
            <a href="/">الرئيسية</a>
            <a href="{{ route('views.about') }}">عن النظام</a>
            <a href="{{ route('views.contact') }}">تواصل معنا</a>
            <a href="{{ route('login') }}" class="loginmobile">تسجيل دخول</a>
            <a href="{{ route('roles') }}" class="loginmobile">إنشاء حساب</a>
            <div class="login">
                <a href="{{ route('login') }}">تسجيل دخول</a>
                <a href="{{ route('roles') }}">إنشاء حساب</a>
            </div>
        </nav>

    </div>
</header>