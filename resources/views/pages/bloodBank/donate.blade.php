@extends('pages.bloodBank.dashbord')
@section('content')
    <form action="{{ route('dashboardblood.addBlood') }}" method="POST" class="form p-4 bg-light rounded shadow-sm">
        @csrf

        <h3 class="text-center mb-4">التبرع بالدم</h3>

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

        <div class="form-group mb-3">
            <label for="Quantity" class="form-label">الكمية</label>
            <input type="number" class="form-control" id="Quantity" name="Quantity" required min="1"
                placeholder="Units required">
        </div>
    

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">إرسال الطلب</button>
        </div>
    </form>
@endsection
