<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nihao! Scan Ikan Nilamu!</title>
    <link href="/diagnosa_input/diagnosa_input.css" rel="stylesheet">
    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="/diagnosa_input/diagnosa_input.js"></script>
    <script src="/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
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


 


    <form action="/upload" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            
            <div class="content-wrapper">
                
                <div class="upload-container">
                <div class="daftar-text"><b>NiHaO! Silahkan Upload Gambar Anda Disini!</b></div>
                    <label for="file-upload" class="custom-file-upload">
                        <img id="uploaded-image" src="/diagnosa_input/mid.png" alt="Folder Icon" width="800" height="auto" />
                    </label>

                    <input id="file-upload" name="image" type="file" style="display:none;" />

                    <div class="butup">
                        <button type="submit"><b>Upload</b></button>
                        <button type="button" onclick="showCamera()"><b>Gunakan Kamera</b></button>
                    </div>
                </div>

                <div id="kamera-container" class="kamera-container" style="display: none;">
                <div class="daftar-text"><b>NiHaO! Tangkapan Kamera-mu Tampil Disini</b></div>
                    <label for="kamera-upload" class="kamera-file-upload">
                        <video id="videoElement" autoplay width="500" height="500"></video>
                        <canvas id="canvas" width="500" height="500" style="display:none;"></canvas>
                    </label>

                    <div class="butup-kamera">
                        <button type="button" onclick="takePicture()" for="file-upload"><b>Ambil Gambar</b></button>
                        <button type="button" onclick="closeCamera()"><b>Tutup Kamera</b></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        const video = document.getElementById('videoElement');
        const canvas = document.getElementById('canvas');

        function showCamera() {
            document.getElementById('kamera-container').style.display = 'block';

            navigator.mediaDevices.getUserMedia({ video: true })
                .then((stream) => {
                    video.srcObject = stream;
                })
                .catch((err) => {
                    console.error('Gagal mengakses kamera:', err);
                });
        }

        function takePicture() {
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, 390);
            canvas.style.display = 'block';
            video.style.display = 'none';

            canvas.toBlob(function(blob) {
                const file = new File([blob], 'captured_image.jpg', { type: 'image/jpeg' });

                const filesList = new DataTransfer();
                filesList.items.add(file);

                const fileInput = document.getElementById('file-upload');
                fileInput.files = filesList.files;
            }, 'image/jpeg');
        }

        class FileListItem extends Array {
            constructor(items, options) {
                super(...items);
                Object.defineProperty(this, 'options', {
                    value: options || {}
                });
            }
            toString() {
                return `[object FileList]`;
            }
        }

        function closeCamera() {
            document.getElementById('kamera-container').style.display = 'none';
            const stream = video.srcObject;
            const tracks = stream.getTracks();

            tracks.forEach(track => {
                track.stop();
            });

            video.style.display = 'block';
            canvas.style.display = 'none';
        }
    </script>

</body>

</html>
