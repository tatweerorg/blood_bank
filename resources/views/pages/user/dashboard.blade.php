@extends('layouts.dashboard-template-user')


@section('content')
    <section class="">
        <div class="card-info">



            <div class="user-info">

                <img class="profileImage" src="{{ asset('storage/' . $userProfile->profile_image) }}" alt="profile img">

                <h1 class="fs-2">اهلاً بعودتك {{ $user->Username }}</h1>
            </div>
            <div>
                <p>{{$donationcount}}</p>
                <p>تبرعاتك</p>
            </div>

            <div>
                <p>{{$bloodbankscount}}</p>
                <p>بنوك الدم</p>

            </div>
            <div>
                <p>{{$pendingrequests}}</p>
                <p>طلبات التبرع المعلقة</p>

            </div>

        </div>
        <div class="notification">
            <div class="notifi-header">
                <p class="fs-4">جميع الاشعارات </p>
                <span>0</span>
            </div>
            <div class="body">
                <div>

                    <h1>title</h1>
                    <p>body</p>
                </div>

            </div>
        </div>
    </section>
@endsection
