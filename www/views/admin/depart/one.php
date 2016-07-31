
    <div class="container">

        Отдел: <?= $depart[0]->department_name ?></td>
        <br>




    <table>

    </table>
    <table class="content-table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>S. Name</th>
            <th>Patronymic</th>
            <th>Photo</th>
            <th>E-mail</th>
            <th>Rating</th>

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
                    <?= $user->patronymic?>
                </td>
                <td>
                    <img src="/template/files/<?= $user->photo ?>" alt="">
                </td>
                <td>
                    <?= $user->email ?>
                </td>
                <td>
                    <?= $user->rating ?>
                </td>
             <!--   <td>
                    <?/*= $user->login */?>
                </td>
                <td>
                    <?/*= $user->position_name */?>
                </td>
                <td>
                    <?/*= $user->department_name */?>
                </td>-->
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
        </div>
    </div>
