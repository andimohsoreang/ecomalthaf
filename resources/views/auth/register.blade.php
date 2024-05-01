<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Regis | MiraShop</title>
    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Particle.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-container {
            position: relative;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            z-index: 1;
            transition: border-color 0.3s ease;
            /* Transisi perubahan warna border */
        }


        .login-container:hover {
            border-color: #28a745;
            /* Warna border hijau saat dihover */
        }

        .login-container h2 {
            color: #333333;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-group label {
            color: #666666;
            font-weight: 500;
        }

        .btn-custom {
            background-color: #28a745;
            color: #ffffff;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #218838;
        }

        .logo-img {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto 30px;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            background-color: #f8f9fa;
            /* Warna latar belakang Particle.js */
        }

        /* Warna latar belakang tag a */
        .register-link {
            color: #28a745 !important;
            /* Warna hijau untuk tag a */
        }
    </style>
</head>

<body>
    <div id="particles-js"></div>
    <div class="login-container" id="loginContainer">
        <img src="asset/mirashop.png" alt="Logo" class="img-fluid logo-img">
        <h2>Login</h2>
        <form action="{{ route('doRegis') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                @error('name')
                    <small class="text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                @error('email')
                    <small class="text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                @error('password')
                    <small class="text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="tel" class="form-control" id="phone" name="phone"
                    placeholder="Enter phone number">
                @error('phone')
                    <small class="text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea class="form-control" id="address" name="address" placeholder="Enter your address" rows="3"></textarea>
                 @error('address')
                    <small class="text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-custom btn-block">Login</button>
        </form>
        <div class="div mt-4 text-center">
            <small>Belum Punya Akun ?</small> <br>
            <a href="#" class="register-link">Daftar Disini Dulu Dong!</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: '#28a745' /* Warna hijau untuk partikel */
                },
                shape: {
                    type: 'circle',
                    stroke: {
                        width: 0,
                        color: '#000000'
                    },
                    polygon: {
                        nb_sides: 5
                    },
                    image: {
                        src: 'img/github.svg',
                        width: 100,
                        height: 100
                    }
                },
                opacity: {
                    value: 0.5,
                    random: false,
                    anim: {
                        enable: false,
                        speed: 1,
                        opacity_min: 0.1,
                        sync: false
                    }
                },
                size: {
                    value: 3,
                    random: true,
                    anim: {
                        enable: false,
                        speed: 40,
                        size_min: 0.1,
                        sync: false
                    }
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#28a745',
                    /* Warna hijau untuk garis */
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 6,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false,
                    attract: {
                        enable: false,
                        rotateX: 600,
                        rotateY: 1200
                    }
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'repulse'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 400,
                        line_linked: {
                            opacity: 1
                        }
                    },
                    bubble: {
                        distance: 400,
                        size: 40,
                        duration: 2,
                        opacity: 8,
                        speed: 3
                    },
                    repulse: {
                        distance: 200,
                        duration: 0.4
                    },
                    push: {
                        particles_nb: 4
                    },
                    remove: {
                        particles_nb: 2
                    }
                }
            },
            retina_detect: true
        });

        // JavaScript untuk mengubah warna border form saat dihover
        const loginContainer = document.getElementById('loginContainer');
        loginContainer.addEventListener('mouseenter', function() {
            this.style.borderColor = '#28a745'; // Warna border hijau saat dihover
        });
        loginContainer.addEventListener('mouseleave', function() {
            this.style.borderColor = '#dee2e6'; // Kembalikan warna border saat tidak dihover
        });
    </script>
</body>

</html>
