    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label for="">Color Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name', $color->name) }}">
        @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>


    <button type="submit" class="btn btn-primary">{{$button}}</button>
    