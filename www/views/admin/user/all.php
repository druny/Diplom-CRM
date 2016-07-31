
    <div class="container">
<table class="simple-little-table" cellspacing='0'>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Patronymic</th>
        <th>Photo</th>
        <th>E-mail</th>
        <th>Position</th>
        <th>Department</th>
        <th>Delet/Update</th>
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
        <td>
            <a href="/user/delet?id=<?= $user->user_id ?>">Удалить</a>/
            <a href="/user/update?id=<?= $user->user_id ?>">Обновить</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

    </div>
    
    </div>
