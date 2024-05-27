<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nihao! Selamat Datang</title>
    <link href="\riwayatdiagnosis\riwayatdiagnosis.css" rel="stylesheet">
    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="\riwayatdiagnosis\riwayatdiagnosis.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="tampilanutama/headercamera.png" alt="NIHAO Logo">
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
        <div class="welcome"><b>Fitur Riwayat Diagnosa</b></div>
        <div class="subtext"><b>NiHaO Pengguna! Silahkan lihat hasil diagnosa yang pernah kamu lakukan sebelumnya</b></div>
    </div>

    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-xs-5">
                            <h2>NiHao!<b> Hasil Diagnosa</b></h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Hasil Diagnosis</th>
                            <th>Waktu Diagnosis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="akun-table-body">
                        @foreach ($diagnoses as $diagnosis)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="data:image/jpeg;base64,{{ base64_encode($diagnosis->image) }}" alt="Diagnosis Image" width="100"></td>
                            <td>{{ is_array($diagnosis->results) ? implode(', ', $diagnosis->results) : $diagnosis->results }}</td>
                            <td>{{ $diagnosis->created_at }}</td>
                            <td>
                                <button onclick="deleteDiagnosis({{ $diagnosis->id }})" class="delete" title="Delete" data-toggle="tooltip">
                                    <img src="\kelolaakun\trashcan.png" alt="Trash Icon" width="50" height="auto" />
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function deleteDiagnosis(id) {
            if(confirm('Anda yakin ingin menghapus riwayat diagnosis ini?')) {
                $.ajax({
                    url: '/diagnosis/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        alert(result.message);
                        location.reload();
                    },
                    error: function(err) {
                        alert(err.responseJSON.message);
                    }
                });
            }
        }
    </script>

</body>
</html>
