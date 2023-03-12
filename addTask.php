<?php
require_once('config/config.php');
require_once('config/db.php');

// will check if submit
if (isset($_POST['submit'])) {
  $task_name = mysqli_real_escape_string($conn, $_POST['task_name']);
  $task_description = mysqli_real_escape_string($conn, $_POST['task_description']);
  $task_duedate = mysqli_real_escape_string($conn, $_POST['task_duedate']);
  $task_status = mysqli_real_escape_string($conn, $_POST['task_status']);

  // will insert the information in person table in database
  $query = "INSERT INTO tasks(task_name, task_description, task_duedate, task_status) VALUES('$task_name', '$task_description', '$task_duedate', '$task_status')";
  //echo $query;

  // in passing the information so we will know if there is an error
  if (mysqli_query($conn, $query)) {
    header('Location: ' . ROOT_URL . '');
  } else {
    echo 'ERROR: ' . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Add Task</title>
  <link rel="stylesheet" href="css/style1.css">

</head>

<body>
  <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
    <div class="container">
      <h2>Add Task</h2>
      <label for="show">Task Name</label>
      <input type="text" placeholder="Enter Task Name" name="task_name" required>
      <label for="show">Task Description</label>
      <input type="text" placeholder="Enter Task Description" name="task_description" required>
      <label for="show">Task Due Date</label>
      <input type="date" placeholder="Select Due Date" name="task_duedate" required>

      <label for="show">Task Status</label>
      <select name="task_status">
        <option>incomplete</option>
        <option>in progress</option>
        <option>complete</option>
      </select>

      <button type="submit" name="submit">Submit</button>

      <div class="click">
        <label>Do you want to view the records? <a href="view.php">Click here</a></label>
      </div>
    </div>
  </form>
</body>

</html>