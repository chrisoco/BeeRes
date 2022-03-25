<div class="form-group">
    <label class="form-label mt-4" for="{{ $name }}">{{ $title }} @if($required) <span class="text-danger">*</span> @endif</label>
    <textarea class="form-control @if($errors->any()) @error($name) is-invalid @else is-valid @enderror @endif"
              rows="3" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $title }}" @if($required) required @endif>{{ $value }}</textarea>
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
