<div class="ml-5 alert alert-secondary" role="alert">
    <h6 class="col-auto alert-heading"><?= $comment['name']; ?> <span class="font-weight-lighter"><?= (new DateTime($comment['date']))->format('d M Y'); ?></span></h6>
    <p><?= $comment['comment']; ?></p>
</div>