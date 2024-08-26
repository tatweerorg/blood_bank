<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" >اسم الموقع</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" >الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  >من نحن</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" >الخدمات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" >اتصل بنا</a>
                </li>
                <!-- إذا كان المستخدم مسجل الدخول -->
                @auth
                    <li class="nav-item">
                        <a class="nav-link" >لوحة التحكم</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            تسجيل الخروج
                        </a>
                        <form id="logout-form"  method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link">تسجيل الدخول</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" ">إنشاء حساب</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
</header>
