@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row justify-content-md-centre">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-5" id="singlebook">
        <form method = "POST" action="../../products/{{$product->id}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Title</label>
                    <input type = "text" class="form-control input @error('title') is-danger @enderror" name="title" value="{{$product->title}}">
                    @error('title')
                        <p class="help is-danger"> {{$errors->first('title')}}</p>
                    @enderror
            </div>
            <div class="form-group">
                <label>Product Type</label>
                    <input type = "text" class="form-control  input @error('type') is-danger @enderror" name="type" value="{{$product->type}}">
                    @error('type')
                        <p class="help is-danger"> {{$errors->first('type')}}</p>
                    @enderror
            </div>
            <div class="form-group">
                <label>Price</label>
                    <input type ="number" class="form-control input @error('price') is-danger @enderror" name="price" value="{{$product->price}}">
                    @error('price')
                        <p class="help is-danger"> {{$errors->first('price')}}</p>
                    @enderror
            </div>
            <div class="form-group">
                <label>Firstname</label>
                    <input type ="text" class="form-control input @error('firstname') is-danger @enderror" name="firstname" value="{{$product->firstname}}">
                    @error('firstname')
                        <p class="help is-danger"> {{$errors->first('firstname')}}</p>
                    @enderror
            </div>
            <div class="form-group">
                <label>Surname</label>
                    <input type ="text" class="form-control input @error('price') is-danger @enderror" name="surname" value="{{$product->surname}}">
                    @error('surname')
                        <p class="help is-danger"> {{$errors->first('surname')}}</p>
                    @enderror
            </div>
            <div class="form-group">
                <label>Play Length</label>
                    <input type ="number" class="form-control  input @error('papl') is-danger @enderror" name="papl" value="{{$product->papl}}">
                    @error('papl')
                        <p class="help is-danger"> {{$errors->first('papl')}}</p>
                    @enderror
            </div>
            <br/>
            <div class="center">
                <button type = "submit" name="save" class="btn btn-success">Update</button>
        </form>
        <br>
        &nbsp;
        <form method = "POST" action="../../products/{{$product->id}}">
            @csrf
            @method('DELETE')
            <div class="center">
                <button type = "delete" name="delete" class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
    <div class="col-sm-3">
    </div>
 </div>
</div>
@endsection