<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nihao! Upload Konten</title>
    <link href="/postkomunitas/postkomunitas.css" rel="stylesheet">
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
                <li onclick="window.location.href='/beranda_pembudidaya'"><a href="#home">Home</a></li>
                <li><a href="#blog">Blog</a></li>
                <li><a href="#service">Service</a></li>
                <li><a href="#about">About</a></li>
            </ul>
        </nav>

        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#"><b><u>Profil</u></b></a>
            <a href="#"><b><u>Ganti Password</u></b></a>
            <a href="#"><b><u>Kententuan Layanan</u></b></a>
            <a href="#"><b><u>Kebijakan Privasi</u></b></a>

            <div class="logoutbtn">
            <a href="/login"><b><u>Log Out</u></b></a>
            </div>

        </div>

        <div id="main">
            <button class="openbtn" onclick="openNav()">&#9776;</button>

        </div>
    </header>

    <section>
        <div class="col-md-5">
            <section class="panel timeline-post-to">
                <div class="panel-body">
                    <form action="{{ route('unggah') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    
                        <input type="text" id="form3Example4cg" class="form-control form-control-lg" name="nama" value="{{ session('username') }}" readonly style="display: none;" />
                        <textarea class="form-control" placeholder="Apa yang ada dipikiran Mu?" name="pesan"></textarea>
                                             
                        <label for="gambar-upload" class="upgambar">
                            <img src="/postkomunitas/up_img.png" alt="Gambar">
                        </label>
                        <input type="file" name="gambar" id="gambar-upload" style="display: none;" required />

                        <div class="buttons">
                            <button type="submit"><b>Unggah</b></button>
                            <button onclick="window.location.href='postingan'"><b>Kembali</b></button>
                        </div>
                        
                    </form>
                    
                </div>
            </section>
        </div>
    </section>

    <script src="/postkomunitas/postkomunitas.js"></script>
</body>

</html>
