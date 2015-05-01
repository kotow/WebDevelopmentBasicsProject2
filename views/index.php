<?php
if(isset($_SESSION['isLogged'])){
    echo '<div class="btnNewTheme"><a href="/public/forum/post"><input type="button" value="New Theme" /></a></div>';
}
?>
<div class="mainTitle"><?=$this->cat;?></div>
<div >
    <div class="title">Форум</div>
    <div class="answer">Отговори</div>
    <div class="answer">Прегледана</div>
    <div class="lastAnswer">Последен отговор</div>
</div>
<?php foreach($this->info as $row):?>
    <article>
        <div class="title"><a href="/public/forum/getQuestion/<?=$row['theme_ID']?>"><?=$row['theme_name']?></a></div>
        <div class="answer"><?=$row['a'];?></div>
        <div class="answer"><?=$row['theme_views']?></div>
        <div class="lastAnswer"><div></div>
            </div>
        <div class="info">Tag: <?=$row['theme_info']?></div>
    </article>
<?php
endforeach;
?>