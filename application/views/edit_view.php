<?php
include_once "application\edit.js"
$row = $data['data'];
?>

<form class="row g-3 needs-validation max-width-400px" novalidate>
  <div class="col-12">
    <label for="kafedraName" class="form-label">Наименование</label>
    <input class="form-control" type="text" id="name" value="<?php echo $row['name']; ?>" placeholder="" required>
    <div class="invalid-feedback">
      Введите значение
    </div>
  </div>
  <div class="col-12">
    <label for="aname" class="form-label">Наименование сокр.</label>
    <input class="form-control" type="text" id="aname" value="<?php echo $row['aname']; ?>" placeholder="" required>
    <div class="invalid-feedback">
      Введите значение
    </div>
  </div>

  <div class="col-12">
    <label for="id" class="form-label">Институт</label>
    <select class="form-select" id="id">
      <option value=""></option>
      <?php
      echo sys::table2select(
              '"autor"'
              , '"id"'
              , '"name"'
              , $row['name']
              , '"actual"=1 or "id"=' . (int) $row['id']
              , '"name"');
      ?>
    </select>
    <div class="invalid-feedback">
      Введите значение
    </div>
  </div>

  <div class="col-12">
    <br>
    <button class="btn btn-primary save" data-id="<?php echo $row['kafedraId']; ?>">Сохранить</button>
    <a class="btn btn-light" href="/KafedraCls">Отмена</a>
  </div>
</form>