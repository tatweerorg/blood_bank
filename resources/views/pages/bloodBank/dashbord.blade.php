<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bloodbankdashbord.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admindashbord.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tabels.css') }}">

</head>

<body>
    <div class="wrap">
        <header class="header">
            <h1>لوحة التحكم الخاصة ببنك الدم</h1> <!-- Arabic for Blood Bank Admin Dashboard -->
        </header>
        <nav class="sidebar">
            <ul>
                <li><a href="{{ route('dashboardblood.home') }}">لوحة التحكم</a></li>

                <li><a href="{{ route('dashboardblood.donors') }}">المتبرعين</a></li>
                <li><a href="{{ route('dashboardblood.bloodstock') }}">مخزون الدم</a></li>
                <li><a href="{{ route('dashboardblood.donationRequests') }}">طلبات التبرع</a></li>
                {{--    <li><a href="#">التقارير</a></li> --}}
                <li><a href="#">الإعدادات</a></li>
                <li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل
                            الخروج</a>
                    </form>
                </li>

            </ul>
        </nav>
        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>

</html>
