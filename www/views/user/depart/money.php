
<div class="container">
    <form action="/department/money" method="post">
        <label for="">
            От
            <input type="date" name="first_date">
        </label>
        <label for="">
            До
            <input type="date" name="second_date">
        </label>
        <br><br>
        <label for="">
            Выбор отдела
            <select name="department_id" id="department_id">
                <option value="" disabled selected>Отдел</option>
                <?php foreach ($department as $depart): ?>
                    <option value="<?= $depart->department_id ?>"><?= $depart->department_name ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            Или
            <br><br>
            <label for="">
                Выбор пользователя
                <select name="user_id" id="">
                    <option value="" disabled selected>Пользователь</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->user_id ?>">
                            <?= $user->name ?>  <?= $user->s_name ?> - <?= $user->email ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
        </label>
        <input type="submit" value="Показать" >
    </form>
    <br><br><br>
    <?php

    if(!empty($sum)) {
        foreach ($sum as $suum):

            echo  'Сумма = ' . array_shift($suum);
        endforeach;
    }else{
        echo 'Данных нет';
    }
    ?>
</div>
