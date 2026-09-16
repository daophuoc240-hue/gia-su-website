@extends('layouts.auth')

@section('title', 'Ðãng Nh?p')

@section('content')
<div class="auth-card glass-card">
    <div class="auth-brand">
        <div class="brand-icon">??</div>
        <h1>TRUNG TÂM K?T N?I GIA SÝ</h1>
        <p>C?ng Thông Tin & Qu?n L? D?y Kèm Chuyên Nghi?p</p>
    </div>

    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="email">
                <i class="fas fa-envelope" style="margin-right:0.4rem;"></i>Email
            </label>
            <input type="email"
                   id="email"
                   name="email"
                   class="form-control"
                   placeholder="Nh?p ð?a ch? email..."
                   value="{{ old('email') }}"
                   required>
        </div>

        <div class="form-group">
            <label class="form-label" for="password">
                <i class="fas fa-lock" style="margin-right:0.4rem;"></i>M?t Kh?u
            </label>
            <div style="position:relative;">
                <input type="password"
                       id="password"
                       name="password"
                       class="form-control"
                       placeholder="Nh?p m?t kh?u..."
                       required
                       style="padding-right: 3rem;">
                <button type="button"
                        onclick="togglePassword('password', this)"
                        style="position:absolute; right:0.8rem; top:50%; transform:translateY(-50%); background:none; border:none; color:var(--text-muted); cursor:pointer; font-size:0.9rem;">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem;">
            <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; font-size:0.85rem; color:var(--text-secondary);">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                Ghi nh? ðãng nh?p
            </label>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-lg">
            <i class="fas fa-sign-in-alt"></i> Ðãng Nh?p
        </button>
    </form>

    <div class="divider"></div>

    <p style="text-align:center; font-size:0.88rem; color:var(--text-secondary);">
        Chýa có tài kho?n?
        <a href="{{ route('register') }}" style="color:var(--primary-start); font-weight:600; text-decoration:none;">
            Ðãng k? ngay
        </a>
    </p>
</div>

<script>
function togglePassword(fieldId, btn) {
    const field = document.getElementById(fieldId);
    const icon  = btn.querySelector('i');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
@endsection
