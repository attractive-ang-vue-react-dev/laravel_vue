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
  