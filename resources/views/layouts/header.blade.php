<header class="header">
    <div class="container">
        <h1 class="headertitle">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo">

            نظام إدارة بنك الدم

        </h1>
        <nav class="navbar">
            <div class="nav">

                <a href="/">الرئيسية</a>
                <a href="{{route('views.about')}}">عن النظام</a>
                <a href="{{route('views.contact')}}">تواصل معنا</a>
            </div>
            <div class="login">

                <a href="{{ route('login') }}" class="">تسجيل دخول</a>
                <a href="{{ route('roles') }}" class=""> انشاء حساب</a>
            </div>



        </nav>
    </div>
</header>