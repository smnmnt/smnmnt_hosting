@csrf
<div class="row mb-3">
    <label for="band_name" class="col-md-14 col-form-label">Исполнитель
    <input class="form-control" type="text" name="band_name" placeholder="Исполнитель" value="{{ old('band_name') ?? $band_un->band_name ?? '' }}">
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="band_desc" class="col-md-14 col-form-label">Об исполнителе
    <textarea class="form-control" type="text" placeholder="Об исполнителе" name="band_desc" rows="3" >{{ old('band_desc') ?? $band_un->band_desc ?? '' }}</textarea>
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="band_img" class="col-md-4 col-form-label">Выберите изображение
    <input class="form-control" type="file" name="band_img" value="">
    </label>
</div>
<!-- /.input-group -->
<input type="submit" class="btn btn-primary form-submit" value="Отправить данные">
