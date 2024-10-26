@extends('layouts.dashboard-template-user')
@section('content')
<section class="recent-requests">
    <h2 class="title">المتبرعين</h2>
    <table id="centersTable" class="display">
        <thead>
            <tr>
            <th>المتبرع</th>
            <th>مركز التبرع</th>
            <th>نوع الدم</th>
                <th>كمية الدم</th>
                <th>تاريخ التبرع  </th>
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
                <td>
                <a href="{{ route('donation.edit' , $donation->id) }}" class="btn btn-warning editbtn">Edit</a>
                <a href="#" class="btn btn-danger deletebtn">Delete</a>
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
                    extend: 'excelHtml5',
                    text: 'تصدير إلى Excel',
                                        className: 'btn-excel'

                },
                {
                    extend: 'pdfHtml5',
                    text: 'تصدير إلى PDF',
                    orientation: 'landscape',
                    pageSize: 'A4',
                                        className: 'btn-pdf'

                },
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
