<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nihao! Selamat Datang</title>
    <link href="/halamanlogin/login.css" rel="stylesheet">
    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <div class="logo">
            <img src="/tampilanutama/headercamera.png" alt="NIHAO Logo">
            <h1>NiHaO</h1>
        </div>
        <nav>
            <ul>
                <li onclick="window.location.href='/'"><a href="#home">Home</a></li>
                <li><a href="#blog">Blog</a></li>
                <li><a href="#service">Service</a></li>
                <li><a href="#about">About</a></li>
            </ul>
        </nav>
    </header>

    

    <div class="gabung">
    <div class="daftar-text"><b>NiHaO! Silahkan LogIn Disini!</b></div>
        <div class="container">

        @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
          
                    <!-- Form Login -->
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="kontainer_form">
                    <div class="form-group">
                        <label class="form-label" for="form3Example4cg"><b>Username:</b></label>
                        <input type="text" id="form3Example4cg" class="form-control form-control-lg" name="username" value="{{ old('username') }}" required />
                    </div>
                    <!-- Input untuk password -->
                    <div class="form-group">
                        <label class="form-label" for="form3Example4cg"><b>Password:</b></label>
                        <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="password" value="{{ old('password') }}" required />
                    </div>

                    <!-- Hyperlink untuk Lupa Password -->
                    <div class="form-group">
                        <a href="{{ route('lupa') }}" class="text-bold">Lupa Password?</a>
                    </div>

                    <div class="ingatsaya">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat Saya</label>
                    </div>

                    <div class="buttons">
                        <button type="submit" class="btn btn-primary"><b>Login</b></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>

</html>
