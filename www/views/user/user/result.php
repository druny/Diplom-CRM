

    <div class="container">
   
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
            <tr>
                <td>
                    <?= $user->name ?>
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

