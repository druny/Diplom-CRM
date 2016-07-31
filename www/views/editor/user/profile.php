
<div class="container">

    <div class="entry-content">
        <div class="entry-title">
            <h2><a  rel="bookmark"><?= $user[0]->name ?> <?= $user[0]->s_name ?></a></h2>
        </div>
        <div class="entry-meta">
            <img src="/template/files/<?= $user[0]->photo ?>" alt="">
        </div>
        <div class="entry-info">
            E-mail: <p><?= $user[0]->email ?></p>
            Login: <p><?= $user[0]->login ?></p>
            Position: <p><?= $user[0]->position_name ?></p>
            Department: <p><?= $user[0]->department_name ?></p>
        </div>
       
    </div>


</div>
</div>
