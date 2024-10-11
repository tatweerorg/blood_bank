<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admindashbord.css') }}">

</head>

<body>
    <div class="container">
        <header class="header">
            <h1>لوحة التحكم الخاصة بالادمن</h1> <!-- Arabic for Blood Bank Admin Dashboard -->
        </header>
        <nav class="sidebar">
            <ul>
                <li><a href="{{ route('dashboard') }}">لوحة التحكم</a></li>
                <li><a href="{{ route('dashboard.bloodbanks') }}">بنوك الدم </a></li>
                <li><a href="{{ route('dashboard.donations') }}">المتبرعين</a></li>
                <li><a href="{{ route('dashboard.inventory') }}">مخزون الدم</a></li>
                <li><a href="{{ route('dashboard.requests') }}">طلبات التبرع</a></li>
                <li><a href="{{ route('dashboard.reports') }}">التقارير</a></li>
                <li><a href="{{ route('dashboard.settings') }}">الإعدادات</a></li>
                <li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل الخروج</a>
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