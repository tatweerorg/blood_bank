@extends('layouts.main')
@section('content')
<div class="container w-75">

    <!-- Display the heading based on the UserType -->
    @if($user->UserType === 'User')
        <h2 class="w-100 text-end pt-4">الخطوة 2: أدخل فصيلة دمك</h2>
    @elseif($user->UserType === 'BloodCenter')
        <h2 class="w-100 text-end pt-4">الخطوة 2: أدخل العنوان</h2>
    @endif

    <!-- Display success and error messages -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif
    <!-- Form starts here -->
    <form action="{{ route('profile.post.step2', ['user_id' => $user_id]) }}" method="POST">
    @csrf
    @if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
        <li>
{{$error}}
        </li>
        @endforeach
    </ul>
    @endif
        <!-- Form for 'User' type -->
        @if($user->UserType === 'User')
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
            @error('BloodType')
                <div class="error" style="color:red;">{{ $message }}</div>
            @enderror
        </div>
        @endif

        <!-- Form for 'BloodCenter' type -->
        @if($user->UserType === 'BloodCenter')
        <div class="form-group">
            <label for="Address">العنوان</label>
            <input type="text" name="Address" id="Address" class="form-control" value="{{ old('Address') }}">
            @error('Address')
                <div class="error" style="color:red;">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ContactNumber">رقم الهاتف</label>
            <input type="text" name="ContactNumber" id="ContactNumber" class="form-control" value="{{ old('ContactNumber') }}">
            @error('ContactNumber')
                <div class="error" style="color:red;">{{ $message }}</div>
            @enderror
        </div>
       

        @endif 

        <!-- Submit Button -->
        <button type="submit" class="btn btn-danger w-25 m-auto">التالي</button>
    </form>

</div>
@endsection
