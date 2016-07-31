
    <div class="container">
<?php foreach ($users as $user): ?>
<form action="/user/update?id=<?= $user->user_id ?>" method="post" enctype="multipart/form-data">
<label for="name">Имя</label>
<br>
    <textarea name="name" id="name" cols="30" rows="1"><?= $user->name ?></textarea>
<br><br>
<label for="s_name">Фамилия</label>
<br>
    <textarea name="s_name" id="s_name" cols="30" rows="1"><?= $user->s_name ?></textarea>
<br><br>
<label for="patronymic">Отчество</label>
<br>
    <textarea name="patronymic" id="patronymic" cols="30" rows="1"><?= $user->patronymic ?></textarea>
<br><br>
<label for="e-mail">E-mail</label>
<br>
    <textarea name="email" id="e-mail" cols="30" rows="1"><?= $user->email ?></textarea>
<br><br>
<label for="photo">Фото</label>
<br>
    <input type="file" name="photo">
    <img  src="/template/files/<?= $user->photo ?>" alt="">

<label for="clearfloat  user_category_id">Категория пользователя</label>
<select id="user_category_id " name="user_category_id">
    <option selected disabled><?= $select_category ?></option>
    <?php foreach ($user_category as $category):?>
        <option value="<?= $category->user_category_id ?>"><?= $category->category ?></option>
    <?php endforeach; ?>
</select>
<br><br>
<label for="position">Должность</label>
<select name="position_id" id="position">
    <option selected disabled><?= $select_position[0]->position_name ?></option>
    <?php foreach ($position as $post):?>
        <option value="<?= $post->position_id ?>"><?= $post->position_name?></option>
    <?php  endforeach; ?>
</select>
<br><br>
<label for="department_id">Отдел</label>
<select name="department_id" id="department_id">
    <option selected disabled><?= $select_department[0]->department_name ?></option>
    <?php foreach ($department as $depart): ?>
        <option value="<?= $depart->department_id ?>"><?= $depart->department_name ?></option>
    <?php endforeach; ?>
</select>
<br><br>
<label for="login">Login</label>
<br>
    <textarea name="login" id="login" cols="30" rows="1"><?= $user->login ?></textarea>
<br><br>
<label for="password">Пароль</label>
<br>
<input type="password" name="password" id="password">
<br>
<br>
<input type="submit" value="Обновить">
</form>
<?php endforeach; ?>
    </div>
    </div>
