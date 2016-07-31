
    <div class="container">
<form action="/department/add" method="post">
    <label for="department_name">Название</label>
    <input type="text" name="department_name" id="department_name"/>
    <br>
    <label for="department_text"></label>
    <textarea type="text" name="department_text" cols="22" rows="10" id="department_text"></textarea>
    <script type="text/javascript">
        CKEDITOR.replace( 'department_text');
    </script>
    <input class="btn btn-3 btn-3e icon-arrow-right" type="submit" name="Добавить">
</form>
        </div>
    </div>
