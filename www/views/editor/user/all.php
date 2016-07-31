
<div class="container">

    <!-- <form action="/user/all">
            Фильтровать по должности
            <select name="position" id="">
                <?php /*foreach ($positions as $position): */?>
                <option value="<?/*= $position->position_id */?>">
                    <?/*= $position->position_name */?>
                </option>
                <?php /*endforeach; */?>
                <input type="submit" value="Фильтровать">
            </select>
        </form>
        <form action="/user/all">
            Фильтровать по отделам
            <select name="department" id="">
                <?php /*foreach ($departments as $department): */?>
                    <option value="<?/*= $department->department_id */?>">
                        <?/*= $department->department_name */?>
                    </option>
                <?php /*endforeach; */?>
                <input type="submit" value="Фильтровать">
            </select>
        </form>-->
    <form action="/user/all">
        <select name="position" id="">
            <option value="" selected disabled>Должность</option>
            <?php foreach ($positions as $position): ?>
                <option value="<?= $position->position_id ?>">
                    <?= $position->position_name ?>
                </option>
            <?php endforeach; ?>
        </select>
        <select name="department" id="">
            <option value="" selected disabled>Отдел</option>
            <?php foreach ($departments as $department): ?>
                <option value="<?= $department->department_id ?>">
                    <?= $department->department_name ?>
                </option>
            <?php endforeach; ?>
            <input type="submit" value="Фильтровать">
        </select>
    </form>


    <table class="simple-little-table" cellspacing='0'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Patronymic</th>
            <th>Photo</th>
            <th>E-mail</th>
            <th>Position</th>
            <th>Department</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <a href="/user/one?id=<?= $user->user_id ?>">
                        <?= $user->user_id ?>
                    </a>
                </td>
                <td>
                    <?= $user->name ?>
                </td>
                <td>
                    <?= $user->s_name ?>
                </td>
                <td>
                    <img src="/template/files/<?= $user->photo ?>" alt="<?= $user->photo ?>">
                </td>
                <td>
                    <?= $user->email ?>
                </td>
                <td>
                    <?= $user->position_name ?>
                </td>
                <td>
                    <?= $user->department_name ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>

</div>

</div>
