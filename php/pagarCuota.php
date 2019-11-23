<?php
require_once("conexion.php");
try {
  require '../vendor/autoload.php';
  $secretKey = "sk_test_LbMyzQU2lCjdmxqX";
  $culqi = new Culqi\Culqi(array('api_key' => $secretKey));
  $token = $_POST['token'];
  $monto = $_POST['monto'];
  $email = $_POST['email'];
  $idcuota = $_POST['idcuota'];
  $charge = $culqi->Charges->create(
  array(
      "amount" => $monto,
      "currency_code" => "PEN",
      "email" => "$email",
      "source_id" => "$token"
    )
  );
  $sql="UPDATE public.cuota SET estado=true WHERE idcuota=$idcuota;";
  $resp = json_encode($charge);
  $result = $cnx->query($sql) or $resp = 0;
  echo $resp;
}
catch (Exception $e) {
  echo json_encode($e->getMessage());
}  

