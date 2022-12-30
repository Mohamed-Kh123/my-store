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
        <label for="">Coupon Code</label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
            value="{{ old('code', $coupon->code) }}">
        @error('name')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Coupon amount</label>
        <input type="text" class="form-control @error('amount') is-invalid @enderror" name="amount"
            value="{{ old('amount', $coupon->amount) }}">
        @error('amount')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Type</label>
        <select type="text" class="form-control @error('type') is-invalid @enderror" name="type">
        <option value="percent" @if('percent' == old('percent', $coupon->type)) selected @endif>Percent</option>
        <option value="fixed" @if('fixed' == old('fixed', $coupon->type)) selected @endif>Fixed</option>
        </select>
        @error('type')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Start Date</label>
        <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date"
            value="{{ old('start_date', $coupon->start_date) }}">
        @error('start_date')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="">End Date</label>
        <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date"
            value="{{ old('end_date', $coupon->end_date) }}">
        @error('end_date')
            <p class="invalid-feedback">{{ $message }}</p>
        @enderror
    </div>


    <button type="submit" class="btn btn-primary">{{$button}}</button>
    