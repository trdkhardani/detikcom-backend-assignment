@include('template.header')

@include('template.navbar')


    <!-- Content -->

    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-lg-5">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <main class="form-signin">
                    <h1 class="h3 mb-3 fw-normal text-center">Login Page</h1>
                    <form action="/login" method="post">
                        @csrf
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control " id="email"
                                placeholder="name@example.com" autofocus required value="">
                            <label for="email">Email</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }} {{-- secara otomatis akan menampilkan pesan error dari validasi yang kita buat di controller --}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>

                        <div class="checkbox mb-3">
                        </div>
                        <button class="w-100 btn btn-lg btn-primary bg-warning btn-outline-warning text-white"
                            type="submit">Login</button>
                    </form>
                    <small class="d-block text-center mt-3">Don't have account yet? <a href="/register">Click
                            here</a></small>
                </main>
            </div>
        </div>


    </div>
</body>

</html>
