@extends('layouts.dashboard-template')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('content')
    <div class=" forms">
        <h1 class="title">تعديل بنك دم </h1>
        @if (session('success'))
            <div class="sccessmassage">
                <p> done</p>
            </div>
        @endif
        @if (session('error'))
            <div class="failemassage">
                <p> faile</p>
            </div>
        @endif
            
        <form action="{{ route('bloodCenter.update', $user->id) }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="name">اسم بنك الدم</label>
                <input type="text" placeholder="اسم بنك الدم" class="input" name="Username" id="name" value="{{ old('name', $user->Username) }}">
            </div>
            <div class="input-group">
                <label for="address">عنوان بنك الدم</label>
                <input type="text" placeholder="عنوان بنك الدم" class="input" name="Address" id="address" value="{{ old('address', $profile->Address) }}">
            </div>
            <div class="input-group">
                <label for="phone">رقم الهاتف </label>
                <input type="text" placeholder="رقم الهاتف" class="input" name="ContactNumber" id="phone" value="{{ old('phone', $profile->ContactNumber) }}">
            </div>
            <input type="submit" value="تعديل" class="btn submit">
        </form>
    </div>
@endsection
