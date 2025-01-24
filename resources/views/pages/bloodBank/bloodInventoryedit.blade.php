@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
@endsection

@section('content')
    <section class="container">

        <div class="container my-5">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


            <h2>تعديل كمية الدم</h2>
            <p class="textalignedit">وحدة الدم : ( {{$inventroy-> BloodType}} )</p>
            <form action="{{ route('bloodInventory.update', $inventroy->id) }}" method="POST">
            @csrf
          
                <!-- Units input -->
                <div class="form-group">
                    <label for="Quantity">عدد الوحدات المتوفرة</label>
                    <input type="text" name="Quantity" id="Quantity" class="form-control" 
       placeholder="{{ old('Quantity', $inventroy->Quantity) }} :  عدد الوحدات" required>

                </div>

           <br>
                <button type="submit" class="btn btn-primary search-btn"> حفظ التعديلات</button>

            </form>
        </div>
    </section>
@endsection
