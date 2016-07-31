
    <div class="container">
       
<!--    <table class="title-table">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Text</th>
            <th>Time start</th>
            <th>Time end</th>
            <th>Кто дал</th>
        </tr>
</table>-->

        <table class="simple-little-table" cellspacing='0'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Text</th>
                <th>Time start</th>
                <th>Time end</th>
                <th>Кто дал</th>
            </tr>
            <?php foreach ($tasks as $task): ?>
        <tr>
            <td>
                <a href="/task/one/?id=<?= $task->task_id ?>">
                    <?= $task->task_id ?>
                </a>
            </td>
            <td><?= $task->title ?></td>
            <td><?= $task->text ?></td>
            <td><?= $task->time_start?></td>
            <td><?= $task->time_finish ?></td>
            <td><?= $task->admin_login ?></td>
        </tr>

            <?php endforeach;?>
    </table>


    </div>
    </div>
