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
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/imonggo.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  </head>

  <body>

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

  <div class ="container">

  <ul class="collapsible popout" data-collapsible="accordion">
    <li>
      <div class="collapsible-header active black">Add Product</div>
        <div class="collapsible-body">
          <div class ="container">
            <div class="row" id ="product">
              <form method ="GET">
                <div class="col s6">
                  <p>
                    <!-- Modal Trigger -->
                    <a class="modal-trigger waves-effect waves-light light-blue accent-3 btn-large" data-target="single_prod">Add Single Product</a>
                    <br><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In efficitur quis urna et consequat. Ut ante turpis, condimentum non mattis quis, mattis eu lacus. Sed quis consequat nibh.
                  </p>

                  <!-- Modal Structure -->
                  <div id="single_prod" class="modal modal-fixed-footer">
                    <div class="modal-content">
                      <h4>Modal Header</h4>
                      <p>A bunch of text
                      </p>
                    </div>
                    <div class="modal-footer">
                       <button class="btn waves-effect waves-light light-blue accent-3 btn" type="submit" name="add_single_product">Continue</button>
                    </div>
                  </div>

                  </div>

                <div class="col s6">
                  <p>
                    <a class="modal-trigger waves-effect waves-light light-blue accent-3 btn-large" data-target="multiple_prod">Add Multiple Products</a>
                    <br><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In efficitur quis urna et consequat. Ut ante turpis, condimentum non mattis quis, mattis eu lacus. Sed quis consequat nibh.
                  </p>

                  <!-- Modal Structure -->
                  <div id="multiple_prod" class="modal modal-fixed-footer">
                    <div class="modal-content">
                      <h4>ADD MULTIPLE PRODUCTS</h4>
                      <hr>
                      Select tags to filter products that will be posted
                       <br><br>
                        <ul>
                         <?php
                            $name=0;
                            if(count($tags) != 0){
                              foreach ($tags as $tag){
                                echo '<input type="checkbox" class="filled-in" id="filled-in-box'.$name.'" name="checkbox_name[]"  value ="'.$tag.'"/><label for="filled-in-box'.$name.'">'.$tag.'</label><br><br>';
                                $name ++;
                              }
                            }else{
                              echo '<h2>No tags available</h2>';
                            }
                          ?>
                        </ul>
                    </div>
                    <div class="modal-footer">
                      <button class="btn waves-effect waves-light light-blue accent-3 btn" type="submit" name="post_products">Continue</button>
                    </div>
                  </div><!--end of modal-->

                  </div>
              </form>
            </div>
        </div>
      </div>
    </li>


    <li>
      <div class="collapsible-header active blue-grey darken-4">Add Customer</div>
        <div class="collapsible-body">
          <div class ="container">
            <div class="row">
              <form method ="GET">
                <div class="col s6">
                  <p>
                    <button class="waves-effect waves-light light-blue accent-3 btn-large" type="submit" name="pull_customers">Add Customer</button>
                    <br><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In efficitur quis urna et consequat. Ut ante turpis, condimentum non mattis quis, mattis eu lacus. Sed quis consequat nibh.
                  </p>
                </div>

                <div class="col s6">
                  <br><br>
                  <img src ="icons/customer.png">
                </div>
              </form>
            </div>
        </div>
      </div>
    </li>

    <li>
      <div class="collapsible-header active blue-grey darken-1">Post Invoice</div>
        <div class="collapsible-body">
          <div class ="container">
            <div class="row">
              <form method ="GET">

                <div class="col s6">
                  <br><br>
                  <img src ="icons/invoice.png">
                </div>

                <div class="col s6">
                  <p>
                    <button class="waves-effect waves-light light-blue accent-3 btn-large" type="submit" name="pull_invoices">Post Invoice</button>
                    <br><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In efficitur quis urna et consequat. Ut ante turpis, condimentum non mattis quis, mattis eu lacus. Sed quis consequat nibh.
                  </p>
                </div>

              </form>
            </div>
        </div>
      </div>
    </li>
  </ul>
</div>
        
     
 <script>
  $(document).ready(function(){
    $('.modal-trigger').leanModal();
  });
  </script>

  </body>
</html>