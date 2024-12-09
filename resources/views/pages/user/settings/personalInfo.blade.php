@extends('pages.user.settings')

@section('data')
    <style>
        /* تنسيق النموذج */
        .form {
            width: 100%;
            max-width: 600px;
            margin: auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .edittitle {
            text-align: center;
            margin-bottom: 20px;
            font-size: 30px;
            color: #333;
            margin: 10px
        }

        /* تنسيق الحقول */
        .form div {
            margin-bottom: 15px;
        }

        .form label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        .form input[type="text"],
        .form input[type="date"],
        .form input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .form input[type="text"]:focus,
        .form input[type="date"]:focus,
        .form input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
        }

        /* تنسيق صورة الملف الشخصي */
        .form img {
            display: block;
            margin: 10px auto;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* تنسيق الزر */
        .form button {
            display: block;
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form button:hover {
            background-color: #0056b3;
        }

        /* تنسيق رسائل النجاح */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
    <h1 class="edittitle">تعديل البيانات الشخصية</h1>
    <form class="form" action="{{ route('settings.updatepersonalinfo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div>
            <label for="Username">اسم المستخدم</label>
            <input type="text" id="Username" name="Username" value="{{ $user->Username }}" required>
        </div>
        <div>
            <label for="profile_image">صورة الحساب</label>
            <input type="file" id="profile_image" name="profile_image">
            @if ($profile->profile_image)
                <div>
                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Image" width="100px"
                        highet ="100px">
                </div>
            @endif
        </div>
        <div>
            <label for="DateOfBirth">تاريخ المسلاد</label>
            <input type="date" id="DateOfBirth" name="DateOfBirth" value="{{ $profile->DateOfBirth }}">
        </div>
        <div>
            <label for="ContactNumber">رقم الهاتف</label>
            <input type="text" id="ContactNumber" name="ContactNumber" value="{{ $profile->ContactNumber }}">
        </div>
        <div>
            <label for="Address">العنوان</label>
            <input type="text" id="Address" name="Address" value="{{ $profile->Address }}">
        </div>

        <button type="submit">حفظ التغييرات</button>


    </form>
@endsection
