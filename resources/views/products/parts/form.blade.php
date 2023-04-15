@csrf
<div class="row mb-3">
    <label for="prod_name" class="col-md-4 col-form-label">Название пластинки
        <input class="form-control" type="text" name="prod_name" placeholder="Название пластинки" required value="{{ old('band_name') ?? $prod_un->prod_name ?? '' }}">
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="prod_band" class="col-md-4 col-form-label">Выберите исполнителя
        <select name="prod_band" id="prod_band" class="form-select" required>
            @if(empty($prod_old))
                <option value="" selected disabled>Выберите исполнителя</option>
            @else
                @foreach($prod_old as $band_un)
                    <option value="{{ $band_un->band_id }}" id="{{ $band_un->band_id }}" selected>{{ $band_un->band_name }}</option>
                    @break
                @endforeach
            @endif
            @foreach($bands as $band)
                <option value="{{ $band->band_id }}" id="{{ $band->band_id }}">{{ $band->band_name }} </option>
            @endforeach
        </select>
        <!-- /#.form-select -->
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="prod_genre" class="col-md-4 col-form-label">Выберите жанр
        <select name="prod_genre" id="prod_genre" class="form-select" required>
            @if(empty($prod_old))
                <option value="" selected disabled>Выберите жанр</option>
            @else
                @foreach($prod_old as $genre_un)
                    <option value="{{ old($genre_un->genre_id) ?? $genre_un->genre_id }}" selected>{{ $genre_un->genre_name }}</option>
                    @break
                @endforeach
            @endif
            @foreach($genres as $genre)
                <option value="{{ $genre->genre_id }}">{{ $genre->genre_name }}</option>
            @endforeach
        </select>
        <!-- /#.form-select -->
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="prod_desc" class="col-md-14 col-form-label">О пластинке
        <textarea class="form-control" type="text" placeholder="О пластинке" name="prod_desc" rows="3" required>{{ old('prod_desc') ?? $prod_un->prod_desc ?? '' }}</textarea>
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="prod_year" class="col-md-4 col-form-label">Год выпуска
        <input class="form-control" type="number" name="prod_year" placeholder="Год выпуска" required value="{{ old('prod_year') ?? $prod_un->prod_year ?? '' }}">
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="prod_price" class="col-md-4 col-form-label">Обычная цена
        <input class="form-control" type="number" name="prod_price" placeholder="Обычная цена" required value="{{ old('prod_price') ?? $prod_un->prod_price ?? '' }}">
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="prod_sale" class="col-md-4 col-form-label">Цена по скидке (оставьте пустым, если скидка отсутствует)
        <input class="form-control" type="number" name="prod_sale" placeholder="Цена по скидке" value="{{ old('prod_sale') ?? $prod_un->prod_sale ?? '' }}">
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="prod_img" class="col-md-4 col-form-label">Выберите изображение
        <input class="form-control" type="file" name="prod_img">
    </label>
</div>
<!-- /.input-group -->

<input type="submit" class="btn btn-primary form-submit" value="Отправить данные">
