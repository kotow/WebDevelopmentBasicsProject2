<?php foreach($this->info as $row):?>
    <tr>
        <td>
            <p><span>User: </span><span class="details"><a href="#"><?= htmlspecialchars($row['message_User']) ?></a></span></p>
            <p><span>Date: </span><span class="details"><?= htmlspecialchars($row['message_Data']) ?></span></p>
        </td>
        <td><div><?= htmlspecialchars($row['message_Text']) ?></div></td>
    </tr>

<?php endforeach; ?>
<?php
if(isset($_SESSION['isLogged'])){
    echo '<div class="btnNewTheme"><a href="/public/forum/answer/'.$this->id.'" /><input type="button" value="New Answer" /></a></div>';
}
?>