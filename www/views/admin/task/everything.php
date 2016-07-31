

    <div class="container">
  
       <!-- <form action="/task/everything">
        <label for="user_id">
            Задания пользователя
            <select name="user_id" id="user_id">
                <?php /*foreach ($users as $user): */?>
                    <option value="<?/*= $user->user_id */?>"><?/*= $user->name */?></option>
                <?php /*endforeach; */?>
            </select>
        </label>
            <input type="submit" value="Фильтровать">
            </form>
        <br>
        <form action="/task/everything">
            <p>Cортировать:</p>
            <label for="">
                По
                <select name="column">
                    <option value="time_start" id="">Дате начала</option>
                    <option value="time_finish" id="">Окончанию</option>
                </select>
            </label>
            <input type="submit" value="Сортировать">
        </form>-->
      <!--  <form action="/task/everything">
            <label for="user_id">
                <select name="user_id" id="user_id">
                    <option value="" selected disabled>Пользователь</option>
                    <?php /*foreach ($users as $user): */?>
                    <option value="<?/*= $user->user_id */?>"><?/*= $user->name */?></option>
                    <?php /*endforeach; */?>
                </select>
            </label>

            <label for="">
                <select name="column">
                    <option value="" selected disabled>Сортировать по</option>
                    <option value="time_start" id="">Дате начала</option>
                    <option value="time_finish" id="">Окончанию</option>
                </select>
            </label>
            <input type="submit" value="Сортировать">
        </form>-->
        <table class="simple-little-table" cellspacing='0'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>time_start</th>
                <th>time_end</th>
                <th>From</th>
                <th>Del/Update</th>
            </tr>
            <tr>
                <?php foreach ($tasks as $task): ?>
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
                <td><a href="/task/delet?id=<?= $task->task_id ?>">Delete</a>/
                    <a href="/task/update?id=<?= $task->task_id ?>">Update</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>

</div>
    </div>
