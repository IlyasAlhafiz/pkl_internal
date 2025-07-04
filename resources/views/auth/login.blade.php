<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <title>Login - FoodMart</title>
  <link rel="shortcut icon" href="{{asset('front/images/LogoXimi.png')}}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<form method="POST" action="{{ route('login') }}">
  @csrf
  <div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
      <div class="text-center mb-4">
        <a href="{{ route('welcome') }}">
          <img src="{{ asset('front/images/Xiaomi Logo.webp') }}" alt="Logo" width="120">
        </a>
      </div>

      <div class="text-center mb-3">
        <div class="row">
          <div class="col">
            <a href="#" class="btn btn-outline-secondary w-100">
              <img src="{{ asset('assets/images/svgs/google-icon.svg') }}" width="18" class="me-2"> Google
            </a>
          </div>
          <div class="col">
            <a href="#" class="btn btn-outline-secondary w-100">
              <img src="{{ asset('assets/images/svgs/facebook-icon.svg') }}" width="18" class="me-2"> Facebook
            </a>
          </div>
        </div>
      </div>

      <div class="text-center mb-3">
        <small class="text-muted">atau login dengan email</small>
      </div>

      {{-- Email --}}
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email"
               id="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}"
               required
               autofocus>
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      {{-- Password --}}
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password"
               id="password"
               name="password"
               class="form-control @error('password') is-invalid @enderror"
               required>
        @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      {{-- Remember & Forgot --}}
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
          <input type="checkbox"
                 class="form-check-input"
                 name="remember"
                 id="remember"
                 {{ old('remember') ? 'checked' : '' }}>
          <label class="form-check-label" for="remember">Ingat saya</label>
        </div>
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-warning text-decoration-none">
            Lupa Password?
          </a>
        @endif
      </div>

      {{-- Login Button --}}
      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-warning">
          Login
        </button>
      </div>

      {{-- Register --}}
      <div class="text-center">
        <span>Belum punya akun?</span>
        <a href="{{ route('register') }}" class="text-warning text-decoration-none">Daftar</a>
      </div>
    </div>
  </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
