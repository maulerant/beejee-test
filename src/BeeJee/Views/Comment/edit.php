<div class="add-comment-form">
    <form action="index.php?q=comment/update" method="POST">
        <input name="id" type="hidden" value="<?= $comment['id'] ?>"/>
        <input name="changed_by_admin" type="hidden" value="1"/>
        <input type="checkbox" name="accepted" <?= $comment['accepted']? 'checked': ''?> >Принять<Br>
        <input class="username" name="username" value="<?= $comment['username'] ?>"/>
        <input class="email" name="email" value="<?= $comment['email'] ?>"/>
        <textarea class="body" name="body"><?= $comment['body'] ?></textarea>
        <div class="image">
            <img src='/media/upload/<?= $comment['image']; ?>' />
        </div>
        <button type="submit">Отправить</button>
    </form>
</div>
