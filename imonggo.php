<?php

include 'parse.php';

date_default_timezone_set('UTC');
$conn = mysql_connect('localhost','root','');	
$db = mysql_select_db('bigcommerce_imonggo', $conn);



//==============================GET FUNCTIONS========================================

function get_products(){
	$username = '1272ea633f6f785fdf04d0d333ee87deb3b5a494';
	$pw = 'x';
	$response = get_file("https://alovelace.c3.imonggo.com/api/products.xml", $username, $pw);

	//parse tags
	$tags = array();
	foreach($response->product as $product){
		if($product->tag_list != ""){
			$tags_per_product = explode(",",preg_replace('/\s+/','', strtolower($product->tag_list)));
			$tags = array_unique(array_merge($tags, $tags_per_product));
		}
	}

    $return = array();
    array_push($return, $response, $tags);
    return $return;
  
}

function get_customers(){
	$username = 'carmela';
	$pw ='fa9fa645b8f477ebdf63a0b34c964a6ca7a1dcdc';
	$response =get_file("https://store-nxjkbmb4.mybigcommerce.com/api/v2/customers" , $username, $pw);
	post_customers($response);
}

function get_invoices(){
	$username = 'carmela';
	$pw ='fa9fa645b8f477ebdf63a0b34c964a6ca7a1dcdc';
	$response = get_file("https://store-nxjkbmb4.mybigcommerce.com/api/v2/orders" , $username, $pw);
	post_invoices($response);
	
}

//==============================POST FUNCTIONS=======================================

function post_products($response, $tags){
	$url = 'https://store-nxjkbmb4.mybigcommerce.com/api/v2/products';
	$username = 'carmela';
	$pw ='fa9fa645b8f477ebdf63a0b34c964a6ca7a1dcdc';

    parse_products($url, $response,$username, $pw, $tags);
}

function post_customers($response){
	$url = 'https://alovelace.c3.imonggo.com/api/customers.xml';
	$username = '1272ea633f6f785fdf04d0d333ee87deb3b5a494';
	$pw = 'x';

	parse_customers($url, $response,$username, $pw);
}


function post_invoices($response){
		$query = "SELECT * FROM last_invoice_posting";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		
		$date_time = date('Y-m-d h:i:s a', time());
		echo "Invoices posted from " . $row[1] . " to " . $date_time . "<br>";
		
		if(!$row)
		{
			$insert_to_last_posting = mysql_query("INSERT INTO last_invoice_posting (id, date) VALUES(DEFAULT, '$date_time') ");
			$insert_to_invoices = mysql_query("INSERT INTO invoices (post_id, post_date) VALUES (DEFAULT, '$date_time')");
		}
		
		else
		{
			$update_last_posting = mysql_query("UPDATE last_invoice_posting SET date = '$date_time' WHERE id='$row[0]'");
			$insert_to_invoices = mysql_query("INSERT INTO invoices (post_id, post_date) VALUES (DEFAULT, '$date_time')");
		}
		
		$url = 'https://alovelace.c3.imonggo.com/api/invoices.xml';
		$pw ='x';
	
		parse_invoices($url, $response,$username, $pw);
}


?>




