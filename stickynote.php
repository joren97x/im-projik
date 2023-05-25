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

    .custom-text {
        white-space: pre-line;
    }

    .container-fluid .row .col-3 .row:hover button{
        background-color: whitesmoke;
    } 

    .card i {
        display:none;
    }

    .card:hover i {
        display:block;
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
              <h1>Sticky Wall</h1>
            </div>
            <div class="row m-2">
              <div class="col ">
                <button class="btn border border-primary " data-bs-toggle="modal" data-bs-target="#newTaskModal"><i
                    class="bi bi-plus-lg"></i> New Note</button>
              </div>
            </div>

            <div class="row">

                <?php  getAllNote(); ?>
                
            </div>

            <br>
            <br>
           
            </div>
      </div>
    </div>
  </div>
  <!-- NEW STICKY NOTE MODAl -->
  <div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="backend.php">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Sticky Note</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body justify-content-center d-flex">
          <div class="card shadow border border-rounded border-white" style="width: 18rem; height: 269px ">
                    <div class="card-body text-start">
                        <div class="row">
                            <div class="col-7">
                                <h4 class="card-title"><input type="text" class="border-0" name="note_title" required placeholder="Note title"></h4>
                            </div>
                        </div>
                        <p class="card-text custom-text"><textarea class="border-0" placeholder="note details" name="note_body" cols="32" required rows="8"></textarea></p>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="btn-confirm" name="btn-confirm" value="newNote">Add Note</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- UPDATE TASK MODAl -->
  <div class="modal fade" id="updateNoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <form method="POST" action="backend.php">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Sticky Note</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body justify-content-center d-flex">
          <div class="card shadow border border-rounded border-white" style="width: 18rem; height: 269px; ">
                    <div class="card-body text-start">
                        <div class="row">
                            <div class="col-7">
                                <h4 class="card-title"><input type="text" class="border-0" id="new_note_title" name="new_note_title" required placeholder="Note title"></h4>
                            </div>
                        </div>
                        <p class="card-text custom-text"><textarea class="border-0" placeholder="note details" id="new_note_body" name="new_note_body" cols="32" required rows="8"></textarea></p>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" id="update_note_id" name="note_id">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="btn-confirm" name="btn-confirm" value="updateNote">Add Note</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- DELETE TASK MODAl -->
  <div class="modal fade" id="deleteNoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="backend.php">
          <div class="modal-body">
            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Delete Sticky Note?</h1>
            <input type="hidden" id="delete_note_id" name="note_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" id="btn-confirm" name="btn-confirm"
              value="deleteNote">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>


</body>
<script>
  function changeDataDeleteModal(note_id) {
    console.log(note_id)
    document.getElementById('delete_note_id').value = note_id
  }

  function changeDataUpdateModal(data) {
    document.getElementById('update_note_id').value = data[0]
    document.getElementById('new_note_title').value = data[1]
    document.getElementById('new_note_body').value = data[2]
  }

</script>

</html>