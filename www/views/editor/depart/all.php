

<div class="container">


        <table class="simple-little-table">
            <tr >
                <th>ID</th>
                <th>Title</th>
                <th>Text</th>
                <?php foreach ($departs as $depart): ?>
            <tr>
                <td>
                    <a href="/department/one/?id=<?= $depart->department_id ?>">
                        <?= $depart->department_id ?>
                    </a>
                </td>
                <td><?= $depart->department_name ?></td>
                <td><?= $depart->department_text ?></td>

            </tr>
            <?php endforeach;?>
        </table>

        <br>

</div>



<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.ui.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/bootstrap.min.js"></script>
