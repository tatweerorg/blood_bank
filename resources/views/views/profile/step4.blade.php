@extends ('layouts.main')
@section('content')
   <div class="container">

        <h2 class="w-100 text-end pt-4">الخطوة 3: أدخل معلومات التواصل</h2>
    <form action="{{ route('profile.post.step4', ['user_id' => $user_id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
                <label for="Address">العنوان</label>
                <textarea name="Address" id="Address" class="form-control @error('Address') is-invalid @enderror" required></textarea>
                @error('Address')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="ContactNumber">رقم الهاتف</label>
                <input type="text" name="ContactNumber" id="ContactNumber" class="form-control @error('ContactNumber') is-invalid @enderror" required>
                @error('ContactNumber')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

          

                <input  name="last_donation_date" id="last_donation_date" class="form-control" type="hidden" value="null">

        <button type="submit" class="btn-primary w-25 m-auto">التالي</button>
        </form>
   </div>
@endsection