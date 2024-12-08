@extends('pages.bloodBank.dashbord')
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
                @foreach ($requests as $request)
                    <tr>
                        <td>{{ $request->Username }}</td>
                        <td>{{ $request->BloodType }}</td>
                        <td>{{ $request->Quantity }}</td>
                        <td>{{ $request->RequestDate }}</td>
                        <td>{{ $request->Status }}</td>
                       
                        <td>
                            <form action="{{ route('bloodRequest.updateStatus',$request->id) }}" method="POST" style="display: inline;">
                                @csrf 
                                <input type="hidden" name="Status" value="Approved">
                                <button type="submit" class="btn btn-warning editbtn">موافقة</button>
                            </form>
                            <form action="{{ route('bloodRequest.updateStatus',$request->id) }}" method="POST" style="display: inline;">
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
