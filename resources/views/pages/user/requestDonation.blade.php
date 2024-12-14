@extends('layouts.dashboard-template-user')

@section('content')
    <style>
        .form {}
    </style>
    <form action="{{ route('dashboarduser.requestsBlood.store') }}" method="POST" class="form p-4 bg-light rounded shadow-sm">
        @csrf

        <h3 class="text-center mb-4">طلب وحدة دم</h3>

        <div class="form-group mb-3">
            <label for="BloodType" class="form-label">فصيلة الدم</label>


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

        <div class="form-group mb-3">
            <label for="Quantity" class="form-label">الكمية</label>
            <input type="number" class="form-control" id="Quantity" name="Quantity" required min="1"
                placeholder="Units required">
        </div>

        <div class="form-group mb-3">
            <label for="RequestDate" class="form-label">تاريخ الطلب</label>
            <input type="date" class="form-control" id="RequestDate" name="RequestDate" required>
        </div>
        <div class="form-group mb-3">
            <label for="center_id" class="form-label">اختيار مركز الدم</label>
            <select class="form-control" id="center_id" name="center_id" required>
                <option value="">اختر مركز الدم</option>
                <option value="all">جميع المراكز</option>
                @foreach ($bloodCenters as $center)
                    <option value="{{ $center->id }}">{{ $center->Username }} </option>
                @endforeach
            </select>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-danger">إرسال الطلب</button>
        </div>
    </form>
@endsection
