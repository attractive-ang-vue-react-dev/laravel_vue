@extends('layout')

@section('content')

<div class="card">
  <div class="card-header">
    <h2>Categories</h2>
    <div class="float-right">
        <a href="{{ route('categories.create')}}" class="btn btn-primary">Add Category</a>
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
          <td>No</td>
          <td>Category Name</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{isset($cnt) ? ++$cnt : $cnt=1 }}</td>
            <td>{{$category->full_name}}</td>
            <td><a href="{{ route('categories.edit',$category->id)}}" class="btn btn-primary btn-sm">Edit</a></td>
            <td>
                <form action="{{ route('categories.destroy', $category->id)}}" method="post">
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