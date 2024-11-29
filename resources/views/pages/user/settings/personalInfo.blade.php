@extends('layouts.dashboard-template-user')
@section('content')
<h1>Edit Profile Info</h1>
<form action="#" method="POST" enctype="multipart/form-data">
   @csrf
   <div>
            <label for="Username">Username:</label>
            <input type="text" id="Username" name="Username" value="{{ $user->Username }}" required>
   </div>
   <div>
            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image">
            @if($profile->profile_image)
                <div>
                    <img src="{{ asset($profile->profile_image) }}" alt="Profile Image" width="100">
                </div>
            @endif
        </div>
   <div>
            <label for="DateOfBirth">Date Of Birth:</label>
            <input type="date" id="DateOfBirth" name="DateOfBirth" value="{{ $profile->DateOfBirth }}" required>
        </div>
        <div>
            <label for="ContactNumber">Contact Number:</label>
            <input type="text" id="ContactNumber" name="ContactNumber" value="{{ $profile->ContactNumber }}" required>
        </div>
        <div>
            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address" value="{{ $profile->ContactNumber }}" required>
        </div>
        
        <button type="submit">Save Changes</button>


</form>

@endsection
