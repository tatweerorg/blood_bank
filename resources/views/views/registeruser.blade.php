
    @extends('layouts.main')
@section('content')

  <section class="register-section">
        <div class="container">
            <h2>إنشاء حساب جديد</h2>
            <form action="{{route('register')}}" method="POST" class="register-form">
                @csrf
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="username">اسم المستخدم</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="blood_type">فصيلة الدم</label>
                    <select id="blood_type" name="blood_type" required>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob">تاريخ الميلاد</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-primary">تسجيل</button>
                </div>
            </form>
        </div>
    </section>
@endsection