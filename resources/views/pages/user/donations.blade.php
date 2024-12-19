@extends('layouts.dashboard-template-user')
@section('content')
<section class="recent-requests">
    <h2 class="title">التبرعات التي قمت بها</h2>
    <table id="centersTable" class="display">
        <thead>
            <tr>
            <th>المتبرع</th>
            <th>مركز التبرع</th>
            <th>نوع الدم</th>
                <th>كمية الدم</th>
                <th>تاريخ التبرع  </th>
                <th>الحالة</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donations as $donation)
            <tr>
            <td>{{ $donation->donor_name}}</td>
            <td>{{ $donation->center_name}}</td>
            <td>{{ $donation->blood_type }}</td>
                <td>{{ $donation->quantity }}</td>
                <td>{{ $donation->last_donation_date }}</td>
                <td
                            style="
    @if ($donation->Status == 'Approved') background-color: green; color: white; 
    @elseif($donation->Status == 'Pending') 
        background-color: yellow; color: black; 
    @else 
        background-color: orange; color: white; @endif">
                            @if ($donation->Status == 'Approved')
                                موافقة
                            @elseif($donation->Status == 'Pending')
                                انتظار
                            @else
                                مرفوضة
                            @endif
                        </td>
                <td>
                <a href="{{ route('dashboarduser.requestsBlood') }}" class="btn btn-danger deletebtn">اطلب دم</a>
                <a href="{{ route('dashboarduser.donateBlood') }}" class="btn btn-danger deletebtn">تبرع بالدم</a>
                </td>
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
        });
    });
</script>
@endsection
