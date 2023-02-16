<?php if (! empty($errors)) : ?>
<div class="alert bg-danger text-white" role="alert">
    <div>
        <?php foreach ($errors as $error) : ?>
            <div><?= esc($error) ?></div>
        <?php endforeach ?>
    </div>
</div>
<?php endif ?>
