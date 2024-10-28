@extends('layouts.dashboard-template-user')
@section('content')
<form action="{{ route('dashboarduser.requestsBlood.store') }}" method="POST">
            @csrf

           

            <div class="form-group">
                <label for="BloodType">Blood Type</label>
                <input type="text" class="form-control" id="BloodType" name="BloodType" required maxlength="3" placeholder="e.g., A+">
            </div>

            <div class="form-group">
                <label for="Quantity">Quantity</label>
                <input type="number" class="form-control" id="Quantity" name="Quantity" required min="1" placeholder="Units required">
            </div>

            <div class="form-group">
                <label for="RequestDate">Request Date</label>
                <input type="date" class="form-control" id="RequestDate" name="RequestDate" required>
            </div>


            <button type="submit" class="btn btn-primary mt-3">Submit Request</button>
        </form>
@endsection