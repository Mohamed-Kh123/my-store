    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-groub">
        <select class="form-select" aria-label="Default select example" name="size">
            <option value="s" @if('s' == old('s', $size->size)) selected @endif>S</option>
            <option value="m" @if('m' == old('m', $size->size)) selected @endif>M</option>
            <option value="l" @if('l' == old('l', $size->size)) selected @endif>L</option>
            <option value="xl" @if('xl' == old('xl', $size->size)) selected @endif>XL</option>
          </select>
    </div>

    <button type="submit" class="btn btn-primary">{{$button}}</button>
    