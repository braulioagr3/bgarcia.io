<?php
include_once 'db.php';

$sql_sel = "SELECT * FROM usuario ORDER BY id DESC";
$result = $conn->query($sql_sel);
$count = $result->num_rows;

    if($count > 0) {
?>
        <div id="comment-count">
        <span id="count-number"><?php echo $count;?></span> Comentario(s)
        </div>
<?php } ?>
        <div id="response">
<?php
while ($row = $result->fetch_array(MYSQLI_ASSOC)){
?>
            <div id="comment-<?php echo $row["id"];?>" class="comment-row">
                <div class="comment-user"><?php echo $row["username"];?></div>
                <div class="comment-msg" id="msgdiv-<?php echo $row["id"];?>"><?php echo $row["message"];?></div>
                <div class="delete" name="delete"
                    id="delete-<?php echo $row["id"];?>"
                    onclick="deletecomment(<?php echo $row["id"];?>)"Eliminar</div>
            </div>
<?php 
}
?>