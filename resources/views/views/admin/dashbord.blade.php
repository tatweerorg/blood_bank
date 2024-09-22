<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard(RTL)</title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    direction: rtl; /* Force RTL layout */
}

.container {
    display: grid;
    grid-template-columns:250px 1fr ; /* Swap sidebar and main content */
    grid-template-rows: auto 1fr;
    min-height: 100vh;
}

.header {
    grid-column: 1 / -1;
    background-color: #f05d5e;
    color: #fff;
    padding: 20px;
    text-align: center;
}

.sidebar {
    background-color: #343a40;
    padding: 20px;
}

.sidebar ul {
    list-style-type: none;
}

.sidebar ul li {
    margin: 15px 0;
}

.sidebar ul li a {
    color: #ffffff;
    text-decoration: none;
    font-size: 16px;
    display: block;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.sidebar ul li a:hover {
    background-color: #495057;
}

.main-content {
    background-color: #fff;
    padding: 20px;
    text-align: right; /* Align text to the right */
}

.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 40px;
}

.card {
    background-color: #f05d5e;
    color: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    font-size: 18px;
}

.recent-requests {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table thead {
    background-color: #f05d5e;
    color: white;
}

table th, table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: right; /* Text aligned to the right */
}

table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

</style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>لوحة التحكم الخاصة  بالادمن</h1> <!-- Arabic for Blood Bank Admin Dashboard -->
        </header>
        <nav class="sidebar">
            <ul>
                <li><a href="#">لوحة التحكم</a></li>
                <li><a href="#">بنوك الدم </a></li>

                <li><a href="#">المتبرعين</a></li>
                <li><a href="#">مخزون الدم</a></li>
                <li><a href="#">طلبات التبرع</a></li>
                <li><a href="#">التقارير</a></li>
                <li><a href="#">الإعدادات</a></li>
                <li><a href="#">تسجيل الخروج</a></li>
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
                            <td>زيد </td>
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
