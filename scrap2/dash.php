<?php
include 'includes/session.php';

if(!isset($_POST['password'])){
  $_SESSION['error'] = "Please login first";
  header("location: index.php");
}
elseif($_POST['password'] != "UKRMedia2022"){
  $_SESSION['error'] = "Invalid password";
  header("location: index.php");
}
else{
  $_SESSION['success'] = "Login successful";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="comps/dash.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/alphardex/aqua.css@master/dist/aqua.min.css'>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">    
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
<?php
      if(isset($_SESSION['error'])){
        echo "
           <div class='alert alert-danger' role='alert'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }

      if(isset($_SESSION['success'])){
        echo "
          <div class='alert alert-primary' role='alert'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
<div id="cbody"></div>
<div class="table-responsive">
<table id="myTable" class="display">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Row 1 Data 1</td>
            <td>Row 1 Data 2</td>
        </tr>
        <tr>
            <td>Row 2 Data 1</td>
            <td>Row 2 Data 2</td>
        </tr>
    </tbody>
</table>

<table id="" class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Source</th>
      <th scope="col">Category</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody id="dbody">
 
  </tbody>
</table>
</div>
  </div>
    <!-- Optional JavaScript; choose one of the two! -->
<script>
      $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script>
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
    <script>
 setInterval(function(){ 
      $.ajax({    
        type: "GET",
        url: "dash_fetch.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#dbody").html(data); 
         
        }
    });

}, 1000);

setInterval(function(){ 
      $.ajax({    
        type: "GET",
        url: "dash_cfetch.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#cbody").html(data); 
         
        }
    });

}, 100);

setInterval(function(){ 
      $.ajax({    
        type: "GET",
        url: "unian/unian_headline.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#body").html(data); 
         
        }
    });

}, 10000);

    </script> 
   
  </body>
</html>