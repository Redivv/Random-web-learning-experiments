<?php
  include('connect.php');

  // Processing Ajax Request
  if(isset($_POST['view'])){  // Changing comment status to 1 - seen, no notifications, display
    if($_POST['view'] === 'seen'){
       $update_query = "UPDATE comments SET comment_status = 1 WHERE comment_status=0";
       mysqli_query($con, $update_query);
    }

    if($_POST['view'] === 'seen2'){  // Changing comment status to 2 - seen, no notifications, no display
       $update_query = "UPDATE comments SET comment_status = 2 WHERE comment_status = 0 OR comment_status = 1";
       mysqli_query($con, $update_query);
    }

    $query = "SELECT * FROM comments WHERE comment_status = 0 OR comment_status = 1 ORDER BY comment_id DESC";  // look for new comments
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    $output = '';  // if an error occurs the output will still exist
    if($count > 0){
    while($row = mysqli_fetch_array($result)){    // preparing the notifications
      $output .= '
      <li>
      <a href="#">
      <strong>'.$row["comment_subject"].'</strong><br />
      <small><em>'.$row["comment_text"].'</em></small>
      </a>
      </li>
      ';
    }
    }else{  // if no new comments found - explain it
        $output .= '<li><a href="#" class="text-bold text-italic">No New Comments</a></li>';
    }

    $query = "SELECT * FROM comments WHERE comment_status = 0 ORDER BY comment_id DESC";  // prepare the number on new comments
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);
    $data = array(
       'notification' => $output,
       'unseen_notification'  => $count
    );
    echo json_encode($data);      // since the Java Script is expecting a json response we need to encode it

  }
  // /.Processing Ajax Request
?>
