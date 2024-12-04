    @extends('layouts.main')
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @endsection

    @section('content')
        <section class="role-selection">
            <div class="container">
                <h2>اختر نوع حسابك</h2>
                <div class="role-options">
                    <a href="{{ route('register.bloodbank') }}" class="role-card">
                        <h3>بنك الدم</h3>
                        <p>إنشاء حساب لبنك الدم</p>
                    </a>
                    <a href="{{ route('register.user') }}" class="role-card">
                        <h3>مستخدم</h3>
                        <h4>متبرع أو محتاج</h4>

                        <p>إنشاء حساب كمستخدم عادي</p>
                    </a>
                </div>
            </div>
        </section>
    @endsection
