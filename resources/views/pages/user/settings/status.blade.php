@extends('layouts.dashboard-template-user')
@section('content')
   <form action="{{ route('settings.updatepersonalinfo') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
            <label for="disease">disease:</label>
            <input type="text" id="disease" name="disease" >
        
   </div>
   <button>Add disease</button>
   </form>
   <div>
    <h2> All diseases</h2>
   </div>
@endsection
