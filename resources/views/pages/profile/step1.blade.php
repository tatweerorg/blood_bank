@extends('layouts.main')

@section('content')
    <section class="profile-step1-section">
        <div class="container w-75">
            <h2 class="w-100 text-end pt-4">الخطوة 1: تحميل صورة الملف الشخصي</h2>

            <form action="{{ route('profile.post.step1', ['user_id' => $user_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Profile Image -->
                <div class="form-group">
                    <label for="profile_image" class="w-100 text-end">صورة الملف الشخصي</label>
                    <input type="file" id="profile_image" name="profile_image"  class="text-end">
                    @error('profile_image')
                        <div class="error" style="color:red;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Next Button -->
                <button type="submit" class="btn-primary w-25 m-auto">التالي</button>
            </form>
        </div>
    </section>
@endsection
