@extends('pages.bloodBank.dashbord')
@section('content')
    <section class="recent-requests">
        <h2 class="title">المتبرعين</h2>
<div class="containerdelete">
        <a href=""  class="btn btn-danger deletedangerbtn ">إضافة متبرع</a></div>
        <table id="centersTable" class="display">
            <thead>
                <tr>
                    <th>المتبرع</th>
                    <th>مركز التبرع</th>
                    <th>نوع الدم</th>
                    <th>كمية الدم</th>
                    <th>تاريخ التبرع </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $donation)
                    <tr>
                        <td>{{ $donation->donor_name }}</td>
                        <td>{{ $donation->center_name }}</td>
                        <td>{{ $donation->blood_type }}</td>
                        <td>{{ $donation->quantity }}</td>
                        <td>{{ $donation->last_donation_date }}</td>
                        
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
