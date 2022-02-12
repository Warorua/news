<?php
include 'includes/session.php';
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