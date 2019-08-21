<?php if (count($comments) > 0): ?>
    <div id="commentList" class="container">
        <h2><span data-toggle="comment-count"><?= count($comments) ?></span> Comments</h2>
        <?php foreach ($comments as $comment): ?>
            <div class="alert alert-secondary" role="alert">
                <div class="row justify-content-between align-items-center">
                    <h6 class="col-auto alert-heading"><?= $comment['name']; ?> <span class="font-weight-lighter"><?= (new DateTime($comment['date']))->format('d M Y'); ?></span></h6>
                    <div class="col-auto">
                        <button class="btn btn-sm btn-link py-0 text-dark" data-toggle="reply" data-parent="[role='alert']" data-comment="<?= $comment['id']; ?>"><i class="fas fa-redo"></i> Reply</button>
                    </div>
                </div>
                <p><?= $comment['comment']; ?></p>
            </div>
		    <?php if (isset($comment['child']) && count($comment['child']) > 0): ?>
		        <?php foreach ($comment['child'] as $comment): ?>
			        <div class="ml-5 alert alert-secondary" role="alert">
				        <h6 class="col-auto alert-heading"><?= $comment['name']; ?> <span class="font-weight-lighter"><?= (new DateTime($comment['date']))->format('d M Y'); ?></span></h6>
				        <p><?= $comment['comment']; ?></p>
			        </div>
		        <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
