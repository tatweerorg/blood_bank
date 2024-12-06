@extends('layouts.dashboard-template-user')
@section('content')
    <section class="recent-requests">
        <h2 class="title">طلبات الدم من مراكز التبرع التي قمت بها</h2>
        <a class="btn-excel" href="{{ route('dashboarduser.requestsBlood') }}">اطلب دم</a>
        <a class="btn-pdf" href="{{ route('dashboarduser.donateBlood') }}"> تبرع الآن</a>
        <table id="centersTable" class="display">
            <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>نوع فصيلة الدم </th>
                    <th>كمية الدم </th>
                    <th>من مركز الدم </th>
                    <th>تاريخ الطلب</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp
                @foreach ($requests as $request)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $request->BloodType }}</td>
                        <td>{{ $request->Quantity }}</td>
                        <td>{{ $request->Centername }}</td>
                        <td>{{ $request->RequestDate }}</td>
                        <td>{{ $request->Status }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <script>
        $(document).ready(function() {
                $('#centersTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/ar.json"
                    },
                    dom: 'Bfrtip',
                    buttons: [

                        {
                            extend: 'print',
                            text: 'طباعة',
                            className: 'btn-print'

                        }
                    ]
                })
            }

        )
    </script>
@endsection
