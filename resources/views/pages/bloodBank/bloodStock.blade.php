@extends('pages.bloodBank.dashbord')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

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
                                <form action="{{ route('bloodInventory.destroy', $inventory->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger deletebtn"  data-url="{{ route('bloodInventory.destroy', $inventory->id) }}">حذف</button>
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
        $(document).on('click', '.deletebtn', function(e) {
    e.preventDefault(); // منع السلوك الافتراضي للزر

    // التأكد من أن المستخدم يريد الحذف
    if (confirm('هل أنت متأكد من أنك تريد الحذف؟')) {
        let button = $(this);
        let row = button.closest('tr'); // تحديد الصف الحالي
        let deleteUrl = button.data('url'); // رابط الحذف الذي تم تخزينه في data-url

        // إرسال طلب AJAX لحذف العنصر
        $.ajax({
            url: deleteUrl, // رابط الحذف
            type: 'DELETE', // نوع الطلب
            data: {
                _token: '{{ csrf_token() }}' // إرسال الـ CSRF Token
            },
            success: function(response) {
                alert('تم الحذف بنجاح!');
                row.fadeOut(500, function() { $(this).remove(); }); // حذف الصف من الجدول بعد نجاح الحذف
            },
            error: function(xhr, status, error) {
                alert('حدث خطأ أثناء عملية الحذف.');
                console.error(xhr.responseText); // طباعة الخطأ في حال فشل الحذف
            }
        });
    }
});


    </script>
@endsection
