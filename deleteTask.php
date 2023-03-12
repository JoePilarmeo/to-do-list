<?php
require_once('config/config.php');
require_once('config/db.php');

if (isset($_POST['delete'])) {
  $id = $_POST['idtasks'];

  $delete = "DELETE FROM tasks WHERE idtasks = '$id'";
  $query = mysqli_query($conn, $delete);
  if ($query) {
    header('Location: ' . ROOT_URL . 'view.php');
    exit;
  } else {
    echo "Error: " . mysqli_error($conn);
    exit;
  }
}

mysqli_close($conn);
?>