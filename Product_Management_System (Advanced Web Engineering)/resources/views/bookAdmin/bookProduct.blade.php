@extends('layouts.app')

<!--adding content-->
@section('content')

<div class="col-sm-4" id="bookdetail">
<h1> Book Information</h1>
      <p><b>Title:</b> {{ $product->title}}<br/>
      <b>Firstname:</b> {{ $product->firstname}}<br/>
      <b>Lastname:</b> {{ $product->surname}}<br/>
      <b>Price:</b> £{{ $product->price}}<br/>
      <b>No. of pages:</b> {{ $product->papl }}</p><br/>
</div>  
<br><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection
