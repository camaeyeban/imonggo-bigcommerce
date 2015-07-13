<?php

include 'general_functions.php';


//=======================================PARSE XML FILE======================================


	function parse_products($url, $xml_file,$username, $pw,$tags){

		foreach($xml_file->product as $product){

      //===============================FOR PRODUCTS TAGS===============================
      $product_tags = explode(",",preg_replace('/\s+/','', strtolower($product->tag_list)));
      $intersect_count =0;

      //check if at least one filter tag exists to each product's tags
      if(count(array_intersect($product_tags,$tags)) != 0){
        $intersect_count = 1;
      }


        //check for duplication, product status and tags
        if(get_file('https://store-nxjkbmb4.mybigcommerce.com/api/v2/products?name='.$product->name, $username, $pw)==NULL && ($product->status!='D') && ($intersect_count==1)){

         
                  
                   $xml_product_content = 
                    '<?xml version="1.0" encoding="UTF-8"?>
                    <product>
                        <name>'.(string)$product->name.'</name>
                        <type>physical</type>
                        <description>'.(string)$product->description.'</description>
                        <price>'.(string)$product->retail_price.'</price>
                        <categories>
                          <value>1</value>
                        </categories>
                        <availability>available</availability>
                        <weight>0.0</weight>
                    </product>';

                    post_file($url, $xml_product_content,$username, $pw);
        }
      } //end of foreach
  }


	function parse_customers($url, $xml_file, $username, $pw){

		//check if each of the products is available online and create json file for posting
		foreach($xml_file->customer as $customer){

            $xml =  
              '<?xml version="1.0" encoding="UTF-8"?>
              <customer>
                <name>'.(string)$customer->first_name.'</name>
                <alternate_code>'.(string)$customer->id.'</alternate_code>
                <first_name>'.(string)$customer->first_name.'</first_name>
                <last_name>'.(string)$customer->last_name.'</last_name>
                <email>'.(string)$customer->email.'</email>
              </customer>
              ';

            post_file($url, $xml, $username, $pw);
		}
	}

	function parse_invoices($url, $xml_file, $username, $pw){

		//check if each of the products is available online
		foreach($xml_file->order as $order){
    //10 is status_id for completed order
     if($order->status_id==10){


       $xml_part1= 
        '<?xml version="1.0" encoding="UTF-8"?>
        <invoice>
          <invoice_date>'.$order->date_shipped.'</invoice_date>
          <reference>'.$order->id.'</reference>
          <invoice_lines type="array">
            <invoice_line>
              <product_id></product_id>
                <quantity></quantity>
                  <retail_price>100</retail_price>
            </invoice_line>
          </invoice_lines>
          <payments type="array">
            <payment>
              <amount>100</amount>
            </payment>
          </payments>
        </invoice>';

         get_order_products($order->products->link, $username, $pw);

          //echo $xml_part2;

          //post_file($url, $xml, $username, $pw);
      }
		}
	}


  function get_order_products($link,$username,$pw){

    $xml='';
     $xml_file = get_file('https://store-nxjkbmb4.mybigcommerce.com/api/v2/orders/100/products.xml',$username,$pw);

     var_dump($xml_file);

     /*foreach($xml_file->product as $product){

        $product_content= '<invoice_line>
                              <product_id>'.$product->product_id.'</product_id>
                              <quantity>'.$product->quantity.'</quantity>
                              <retail_price>'.$product->base_price.'</retail_price>
                            </invoice_line>';

        $xml = $xml.$product_content;
     }

     return $xml;*/


  }
?>

