@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/about&contact.css') }}">
@endsection
@section('content')
    <section class="about-section">
        <div class="container container-section">
            <div class="intro">
                <h1 class="title">من نحن</h1>
                <p>مرحبًا بكم في نظام ادارة بنوك الدم، شريككم الموثوق في إنقاذ الأرواح من خلال التبرع بالدم. مهمتنا هي سد
                    الفجوة بين
                    المتبرعين بالدم والمرضى المحتاجين، وضمان عملية تبرع وتوزيع سلسة وآمنة وفعالة.</p>
            </div>

            <div class="mission">
                <h2 class="title">مهمتنا</h2>
                <p>مهمتنا هي توفير منصة موثوقة وفعالة تربط بين متبرعي الدم والمستشفيات، لضمان حصول المرضى الذين يحتاجون إلى
                    عمليات نقل الدم على التبرعات التي تنقذ حياتهم بسرعة وأمان.</p>
            </div>

            <div class="importance">
                <h2 class="title">أهمية التبرع بالدم</h2>
                <p>كل عام، يعتمد ملايين الأشخاص حول العالم على الدم المتبرع به للبقاء على قيد الحياة أثناء العمليات
                    الجراحية، علاجات السرطان، الولادة، والحوادث. من خلال التبرع بالدم، لا تقوم فقط بإنقاذ الأرواح بل تساهم
                    أيضًا في مجتمع أكثر صحة.</p>
                <p>هل تعلم؟ يمكن لتبرع واحد أن ينقذ ما يصل إلى ثلاث أرواح، وهناك حاجة مستمرة للدم لأن مخزون الدم غالبًا ما
                    ينفد.</p>
            </div>

            <div class="how-it-works">
                <h2 class="title">كيفية العمل</h2>
                <ol>
                    <li><strong>التسجيل كمتبرع:</strong> قم بإنشاء حساب واملأ بياناتك، بما في ذلك فصيلة دمك.</li>
                    <li><strong>التبرع بالدم:</strong> قم بزيارة مركز التبرع بالدم، حيث تكون العملية سريعة وآمنة وسهلة.</li>
                    <li><strong>مساعدة المرضى المحتاجين:</strong> يتم معالجة دمك وتوزيعه على المرضى الذين في أمس الحاجة
                        إليه.</li>
                </ol>
            </div>

            <div class="impact">
                <h2 class="title">أثرنا</h2>

                <div class="statistics">
                    <div class="stat-item">
                        <h3>5,000+</h3>
                        <p>عمليات تبرع بالدم</p>
                    </div>
                    <div class="stat-item">
                        <h3>100+</h3>
                        <p>مستشفى مدعومة</p>
                    </div>
                    <div class="stat-item">
                        <h3>15,000+</h3>
                        <p>أرواح منقذة</p>
                    </div>
                </div>
            </div>

            <div class="team">
                <h2 class="title">تعرف على الفريق</h2>
                <p>يعمل فريقنا المكرس من المحترفين على مدار الساعة لضمان عملية تبرع سلسة وفعالة. تعرف على الأشخاص الذين
                    يجعلون كل شيء يحدث.</p>
                <div class="team-members">
                    <div class="team-member">
                        <h3>محمود طميزة</h3>
                        <p></p>
                    </div>
                    <div class="team-member">
                        <h3> عبد الله موسى</h3>
                        <p></p>
                    </div>

                </div>
            </div>


        </div>
    </section>
@endsection
