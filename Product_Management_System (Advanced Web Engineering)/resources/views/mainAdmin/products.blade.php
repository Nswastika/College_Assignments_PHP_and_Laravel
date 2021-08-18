@extends('layouts.app')
<!--adding content-->
@section('content')
<br/>
<div class="container">
    <h1 style="text-align:center;"> Admin Dashboard</h1>
    <br>
    <div class="row">
        <div class="col-12"> 
            <h3 style="color:purple;text-align:right;">Add a new product: <a href="{{'products/create'}}" class="btn btn-success">Add</a></h3>
        </div>
    </div>
    <div class="row justify-content-md-centre">
        <div class="col-12">
        <h2>Books</h2>
            <table class="table table-bordered">
                <thead>
                   <tr class="bg-primary">
                      <th scope="col">Title</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Surname</th>
                      <th scope="col">Price</th>
                      <th scope="col">Number of pages</th>
                      <th scope="col">Action</th>
                   </tr>
                </thead>
                <tbody>
                @foreach($book as $product)
                    <tr class="table-primary">
                      <td>{{ $product->title}}</td>
                      <td>{{ $product->firstname}}</td>
                      <td>{{ $product->surname}}</td>
                      <td>£{{$product->price}}</td>
                      <td>{{ $product->papl }}</td>
                      <td><a href="{{ route('singleProduct',$product->id)}}" class="btn btn-primary">Show</a>&nbsp
                       <a href="{{ route('editProduct',$product->id)}}" class="btn btn-danger">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
           </table>
        </div>
    </div>
    <div class="row justify-content-md-centre">
        <div class="col-12">
        <h1>Cds</h1>
            <table class="table table-bordered">
                <thead>
                   <tr class="bg-primary">
                      <th scope="col">Title</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Surname</th>
                      <th scope="col">Price</th>
                      <th scope="col">Play Length</th>
                      <th scope="col">Action</th>
                   </tr>
                </thead>
                <tbody>
                @foreach($cd as $product)
                    <tr class="table-primary">
                      <td>{{ $product->title}}</td>
                      <td>{{ $product->firstname}}</td>
                      <td>{{ $product->surname}}</td>
                      <td>£{{$product->price}}</td>
                      <td>{{ $product->papl }}</td>
                      <td><a href="{{ route('singleProduct',$product->id)}}" class="btn btn-primary">Show</a>
                       <a href="{{ route('editProduct',$product->id)}}" class="btn btn-danger">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
           </table>
        </div>



    </div>
</div>


@endsection