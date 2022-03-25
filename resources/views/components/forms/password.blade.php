<div class="form-group">
    <label class="form-label mt-4" for="password">Password<span class="text-danger">*</span></label>
    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" required>
    @error('password')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
@if($confirm)
<div class="form-group">
    <label class="form-label mt-4" for="password-confirm">Confirm Password<span class="text-danger">*</span></label>
    <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password-confirm" required>
    @error('password_confirmation')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
@endif
