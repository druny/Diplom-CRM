
    <div class="container">
<form action="/task/add/" enctype="multipart/form-data" method="post"
      oninput="value.value = rating_value.valueAsNumber">
    <label for="">
        Title:
        <br>
        <input type="text" name="title">
    </label>

    <br>
    <label for="">
        Text:
        <br>
        <textarea type="text" name="text" id="text"></textarea>
        <script type="text/javascript">
            CKEDITOR.replace( 'text');
        </script>
    </label>
    <br>
    <label for="">
        Time Start:
        <br>
        <input type="date" name="time_start">
    </label>
    <br>
    <label for="">
        Time Finish:
        <br>
        <input type="date" name="time_finish">
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
    <select name="user_id" id="" size="5"> 
        <?php foreach ($users as $user): ?>

        <option value="<?= $user->user_id ?>">
            <?= $user->name ?>  <?= $user->s_name ?> - <?= $user->email ?>
        </option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="">
        Стоимость задания
        <input type="number" value="task_price">
    </label>

    <br>
    <label for="flying">Баллы за выполненное задание</label>
    <input name="rating_value" id="flying" type="range" min="1" max="20" value="1">
    <output for="flying" name="value">1</output>/20

    <br><br>
    <input type="submit" value="Создать задание">
</form>
        </div>
    </div>
