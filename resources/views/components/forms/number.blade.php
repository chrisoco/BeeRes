<div class="form-group">
    <label class="form-label mt-4" for="{{ $name }}">{{ $title }} @if($required) <span class="text-danger">*</span> @endif</label>
    <input class="form-control @if($errors->any()) @error($name) is-invalid @else is-valid @enderror @endif"
           type="number" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}"
           min="{{ $min }}" max="{{ $max }}" step="{{ $step }}" @if($required) required @endif>
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
