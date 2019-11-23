<?php
require_once("conexion.php");
try {
  require '../vendor/autoload.php';
  $secretKey = "sk_test_LbMyzQU2lCjdmxqX";
  $culqi = new Culqi\Culqi(array('api_key' => $secretKey));
  $token = $_POST['token'];
  $monto = $_POST['monto'];
  $email = $_POST['email'];

  $charge = $culqi->Charges->create(
  array(
      "amount" => $monto,
      "currency_code" => "PEN",
      "email" => "$email",
      "source_id" => "$token"
    )
  );
  echo json_encode($charge);
}
catch (Exception $e) {
  echo json_encode($e->getMessage());
}  

