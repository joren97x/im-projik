<?php

require "PDOclass.php";

if (isset($_POST['btn-confirm'])) {

    $route = $_POST['btn-confirm'];
    echo $route;
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

    }

}

function addNewTask($taskName) {
    
    try {
        $db = new Database();
        if($db->getStatus()) {
            $query = $db->getConn()->prepare("INSERT INTO task (task_name, task_status, task_priority) VALUES (?,?,?)");
            $query->execute(array($taskName, "pending", "low"));
            header("Location: index.php");
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
            header("Location: index.php");
        }else {
            echo "BRUH";
        }
    }
    catch(Exception $e) {
        return $e;
    }
}
//<s>disabled
function getAllTask() {
    try {
        $db = new Database();
        if($db->getStatus()) {
            $stmt = $db->getConn()->prepare("SELECT * FROM task ORDER BY task_status = 'done', task_priority, task_id");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $task) {
                $checked = ($task['task_status'] == 'done') ? 'checked' : '';
                $priority = ($task['task_priority'] == 'favorite' && $task['task_status'] == 'pending') ? 'style="background-color: rgb(251, 255, 220)"' : '';
                $checkButton = ($task['task_status'] == 'done') ? 'disabled' : '';
                $hidden = ($task['task_status'] == 'done') ? 'hidden' : '';
                $s1 = ($task['task_status'] == 'done') ? '<s>' : '';
                $s2 = ($task['task_status'] == 'done') ? '</s>' : '';
                //$s = '';
                $s = ($task['task_priority'] == "low") ? "color: black" : "color: red"; 
                echo "<div class='row  fs-5 my-4 p-2 task' $priority> 
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
            return "error maw";
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
            header("Location: index.php");
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
            header("Location: index.php");
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
            header("Location: index.php");
        }
        else {
            echo "bruh";
        }
    }
    catch(Exception $e) {
        return $e;
    }
}
