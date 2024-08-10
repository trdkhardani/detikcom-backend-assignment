<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-warning">
    <div class="container">
        <a class="navbar-brand" href="/">Perpustakaan Digital</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $active === 'buku' ? 'active' : '' }}" href="/">Buku</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link " href="/about">About</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ $active === 'kategori' ? 'active' : '' }}" href="/kategori">Kategori</a>
                </li>

                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth {{-- jika user sudah login --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Welcome, {{ auth()->user()->username }}! {{-- menampilkan username dari user yang sedang login --}}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-house-fill"></i>Dashboard</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Log out from this site?')"><i
                                            class="bi bi-box-arrow-right"></i>Logout</button>
                                </form>
                        </ul>
                    </li>
                @else
                    {{-- jika user belum login --}}
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="/login" class="nav-link {{ $active === 'login' ? 'active' : '' }}"><i
                                    class="bi bi-box-arrow-in-right"></i>Login</a>
                        </li>
                    </ul>
                @endauth

        </div>
    </div>
</nav>
<!-- End Navbar -->

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
