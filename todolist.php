<?php require "backend.php"; if(!isset($_SESSION['email'])) { header("Location: login.php"); }?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
  <title>Document</title>
  <style>
    body {
      background-repeat: no-repeat;
      background-size: cover;
      font-family: 'Patrick Hand', cursive;

    }
    .container-fluid .row .col-3 .row:hover button{
        background-color: whitesmoke;
    } 

    .container {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input~.checkmark {
      background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked~.checkmark {
      background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked~.checkmark:after {
      display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
      left: 9px;
      top: 5px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }

    .h2 {
      justify-content: center;
      text-align: center;
      margin: 100px auto;
      opacity: 0.7;
      color: beige;
      cursor: pointer;
    }

    .h2:hover {
      opacity: 1;
    }

    ul {
      margin: auto;

    }

    li {
      display: inline;
      padding-left: 5%;
    }

    .r {
      float: right;
      padding-right: 50px;
      text-decoration: none;
    }

    .bt {
      padding: 3px;
      padding-top: 5px;
      border-radius: 50px;
      ;
      width: 90px;
      background-image: linear-gradient(45deg, rgb(202, 109, 109), rgb(94, 94, 209));
      background-size: 300%;
      background-position: left;
      transition: background-position 0.5s;
    }

    button[type=button]:hover,
    button[type=button]:focus {
      background-position: right;

    }

    .text-white {
      transition: transform 0.5s ease;
    }

    .text-white:hover {
      background-color: rgb(246, 241, 241);
      transform: translateY(-10px);
    }

    .task:hover {
      background-color: whitesmoke;
    }

    .task:hover .submit {
      background-color: whitesmoke;
    }

    .task .submit {
      background-color: white;
    }

    .task button {
      color: white;
    }

    .task:hover button {
      color: black;
    }

    .task #favForm {
      display: none;
    }

    .task:hover #favForm {
      display: block;
    }

    .task:hover input {
      cursor: pointer;
    }

  </style>
</head>

<body>

  <div class="container-fluid">
      <div class="row">
        <div class="col-3 text-start">
            <h3 class="ms-5">Menu</h3>
            <div class="row ms-3"><a href="stickynote.php"><button class="btn w-75">Sticky Wall</button></a></div>
            <div class="row ms-3"><a href="todolist.php"><button class="btn w-75">To Do List</button></a></div>
            <?php 
            if(isset($_SESSION['email'])) {
              echo "<div class='row ms-3'><a href='logout.php'><button class='btn w-75'>Logout</button></a></div>";
            }
            else {
              echo "<div class='row ms-3'><a href='login.php'><button class='btn w-75'>Log In</button></a></div>
              <div class='row ms-3'><a href='register.php'><button class='btn w-75'>Register</button></a></div>";
            }
            
            ?>
          </div>
          <div class="col-9 text-end">
            <div class="row text-center">
              <h1>To Do List </h1>
            </div>
            <div class="row m-2">
              <div class="col ">
                <button class="btn border border-primary " data-bs-toggle="modal" data-bs-target="#newTaskModal"><i
                    class="bi bi-plus-lg"></i> New Task</button>
              </div>
            </div>
            <?php 
                            getAllTask();
                        ?>
            </div>
      </div>
    </div>
  </div>
  <!-- NEW TASK MODAl -->
  <div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="backend.php">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Task</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" placeholder="task name :)" id="taskName" name="taskName">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-confirm" name="btn-confirm" value="addNewTask">Save
              changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- UPDATE TASK MODAl -->
  <div class="modal fade" id="updateTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="backend.php">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Task</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" placeholder="task name :)" id="new_task_name" name="new_task_name">
            <input type="hidden" id="update_task_id" name="task_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-confirm" name="btn-confirm" value="updateTask">Save
              changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- DELETE TASK MODAl -->
  <div class="modal fade" id="deleteTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="backend.php">
          <div class="modal-body">
            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Delete Task?</h1>
            <input type="hidden" id="delete_task_id" name="task_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" id="btn-confirm" name="btn-confirm"
              value="deleteTask">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>


</body>
<script>
  function changeDataDeleteModal(task_id) {
    document.getElementById('delete_task_id').value = task_id
  }

  function changeDataUpdateModal(task_id) {
    var task_name = task_id.substring(3, task_id.length)
    task_id = task_id.substring(0, task_id.indexOf(","));
    document.getElementById('update_task_id').value = task_id
    document.getElementById('new_task_name').value = task_name
  }

  function changeStarColor(task_id) {
    var starIcon = document.getElementById("starIcon" + task_id);
    starIcon.style.color = "red";
  }

  function doneTask(task_id) {
    console.log(task_id)
    var checkbox = document.getElementById("btn-confirm");
    var form = document.getElementById("myForm" + task_id);
    form.submit();
  }
</script>

</html>