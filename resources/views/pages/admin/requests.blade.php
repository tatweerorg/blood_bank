@extends('layouts.dashboard-template')
@section('content')
<section class="recent-requests">
    <h2 class="title">طلبات التبرع بالدم </h2>
    <table id="centersTable" class="display">
        <thead>
            <tr>
                <th>اسم المتقدم</th>
                <th>نوع فصيلة الدم </th>
                <th>كمية الدم </th>
                <th>تاريخ الطلب</th>
                <th>الحالة</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
            <td>{{ $request->Username }}</td>
                <td>{{ $request->BloodType }}</td>
                <td>{{ $request->Quantity }}</td>
                <td>{{ $request->RequestDate }}</td>
                <td
                            style="
    @if ($request->Status == 'Approved') background-color: green; color: white; 
    @elseif($request->Status == 'Pending') 
        background-color: yellow; color: black; 
    @else 
        background-color: orange; color: white; @endif">
                            @if ($request->Status == 'Approved')
                                موافقة
                            @elseif($request->Status == 'Pending')
                                انتظار
                            @else
                                مرفوضة
                            @endif
                        </td>                 <td>
                <a href="{{ route('bloodRequest.edit' , $request->id ) }}" class="btn btn-warning editbtn">Edit</a>
                <a href="#" class="btn btn-danger deletebtn">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
<script>
    $(document).ready(function(){
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