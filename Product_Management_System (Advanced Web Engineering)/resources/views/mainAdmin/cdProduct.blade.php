@extends('layouts.app')
@section('content')

<div class="col-sm-4" id="cddetail">
<h1>Cd Information</h1>
      <p><b>Title:</b> {{ $product->title}}<br/>
      <b>Firstname:</b> {{ $product->firstname}}<br/>
      <b>Lastname:</b> {{ $product->surname}}<br/>
      <b>Price:</b> £{{ $product->price}}<br/>
      <b>Play Length:</b> {{ $product->papl }}</p><br/>
</div>  
<br><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection