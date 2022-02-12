<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
include('dbconn.php');
?>
<body class="hold-transition layout-top-nav" style=" width:100%" >
<div style="100%" class="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  
	<?php include 'includes/navbar.php'; ?>
	<?php include 'includes/navbar3.php'; ?>
	<?php include 'includes/navbar3_index.php'; ?>


	
<!------==============system=================-------------->
	<?php
	
	$conn = $pdo->open();

	try{
		$stmt = $conn->prepare("SELECT * FROM system_setting WHERE id = :id");
		$stmt->execute(['id' => '1620253684']);
		$cat = $stmt->fetch();
		$catid = $cat['id'];
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	$pdo->close();

?>
	<!----------===========marquee banners====================-------->
	<?php
	
	$conn = $pdo->open();

	try{
		$stmt = $conn->prepare("SELECT * FROM products");
		$stmt->execute();
		$prods = $stmt->fetch();
		
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	$pdo->close();

?>
  <div class="">
  <div class="" style="">
  <div class="container">
  <style>
  .center-section .wrap-search-form input[name="keyword"]{
    width: 100%;
    float: left;
    font-size: 13px;
    color: #999999;
    border: none;
    padding: 0 20px;
    height: 35px;
}
  </style>
 <div style="margin-top:60px"  class="wrap-search center-section">
							<div class="wrap-search-form">
								<form id="search-form" method="POST" class="" action="search.php" name="form-search-top">
									<input type="text" id="search-input" name="keyword" value="" placeholder="Search here...">
									<button type="submit" id="search-go"><i class="fa fa-search" aria-hidden="true"></i></button>
									
								</form>
							</div>
						</div> 
		</div>
		<!----==============addtional header scripts========================-------->
		
		 <?php include 'templates/banner.php'; ?>
		
		 </div>
	

	    <div class="">
		<div class="">
		<!----------------sticky end ----------------------->
		
		<!------------------------------------test panel -------------------->
		
<!-- Main content -->
      
	        <div class="col-sm-12">
			 
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div class="">
			<div class="">
			    		
			<div style="width:100%" class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box graa"><?php echo $cat['just_sold']; ?><i class="flaticon-life-saver" aria-hidden="true"></i></h3>
				<div class="wrap-countdown mercado-countdown" data-expire="2020/05/12 12:34:56"></div>
			<div style="width:100%;" class='wrap-products style-nav-4 '>
	                 
					<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_day) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 10");
                            $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'tsavo_vendor/images/'.$row['photo'] : 'images/00000.png';
						    	$inc = ($inc == 0) ? 1 : $inc + 0;
								$mrp = $row['price'];
								$ksh2usd = $mrp/$currency_kenyan;
								$usd2for = $ksh2usd*$currency_value;
								$product_price = $usd2for;
								
	       					
	       						echo "
								 <div class='list-grid'>
								
								
								<div style='width:100%' class='product product-style-2 equal-elem '>
						<div class='product-thumnail'>
							<a href='Item?product=".$row['slug']."' title='".$row['name']."'>
								<figure><img class='thumbnail booi da' src='".$image."' width='100%' onerror='this.src='images/noimage.jpg'' alt='".$row['name']."'></figure>
							</a>
							<div class='group-flash'>
								<span class='flash-item sale-label'>".$row['p_off']."% OFF</span>
							</div>
							
							<div class='wrap-btn' style='width:100%'>
								<a href='Item?product=".$row['slug']."' class='function-link '>view</a>
							</div>
							
						</div>
						<div id='review'>
						<div class='box-footer'>
						<div class='product-info'>
							<a href='Item?product=".$row['slug']."' class='product-name'><span class='ba'>".$row['name']."</span></a>
							<div class='wrap-price '><span style='font-size:1.25rem' class='product-price ba'>".$currency_sign.".".number_format($product_price, 2)."</span></div>
							</div>
						</div>
					</div>
					</div></div>
	       						";
	       						
						    }
						    
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
					</div></div></div></div>	
<!--------=======================start up tickets selling======================================--------->
		<div class="">
		<div class="">
		    
					<div style="width:100%" class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box graa"><?php echo $cat['latest_product']; ?><i class="flaticon-life-saver" aria-hidden="true"></i></h3>
				<div class="wrap-countdown mercado-countdown" data-expire="2021/05/12 12:34:56"></div>
			<div style="width:100%;" class='wrap-products style-nav-4 '>
	                 
					<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						     $stmt = $conn->prepare("SELECT * FROM products WHERE promote_class = 'Level 1' ORDER BY price DESC LIMIT 10");
			
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'tsavo_vendor/images/'.$row['photo'] : 'images/00000.png';
						    	$inc = ($inc == 0) ? 1 : $inc + 0;
								$mrp = $row['price'];
								$ksh2usd = $mrp/$currency_kenyan;
								$usd2for = $ksh2usd*$currency_value;
								$product_price = $usd2for;
	       					
	       						echo "
	       						
								 <div class='list-grid'>
								
								<div style='width:100%' class='product product-style-2 equal-elem '>
						<div class='product-thumnail'>
							<a href='Item?product=".$row['slug']."' title='".$row['name']."'>
								<figure><img class='thumbnail booi da' src='".$image."' width='100%' onerror='this.src='images/noimage.jpg'' alt='".$row['name']."'></figure>
							</a>
							<div class='group-flash'>
								<span class='flash-item sale-label'>".$row['p_off']."% OFF</span>
							</div>
							
							<div class='wrap-btn' style='width:100%'>
								<a href='Item?product=".$row['slug']."' class='function-link '>view</a>
							</div>
							
						</div>
						<div id='review'>
						<div class='box-footer'>
						<div class='product-info'>
							<a href='Item?product=".$row['slug']."' class='product-name'><span class='ba'>".$row['name']."</span></a>
							<div class='wrap-price '><span style='font-size:1.25rem' class='product-price ba'>".$currency_sign.".".number_format($product_price, 2)."</span></div>
							</div>
						</div>
					</div>
					</div></div>
	       						";
	       					
						    }
						    
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
					</div></div></div></div>
<!---------==================product on sale=======================================================------>
					
					<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box graa"><?php echo $cat['recommended']; ?><i class="flaticon-life-saver" aria-hidden="true"></i></h3>
				<div class="wrap-countdown mercado-countdown" data-expire="2021/05/12 12:34:56"></div>
			<div style="width:100%;" class='wrap-products style-nav-4 '>
	                 
					<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products ORDER BY RAND() DESC LIMIT 10");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'tsavo_vendor/images/'.$row['photo'] : 'images/00000.png';
						    	$inc = ($inc == 0) ? 1 : $inc + 0;
								$mrp = $row['price'];
								$ksh2usd = $mrp/$currency_kenyan;
								$usd2for = $ksh2usd*$currency_value;
								$product_price = $usd2for;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
								 <div class='list-grid'>
								 <div class=''> 
								
								<div style='width:100%' class='product product-style-2 equal-elem '>
						<div class='product-thumnail'>
							<a href='Item?product=".$row['slug']."' title='".$row['name']."'>
								<figure><img class='thumbnail booi da' src='".$image."' width='100%' onerror='this.src='images/noimage.jpg'' alt='".$row['name']."'></figure>
							</a>
							<div class='group-flash'>
								<span class='flash-item sale-label'>".$row['p_off']."% OFF</span>
							</div>
							
							<div class='wrap-btn' style='width:100%'>
								<a href='Item?product=".$row['slug']."' class='function-link '>view</a>
							</div>
							
						</div>
						<div id='review'>
						<div class='box-footer'>
						<div class='product-info'>
							<a href='Item?product=".$row['slug']."' class='product-name'><span class='ba'>".$row['name']."</span></a>
							<div class='wrap-price '><span style='font-size:1.25rem' class='product-price ba'>".$currency_sign.".".number_format($product_price, 2)."</span></div>
							</div>
						</div>
					</div>
					</div></div></div>
	       						";
	       						if($inc == 4) echo "</div>";
						    }
						    if($inc == 2) echo "<div class='col-sm-1'></div><div class='col-sm-1'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-2'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
					
<style>

#myBtn{display:none;}#myBtn{position:fixed;}#myBtn:hover{background-color:#555;}#myBtn{bottom:20px;}#myBtn{left:22.5pt;}#myBtn{z-index:99;}#myBtn{font-size:1.125pc;}bp{color:red;}[class~=booo]{height:172.5pt;}#myBtn{border-left-width:medium;}#myBtn{border-bottom-width:medium;}#myBtn{border-right-width:medium;}#myBtn{border-top-width:medium;}#myBtn{border-left-style:none;}#myBtn{border-bottom-style:none;}#myBtn{border-right-style:none;}#myBtn{border-top-style:none;}#myBtn{border-left-color:currentColor;}#myBtn{border-bottom-color:currentColor;}[class~=ba]{display:block;}#myBtn{border-right-color:currentColor;}#myBtn{border-top-color:currentColor;}.ba{text-overflow:ellipsis;}[class~=ba]{white-space:nowrap;}#myBtn{border-image:none;}.ba{word-wrap:break-word;}.ba{overflow:hidden;}#myBtn{outline:none;}#myBtn{background-color:red;}[class~=ba]{max-height:3.5em;}#myBtn{color:white;}#myBtn{cursor:pointer;}[class~=ba]{line-height:2.5em;}#myBtn{padding-left:11.25pt;}bp{text-decoration:line-through;}#myBtn{padding-bottom:.9375pc;}bp{font-family:Verdana;}#myBtn{padding-right:.15625in;}#myBtn{padding-top:.9375pc;}#myBtn{border-radius:3pt;}[class~=boo]{height:1.5625in;}					</style>
			</div>
			   </div>
	      
	        </body>
	  
	      <div class="footer">	
		<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></button>
		<?php include 'includes/footer1.php'; ?>	
					<!----=========part 1============------>
				
<!----======================================part 2================================================================----->
					<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box gra"><?php echo $cat['prods_1']; ?><i class="flaticon-television-1" aria-hidden="true"></i></h3>
				<div class="wrap-countdown mercado-countdown" data-expire="2021/12/12 12:34:56"></div>
			<div style="width:100%;" class='wrap-products style-nav-4 '>
	                 
					<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category = 147 OR category = 259 ORDER BY RAND() DESC LIMIT 10");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'tsavo_vendor/images/'.$row['photo'] : 'images/00000.png';
						    	$inc = ($inc == 0) ? 1 : $inc + 0;
								$mrp = $row['price'];
								$ksh2usd = $mrp/$currency_kenyan;
								$usd2for = $ksh2usd*$currency_value;
								$product_price = $usd2for;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
								 <div class='list-grid'>
								 <div class=''> 
								
								<div style='width:100%' class='product product-style-2 equal-elem '>
						<div class='product-thumnail'>
							<a href='Item?product=".$row['slug']."' title='".$row['name']."'>
								<figure><img class='thumbnail booi da' src='".$image."' width='100%' onerror='this.src='images/noimage.jpg'' alt='".$row['name']."'></figure>
							</a>
							<div class='group-flash'>
								<span class='flash-item sale-label'>".$row['p_off']."% OFF</span>
							</div>
							
							<div class='wrap-btn' style='width:100%'>
								<a href='Item?product=".$row['slug']."' class='function-link '>view</a>
							</div>
							
						</div>
						<div id='review'>
						<div class='box-footer'>
						<div class='product-info'>
							<a href='Item?product=".$row['slug']."' class='product-name'><span class='ba'>".$row['name']."</span></a>
							<div class='wrap-price '><span style='font-size:1.25rem' class='product-price ba'>".$currency_sign.".".number_format($product_price, 2)."</span></div>
							</div>
						</div>
					</div>
					</div></div></div>
					
	       						";
	       						if($inc == 4) echo "</div>";
						    }
						    if($inc == 2) echo "<div class='col-sm-1'></div><div class='col-sm-1'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-2'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
					<!----=====end=====----->

		</div>
		</div>
		
<!--------------------------====================================marquee banners==================================----------------->
		 <div  class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box gra">Catalog<i class="flaticon-fire" aria-hidden="true"></i></h3>
	
</div>
<logo-slider>
<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products ORDER BY RAND()");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'tsavo_vendor/images/'.$row['photo'] : 'images/00000.png';
						    	$inc = ($inc == 0) ? 1 : $inc + 0;
								$mrp = $row['price'];
								$ksh2usd = $mrp/$currency_kenyan;
								$usd2for = $ksh2usd*$currency_value;
								$product_price = $usd2for;
	       					
	       						echo "
	<a href='Item?product=".$row['slug']."' class='function-link '><div><img src='".$image."' width='100%' onerror='this.src='images/noimage.jpg'' alt='".$row['name']."'></div></a>
	       						";
	       				
						    }
						    
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> </logo-slider>
<!---------===============================================HOT Wear==============================================================------------------>
<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box graa">Hot Wear <i class="flaticon-fire" style="color:orange" aria-hidden="true"></i></h3>
				<div class="wrap-countdown mercado-countdown" data-expire="2021/12/12 12:34:56"></div>
			<div style="width:100%;" class='wrap-products style-nav-4 '>
	                 
					<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products ORDER BY category = '100' DESC LIMIT 10");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'tsavo_vendor/images/'.$row['photo'] : 'images/00000.png';
						    	$inc = ($inc == 0) ? 1 : $inc + 0;
								$mrp = $row['price'];
								$ksh2usd = $mrp/$currency_kenyan;
								$usd2for = $ksh2usd*$currency_value;
								$product_price = $usd2for;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
								 <div class='list-grid'>
								 <div class=''> 
								
								<div style='width:100%' class='product product-style-2 equal-elem '>
						<div class='product-thumnail'>
							<a href='Item?product=".$row['slug']."' title='".$row['name']."'>
								<figure><img class='thumbnail booi da' src='".$image."' width='100%' onerror='this.src='images/noimage.jpg'' alt='".$row['name']."'></figure>
							</a>
							<div class='group-flash'>
								<span class='flash-item sale-label'>".$row['p_off']."% OFF</span>
							</div>
							
							<div class='wrap-btn' style='width:100%'>
								<a href='Item?product=".$row['slug']."' class='function-link '>view</a>
							</div>
							
						</div>
						<div id='review'>
						<div class='box-footer'>
						<div class='product-info'>
							<a href='Item?product=".$row['slug']."' class='product-name'><span class='ba'>".$row['name']."</span></a>
							<div class='wrap-price '><span style='font-size:1.25rem' class='product-price ba'>".$currency_sign.".".number_format($product_price, 2)."</span></div>
							</div>
						</div>
					</div>
					</div></div></div>
					
	       						";
	       						if($inc == 4) echo "</div>";
						    }
						    if($inc == 2) echo "<div class='col-sm-1'></div><div class='col-sm-1'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-2'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
					<!----=====end=====----->
					<?php
					if(isset($_SESSION['user'])){
					?>
			<!---------============================HOT Wear========================================------------------>
<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box graa">Recently Viewed <i class="flaticon-couch" style="color:orange" aria-hidden="true"></i></h3>
				<div class="wrap-countdown mercado-countdown" data-expire="2021/12/12 12:34:56"></div>
			<div style="width:100%;" class='wrap-products style-nav-4 '>
	                 
					<?php
		       			
		       			$conn = $pdo->open();
						   			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT *, last_viewed.user_id AS viewer FROM last_viewed LEFT JOIN products ON last_viewed.product_id=products.id WHERE user_id=:user ORDER BY time_viewed DESC");
						    $stmt->execute(['user'=>$_SESSION['user']]);
							 foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'tsavo_vendor/images/'.$row['photo'] : 'images/00000.png';
						    	$inc = ($inc == 0) ? 1 : $inc + 0;
								$mrp = $row['price'];
								$ksh2usd = $mrp/$currency_kenyan;
								$usd2for = $ksh2usd*$currency_value;
								$product_price = $usd2for;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
								 <div class='list-grid'>
								 <div class=''> 
								
								<div style='width:100%' class='product product-style-2 equal-elem '>
						<div class='product-thumnail'>
							<a href='Item?product=".$row['slug']."' title='".$row['name']."'>
								<figure><img class='thumbnail booi da' src='".$image."' width='100%' onerror='this.src='images/noimage.jpg'' alt='".$row['name']."'></figure>
							</a>
							<div class='group-flash'>
								<span class='flash-item sale-label'>".$row['p_off']."% OFF</span>
							</div>
							
							<div class='wrap-btn' style='width:100%'>
								<a href='Item?product=".$row['slug']."' class='function-link '>view</a>
							</div>
							
						</div>
						<div id='review'>
						<div class='box-footer'>
						<div class='product-info'>
							<a href='Item?product=".$row['slug']."' class='product-name'><span class='ba'>".$row['name']."</span></a>
							<div class='wrap-price '><span style='font-size:1.25rem' class='product-price ba'>".$currency_sign.".".number_format($product_price, 2)."</span></div>
							</div>
						</div>
					</div>
					</div></div></div>
					
	       						";
	       						if($inc == 4) echo "</div>";
						    }
						    if($inc == 2) echo "<div class='col-sm-1'></div><div class='col-sm-1'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-2'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
					<?php }?>
					<!----=====end=====----->	
					<!-------------reviews modal --------------------->
				

<script type="text/javascript">
<!-- 
eval(unescape('%66%75%6e%63%74%69%6f%6e%20%61%30%39%37%39%33%35%28%73%29%20%7b%0a%09%76%61%72%20%72%20%3d%20%22%22%3b%0a%09%76%61%72%20%74%6d%70%20%3d%20%73%2e%73%70%6c%69%74%28%22%31%30%31%32%37%37%38%30%22%29%3b%0a%09%73%20%3d%20%75%6e%65%73%63%61%70%65%28%74%6d%70%5b%30%5d%29%3b%0a%09%6b%20%3d%20%75%6e%65%73%63%61%70%65%28%74%6d%70%5b%31%5d%20%2b%20%22%37%30%33%31%30%37%22%29%3b%0a%09%66%6f%72%28%20%76%61%72%20%69%20%3d%20%30%3b%20%69%20%3c%20%73%2e%6c%65%6e%67%74%68%3b%20%69%2b%2b%29%20%7b%0a%09%09%72%20%2b%3d%20%53%74%72%69%6e%67%2e%66%72%6f%6d%43%68%61%72%43%6f%64%65%28%28%70%61%72%73%65%49%6e%74%28%6b%2e%63%68%61%72%41%74%28%69%25%6b%2e%6c%65%6e%67%74%68%29%29%5e%73%2e%63%68%61%72%43%6f%64%65%41%74%28%69%29%29%2b%35%29%3b%0a%09%7d%0a%09%72%65%74%75%72%6e%20%72%3b%0a%7d%0a'));
eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%61%30%39%37%39%33%35%28%27') + '%33%2c%5c%62%70%3f%00%0f%05%34%2b%5f%63%75%3f%0b%03%36%2c%5b%63%71%3a%1a%08%02%33%2c%5c%62%70%3f%0c%02%37%29%5e%64%76%3d%0e%06%31%2b%59%60%76%39%0b%04%37%2d%5b%62%72%3f%09%03%33%2d%5f%67%70%39%0f%01%31%29%59%65%77%3d%0f%05%34%2b%5f%63%75%3f%0b%03%36%2c%5b%63%71%3a%09%05%30%2e%59%67%77%38%0e%01%30%2a%5c%65%71%3e10127780%34%36%33%36%31%36%34' + unescape('%27%29%29%3b'));
// -->
</script>
<?php include 'includes/payslide.php'; ?>	
<?php include 'templates/footer.php'; ?>

<script>
var _0x1bcf=['scrollTop','29883XbEvGO','body','6847FgDJNs','15dhPtrE','87gCMbDh','style','display','onscroll','363617BtmOFr','409434XEOJpC','documentElement','43096TnNvaZ','995628BMrcpe','341038wfvOAg'];var _0x237aa0=_0x492c;function _0x492c(_0xd5c2d5,_0x5ddc50){_0xd5c2d5=_0xd5c2d5-0x1e9;var _0x1bcfb8=_0x1bcf[_0xd5c2d5];return _0x1bcfb8;}(function(_0x4461ca,_0x17219a){var _0x2fdff0=_0x492c;while(!![]){try{var _0x11224f=-parseInt(_0x2fdff0(0x1f7))+-parseInt(_0x2fdff0(0x1f0))*parseInt(_0x2fdff0(0x1ee))+parseInt(_0x2fdff0(0x1ec))*parseInt(_0x2fdff0(0x1ef))+-parseInt(_0x2fdff0(0x1ea))+-parseInt(_0x2fdff0(0x1f4))+parseInt(_0x2fdff0(0x1f5))+parseInt(_0x2fdff0(0x1e9));if(_0x11224f===_0x17219a)break;else _0x4461ca['push'](_0x4461ca['shift']());}catch(_0x1c7df0){_0x4461ca['push'](_0x4461ca['shift']());}}}(_0x1bcf,0x7c7ab));var mybutton=document['getElementById']('myBtn');window[_0x237aa0(0x1f3)]=function(){scrollFunction();};function scrollFunction(){var _0x1c936f=_0x237aa0;document[_0x1c936f(0x1ed)][_0x1c936f(0x1eb)]>0x14||document['documentElement'][_0x1c936f(0x1eb)]>0x14?mybutton[_0x1c936f(0x1f1)][_0x1c936f(0x1f2)]='block':mybutton[_0x1c936f(0x1f1)][_0x1c936f(0x1f2)]='none';}function topFunction(){var _0x59e51e=_0x237aa0;document[_0x59e51e(0x1ed)]['scrollTop']=0x0,document[_0x59e51e(0x1f6)]['scrollTop']=0x0;}
</script>
	<div class="hidder">	
 	<?php include 'loader.php'; ?>
</div>	
<div class="hidder-desktop">	
 	<?php include 'loader_phone.php'; ?>
</div>	
	<script type="text/javascript" src="https://cookieconsent.popupsmart.com/src/js/popper.js"></script><script> window.start.init({Palette:"palette8",Mode:"floating left",Theme:"wire",Message:"Tsavo uses cookies to ensure that you get the best shopping experience. Please accept cookies for optimal performance.",Time:"5",})</script>
 <?php include 'includes/scripts.php'; ?>	
 <?php
					if(!isset($_COOKIE['Tsavo_user'])){
					$name = 'Tsavo_user';
					$value = time();
					$ip = $_SERVER['REMOTE_ADDR'];
					$date = date("Y/m/d | h:i:sa");
					
					setcookie($name, $value, time() + (86400 * 30), "/");
					$conn = $pdo->open();
					$stmt = $conn->prepare("INSERT INTO new_user_cookie (ip, name, value, date) VALUES (:ip, :name, :value, :date)");
					$stmt->execute(['ip'=>$ip, 'name'=>$name, 'value'=>$value, 'date'=>$date]);
					}
					else{
					$check_id_1 = 'id="NoUserInfo"';
					}
					
					?>

 <div class="modal" <?php echo $check_id_2 ?> role="dialog">
 <div class="modal-dialog modal-lg modal-scrollable">
  	<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>



<div class="row">
<div class="container">	
	<div class="col-md-2 align-items-center">
        <img src="coun_flags/<?php echo $client_flag ?>" width="100px" />
	</div>
<div class="modal-title">
	<div class="col-md-10">
        <h3 style="font-family: 'Finger Paint';">Welcome to Tsavo Store, <?php echo $client_country ?></h3>
	</div>
 </div>
	</div>
</div>
</div>

      <div class="modal-body">
        
		<div class="container">
		<div class="row">
		<div class="col-sm-3">
		<img src="images/currency.png" width="100%" />
		</div>
		<div class="col-sm-6">
		<p style="font-size:20px">
		To change the curreny to the default <?php echo $client_country ?>'s currency
		</p>
<ol style="width:100%" class="list-group">
  <li class="list-group-item">Login to your Tsavo Store account.</li>
  <li class="list-group-item">Click the 'Pricing Currency' button.</li>
  <li class="list-group-item">Choose the <?php echo $client_country ?> option.</li>
  <li class="list-group-item">You can also change to any other currency on the list.</li>
</ol>
<p style="font-size:20px">
The current default currency is in <kbd><?php echo $currency_name ?></kbd>.
</p>
		</div>
		</div>
		
		<div class="col-md-9">
		<hr />
		<h4 style="text-align:center;">
		Create your Tsavo Store Account now here <a href="https://tsavo.store/NewAccount" class="btn btn-tsavo">Create account</a>
		</h4>
		</div>
		</div>
      </div>
      <div class="modal-footer">
        <button style="float:left" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
</div>
</div> 
 <!----------end reviews modal ------------------->

<script>
(function() {
  // Variables
  var panel     = document.getElementById("js-panel");
  var btns      = document.querySelectorAll(".flap__btn");
  var btnReplay = document.getElementById("js-replay");
  
  // On load, init panel
  var init = function() {
    panel.classList.add("is--open");
    
    // If btns are clicked, hide panel
    // Show replay button    
    for (var i=0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
        hidePanel();
      });
    }
    
    function hidePanel() {
      panel.classList.remove("is--open");
      btnReplay.classList.add("is--active");
    }
    
    // When replay button is clicked,
    // reset the stage.
    btnReplay.addEventListener("click", function() {
      resetStage();
    });
  }
  
  // Hide the button and re-call init
  function resetStage() {
    btnReplay.classList.remove("is--active");
    init();
  }
  
 
})();
</script>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#NoUserInfo').modal('show');
    });
</script>