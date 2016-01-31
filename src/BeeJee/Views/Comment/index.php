<div class="comments">
    <div class="order_by">
        <span>Отсортировать по:</span>
        <a href="index.php?q=comment/index&order_by=username">Имени</a>
        <a href="index.php?q=comment/index&order_by=created_at">Дате</a>
    </div>
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <div class="comment-header">
                    <span class="username"> <?= $comment['username'] ?> </span>
                    <span class="created_at"> <?= $comment['created_at'] ?> </span>
                    <span class="changed_by_admin"> <?= $comment['changed_by_admin'] ? 'Изменил админ' : '' ?> </span>
                    <?php if ($isAdmin): ?>
                        <span class="edit"><a href="index.php?q=comment/edit&id=<?= $comment['id'] ?>">Редактировать</a></span>
                    <?php endif; ?>
                </div>
                <div class="body">
                    <?= $comment['body']; ?>
                </div>
                <div class="image">
                    <img src='/media/upload/<?= $comment['image']; ?>' />
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="comment preview">
        <div class="comment-header">
            <span class="username"></span>
            <span class="created_at"></span>
        </div>
        <div class="body">
        </div>
    </div>
</div>
<div class="add-comment-form" >
    <form action="index.php?q=comment/create" method="POST" enctype="multipart/form-data">
        <input class="username" name="username" placeholder="Your name"/>
        <input class="email" name="email" placeholder="Email"/>
        <textarea class="body" name="body" placeholder="Comment"></textarea>
        <input type="file" name="picture">

        <a href="#" class="js-preview">Предварительный просмотр</a>
        <button type="submit">Отправить</button>
    </form>
</div>

<script>
    jQuery(document).ready(function () {
        $('.js-preview').click(function () {
            var now = new Date();
            $('.preview .username').html($('.add-comment-form .username').val());
            $('.preview .created_at').html(now.toString());
            $('.preview .body').html($('.add-comment-form .body').val());

            return false;
        });
    });
</script>
