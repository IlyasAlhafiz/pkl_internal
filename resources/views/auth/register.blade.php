<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - FoodMart</title>
  <link rel="shortcut icon" href="{{asset('front/images/LogoXimi.png')}}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<form method="POST" action="{{ route('register') }}">
  @csrf
  <div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow-sm p-4" style="max-width: 450px; width: 100%;">
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
        <small class="text-muted">atau daftar dengan email</small>
      </div>

      {{-- Name --}}
      <div class="mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text"
               id="name"
               name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}"
               required
               autofocus>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      {{-- Email --}}
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email"
               id="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}"
               required>
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

      {{-- Confirm Password --}}
      <div class="mb-4">
        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
        <input type="password"
               id="password_confirmation"
               name="password_confirmation"
               class="form-control"
               required>
      </div>

      {{-- Register Button --}}
      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-warning">
          Daftar
        </button>
      </div>

      {{-- Login --}}
      <div class="text-center">
        <span>Sudah punya akun?</span>
        <a href="{{ route('login') }}" class="text-warning text-decoration-none">Login</a>
      </div>
    </div>
  </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
