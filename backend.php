<?php
session_start();
require "PDOclass.php";

if (isset($_POST['btn-confirm'])) {

    $route = $_POST['btn-confirm'];
    
    switch ($route) {
        case 'addNewTask':
            echo addNewTask($_POST['taskName']);
            break;
        case 'deleteTask':
            echo deleteTask($_POST['task_id']);
            break;
        case 'updateTask':
            echo updateTask($_POST['task_id'], $_POST['new_task_name']);
            break;
        case 'addToFav':
            echo addToFav($_POST['task_id']);
            break;
        case 'doneTask':
            echo doneTask($_POST['task_id']);
            break;
        case 'Login':
            echo login($_POST['user_email'], $_POST['user_pass']);
            break;
        case 'Register':
            echo register($_POST['user_email'], $_POST['user_name'], $_POST['user_pass']);
            break;
        case 'newNote':
            echo newNote($_POST['note_title'], $_POST['note_body']);
            break;
        case 'updateNote':
            echo updateNote($_POST['note_id'], $_POST['new_note_title'], $_POST['new_note_body']);
            break;
        case 'deleteNote':
            echo deleteNote($_POST['note_id']);
            break;
        default:
            echo "bruh";
            break;
    }
}

function login($user_email, $user_pass) {
    try{
        $db = new Database();
        if($db->getStatus()) {
            $query = $db->getConn()->prepare("SELECT * FROM users WHERE user_email = ? AND user_pass = ?");
            $query->execute(array($user_email, $user_pass));
            $result = $query->fetch();
            if($result) {
                session_start();
                $_SESSION['email'] = $user_email;
                $_SESSION['user_id'] = $result[0];
                header("Location: todolist.php");
                //echo "pa log-inon in";
            }
            else {
                echo "di mao email or password";
            }
        }
        else {
            echo "Failed to CONNECT!";
        }
    }
    catch(Exception $e) {
        return $e;
    }

}

function register($user_email, $user_name, $user_pass) {

    try {
        $db = new Database();
        if($db->getStatus()) {
            $query = $db->getConn()->prepare("INSERT INTO users (user_email, user_name, user_pass) VALUES (?,?,?)");
            $query->execute(array($user_email, $user_name, $user_pass));
            session_start();
            $getId = $db->getConn()->prepare("SELECT user_id FROM users WHERE user_email = ?");
            $getId->execute(array($user_email));
            $result = $getId->fetch();
            $_SESSION['email'] = $user_email;
            $_SESSION['user_id'] = $result[0];
            header("Location: todolist.php");
        }
        else {
            echo "sayop ka pre";
        }
    }
    catch(Exception $e) {
        return $e;
    }
    
}

function addNewTask($taskName) {
    
    try {
        $db = new Database();
        if($db->getStatus()) {
            $query = $db->getConn()->prepare("INSERT INTO task (user_id, task_name, task_status, task_priority) VALUES (?, ?,?,?)");
            $query->execute(array($_SESSION['user_id'], $taskName, "pending", "low"));
            header("Location: todolist.php");
        }
        else {
            return "error pre";
        }
    }
    catch(Exception $e) {
        return $e;
    }

}

function doneTask($task_id) {
    try {
        $db = new Database();
        if($db->getStatus()) {
            $query = $db->getConn()->prepare("UPDATE task SET task_status = 'done' WHERE task_id = ?");
            $query->execute(array($task_id));
            header("Location: todolist.php");
        }else {
            echo "BRUH";
        }
    }
    catch(Exception $e) {
        return $e;
    }
}

function getAllTask() {
    try {
        $db = new Database();
        if($db->getStatus()) {
            $stmt = $db->getConn()->prepare("SELECT * FROM task WHERE user_id = ? ORDER BY task_status = 'done', task_priority, task_id");
            $stmt->execute(array($_SESSION['user_id']));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $task) {

                $checked = ($task['task_status'] == 'done') ? 'checked' : '';
                $priority = ($task['task_priority'] == 'favorite' && $task['task_status'] == 'pending') ? 'style="background-color: rgb(251, 255, 220)"' : '';
                $checkButton = ($task['task_status'] == 'done') ? 'disabled' : '';
                $hidden = ($task['task_status'] == 'done') ? 'hidden' : '';
                $s1 = ($task['task_status'] == 'done') ? '<s>' : '';
                $s2 = ($task['task_status'] == 'done') ? '</s>' : '';
                $s = ($task['task_priority'] == "low") ? "color: black" : "color: red"; 

                echo "<div class='row  fs-5 my-2 p-2 task' $priority> 
                <div class='col-10 d-flex align-items-center'>
                    <form method='POST' id='myForm".$task['task_id']."' action='backend.php'> 
                        <input type='hidden' value='".$task['task_id']."' name='task_id')'> 
                        <input type='checkbox' $checked $checkButton onclick='doneTask(".$task['task_id'].")' id='btn-confirm' name='btn-confirm' value='doneTask'> 
                    </form>
                    <label class='ms-3'>$s1".$task['task_name']."$s2</label>
                </div>
                <div class='col-2 d-flex justify-content-end text-end '>
                    <form action='backend.php' method='POST' id='favForm'>
                        <button class='submit border-0  mt-2' $hidden name='btn-confirm' value='addToFav' onclick='changeStarColor(".$task['task_id'].")'>
                        <i class='bi bi-heart-fill' id='starIcon".$task['task_id']."' style='".$s."'></i> 
                        <input type='hidden' name='task_id' value='".$task['task_id']."'> 
                        </button>
                    </form>
                    <button class='btn' $hidden data-bs-toggle='modal' value='".$task['task_id']."' onclick='changeDataUpdateModal(\"".$task['task_id'].", ".$task['task_name']."\")' data-bs-target='#updateTaskModal'><i class='bi bi-pencil-square'></i></button>
                    <button class='btn' data-bs-toggle='modal' value='".$task['task_id']."' onclick='changeDataDeleteModal(".$task['task_id'].")' data-bs-target='#deleteTaskModal'><i class='bi bi-x-lg'></i></button>
                </div>
            </div>";
            }
        }
        else {
            return "error";
        }
    }
    catch(Exception $e) {
        return $e;
    }
}

function deleteTask($task_id) {
    try {
        $db = new Database();
        if($db->getStatus()){
            $stmt = $db->getConn()->prepare("DELETE FROM task WHERE task_id = ?");
            $stmt->execute(array($task_id));
            header("Location: todolist.php");
        }
        else {
            return "error choy";
        }
    }
    catch(Exception $e) {
        return $e;
    }
}

function updateTask($task_id, $new_task_name) {
    try {
        $db = new Database();
        if($db->getStatus()) {
            $query = $db->getConn()->prepare("UPDATE task SET task_name = ? WHERE task_id = ?");
            $query->execute(array($new_task_name, $task_id));
            header("Location: todolist.php");
        }
        else {
            "eorror lagi";
        }
    }
    catch(Exception $e) {
        return $e;
    }
}

function addToFav($task_id) {
    try{
        $db = new Database();
        if($db->getStatus()) {
            $stmt = $db->getConn()->prepare("SELECT task_priority FROM task WHERE task_id = ?");
            $stmt->execute(array($task_id));
            $result = $stmt->fetch();
            $priority = ($result[0] == "low") ? "favorite" : "low";
            $query = $db->getConn()->prepare("UPDATE task SET task_priority = ? WHERE task_id = ?");
            $query->execute(array($priority, $task_id));
            header("Location: todolist.php");
        }
        else {
            echo "bruh";
        }
    }
    catch(Exception $e) {
        return $e;
    }
}

function newNote($note_title, $note_body) {
    try {
        $db = new Database();
        if($db->getStatus()) {
            $query = $db->getConn()->prepare("INSERT INTO note (user_id, note_title, note_body) VALUES (?,?,?)");
            $query->execute(array($_SESSION['user_id'], $note_title, $note_body));
            header("Location: stickynote.php");
        }
        else {
            return "error";
        }
    }
    catch (Exception $e) {
        return $e;
    }
}

function getAllNote() {
    try {
        $db = new Database();
        if ($db->getStatus()) {
            $query = $db->getConn()->prepare("SELECT * FROM note WHERE user_id = ? ORDER BY note_id DESC");
            $query->execute(array($_SESSION['user_id']));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            $colors = [
                '0' => "background-color: rgb(255, 101, 163)",
                '1' => "background-color: rgb(254, 255, 156)",
                '2' => "background-color: rgb(201, 167, 235)",
                '3' => "background-color: rgb(176, 218, 255)",
                '4' => "background-color: rgb(255, 165, 89)",
                '5' => "background-color: rgb(221, 255, 187)",
                '6' => "background-color: rgb(254, 161, 161)",
                '7' => "background-color: rgb(122, 252, 255)",
                '8' => "background-color: rgb(173, 228, 219)",
                '9' => "background-color: rgb(232, 170, 66)"
            ];

            foreach ($result as $note) {
                $bg = $colors[$note['note_id'] % 10];

                echo "<div class='col-4 mt-3'>
                    <div class='card shadow border-rounded' style='width: 18rem; height: 269px; $bg'>
                        <div class='card-body text-start'>
                            <div class='row'>
                                <div class='col-7'>
                                    <h4 class='card-title'> " . $note['note_title'] . " </h4>
                                </div>
                                <div class='col-5 justify-content-end d-flex'>
                                    <button class='btn' data-bs-toggle='modal' data-bs-target='#updateNoteModal' onclick='changeDataUpdateModal(" . htmlspecialchars(json_encode([$note['note_id'], $note['note_title'], $note['note_body']]), ENT_QUOTES) . ")'><i class='bi bi-pencil'></i></button>
                                    <button class='btn' data-bs-toggle='modal' data-bs-target='#deleteNoteModal' onclick='changeDataDeleteModal(" . $note['note_id'] . ")'><i class='bi bi-x-lg'></i></button>
                                </div>
                            </div>
                            <p class='card-text custom-text'>" . $note['note_body'] . "</p>
                        </div>
                    </div>
                </div>";
            }
        } else {
            return "error";
        }
    } catch (Exception $e) {
        return $e;
    }
}

function updateNote($note_id, $new_note_title, $new_note_body) {
    try {
        $db = new Database();
        if($db->getStatus()) {
            $query = $db->getConn()->prepare("UPDATE note SET note_title = ?, note_body = ? WHERE note_id = ?");
            $query->execute(array($new_note_title, $new_note_body, $note_id));
            header("Location: stickynote.php");
        }
        else {
            "eorror lagi";
        }
    }
    catch(Exception $e) {
        return $e;
    }
}

function deleteNote($note_id) {
    try {
        $db = new Database();
        if($db->getStatus()){
            $stmt = $db->getConn()->prepare("DELETE FROM note WHERE note_id = ?");
            $stmt->execute(array($note_id));
            header("Location: stickynote.php");
        }
        else {
            return "error choy";
        }
    }
    catch(Exception $e) {
        return $e;
    }
}
