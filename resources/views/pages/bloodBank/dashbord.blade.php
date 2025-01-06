<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bloodbankdashbord.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admindashbord.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tabels.css') }}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <!-- JSZip and PDFMake for Excel and PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


    {{-- Font google --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Bebas+Neue&family=Cairo:wght@200..1000&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />

    @yield('styles')

</head>

<body>
    <div class="wrap">
        <header class="header">
            <h1 class="headertitle">
                <img src="{{ asset('images/logo.png') }}" alt="logo">
                <span>بوابة بنك الدم</span>
            </h1>
        </header>
        <nav class="sidebar">
            <ul>
                <li><a href="{{ route('dashboard.bloodcenter') }}">لوحة التحكم</a></li>

                <li><a href="{{ route('dashboardblood.donors') }}">المتبرعين</a></li>
                <li><a href="{{ route('dashboardblood.bloodstock') }}">مخزون الدم</a></li>
                <li><a href="{{ route('dashboardblood.donationRequests') }}">طلبات الدم </a></li>
                <li><a href="{{ route('dashboardblood.giverequests') }}">طلبات التبرع </a></li>
                {{--    <li><a href="#">التقارير</a></li> --}}
                <li><a href="{{ route('dashboardblood.setting') }}">الإعدادات</a></li>
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
