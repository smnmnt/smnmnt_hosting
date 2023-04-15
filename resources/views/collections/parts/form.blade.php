@csrf
<div class="row mb-3">
    <label for="coll_name" class="col-md-4 col-form-label">Название коллекции
        <input class="form-control" type="text" name="coll_name" placeholder="Название коллекции" required value="{{ old('coll_name') ?? $coll_un->coll_name ?? '' }}">
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="coll_desc" class="col-md-14 col-form-label">О коллекции
        <textarea class="form-control" type="text" placeholder="О коллекции" name="coll_desc" rows="3" required>{{ old('coll_desc') ?? $coll_un->coll_desc ?? '' }}</textarea>
    </label>
</div>
<!-- /.input-group -->
<div class="row mb-3">
    <label for="coll_desc" class="col-md-4 col-form-label">Выберите пластинки в коллекцию:
    @foreach($products as $prod_un)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="prod_checkbox[]" value="{{ $prod_un->prod_id }}" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            {{ $prod_un->prod_name }} от {{ $prod_un->band_name }}
        </label>
    </div>
    @endforeach
    </label>
</div>
<!-- /.input-group -->
<input type="submit" class="btn btn-primary form-submit" value="Отправить данные">

