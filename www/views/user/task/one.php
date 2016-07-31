
<div class="container">
    <div class="entry-content">
        <?php foreach ($task as $values): ?>
            <div class="entry-title">
                <h2><a  rel="bookmark"><?= $values->title ?></a></h2>
            </div>
            <div class="entry-meta">
                <a>Time start:</a><p><?= $values->time_start?></p>
            </div>
            <div class="entry-meta">
                <a>Time end:</a><p><?= $values->time_finish?></p>
            </div>
            <div class="entry-text">
                <p class="description">
                    <?= $values->text ?>
                </p>
            </div>
            <div class="who-gave">
                <a>Who gave:</a>
                <p>
                    <?php foreach ($login_user as $login): ?>
                        <?= $values->admin_login ?>
                    <?php endforeach; ?>
                </p>

            </div>
            <button class="btn  btn-8 btn-8a files">
                <a href="\template\files\<?= $values->task_file ?>">Скачать файлы задания</a>
            </button>
        <?php endforeach; ?>
    </div>

    <?php foreach ($task as $values): ?>
        <?php  if($values->admin_login == $_SESSION['login']):  ?>
            <form class="confirm" action="/task/confirm?id=<?= $task[0]->task_id ?>" method="post">
                <input type="hidden" name="task_id" value="<?= $values->task_id  ?>">
                <input type="hidden" name="user_id" value="<?= $user_id[0]->user_id ?>">
                <input type="hidden" name="rating" value="<?= $values->rating_value ?>">
                <input type="hidden" name="task_status_id" value="2">
                <input class="btn btn-2 btn-2g" type="submit" value="Подтвердить задание">
            </form>
        <?php endif; ?>
        <?php if($values->task_status_id == 1 && $login->login == $_SESSION['login'] ): ?>

            <form class="checking" action="/task/checks?id=<?= $task[0]->task_id ?>" method="post" enctype="multipart/form-data">
                <label>
                    Комментарий к заданию:
                    <input type="text" name="task_comment">
                </label>
                <input type="hidden" name="task_status_id" value="3">
                <br>
                <label>
                    Файлы выполненного задания
                    <div  class="file_upload">
                        <input  type="file" name="task_ready_file" >
                    </div>
                </label>
                <br>
                <input class="btn btn-7 btn-7b icon-envelope" type="submit" value="Отправить на проверку">
            </form>
        <?php endif;?>
        <br>
        <?php if($values->task_status_id == 3): ?>
            Комментарий к заданию: <p><?= $values->task_comment ?></p>
            <button class="btn  btn-8 btn-8a files">
                <a href="\template\files\<?= $values->task_ready_file ?>">Скачать файлы готового задания</a>
            </button>
        <?php endif; ?>
    <?php endforeach; ?>


</div>
</div>
