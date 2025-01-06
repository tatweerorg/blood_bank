@extends('layouts.dashboard-template-user')
@section('content')
    <form action="{{ route('dashboarduser.giveBlood.store') }}" method="POST" class="form p-4 bg-light rounded shadow-sm">
        @csrf

        <h3 class="text-center mb-4">التبرع بالدم</h3>

        <div class="form-group mb-3">
            <label for="blood_type" class="form-label">فصيلة الدم</label>



            <select name="blood_type" id="blood_type" class="form-control">
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
            <label for="quantity" class="form-label">الكمية</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required min="1"
                placeholder="Units required">
        </div>

        <div class="form-group mb-3">
            <label for="last_donation_date" class="form-label">التاريخ المتاح </label>
            <input type="datetime-local" class="form-control" id="last_donation_date" name="last_donation_date" required>
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
            <button type="submit" class="btn btn-danger">إرسال الطلب</button>
        </div>
    </form>
@endsection
