<?php
	require_once('config/config.php');
	require_once('config/db.php');

  if(isset($_POST['update'])){
    $idtasks = mysqli_real_escape_string($conn, $_POST['idtasks']);
		$task_name = mysqli_real_escape_string($conn,$_POST['task_name']);
    $task_description = mysqli_real_escape_string($conn, $_POST['task_description']);
	  $task_duedate = mysqli_real_escape_string($conn,$_POST['task_duedate']);
    $task_status = mysqli_real_escape_string($conn,$_POST['task_status']);

    $query = "UPDATE tasks SET task_name = '$task_name', task_description = '$task_description', task_duedate = '$task_duedate', task_status = '$task_status' WHERE idtasks=" . $idtasks;

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('Error updating task: ' . mysqli_error($conn));
    }
  }
  if (isset($_GET['idtasks'])) {
    $idtasks = $_GET['idtasks'];
} 
// create query
$query = "SELECT * FROM tasks WHERE idtasks=" . $idtasks;
// get the result 
$result = mysqli_query($conn,$query);

if($result && mysqli_num_rows($result) == 1){
  $task = mysqli_fetch_array($result);
  $task_name = $task['task_name'];
  $task_description = $task['task_description'];
  $task_duedate = $task['task_duedate'];
  $task_status = $task['task_status'];

}
mysqli_free_result($result);

mysqli_close($conn);


if(isset($_POST['update'])){
    
  header('Location: '.ROOT_URL.'view.php');
}
  
  ?>
<!DOCTYPE html>
<html>

<head>
  <title>Edit Task</title>
  <link rel="stylesheet" href="css/style1.css">

</head>

<body>


  <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div class="container">
    <h2>Edit Task</h2>
      <input type="hidden" name="idtasks" value="<?php echo $task['idtasks']; ?>">
      <label for="show">Task Name</label>
      <input type="text" placeholder="Enter Task Name" name="task_name" value="<?php echo $task['task_name']; ?>" required>
      <label for="show">Task Description</label>
      <input type="text" placeholder="Enter Task Description" name="task_description" value="<?php echo $task['task_description']; ?>" required>
      <label for="show">Task Due Date</label>
      <input type="date" placeholder="Select Due Date" name="task_duedate" value="<?php echo $task['task_duedate']; ?>" required>
      <label for="show" >Task Status</label>
      <select name="task_status">
  <option value="incomplete" <?php if ($task['task_status'] == 'incomplete') echo 'selected'; ?>>incomplete</option>
  <option value="in progress" <?php if ($task['task_status'] == 'in progress') echo 'selected'; ?>>in Progress</option>
  <option value="complete" <?php if ($task['task_status'] == 'complete') echo 'selected'; ?>>complete</option> 
</select>
      
      <button type="submit" name="update" >Update</button>
      
    </div>
  </form>
</body>

</html>







