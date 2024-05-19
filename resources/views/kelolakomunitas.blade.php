<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nihao! Scan Ikan Nilamu!</title>
    <link href="\komunitas\komunitas.css" rel="stylesheet">
    <link href="/bootstrap-5.3.3-dist/css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46Z
    <script src="\komunitas\komunitas.js"></script>
    <script src="/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
    <style>

    </style>
</head>

<body>

    <header>
        <div class="logo">
            <img src="/tampilanutama/headercamera.png" alt="NIHAO Logo">
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


<div class="pertama">

    <div class="welcom">
                <div class="welcome"><B>Fitur Kelola Komunitas</B></div>
                <div class="subtext"><b>Nihao! Admin, Silahkan kelola Komunitas Pengguna NiHaO disini</b>            
    </div>

</div> 


    <script>
    
    function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}

       

    </script>

    

</body>

</html>
