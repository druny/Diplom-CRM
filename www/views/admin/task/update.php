
    <div class="container">
<form action="/task/update?id=<?= $task[0]->task_id ?>" enctype="multipart/form-data" method="post"
      oninput="value.value = rating_value.valueAsNumber">
    <label for="title">
        Title:
        <br>
        <textarea name="title" id="title" cols="30" rows="1"><?= $task[0]->title ?></textarea>
    </label>
    <br>
    <label for="text">
        Text:
        <br>
        <textarea name="text" id="text" cols="30" rows="1"><?= $task[0]->text ?></textarea>
    </label>
    <br>
    <label for="time_start">
        Time Start:
        <br>
        Now:
        <textarea  cols="30" rows="1" disabled><?= $task[0]->time_start ?></textarea>
        <br>
        Select: <input type="date" name="time_start">
    </label>
    <br>
    <label for="">
        Time Finish:
        <br>
        Now:
        <textarea  cols="30" rows="1" disabled><?= $task[0]->time_finish ?></textarea>
        <br>
        Select: <input type="date" name="time_finish">
    </label>
    <br>

    <input type="file" name="task_file">
    <br>
    <select name="task_priority_id" id="">
        <?php foreach ($degree as $deg): ?>
            <option value="<?= $deg->task_priority_id ?>">
                <?= $deg->degree ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    <br>
    <label for="flying">Баллы за выполненное задание</label>
    <input name="rating_value" id="flying" type="range" min="1" max="20" value="<?= $task[0]->rating_value ?>">
    <output for="flying" name="value"><?= $task[0]->rating_value ?></output>/20

    <br><br>
    <input type="submit" value="Update task">
    </form>
<form action="/task/confirm?id=<?= $task[0]->task_id ?>" method="post">
    <input type="hidden" name="task_id" value="<?= $task[0]->task_id ?>">
    <input type="hidden" name="user_id" value="<?= $user ?>">
    <input type="hidden" name="rating" value="<?= $task[0]->rating_value ?>">
    <input type="hidden" name="task_status_id" value="2">
    <input type="submit" value="Подтвердить задание">
</form>
    </div>
    </div>
