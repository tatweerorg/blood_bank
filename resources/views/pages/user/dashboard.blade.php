<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bloodbankdashbord.css') }}">

</head>

<body>
    <div class="container">
        <header class="header">
            <h1>لوحة التحكم الخاصة  بالمستخدم</h1> <!-- Arabic for Blood Bank Admin Dashboard -->
        </header>
        <nav class="sidebar">
            <ul>
                <li><a href="#">لوحة التحكم</a></li>

                <li><a href="#">المتبرعين</a></li>
                <li><a href="#">مخزون الدم</a></li>
                <li><a href="#">طلبات التبرع</a></li>
                <li><a href="#">التقارير</a></li>
                <li><a href="#">الإعدادات</a></li>
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
            <section class="dashboard-cards">
                <div class="card">
                    <h3>إجمالي التبرعات</h3>
                    <p>1500</p>
                </div>
                <div class="card">
                    <h3>وحدات الدم المتاحة</h3>
                    <p>300</p>
                </div>
                <div class="card">
                    <h3>الطلبات المعلقة</h3>
                    <p>45</p>
                </div>
                <div class="card">
                    <h3>إجمالي المتبرعين</h3>
                    <p>1200</p>
                </div>
            </section>
            <section class="recent-requests">
                <h2>طلبات التبرع الأخيرة</h2>
                <table>
                    <thead>
                        <tr>
                            <th>اسم المتبرع</th>
                            <th>فصيلة الدم</th>
                            <th>التاريخ</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>محمود </td>
                            <td>O+</td>
                            <td>2024-09-15</td>
                            <td>موافقة</td>
                        </tr>
                        <tr>
                            <td>عبد الله </td>
                            <td>A-</td>
                            <td>2024-09-14</td>
                            <td>معلقة</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>

</html>