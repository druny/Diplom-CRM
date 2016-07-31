
    <div class="container">
<!--<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>S. Name</th>
        <th>Patronymic</th>
        <th>Rating</th>
        <th>Photo</th>
        <th>E-mail</th>
        <th>Login</th>
        <th>Position</th>
        <th>Department</th>
    </tr>
</table>-->
        <h1>Отображение рейтинга пользователей</h1>
<table class="content-table">
    <tr style="border: 1px solid black;">
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Отчетсво</th>
        <th>Фото</th>
        <th>E-mail</th>
        <th>Рейтинг</th>
    </tr>
    <?php foreach ($users as $user): ?>
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
