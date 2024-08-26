<footer class="bg-light text-center text-lg-start">
    <div class="container p-4">
        <div class="row">
            <!-- القسم الأول: معلومات عن الشركة -->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">اسم الشركة</h5>
                <p>
                    هنا يمكنك كتابة نبذة قصيرة عن الشركة أو الموقع الخاص بك. يمكنك تضمين معلومات التواصل أو روابط إلى صفحات مهمة.
                </p>
            </div>

            <!-- القسم الثاني: روابط سريعة -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">روابط سريعة</h5>
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="{{ url('/') }}" class="text-dark">الرئيسية</a>
                    </li>
                    <li>
                        <a href="{{ url('/about') }}" class="text-dark">من نحن</a>
                    </li>
                    <li>
                        <a href="{{ url('/services') }}" class="text-dark">الخدمات</a>
                    </li>
                    <li>
                        <a href="{{ url('/contact') }}" class="text-dark">اتصل بنا</a>
                    </li>
                </ul>
            </div>

            <!-- القسم الثالث: روابط التواصل الاجتماعي -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">تابعنا</h5>
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="https://www.facebook.com" class="text-dark">فيسبوك</a>
                    </li>
                    <li>
                        <a href="https://www.twitter.com" class="text-dark">تويتر</a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com" class="text-dark">إنستجرام</a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com" class="text-dark">لينكد إن</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- الجزء السفلي من الفوتر -->
    <div class="text-center p-3 bg-dark text-white">
        © {{ date('Y') }} جميع الحقوق محفوظة:
        <a class="text-white" href="{{ url('/') }}">اسم الموقع</a>
    </div>
</footer>
