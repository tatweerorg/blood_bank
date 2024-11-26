@extends('layouts.main')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/hero.css') }}">
@endsection

@section('content')
<h2>نتائج البحث</h2>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($results->isNotEmpty())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>اسم المركز</th>
                <th>العنوان</th>
                <th>رقم الاتصال</th>
                <th>فصيلة الدم</th>
                <th>الوحدات المتوفرة</th>
                <th>تاريخ انتهاء الصلاحية</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result->center->Username }}</td>
                    <td>{{ $result->center->profile->Address }}</td>
                    <td>{{ $result->center->profile->ContactNumber }}</td>
                    <td>{{ $result->BloodType }}</td>
                    <td>{{ $result->Quantity }}</td>
                    <td>{{ $result->ExpirationDate }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>لا توجد نتائج مطابقة للبحث.</p>
@endif



@endsection