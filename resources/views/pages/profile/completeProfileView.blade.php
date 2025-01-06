@extends('layouts.main')

@section('content')
    <div class="container w-75 py-5">
        <h2 class="text-end py-4 text-danger">إكمال الملف الشخصي</h2>

        <div class="card shadow border-0">
            <div class="card-body">
                <form action="{{ route('profile.complete', ['user_id' => $user_id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- صورة الملف الشخصي -->
                    <div class="form-group mb-4">
                        <label for="profile_image" class="w-100 text-end fw-bold">صورة الملف الشخصي</label>
                        <input type="file" id="profile_image" name="profile_image" class="form-control">
                        @error('profile_image')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- فصيلة الدم أو العنوان -->
                    @if ($user->UserType === 'User')
                        <div class="form-group mb-4">
                            <label for="BloodType" class="w-100 text-end fw-bold">فصيلة الدم</label>
                            <select name="BloodType" id="BloodType" class="form-select">
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
                            @error('BloodType')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    @elseif($user->UserType === 'BloodCenter')
                        <div class="form-group mb-4">
                            <label for="Address" class="w-100 text-end fw-bold">العنوان</label>
                            <input type="text" name="Address" id="Address" class="form-control"
                                value="{{ old('Address') }}">
                            @error('Address')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="ContactNumber" class="w-100 text-end fw-bold">رقم الهاتف</label>
                            <input type="text" name="ContactNumber" id="ContactNumber" class="form-control"
                                value="{{ old('ContactNumber') }}">
                            @error('ContactNumber')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <!-- تاريخ الميلاد -->
                    @if ($user->UserType === 'User')
                        <div class="form-group mb-4">
                            <label for="DateOfBirth" class="w-100 text-end fw-bold">تاريخ الميلاد</label>
                            <input type="date" name="DateOfBirth" id="DateOfBirth" class="form-control"
                                value="{{ old('DateOfBirth') }}">
                            @error('DateOfBirth')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- عنوان المستخدم -->
                        <div class="form-group mb-4">
                            <label for="Address" class="w-100 text-end fw-bold">العنوان</label>
                            <textarea name="Address" id="Address" class="form-control @error('Address') is-invalid @enderror" required>{{ old('Address') }}</textarea>
                            @error('Address')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- رقم الهاتف -->
                        <div class="form-group mb-4">
                            <label for="ContactNumber" class="w-100 text-end fw-bold">رقم الهاتف</label>
                            <input type="text" name="ContactNumber" id="ContactNumber"
                                class="form-control @error('ContactNumber') is-invalid @enderror" required
                                value="{{ old('ContactNumber') }}">
                            @error('ContactNumber')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif


                    <!-- زر الإرسال -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-danger w-50">إكمال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
