<?php 

header('Content-Type: application/json'); // Establece el tipo de contenido como JSON (configurarcion)
$data = json_decode(file_get_contents('php://input'), true); //obtengo los datos JSON y los trabajo como array_assoc

$message = "error";


try{

    $CI = $data["CI"];
    $email = $data["email"];
    $password = $data["password"];
    $password_prepare = password_hash($password,PASSWORD_DEFAULT); //clave encriptada

 $link = new PDO("mysql:host=localhost;dbname=clientes","root","admin");

 $sql = "SELECT * FROM usuarios WHERE email = ?";

 $stmt = $link->prepare($sql);

 $stmt->bindParam(1,$email);
 $stmt->execute();
 
 if($stmt->rowCount() < 1){
    //insertar

    $sql_insert = "INSERT INTO usuarios (CI,clave,email) VALUES (?, ?, ?)";
    $stmt_insert = $link->prepare($sql_insert);
    $stmt_insert->bindParam(1,$CI);
    $stmt_insert->bindParam(2,$password_prepare);
    $stmt_insert->bindParam(3,$email);
  
    $stmt_insert->execute();

    $message = "success";

 }

else  if($stmt->rowCount() > 0){
  $message = "user_exist";
}

} catch (PDOexception $e){
   
    $message = "error al conectar con la bdd: " . $e->getMessage();
}
finally{

    echo json_encode($message);
}

?>