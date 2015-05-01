<section>
    <div>
        <div class="title">Категории</div>
        <div class="theme">Теми</div>
        <div class="answer">Отговори</div>
        <div class="lastAnswer">Последен отговор</div>
    </div>
    <?php foreach($this->info as $row):?>
    <article>
        <div class="title"><a href="/public/question/getquestionsbycategory/<?=$row['topic_ID']?>"><?=$row['topic_name']?></a></div>
        <div class="theme"><?=$row['a']?></div>
        <div class="answer"><??></div>
        <div class="lastAnswer"><div><??></div>
            Тема:  <??>
            Последно: <??></div>
        <div class="info"><?=$row['topic_info']; ?></div>
    </article>
    <?php endforeach; ?>
</section>