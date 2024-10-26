@extends('layouts.dashboard-template-user')
@section('content')
                  <section class="dashboard-cards">
                <div class="card">
                    <h3>إجمالي التبرعات</h3>
                    <p>{{ $donationcount }}</p>
                </div>
                <div class="card">
                    <h3>وحدات الدم المتاحة</h3>
                    <p>{{ $quantity }}</p>
                </div>
                <div class="card">
                    <h3>الطلبات المعلقة</h3>
                    <p>{{ $pendingrequests }}</p>
                </div>
                <div class="card">
                    <h3>إجمالي المتبرعين</h3>
                    <p>{{ $donorcount }}</p>
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
                        @foreach( $bloodrequests as $request)
                        <tr>
                            <td>{{ $request->Username }} </td>
                            <td>{{ $request->BloodType }}</td>
                            <td>{{ $request->RequestDate }}</td>
                           <td>
                           @if($request->Status === 'Pending')
        معلق
        @elseif($request->Status === 'Approved')
        مقبول
        @elseif($request->Status === 'Cancelled')
        مرفوض
    @endif

                           </td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                </table>
            </section>
@endsection