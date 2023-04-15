@csrf
<div class="row mb-3">
    <label for="genre_name" class="col-md-4 col-form-label">Название жанра
        <input class="form-control" type="text" name="genre_name" placeholder="Название жанра" required value="{{ old('genre_name') ?? $genre_un->genre_name ?? '' }}">
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="genre_desc" class="col-md-4 col-form-label">Описание жанра
        <input class="form-control" type="text" name="genre_desc" placeholder="Описание жанра" required value="{{ old('genre_desc') ?? $genre_un->genre_desc ?? '' }}">
    </label>
</div>
<!-- /.input-group -->
<input type="submit" class="btn btn-primary form-submit" value="Отправить данные">
