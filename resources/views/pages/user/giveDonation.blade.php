@extends('layouts.dashboard-template-user')
@section('content')
    <form action="{{ route('dashboarduser.giveBlood.store') }}" method="POST" class="form p-4 bg-light rounded shadow-sm">
        @csrf

        <h3 class="text-center mb-4">التبرع بالدم</h3>

        <div class="form-group mb-3">
            <label for="blood_type" class="form-label">فصيلة الدم</label>
            <input type="text" class="form-control" id="blood_type" name="blood_type" required maxlength="3"
                placeholder="e.g., A+" style="text-transform: uppercase;">
        </div>

        <div class="form-group mb-3">
            <label for="quantity" class="form-label">الكمية</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required min="1"
                placeholder="Units required">
        </div>

        <div class="form-group mb-3">
            <label for="last_donation_date" class="form-label">تاريخ آخر تبرع</label>
            <input type="date" class="form-control" id="last_donation_date" name="last_donation_date" required>
        </div>

        <div class="form-group mb-3">
            <label for="center_id" class="form-label">اختر مركز التبرع</label>
            <select name="center_id" id="center_id" class="form-control" required>
                <option value="" disabled selected>اختر مركز</option>
                @foreach ($centers as $center)
                    <option value="{{ $center->id }}">{{ $center->Username }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">إرسال الطلب</button>
        </div>
    </form>
@endsection
