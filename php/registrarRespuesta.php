<?php
require_once("conexion.php");
try {
  require '../vendor/autoload.php';
  session_start();
  $idcliente = $_SESSION['idusuario'];
  $secretKey = "sk_test_LbMyzQU2lCjdmxqX";
  $culqi = new Culqi\Culqi(array('api_key' => $secretKey));
  $token = $_POST['token'];
  $monto = $_POST['monto'];
  $email = $_POST['email'];
  $solicitud = $_POST['idsolicitud'];
  $interes = $_POST['interes'];


  $charge = $culqi->Charges->create(
  array(
      "amount" => $monto,
      "currency_code" => "PEN",
      "email" => "$email",
      "source_id" => "$token"
    )
  );
  $sql="INSERT INTO public.respuesta(
	idrespuesta, idsolicitud, idcliente, fecha, hora, tasainteres, estado)
	VALUES ((select coalesce(max(idrespuesta),0)+1 from respuesta), $solicitud, $idcliente, default, default, $interes, default);";
  $resp = json_encode($charge);
  $result = $cnx->query($sql) or $resp = 0;
  echo $resp;
}
catch (Exception $e) {
  echo json_encode($e->getMessage());
}  
