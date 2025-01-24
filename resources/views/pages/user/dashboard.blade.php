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
                <span>{{ $remindercount }}</span>
            </div>
            <div class="body">
                <div>
                    @if($remindercount > 0)
                    @foreach($reminders as $reminder)
                    <h1>من {{$reminder->sender_name}} </h1>
                    @if($reminder->reminder === 'approve')
                    تم قبول طلبك المقدم ل {{$reminder->sender_name}} 
                    @elseif($reminder->reminder === 'cancelled')
                    تم رفض طلبك المقدم ل {{$reminder->sender_name}} 
                    @elseif($reminder->reminder === 'donate')
                    تم حجز موعد التبرع بالدم من قبل {{$reminder->sender_name}}في تاريخ {{$reminder->reminder_date}}
                    @elseif($reminder->reminder === 'request')
                    تم طلب دم من قبل {{$reminder->sender_name}}في تاريخ {{$reminder->reminder_date}}

                    @endif
                    @endforeach     
                    @elseif($remindercount==0) 
                    لا يوجد إشعارات
                    @endif        
                </div>

            </div>
        </div>
    </section>
@endsection
