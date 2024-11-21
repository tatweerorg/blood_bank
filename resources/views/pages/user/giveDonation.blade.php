@extends('layouts.dashboard-template-user')
@section('content')
<form action="{{ route('dashboarduser.giveBlood.store') }}" method="POST">
            @csrf

           

            <div class="form-group">
                <label for="blood_type">فصيلة الدم</label>
                <input type="text" class="form-control" id="blood_type" name="blood_type" required maxlength="3" placeholder="e.g., A+">
            </div>

            <div class="form-group">
                <label for="quantity">الكمية</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required min="1" placeholder="Units required">
            </div>

            <div class="form-group">
                <label for="last_donation_date">المركز</label>
                <input type="date" class="form-control" id="last_donation_date" name="last_donation_date" required  placeholder="Date required">
            </div>
            <div class="form-group">
                <label for="center_id">اختر مركز التبرع</label>
                <select name="center_id" id="center_id" class="form-control">
                    <option value="">اختر مركز</option>
                    @foreach($centers as $center)
                    <option value="{{ $center->id }}">{{ $center->Username }}</option>
                    @endforeach
                </select>
           
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit Request</button>
        </form>
@endsection