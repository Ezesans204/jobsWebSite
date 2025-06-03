<?php
header('Content-Type: application/json'); // Establece el tipo de contenido como JSON

// Recibir la solicitud (POST)
$data = json_decode(file_get_contents('php://input'), true);

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $message = "error";
    
    $CI = htmlspecialchars(htmlentities($_POST["CI"]));
    $email = htmlspecialchars(htmlentities($_POST["email"]));
    

    //coneixion a la base de datos y demas
  try{
     $link = new PDO("mysql:host=localhost;dbname=clientes","root","");
     
     $Sql_select = "SELECT * FROM usuarios2 WHERE CI = ? AND EMAIL = ?";
     $stmt = $link -> prepare($Sql_select);
     $stmt -> bindParam(1,$CI);
     $stmt -> bindParam(2,$email);
     $stmt -> execute();

     if($stmt -> rowCount() > 0){
         
        session_start();
        $_SESSION["CI"] = $CI;
        $message = "success"; //equivalente a header("location: url") ya que esto se manda a JS y se trabaja ahí para mayor seguridad

     }


    }catch(PDOException $e){
        $message = "error al conectar con la BBDD clientes";
  }
  
  finally{
      echo json_encode($message);
      
    }
    
}






?>