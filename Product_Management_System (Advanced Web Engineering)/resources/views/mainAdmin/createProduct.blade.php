@extends('layouts.app')
@section('content')
<br>
<div class="container">
    <h1 style="text-align:left;"> &nbsp;Add new product:</h1>
 <div class="row justify-content-md-centre">
  <div class="col-sm-5 d-flex justify-content-center" id="addform">
    <form method = "POST" action="../products">
    @csrf
    <div class="form-group">
        <label>Title: </label>
        <input type = "text" class="form-control input @error('title') is-danger @enderror" name="title" value="{{old('title')}}">
        @error('title')
            <p class="help is-danger"> {{$errors->first('title')}}</p>
        @enderror
    </div>

    <div class="form-group">
        <label>Product Type: </label>
        <select name ="type" class="form-control">
            <option value="cd">CD</option>
            <option value="book">Book</option>
        </select>
    </div>
    <div class="form-group">
        <label>Price: </label>
        <input type ="number" class="form-control input @error('price') is-danger @enderror" name="price" value="{{old('price')}}">
        @error('price')
            <p class="help is-danger"> {{$errors->first('price')}}</p>
        @enderror
    </div>
    <div class="form-group">
        <label>Firstname:</label>
        <input type ="text" class="form-control input @error('firstname') is-danger @enderror" name="firstname" value="{{old('firstname')}}">
        @error('firstname')
            <p class="help is-danger"> {{$errors->first('firstname')}}</p>
        @enderror
    </div>
    <div class="form-group">
        <label>Surname: </label>
        <input type ="text" class="form-control input @error('price') is-danger @enderror" name="surname" value="{{old('surname')}}">
        @error('surname')
            <p class="help is-danger"> {{$errors->first('surname')}}</p>
        @enderror
    </div>
    <div class="form-group">
        <label>Playlength/ No.of pages :</label>
        <input type ="number" class="form-control input @error('papl') is-danger @enderror" name="papl" value="{{old('papl')}}">
        @error('papl')
            <p class="help is-danger"> {{$errors->first('papl')}}</p>
        @enderror
    </div>
    <br/>
    <button type = "submit" name="save" class="btn btn-success">save</button>
    </form>
  </div>
 </div>
</div>
@endsection