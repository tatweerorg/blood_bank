@extends('layouts.dashboard-template-user')


@section('content')
    <section class="">
        <div class="card-info">


            <img src="http://127.0.0.1:8000/public/storage/app/public{{ $userProfile->profile_image }}" alt="profile img">
            <h1>اهلاً بعودتك {{ $user->Username }}</h1>

            <div></div>
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
    </section>
@endsection
