@extends('pages.bloodBank.dashbord')
@section('content')
    <section class="recent-requests">
        <h2 class="title">طلبات الدم من المركز</h2>
        @if (session('error'))
                <div class="alert alert-danger art">
                    {{ session('error') }}


                </div>
            @endif

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
                @foreach ($requests as $request)
                    <tr>
                        <td>{{ $request->Username }}</td>
                        <td>{{ $request->blood_type }}</td>
                        <td>{{ $request->quantity }}</td>
                        <td>{{ $request->last_donation_date }}</td>
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
                        </td>                       
                        <td>
                            <form action="{{ route('giverequests.updateStatus',$request->id) }}" method="POST" style="display: inline;">
                                @csrf 
                                <input type="hidden" name="Status" value="Approved">
                                <button type="submit" class="btn btn-warning editbtn">موافقة</button>
                            </form>
                            <form action="{{ route('giverequests.updateStatus',$request->id) }}" method="POST" style="display: inline;">
                                @csrf 
                                <input type="hidden" name="Status" value="Cancelled">
                                <button type="submit" class="btn btn-danger deletebtn">رفض</button>

                            </form>
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
                })
            }

        )
    </script>
@endsection
