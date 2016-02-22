<div class="col-md-12 comments" role="main">
    <div class="row">
        <div class="col-md-11 order_by">
            <strong>Отсортировать по:</strong>
            <a href="/index.php?q=comment/index&order_by=username">Имени</a>
            <a href="/index.php?q=comment/index&order_by=created_at">Дате</a>
        </div>
    </div>
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="comment bs-callout bs-callout-info">
                <h5>
                    <span class="username"> <?= $comment['username'] ?> </span>
                    <span class="created_at"> (<?= $comment['created_at'] ?>) </span>
                    <?php if ($comment['changed_by_admin']): ?>
                        <code class="changed_by_admin"> Изменил админ </code>
                    <?php endif; ?>
                    <?php if ($isAdmin): ?>
                        <span class="edit"><a href="/index.php?q=comment/edit&id=<?= $comment['id'] ?>">Редактировать</a></span>
                    <?php endif; ?>
                </h5>

                <div class="body bs-example">
                    <?= $comment['body']; ?>
                </div>
                <?php if (!empty($comment['image'])): ?>
                    <div class="image bs-example-images">
                        <img class="img-thumbnail" src='/media/upload/<?= $comment['image']; ?>'/>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="comment preview bs-callout bs-callout-info" style="display:none">
        <h5>
            <span class="username"></span>
            <span class="created_at"></span>
        </h5>

        <div class="body bs-example">
        </div>
    </div>
</div>

<div class="col-md-12 add-comment-form" role="form">
    <form action="/index.php?q=comment/create" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Имя:</label>
            <input class="username form-control" name="username" placeholder="Your name"/>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input class="email form-control" name="email" placeholder="Email"/>
        </div>
        <div class="form-group">
            <label for="body">Текст:</label>
            <textarea class="body form-control" name="body" placeholder="Comment"></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="picture">
        </div>

        <a href="#" class="js-preview btn">Предварительный просмотр</a>
        <button type="submit" class="btn btn-default">Отправить</button>
    </form>
</div>

<script>
    jQuery(document).ready(function () {
        $('.js-preview').click(function () {
            var now = new Date();
            $('.preview .username').html($('.add-comment-form .username').val());
            $('.preview .created_at').html('('+now.toString()+')');
            $('.preview .body').html($('.add-comment-form .body').val());
            $('.preview').show();
            return false;
        });
    });
</script>
