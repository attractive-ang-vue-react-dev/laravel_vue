@extends('layout')

@section('content')

<div class="card">
  <div class="card-header">
    Add Category
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('categories.store') }}">
          <div class="form-group">
              @csrf
              <label for="parent_id">Parent Category: </label>
              <select class="form-control" name="parent_id">
                <option value="0" selected>&nbsp;</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{ $category->full_name }}</option>
                @endforeach
              </select>
              
          </div>
          <div class="form-group">
              <label for="name">Category Name :</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          
          <button type="submit" class="btn btn-primary">Create Category</button>
      </form>
  </div>
</div>
@endsection