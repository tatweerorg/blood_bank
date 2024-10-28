<header class="header">
    <div class="container">
        <h1 class="headertitle">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="logobackground">

            نظام إدارة بنك الدم

        </h1>
        <nav class="navbar">
            <a href="/">الرئيسية</a>
            <a href="{{route('views.about')}}">عن النظام</a>
            <a href="{{route('views.contact')}}">تواصل معنا</a>
            <a href="{{ route('login') }}">تسجيل دخول</a>


        </nav>
    </div>
</header>