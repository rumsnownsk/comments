<?php if (!empty($comments)): ?>
    <table class="table table-hover">
        <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">agent</th>
            <th scope="col">User</th>
            <th scope="col">comment</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comment) : ?>
            <tr id="comment-<?= $comment['id'] ?>">
                <th scope="row"><?= $comment['id'] ?></th>
                <td class="comment_id"><?= $comment['user_agent'] ?></td>
                <td class="name"><?= $comment['name'] ?></td>
                <td class="comment"><?= $comment['comment'] ?></td>
                <td class="comment"><?= $comment['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Нет комментариев</p>
<?php endif; ?>
