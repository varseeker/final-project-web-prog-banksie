<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sharia Empower</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/main-logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    
    <style>
        body {
            font-family: sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #222;
            padding: 0 20px;
        }
        .sidebar-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-list li {
            margin-bottom: 10px;
        }
        .sidebar-list a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.3s;
        }
        .sidebar-list a:hover {
            background-color: #333;
        }
        .main-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    @include('layouts/navbar')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                <ul class="sidebar-list">
                    {{-- <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="{{ route('admin.users') }}"><i class="fas fa-users"></i> Pengguna</a></li>
                    <li><a href="{{ route('admin.products') }}"><i class="fas fa-shopping-cart"></i> Produk</a></li>
                    <li><a href="{{ route('admin.orders') }}"><i class="fas fa-file-invoice"></i> Pesanan</a></li> --}}
                    </ul>
            </div>
            <div class="col-md-9 main-content">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts/footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5qIC8NBTov41p" crossorigin="anonymous"></script>
</body>
</html>
