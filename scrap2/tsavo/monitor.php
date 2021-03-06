<?php include 'includes/session.php' ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../comps/dash.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/alphardex/aqua.css@master/dist/aqua.min.css'>
    <title>Hello, world!</title>
  </head>
  <body>
 <div class="container gx-5 p-3 ">
   <div class="row">
<div class="col-md-4">
    <h1>Fetching
        <div class="dots"><span class="dot z"></span><span class="dot f"></span><span class="dot s"></span><span class="dot t"><span class="dot l"></span></span></div>
      </h1>

</div>
 <div class="col-md-4"></div>
<div class="col-md-4">
    <div class="clock-loader"></div>
</div>
</div> 

<div id="fetchPr">

</div>

<div class="col-md-6 mb-3">
<button onclick="Fdelete()" class="btn btn-danger mb-3" style="width: 100%;">Delete</button>
    </div>

<div class="mb-3" id="del"></div>
<div style="padding: 15px;" id="FboY">
<div class="mb-3" id="fbody"></div>
</div>

<table class="table mb-3">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Slug</th>
      <th scope="col">Supplier</th>
      <th scope="col">Category</th>
    </tr>
  </thead>
  <tbody id="dbody">
 
  </tbody>
</table>

</div>
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
        url: "count.php",             
        dataType: "html",                  
        success: function(data){ 
            $("#fbody").html(data); 
         
        }
    });

}, 2000);

 setInterval(function(){ 
      $.ajax({    
        type: "GET",
        url: "fetch.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#dbody").html(data); 
         
        }
    });

}, 5600);
setInterval(function(){ 
      $.ajax({    
        type: "GET",
        url: "savo.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#body").html(data); 
         
        }
    });

}, 10000);


function Fdelete(){
  $.ajax({    
        type: "GET",
        url: "delete.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#del").html(data); 
         
        }
    });

}

    </script> 
    
  </body>
</html>