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


<div class="pertama">

    <div class="welcom">
                <div class="welcome"><B>Fitur Komunitas Pembudidaya!</B></div>
                <div class="subtext"><b>Nihao! Pembudidaya, di laman ini anda bisa berbagi pengetahuan atau cerita dengan Pembudidaya lainnya</b>            
    </div>

    <div class="postkontent">
                <button class="button" onclick="window.location.href='postingan'">
            <img id="uploaded-image" src="\komunitas\button_post.png" alt="Folder Icon" width="400" height="auto" />
                </button>
    
    </div>

</div> 

<div class="panel">
<div class="komusi">
        <div class="container profile">
            <div class="row">
                @foreach ($posts as $post)
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-fill ps-2">
                                    <div class="fw-bold">
                                        <a href="#" class="text-decoration-none">{{ $post->nama }}</a>
                                    </div>
                                    <div class="small text-body text-opacity-50">{{ $post->created_at->format('F d') }}</div>
                                </div>
                            </div>
                            <p>{{ $post->pesan }}</p>
                            <div class="profile-img-list">
                                <div class="profile-img-list-item main">
                                    <a href="#" data-lity="" class="profile-img-list-link">
                                        <img src="{{ asset('storage/' . $post->gambar) }}" alt="gambar" class="img-fluid post-image">
                                    </a>
                                </div>
                            </div>
                           
                            <div class="row text-center fw-bold">
                                <div class="col">
                                    <a href="#" class="text-body text-opacity-50 text-decoration-none d-block p-2">
                                        <i class="far fa-comment me-1 d-block d-sm-inline"></i> Komentar
                                    </a>
                                </div>
                            </div>
                            <hr class="mb-3 mt-1 opacity-1" />
                            
                            <div class="d-flex align-items-center">
                                <div class="flex-fill ps-2">
                                <div class="position-relative d-flex align-items-center">
                                <form method="POST" action="{{ route('comments.store') }}">
                                    @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        
                                            <input type="text" name="comment" class="form-control rounded-pill bg-white bg-opacity-15 komentar-input" placeholder="Tulis Komentar..." />
                                            <button type="submit" class="submit-komentar">
                                                <img src="/komunitas/send.png" alt="Submit" class="submit-img">
                                            </button>
                                      
                                </form>
                                    </div>  
                                </div>
                            </div>

                            <div class="komentar-list mt-3">
                                @if ($post->comments()->exists())
                                    @foreach ($post->comments as $comment)
                                        <div class="komentar-item mb-2 p-2 rounded bg-light">
                                            <strong>{{ $comment->username }}</strong>
                                            <p>{{ $comment->comment }}</p>
                                            <div class="small text-muted">{{ $comment->created_at->diffForHumans() }}</div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">Belum ada komentar.</p>
                                @endif
                                </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
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
