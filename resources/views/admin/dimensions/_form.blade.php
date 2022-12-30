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
        <select class="form-select" aria-label="Default select example" name="dimension">
            <option value="40x60cm" @if('40x60cm' == old('40x60cm', $dimension->dimension)) selected @endif>40x60cm</option>
            <option value="60x90cm" @if('60x90cm' == old('60x90cm', $dimension->dimension)) selected @endif>60x90cm</option>
            <option value="80x120cm" @if('80x120cm' == old('80x120cm', $dimension->dimension)) selected @endif>80x120cm</option>
          </select>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">{{$button}}</button>
    