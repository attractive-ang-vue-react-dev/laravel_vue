@extends('layout')

@section('content')
<div class="card">
  <div class="card-header">
    Edit Category
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
      <form method="post" action="{{ route('categories.update', $category->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="parent_id">Parent Category: </label>
              <select class="form-control" name="parent_id">
                <option value="0" {{ ( $category->parent_id==0) ? 'selected' : '' }}>&nbsp;</option>
                @foreach($categories as $cat)
                    <option value="{{$cat->id}}" {{ ( $category->parent_id==$cat->id) ? 'selected' : '' }}>{{ $cat->full_name }}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="name">Category Name :</label>
              <input type="text" class="form-control" name="name" value="{{ $category->name }}" />
          </div>
          <button type="submit" class="btn btn-primary">Update Category</button>
      </form>
  </div>
</div>
@endsection