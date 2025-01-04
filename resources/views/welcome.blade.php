<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sharia Empower</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('img/main-logo.png') }}">
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script>
    // Optional: Add functionality to the cards on hover (e.g., change text color)

    const hoverCards = document.querySelectorAll('.hover-card');

    hoverCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.querySelector('.card-title').style.color = '#333';
        });
        card.addEventListener('mouseleave', () => {
            card.querySelector('.card-title').style.color = '';
        });
    });

  </script>
</head>
<body>
    @include('layouts.navbar')
    <div style="margin-top: 1.5rem">
      <section class="hero d-flex align-items-center">
          <div class="container">
          <div class="row align-items-center">
              <div class="col-md-6">
              <h1>Selamat Datang di Bank Sharia Empower</h1>
              <p class="lead">Mulai kelola keuangan Anda dengan mudah dan aman.</p>
              <div class="d-flex gap-2">
                  <a href="{{ route('login') }}" class="btn btn-primary px-4">Masuk</a>
                  <a href="{{ route('register') }}" class="btn btn-outline-primary px-4">Daftar</a>
              </div>
              </div>
              <div class="col-md-6 d-none d-md-block">
              <img src="{{ asset('img/homepage-image1.png') }}" alt="Web Banking Hero Image" class="img-fluid">
              </div>
          </div>
          </div>
      </section>
      <section class="section-kelebihan">
          <div class="container">
            <h2>Kelebihan Web Banking Kami</h2>
            <div class="row">
              <div class="col-md-4">
                <div class="card card-primary text-center">
                  <div class="card-header">
                    <i class="fas fa-lock fa-3x"></i>
                  </div>
                  <div class="card-body bg-light">
                    <h5 class="card-title">Keamanan Terjamin</h5>
                    <p class="card-text">Sistem keamanan kami tercanggih untuk melindungi data dan transaksi Anda.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-success text-center">
                  <div class="card-header">
                    <i class="fas fa-mobile-alt fa-3x"></i>
                  </div>
                  <div class="card-body bg-light">
                    <h5 class="card-title">Akses Mudah</h5>
                    <p class="card-text">Akses web banking Anda dari mana saja dan kapan saja, dengan perangkat apa pun.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-info text-center">
                  <div class="card-header">
                    <i class="fas fa-chart-line fa-3x"></i>
                  </div>
                  <div class="card-body bg-light">
                    <h5 class="card-title">Fitur Lengkap</h5>
                    <p class="card-text">Nikmati berbagai fitur lengkap untuk mengelola keuangan Anda dengan mudah.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </section>
      <section class="section-about-us">
          <div class="container">
              <div class="row">
              <div class="col-md-8">
                  <img src="{{ asset('img/logo-with-name-black.png') }}" alt="Bank Sharia Empower Logo" class="img-fluid w-50 mb-3">
                  <h2>Tentang Kami</h2>
                  <p>Bank Sharia Empower adalah bank terpercaya yang telah melayani masyarakat selama bertahun-tahun. Kami berkomitmen untuk memberikan layanan terbaik dan solusi keuangan yang inovatif kepada para nasabah kami.</p>
                  <p>Dengan web banking kami, Anda dapat mengelola keuangan Anda dengan mudah dan aman dari mana saja dan kapan saja. Kami menawarkan berbagai fitur lengkap, seperti:</p>
                  <div class="row row-cols-1 row-cols-md-2 g-4">
                  <div class="col">
                      <div class="card hover-card">
                      <div class="card-body">
                          <i class="fas fa-money-bill-alt mb-2"></i>
                          <h5 class="card-title">Transfer Dana</h5>
                          <p class="card-text">Transfer uang dengan mudah dan cepat ke berbagai rekening.</p>
                      </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card hover-card">
                      <div class="card-body">
                          <i class="fas fa-credit-card mb-2"></i>
                          <h5 class="card-title">Pembayaran Tagihan</h5>
                          <p class="card-text">Bayar berbagai tagihan bulanan Anda dengan mudah dan tepat waktu.</p>
                      </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card hover-card">
                      <div class="card-body">
                          <i class="fas fa-mobile-alt mb-2"></i>
                          <h5 class="card-title">Isi Ulang Pulsa</h5>
                          <p class="card-text">Isi ulang pulsa Anda dan pulsa kerabat dengan mudah.</p>
                      </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card hover-card">
                      <div class="card-body">
                          <i class="fas fa-ellipsis-h mb-2"></i>
                          <h5 class="card-title">Dan Banyak Lagi</h5>
                          <p class="card-text">Nikmati berbagai fitur lainnya untuk memudahkan pengelolaan keuangan Anda.</p>
                      </div>
                      </div>
                  </div>
                  </div>
              </div>
              <div class="col-md-4 text-center">
                <a href="#" class="btn btn-primary btn-lg" style="margin-top: 2rem;">Buka Rekening Anda Sekarang</a>
                <p class="mt-3">Atau hubungi kami di <a href="tel:+62215551212">(+62) 21 555 1212</a></p>
              </div>
              </div>
          </div>
      </section>
    </div>
    <div style="margin-top: 1.5rem; border-top: outset;">
        @include('layouts.footer')
    </div>
      
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
