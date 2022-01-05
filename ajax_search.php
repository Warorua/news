<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
   <?php
include 'includes/navbar.php';
   ?>
  <div class="container">   
  <form id="updateForm" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Search Here:</label>
    <input type="text" class="form-control" name="search" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    <div id="emailHelp" class="form-text">A short description of what you want to search.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Articles per page:</label>
    <input type="number" class="form-control" name="total" id="exampleInputEmail1" aria-describedby="emailHelp" max="25" required>
    <div id="emailHelp" class="form-text">Maximum request to request are 25.</div>
  </div>
  
  <button type="submit" class="btn btn-primary">Search</button>
</form>
    
        <div id="tbody2"></div>
       
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
 setInterval(function(){ 
      $.ajax({    
        type: "GET",
        url: "ajax_fetch.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#tbody2").html(data); 
           
        }
    });

}, 10000);






$(document).on('submit','#updateForm',function(e){
        e.preventDefault();
                
         var search= $("input[name='search']").val();
         var total= $("input[name='total']").val();
        $.ajax({
        method:"POST",
        url: "search.php",
        data:{
           total:total,
           search:search
           },
        success: function(data){
          $("#tbody2").html(data); 
   
    }});
});
</script>
  </body>
</html>