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
                        <td>
                            <div class="actions">
                                <a href="{{ route('bloodCenter.edit', $center->id) }}"
                                    class="btn btn-warning editbtn">Edit</a>
                                <form action="{{ route('bloodCenter.destroy', $center->id) }}" method="POST">


                                    <input type="submit" class="btn btn-danger deletebtn" value="Delete">
                                </form>
                            </div>

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
                buttons: [{
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
