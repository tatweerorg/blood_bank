@extends('layouts.dashboard-template-user')
@section('content')
    <style>
        .ul {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
            width: 100%;
            margin: auto;
            background-color: #d0d0d0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .ul .li {
            border-bottom: 1px solid #ddd;
            width: 35%;
            text-align: center
        }

        .ul .li .a {
            display: block;
            text-decoration: none;
            color: #333;
            font-size: 16px;
            padding: 15px;
            transition: all 0.3s ease;
        }

        .ul .li .a:hover {
            background-color: #007bff;
            color: #fff;
            transform: scale(1.02);
        }

        .ul .li:last-child {
            border-bottom: none;
        }
    </style>
    <ul class="ul">
        <li class="li"><a class="a" href="{{ route('settings.personalInfo') }}">البيانات الشخصية</a></li>
        <li class="li"><a class="a" href="{{ route('settings.status') }}">الحالة المرضية </a></li>
        <li class="li"><a class="a" href="{{ route('settings.donationInfo') }}">سجل التبرعات </a></li>

    </ul>
    <main class="content-area">
        <div id="dynamic-content">
            @yield('data')
        </div>
    </main>
@endsection
