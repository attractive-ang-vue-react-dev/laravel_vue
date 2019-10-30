@extends('layout')

@section('content')

<div class="card">
  <div class="card-header">
    Add Product
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
      <form method="post" action="{{ route('products.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Product Name:</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="model">Model :</label>
              <input type="text" class="form-control" name="model"/>
          </div>
          <div class="form-group">
              <label for="price">Price :</label>
              <input type="text" class="form-control" name="price"/>
          </div>
          <div class="form-group">
              <label for="quantity">Quantity :</label>
              <input type="text" class="form-control" name="quantity"/>
          </div>
          <div class="form-group">
              <label for="cat_search">Category :</label>
              <input class="form-control" type="text" id="cat-search" placeholder="Categories">
              <ul class="form-control list-group" id="cat-all">
                @foreach($categories as $cat)
                  <li class="list-group-item" id="cat-one_{{$cat->id}}">{{$cat->full_name}}</option>
                @endforeach
              </ul>
              <ul class="list-group" id="my-cat-list">
              </ul>
          </div>
          <input type="hidden" id="real_cat" name="real_cat">
          <button type="submit" class="btn btn-primary">Create Product</button>
      </form>
  </div>
</div>
@endsection
@section('special-script')
  <script type="text/javascript">
    var real_cat=[];
    $(document).ready(function () { 
    
      $("#my-cat-list li a").each(function(){
          var id=$(this).attr("id").split("_")[1];
          real_cat.push(parseInt(id));  
          $("#real_cat").val(real_cat);
      });
      $("#cat-search").click(function(){
        $("#cat-all").fadeIn();
      });
      $("#cat-all li").click(function(){

        var id=parseInt($(this).attr("id").split("_")[1]);
        if(!real_cat.includes(id)){
            real_cat.push(parseInt(id));  
            var new_str="<li class='list-group-item' id='my-cat-li_" + id + "'><a id='my-cat_"+id+"' class='fas fa-minus-circle' onclick='javascript:removeItem("+id+")'></a>"+$(this).html() +"</li>";
            $("#my-cat-list").append(new_str);
            $("#real_cat").val(real_cat);
        }
        $("#cat-all").hide();
      });

      $('#cat-search').keyup(function(){
    
          var text = $(this).val();
          $('#cat-all li').hide();
          $('#cat-all li:contains("'+text+'")').show();
      });
      
    });
    $(document).mouseup(function (e){

      var container = $("#cat-all");
      if (!container.is(e.target) && container.has(e.target).length === 0){
        container.fadeOut();
      }

    }); 
    function removeItem(id){
        var index=real_cat.indexOf(id);
        console.log(index);
        real_cat.splice(index,1);
        console.log(real_cat);  
        $("#real_cat").val(real_cat);
        $("#my-cat-li_"+id).remove();
    }
  </script>
@endsection