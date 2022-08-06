<?php 

$mysqli = new mysqli("localhost","root","","binaa");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}


switch ($_GET['action']) {
  case 'add':


      $name = htmlspecialchars($_POST['name']); 
      $email = htmlspecialchars($_POST['email']); 
      $content = htmlspecialchars($_POST['content']); 
      $ip = htmlspecialchars($_POST['ip']);
      $date = date("d-m-Y");

      $result =$mysqli -> query("INSERT INTO notices (name, email, content , date , ip)
      VALUES ('$name', '$email', '$content' , '$date' , '$ip')");
    

    echo json_encode(
      array(
        "result"=> array("insertId" => $mysqli -> insert_id)
      )
    );   

    break;
    
  case 'get':
   
    $result = $mysqli -> query("SELECT `id` ,`name` ,`email`,`content`,`date` ,`ip` FROM notices order by id DESC");
    $notices = array();

    if ($result->num_rows > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        if($_GET['ip'] == $row['ip']){
          $row['canRemove'] = true;
        }
        unset($row['ip']);
        array_push($notices, $row);
      }
    }
  
      echo json_encode(
        array(
          "result"=>$notices
        )
      );      


    break;
  case 'delete':
   
    $result = $mysqli -> query("DELETE FROM notices WHERE id='$_GET[id]'");





    echo json_encode(
      array(
        "result"=>$result
      )
    );   

    break;
  
  default:
      http_response_code(404);
    break;
}





?>