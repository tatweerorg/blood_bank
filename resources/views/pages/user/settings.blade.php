@extends('layouts.dashboard-template-user')
@section('content')
    <ul>
    <li><a href="{{ route('settings.personalInfo') }}">البيانات الشخصية</a></li>
    <li><a href="{{ route('settings.status') }}">الحالة المرضية </a></li>
    <li><a href="{{ route('settings.donationInfo') }}">سجل التبرعات  </a></li>    
    <li><a href="">تسجيل الخروج  </a></li>
    
    </ul> 
@endsection
