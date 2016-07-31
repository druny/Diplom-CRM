
<div class="container">




    <table class="simple-little-table" cellspacing='0'>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>time_start</th>
            <th>time_end</th>
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
            </tr>
        <?php endforeach;?>
    </table>

    <br>

</div>
</div>
