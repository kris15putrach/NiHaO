<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Nihao! Selamat Datang</title>
            <link href="\register\register.css" rel="stylesheet">
            <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
            <script src="\register\register.js"></script>
            <script src="/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
            <style>
  
            </style>
        </head>

        <body>

            <header>
                <div class="logo">
                    <img src="tampilanutama/headercamera.png" alt="NIHAO Logo">
                    <h1>NiHaO</h1>
                </div>
                <nav>
                    <ul>
                        <li><a href="#home">Home</a></li>
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
                    <a href="#"><u>Log Out</u></a>
                    </div>

                </div>

                <div id="main">
                    <button class="openbtn" onclick="openNav()">&#9776;</button>
            
                </div>

                
            </header>

            <form action="/daftar" method="POST">
                                    @csrf

                                 <div class="kontainer_form">   
                                    <div class="email">
                                        <label class="form-label" for="form3Example1cg"><b>Email:</ b></label>
                                        <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="email" required />
                                    </div>

                                    <div class="username">
                                        <label class="form-label" for="form3Example4cg"><b>Username:</b></label>
                                        <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="username" required />
                                    </div>

                                    <div class="password">
                                        <label class="form-label" for="form3Example4cg"><b>Password:</b></label>
                                        <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="password" required />
                                    </div>

                                    <div class="confirm">
                                        <label class="form-label" for="form3Example4cg"><b>Konfirmasi Password:</b></label>
                                        <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="konfirmasi password" required />
                                    </div>

                                    <div class="role">
                                        <label class="form-label" for="form3Example4cg"><b>Pilih Daftar Sebagai:</b></label>
                                        <select class="form-input" name="role">
                                        <option value="user">Pengguna</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    </div>

                                    <div class="button_daftar">
                                        <button type="submit">Register</button>
                                    </div>

                                </div>


                                </form>


        </body>

        </html>
