@extends('layouts.dashboard-template-user')


@section('content')
    <section class="">
        <div class="card-info">



            <div class="user-info">

                <img class="profileImage" src="{{ asset('storage/' . $userProfile->profile_image) }}" alt="profile img">

                <h1>اهلاً بعودتك {{ $user->Username }}</h1>
            </div>
            <div>
                <p>1</p>
                <p>تبرعاتك</p>
            </div>

            <div>
                <p>2</p>
                <p>بنوك الدم</p>

            </div>
            <div>
                <p>3</p>
                <p>طلبات التبرع حولك</p>

            </div>

        </div>
        <div class="notification">
            <div class="notifi-header">
                <h1>جميع الاشعارات </h1>
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
