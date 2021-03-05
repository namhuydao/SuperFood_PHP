<?php
include '../../../../database/database.php';
include '../../../../function/function.php';

$id = $_POST['roleDelete_id'];
$sql = "DELETE FROM roles WHERE id ='$id'";
if ($conn->query($sql) === TRUE) {
    $sql = "DELETE FROM `link_role_permission` WHERE role_id = '$id'";
    $conn->query($sql);
    echo "<script>window.location = '../main-view/manage-roles.php';</script>";
} else {
    echo $conn->error;
}
