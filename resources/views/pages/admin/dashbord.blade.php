@extends('layouts.dashbord')
@section('content')
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
@endsection
