<?php

include 'imonggo.php';

 //get tags for checkbox creation
 $get_output = get_products();
 $response = $get_output[0];
 $tags = $get_output[1];

  
  if(isset($_GET['post_products'])){

    $post_tags = $_GET['checkbox_name'];

    if(count($post_tags) != 0){
      post_products($response, $post_tags);
    }

  }elseif(isset($_GET['pull_customers'])){
    get_customers();
  }elseif(isset($_GET['pull_invoices'])){
    get_invoices();
  }elseif(isset($_GET['update_inventory'])){
    get_inventory();
  }


if($_POST){
    if(isset($_POST['post_invoices'])){
        post_invoices();
    }else{
      echo "POST METHOD ERROR";
    }
}

?>



<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <link rel="stylesheet" type="text/css" href="css/imonggo.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
  </head>
  <body>

  <h1>Imonggo - Bigcommerce</h1>

  <br><br><br>
  <form method ="GET">
 
    <button type = "button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Add Product</button>
    <button type="submit" class="btn btn-info btn-md" name="pull_customers">Add Customer</button>
    <button type="submit" class="btn btn-info btn-md" name="pull_invoices">Post Invoices</button>
 
  </form>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">PRODUCT FILTER TAGS</h4>

        </div>
        <div class="modal-body">

        <section>
        <form class="ac-custom ac-checkbox ac-boxfill" autocomplete="off" method="GET">
          <h3>How can you appropriately empower dynamic leadership skills after business portals?</h3><br>
          <ul>
             <?php
              if(count($tags) != 0){
                foreach ($tags as $tag){
                  echo '<li><input id="cb10" type="checkbox" name="checkbox_name[]" value="'.$tag.'"><label>'.$tag.'</label></li>';
                }
              }else{
                echo '<h2>No tags available</h2>';
              }
              ?>
          </ul>
          
        </form>
    
      </section>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info btn-md" name="post_products">Continue</button>
        </div>
      </div>
      
    </div>
  </div> <!--Modal_end-->
  
     
      
    <script src="js/svgcheckbx.js"></script>
  </body>
</html>