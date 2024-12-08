@extends('pages.bloodBank.dashbord')
@section('content')
    <section class="recent-requests">
        <h2 class="title">مخزون الدم للمركز</h2>
        <div class="containerdelete">
        <a href="{{ route('dashboardblood.donateBlood') }}"  class="btn btn-danger deletedangerbtn ">إضافة دم</a></div>
        <table id="centersTable" class="display">
            <thead>
                <tr>
                    <th>نوع فصيلة الدم </th>
                    <th>كمية الدم </th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventores as $inventory)
                    <tr>
                        <td>{{ $inventory->BloodType }}</td>
                        <td>{{ $inventory->Quantity }}</td>
                        <td>
                            <a href="{{ route('bloodInventory.edit', $inventory->id) }}"
                                class="btn btn-warning editbtn">تعديل</a>
                            <a href="#" class="btn btn-danger deletebtn">حذف</a>
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
