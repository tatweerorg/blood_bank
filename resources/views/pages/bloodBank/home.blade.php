@extends('pages.bloodBank.dashbord')
@section('content')
    <section class="">
        <div class="card-info">



            <div class="user-info">
            @if(isset($userProfile))

                <img class="profileImage" src="{{ asset('storage/' . $userProfile->profile_image) }}" alt="profile img">
                @else
                <h2>welcome</h2>
                @endif
                @if(isset($user))
 
                <h1 class="fs-2">اهلاً بعودتك {{ $user->Username }}</h1>
                @else
                <h2>لا يوجد مستخدم</h2>
                 @endif
            </div>
             <div>
                <p>{{$userscount}}</p>
                <p>المتبرعين </p>

            </div>
            <div>
                <p>{{$requestcount}}</p>
                <p>طلبات الدم</p>
            </div>

           
            <div>
                <p>{{$givecount}}</p>
                <p>طلبات التبرع </p>

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
                    تم قبول الطلب المقدم من قبل {{$reminder->sender_name}} 
                    @elseif($reminder->reminder === 'cancelled')
                    تم رفض الطلب المقدم من قبل {{$reminder->sender_name}} 
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
