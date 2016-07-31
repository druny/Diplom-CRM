

    <div class="container">

<table class="simple-little-table" cellspacing='0'>
    <tr style="border: 1px solid black;">
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Отчетсво</th>
        <th>Фото</th>
        <th>E-mail</th>
        <th>Рейтинг</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            
            <td>
                <a href="/user/one?id=<?= $user->user_id ?>">
                    <?= $user->name ?>
                </a>
            </td>
            <td>
                <?= $user->s_name ?>
            </td>
            <td>
                <?= $user->patronymic?>
            </td>

            <td>
                <img src="/template/files/<?= $user->photo ?>" alt="">
            </td>
            <td>
                <?= $user->email ?>
            </td>
            <td>
                <strong><?= $user->rating ?></strong>
            </td>

        </tr>
    <?php endforeach; ?>
</table>
    </div>
    </div>
