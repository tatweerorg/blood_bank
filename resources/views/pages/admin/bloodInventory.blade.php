@extends('layouts.dashboard-template')
@section('content')
<section class="recent-requests">
    <h2>مخزون الدم </h2>
    <table id="centersTable" class="display">
        <thead>
            <tr>
                <th>نوع فصيلة الدم </th>
                <th>كمية الدم </th>
                <th>تاريخ الانتهاء</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventores as $inventory)
            <tr>
                <td>{{ $inventory->BloodType }}</td>
                <td>{{ $inventory->Quantity }}</td>
                <td>{{ $inventory->ExpirationDate }}</td>
                <td>
                <a href="#" class="btn btn-warning">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>
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
                    extend: 'excelHtml5',
                    text: 'تصدير إلى Excel'

                },
                {
                    extend: 'pdfHtml5',
                    text: 'تصدير إلى PDF',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    extend: 'print',
                    text: 'طباعة'
                }
            ]
        })
    }

    )
</script>
@endsection