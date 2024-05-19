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
        <div class="welcome"><b>Fitur Kelola Akun</b></div>
        <div class="subtext"><b>NiHaO Admin! Silahkan Kelola Akun Pengguna NiHaO disini</b></div>
    </div>

    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-xs-5">
                            <h2>Pengguna <b>NiHaO!</b></h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Waktu Dibuat</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="akun-table-body">
                        @foreach ($olah as $akun)
                        <tr id="akun-{{ $akun->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="#">{{ $akun->username }}</a></td>
                            <td>{{ $akun->email }}</td>
                            <td>{{ $akun->created_at }}</td>
                            <td>{{ $akun->role }}</td>
                            <td>
                                <a href="#" class="delete" data-id="{{ $akun->id }}" title="Delete" data-toggle="tooltip">
                                    <img id="uploaded-image" src="\kelolaakun\trashcan.png" alt="Trash Icon" width="50" height="auto" />
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.delete').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                if (confirm('Anda yakin ingin menghapus Akun ini?')) {
                    $.ajax({
                        url: '/akun/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                $('#akun-' + id).remove();
                                alert(response.success);
                            } else {
                                alert(response.error);
                            }
                        },
                        error: function (response) {
                            alert('An error occurred. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
