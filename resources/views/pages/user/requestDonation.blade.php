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
            <input type="text" class="form-control" id="BloodType" name="BloodType" required maxlength="3"
                placeholder="e.g., A+" style="text-transform: uppercase;">
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

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">إرسال الطلب</button>
        </div>
    </form>
@endsection
