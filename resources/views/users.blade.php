@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>نتائج البحث</h2>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($users->isNotEmpty())
    
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>اسم المركز</th>
                        <th>العنوان</th>
                        <th>رقم الاتصال</th>
                        <th>فصيلة الدم</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->Username }}</td>
                            <td>{{ $user->profile->Address }}</td>
                            <td>{{ $user->profile->ContactNumber }}</td>
                            <td>{{ $user->profile->BloodType }}</td>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
           <p>لا يوجد مستخدمين بنفس فصيلة الدم هذه</p>
        @endif
    </div>




@endsection
