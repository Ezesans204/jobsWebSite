<?php
header('Content-Type: application/json'); // Establece el tipo de contenido como JSON
$data = json_decode(file_get_contents('php://input'), true);

    $message = "error";
    
    // $CI = htmlspecialchars(htmlentities($_POST["CI"]));
    // $email = htmlspecialchars(htmlentities($_POST["email"]));
    
    $email = $data["email"];
    $password = $data["password"];

    //coneixion a la base de datos y demas
  try{
     $link = new PDO("mysql:host=localhost;dbname=clientes","root","admin");
     
     $Sql_select = "SELECT ClAVE FROM usuarios WHERE EMAIL = ?";
     $stmt = $link -> prepare($Sql_select);
     $stmt -> bindParam(1,$email);
    //  $stmt -> bindParam(1,$password);
     $stmt -> execute();

     if($stmt -> rowCount() > 0){
         
         $result = $stmt->fetchAll(); //recupera el hash del campo clave de la bbdd
         $hash = $result[0][0]; //la almacena el hash
         $password_hash = password_verify($password,$hash);//verifica si el hash pertenece a la clave
         $message = $password_hash;

         if($password_hash){
           session_start();
           $_SESSION["CI"] = $email;
           $message = "success"; //equivalente a header("location: url") ya que esto se manda a JS y se trabaja ahí para mayor seguridad
         }

         else $message = "incorrect";
     }


    }catch(PDOException $e){
        $message = "error al conectar con la BBDD clientes";
  }
  
  finally{
      echo json_encode($message);
      
    }
    







?>