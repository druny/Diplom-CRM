
    <div class="container">
<form action="/user/add" method="post" enctype="multipart/form-data">
    <label for="name">Имя</label>
    <br>
    <input type="text" name="name" id="name">
    <br><br>
    <label for="s_name">Фамилия</label>
    <br>
    <input type="text" name="s_name" id="s_name">
    <br><br>
    <label for="patronymic">Отчество</label>
    <br>
    <input type="text" name="patronymic" id="patronymic">
    <br><br>
    <label for="e-mail">E-mail</label>
    <br>
    <input type="email" name="e-mail" id="e-mail">
    <br><br>
    <label for="photo">Фото</label>
    <br>
    <input type="file" name="photo" id="photo">
    <br><br>
    <label for="user_category_id">Категория пользователя</label>
    <select id="user_category_id " name="user_category_id">
        <?php foreach ($user_category as $category):?>
        <option value="<?= $category->user_category_id ?>"><?= $category->category ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <label for="position">Должность</label>
    <select name="position_id" id="position">
        <?php foreach ($position as $post):?>
            <option value="<?= $post->position_id ?>"><?= $post->position_name?></option>
        <?php  endforeach; ?>
    </select>
    <br><br>
    <label for="department_id">Отдел</label>
    <select name="department_id" id="department_id">
        <?php foreach ($department as $depart): ?>
        <option value="<?= $depart->department_id ?>"><?= $depart->department_name ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <label for="login">Login</label>
    <br>
    <input type="text" name="login" id="login">
    <br><br>
    <label for="password">Пароль</label>
    <br>
    <input type="password" name="password" id="password">
    <br>
    <br>
    <input type="submit" value="Добавить">
</form>
    </div>
    </div>
