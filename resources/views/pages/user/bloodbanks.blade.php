@extends('layouts.dashboard-template-user')
@section('content')
    <section class="recent-requests">
        <h2 class="title">مراكز التبرع </h2>
        <table id="centersTable" class="display">
            <thead>
                <tr>
                    <th>اسم المركز</th>
                    <th>عنوان المركز</th>
                    <th>رقم الهاتف</th>
                    <th>العمليات </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($centers as $center)
                    <tr>
                        <td>{{ $center->Username }}</td>
                        <td>{{ $center->Address }}</td>
                        <td>{{ $center->ContactNumber }}</td>
                        <td  class="buttons">
                        <a href="https://wa.me/972{{ preg_replace('/\D/', '', $center->ContactNumber) }}?text=مرحبًا، أريد التواصل معك." class="btn btn-warning editbtn" target="_blank">تواصل</a>
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
