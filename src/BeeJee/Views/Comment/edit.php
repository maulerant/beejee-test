<div class="col-md-12 add-comment-form" role="form">
    <form action="index.php?q=comment/update" method="POST">
        <input name="id" type="hidden" value="<?= $comment['id'] ?>"/>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="accepted" <?= $comment['accepted'] ? 'checked' : '' ?> >Принять<Br>
            </label>
        </div>
        <div class="form-group">
            <label for="username">Имя:</label>
            <input class="username form-control" name="username" value="<?= $comment['username'] ?>"/>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input class="email form-control" name="email" value="<?= $comment['email'] ?>"/>
        </div>
        <div class="form-group">
            <label for="body">Текст:</label>
            <textarea class="body form-control" name="body" placeholder="Comment"><?= $comment['body'] ?></textarea>
        </div>
        <div class="form-group image">
            <img src='/media/upload/<?= $comment['image']; ?>'/>
        </div>

        <a href="index.php?q=comment/index" class="btn">Отменить</a>
        <button type="submit" class="btn btn-default">Отправить</button>
    </form>
</div>
