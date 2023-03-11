<?php
require_once('config/config.php');
require_once('config/db.php');

if (isset($_POST['status'])) {
  $status = $_POST['status'];
} else {
  $status = '';
}

// Query the database based on the selected status
if (!empty($status)) {
  $query_db = "SELECT * FROM tasks WHERE task_status = '$status' ORDER BY idtasks ASC";
} else {
  $query_db = "SELECT * FROM tasks ORDER BY idtasks ASC";
}
$query = mysqli_query($conn, $query_db);


//check if there is any rows 
if (mysqli_num_rows($query) > 0) {
    // to fetch all the rows
    $tasks = mysqli_fetch_all($query, MYSQLI_ASSOC);
  } else {
    $tasks = [];
  }

  if(isset($_POST['edit'])){
    
        header('Location: '.ROOT_URL.'editTask.php');
  }
    mysqli_close($conn);


?>
<html>

<head>
    <title>View Records</title>
    <link rel="stylesheet" href="css/style2.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <h2>To Do List</h2></br>
            <div class="stat">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
            <label for="status">Select Status:</label>
      <select name="status">
          <option value="">ALL</option>
          <option value="complete" <?php if ($status == "complete") echo "selected"; ?>>COMPLETE</option>
          <option value="incomplete" <?php if ($status == "incomplete") echo "selected"; ?>>INCOMPLETE</option>
          <option value="in progress" <?php if ($status == "in progress") echo "selected"; ?>>IN PROGRESS</option>
</select> 
<button type="submit" name="filter">Go</button>
</form>
</div>

            <button class="button-add" type="button" onclick="document.location='addTask.php'">Add Task</button>
            <table>
            <div class="info">
            <thead>
                    <tr>
                    <th >Task ID</th>
                    <th >Task Name</th>
                    <th >Task Description</th>
                    <th >Task Due Date</th>
                    <th >Task Status</th>
                    <th> Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($tasks as $task) : ?>
                    <tr>
                    <th scope="row"><?php echo $task['idtasks'];?></th>
                    <td><?php echo $task['task_name'];?></td>
                    <td><?php echo $task['task_description'];?></td>
                    <td><?php echo $task['task_duedate'];?></td>
                    <td><?php echo $task['task_status'];?></td>
                    <td> 
                    <div class="left">
                    <form method="POST" action="deleteTask.php">
                    <input type="hidden" name="idtasks" value="<?php echo $task['idtasks']; ?>">
                    <a href="deleteTask.php">
                        <button type="submit"  name="delete" class="button-del"> Delete</button>
                </a>
                </div>
                
                        </form>
                        <div class="right" >
                          <form method="POST" action="editTask.php">
                          <a href="editTask.php?idtasks=<?php echo $task['idtasks']; ?>" class="button-del">Edit</a>

                        
                        </form>   
                </div>

                <!-- <div class="left"> 
                    <form method="POST" action="deleteTask.php">
                    <input type="hidden" name="idtasks" value="<?php echo $task['idtasks']; ?>">
                        <button type="submit"  name="delete" class="button-del"> Delete</button>
                </form>
                </div>
                <div class="right"> 
                <form method="POST" action="editTask.php">
                        <a href="editTask.php">
                       <input type="hidden" name="idtasks" value="<?php echo $task['idtasks']; ?>">
                    <button type="submit" name="edit" class="button-del" action="editTask.php">Edit</button>
                  </form>
                </div> -->
                          
                    </td>
                    </tr>
                <?php endforeach; ?>   
                </tbody>
                </div>
            </table>
        </div>
    </div>
</body>
</html>