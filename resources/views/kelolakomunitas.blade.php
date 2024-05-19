<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nihao! Selamat Datang</title>
    <link href="\kelolaakun\kelolaakun.css" rel="stylesheet">
    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="tampilanutama/headercamera.png" alt="NIHAO Logo">
            <h1>NiHaO</h1>
        </div>
        <nav>
            <ul>
                <li onclick="window.location.href='/beranda_admin'"><a href="#home">Home</a></li>
                <li><a href="#blog">Blog</a></li>
                <li><a href="#service">Service</a></li>
                <li><a href="#about">About</a></li>
            </ul>
        </nav>
        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#"><u>Profil</u></a>
            <a href="#"><u>Ganti Password</u></a>
            <a href="#"><u>Kententuan Layanan</u></a>
            <a href="#"><u>Kebijakan Privasi</u></a>
            <div class="logoutbtn">
                <a href="/login"><b><u>Log Out</u></b></a>
            </div>
        </div>
        <div id="main">
            <button class="openbtn" onclick="openNav()">&#9776;</button>
        </div>
    </header>

    <div class="sambutan">
        <div class="welcome"><b>Fitur Kelola Komunitas</b></div>
        <div class="subtext"><b>NiHaO Admin! Silahkan Kelola Komunitas Pengguna NiHaO disini</b></div>
    </div>

    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-xs-5">
                            <h2>Postingan <b>NiHaO!</b></h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Post_Id</th>
                            <th>Nama</th>
                            <th>Pesan</th>
                            <th>Gambar</th>
                            <th>Waktu Post</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unggah as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->nama }}</td>
                                <td>{{ $post->pesan }}</td>
                                <td><img src="data:image/jpeg;base64,{{ base64_encode($post->gambar) }}" alt="Gambar" width="100"/></td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    <form action="/unggah/{{ $post->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-xs-5">
                            <h2>Komentar Postingan <b>NiHaO!</b></h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Comment_Id</th>
                            <th>Post_Id</th>
                            <th>Username</th>
                            <th>Komentar</th>
                            <th>Waktu Post</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>{{ $comment->post_id }}</td>
                                <td>{{ $comment->username }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>{{ $comment->created_at }}</td>
                                <td>
                                    <form action="/comments/{{ $comment->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
