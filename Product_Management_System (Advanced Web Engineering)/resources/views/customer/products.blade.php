@extends('layouts.app')
<!--adding content-->
@section('content')
<br/>
<div class="container">
    <h1 style="text-align:center;">List of all Books & Cds</h1>
    <br>
    <div class="row">
        <div class="col-6" id="bookdetail" style="background-color:#FAB2AF;">
        <h1 style="color:purple;">Books</h1>
        <br>
                @foreach($book as $product)
                    <p><b>Title:</b> {{ $product->title}}<br/>
                    <b>Type:</b> {{ $product->type}}<br/>
                    <b>Firstname:</b> {{ $product->firstname}}<br/>
                    <b>Lastname:</b> {{ $product->surname}}<br/>
                    <b>Price:</b> £{{ $product->price}}<br/>
                    <b>No. of pages:</b> {{ $product->papl }}</p><br/>
                    <p>-------------------------------------------------------------<p>
                @endforeach
        </div>
        <div class="col-6" id="cddetail" style="background-color:#D2A7DC;">
        <h1 style="color:purple;">Cds</h1>
        <br>
                @foreach($cd as $product)
                    <p><b>Title:</b> {{ $product->title}}<br/>
                    <b>Type:</b> {{ $product->type}}<br/>
                    <b>Firstname:</b> {{ $product->firstname}}<br/>
                    <b>Lastname:</b> {{ $product->surname}}<br/>
                    <b>Price:</b> £{{ $product->price}}<br/>
                    <b>Play Length:</b> {{ $product->papl }}</p><br/>
                    <p>-------------------------------------------------------------<p>
                @endforeach
        </div>
    </div>
</div>


@endsection