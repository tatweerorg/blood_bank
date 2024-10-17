<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admindashbord.css') }}">
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->

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
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->

</body>

</html>