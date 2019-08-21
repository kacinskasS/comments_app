<!DOCTYPE html>
<html lang="lt">
    <head>
        <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Comment Form</title>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    </head>
    <body>

        <?php if (isset($_SESSION['messages'])): ?>
        <section id="messages-section">
            <div class="uk-container">
                <?php foreach (['primary', 'success', 'warning', 'danger'] as $alertClass):?>
                <?php if (isset($_SESSION['messages'][$alertClass])):?>
                <div class="uk-alert-<?= $alertClass;?>" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <ul class="uk-list">
                        <?php foreach ($_SESSION['messages'][$alertClass] as $alert): ?>
                        <li><?= $alert; ?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            <?php endif;?>
            <?php endforeach;?>
            <?php unset($_SESSION['messages']);?>
        </section>
        <?php endif;?>

        <?php if (isset($form)): ?>
            <?= $form;?>
        <?php endif;?>

        <?php if (isset($list)): ?>
            <?= $list; ?>
        <?php endif;?>


        <?php if (isset($dashboard)): ?>
        <section id="dashboard-section">
            <div class="uk-container">

            </div>
        </section>
        <?php endif;?>


        <?php if (isset($status)): ?>
        <section id="status-section">
            <div class="uk-container">
                <?= $status;?>
            </div>
        </section>
        <?php endif;?>
	    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	    <script type="text/javascript" src="<?= BASE_URL ;?>/public/js/app.js"></script>
	    <?php if (isset($javascript)): ?>
	        <script defer type="text/javascript" src="<?= BASE_URL . '/public/js/'.$javascript.'.js';?>"></script>
        <?php endif;?>
    </body>
</html>

