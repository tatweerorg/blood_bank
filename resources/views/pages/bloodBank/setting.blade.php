@extends('pages.bloodBank.dashbord')

@section('content')
    <style>
        .container {
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .table tbody th {
            background-color: #d32f2f;

        }

        .table tbody td {
            background-color: #d32f2f;
            font-weight: 500
        }

        h3 {
            font-size: 24px;
        }
    </style>
    <div class="container mt-5">
        <h3 class="text-center mb-4">معلومات بنك الدم</h3>

        <div class="card shadow-sm mx-auto">
            <div class="card-header text-center bg-danger text-white">
                <h4>{{ $user->Username }}</h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $user->profile->profile_image) }}" alt="صورة الملف الشخصي"
                        class="rounded-circle img-thumbnail" style="width: 150px; height: 150px;">
                </div>

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>اسم المستخدم</th>
                            <td>{{ $user->Username }}</td>
                        </tr>
                        <tr>
                            <th>البريد الإلكتروني</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>رقم الهاتف</th>
                            <td>{{ $user->profile->ContactNumber ?? 'غير متوفر' }}</td>
                        </tr>
                        <tr>
                            <th>العنوان</th>
                            <td>{{ $user->profile->Address ?? 'غير متوفر' }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
