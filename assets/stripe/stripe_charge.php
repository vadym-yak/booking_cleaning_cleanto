<?php 

 require('Stripe.php');

  $success = '';
  $error = '';
  Stripe::setApiKey("sk_test_52qqVsnE15PYbml6hQZsxaSD");
  $error = '';
  //$success = '';

  try {
    if (!isset($_POST['token']))
      throw new Exception("The Stripe Token was not generated correctly");
    Stripe_Charge::create(array("amount" => $_POST['amount'],
                                "currency" => $_POST['currency'],
                                "card" => $_POST['token'],
								"description" => $_POST['description']));
    $success = '<div class="alert alert-success">
                <strong>Success!</strong> Your payment was successful.
				</div>';
				
  }
  catch (Exception $e) {
	$error = '<div class="alert alert-danger">
			  <strong>Error!</strong> '.$e->getMessage().'
			  </div>';
  }

?>