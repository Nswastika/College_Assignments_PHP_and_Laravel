@extends('layouts.app')
@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                    <h1>Thank you for registration! </h1>
                    <img class="d-block w-100" src="images/listen.jpg" alt="First slide">
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
                    <h3>Now, you can view information of all Books & Cds:
                    <a href="{{ route('allProduct')}}" class="btn btn-primary">View</a></h3>
        </div>
    </div>
</div>
<br>
@endsection
