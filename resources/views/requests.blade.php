@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
@endsection

@section('content')
    <section class="container">

        <div class="container my-5">
            @if (session('error'))
                <div class="alert alert-danger art">
                    {{ session('error') }}


                </div>
            @endif

            <h2>أدخل تفاصيل الطلب</h2>
            <p>املأ الحقول أدناه لمعرفة المراكز التي تتوفر فيها الدم المطلوب</p>
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="BloodType">فصيلة الدم</label>
                    <select name="BloodType" id="BloodType" class="form-control">
                        <option value="">اختر فصيلة دمك</option>
                        <option value="A+" {{ old('BloodType') == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ old('BloodType') == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ old('BloodType') == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ old('BloodType') == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="AB+" {{ old('BloodType') == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ old('BloodType') == 'AB-' ? 'selected' : '' }}>AB-</option>
                        <option value="O+" {{ old('BloodType') == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ old('BloodType') == 'O-' ? 'selected' : '' }}>O-</option>
                    </select>
                </div>

                <!-- Units input -->
                <div class="form-group">
                    <label for="units">عدد الوحدات المطلوبة</label>
                    <input type="number" name="units" id="units" class="form-control" placeholder="عدد الوحدات"
                        min="1" required>
                </div>

                <!-- Location input -->
                <div class="form-group mb-3">
                    <label for="location">المكان</label>
                    <input type="text" name="location" id="location" class="form-control"
                        placeholder="المدينة أو المنطقة" required>
                </div>
                <button type="submit" class="btn btn-primary search-btn">ابحث الآن</button>

            </form>
        </div>
    </section>
@endsection
