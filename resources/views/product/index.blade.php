@extends('layout')

@section('content')

<div class="card">
  <div class="card-header">
    <h2>Products</h2>
    <div class="float-right">
        <a href="{{ route('products.create')}}" class="btn btn-primary">Add Product</a>
    </div>
  </div>
<div class="content">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped table-bordered">
    <thead>
        <tr>
          <td></td>
          <td>Product Name</td>
          <td>Model</td>
          <td>Price</td>
          <td>Quantity</td>
          <td>Status</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ isset($cnt)? ++$cnt : $cnt=1 }}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->model}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->quantity}}</td>
            <td>{{($product->status==1) ? 'Enabled' : 'Disabled'}}</td>
            <td><a href="{{ route('products.edit',$product->id)}}" class="btn btn-primary btn-sm">Edit</a></td>
            <td>
                <form action="{{ route('products.destroy', $product->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection