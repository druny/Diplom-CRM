

<div class="container">
    <?php foreach ($departs as $depart): ?>

        <table class="content-table">
            <tr >
                <th>ID</th>
                <th>Title</th>
                <th>Text</th>
            </tr>
            <tr>
                <td>
                    <a href="/department/one/?id=<?= $depart->department_id ?>">
                        <?= $depart->department_id ?>
                    </a>
                </td>
                <td><?= $depart->department_name ?></td>
                <td><?= $depart->department_text ?></td>

            </tr>
        </table>

        <br>
    <?php endforeach;?>
</div>



<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.ui.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/bootstrap.min.js"></script>
