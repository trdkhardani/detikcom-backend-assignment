@include('template.header')
<body>
    @include('template.navbar')

    <h1>Dashboard</h1>
    @auth
    <h3>Selamat Datang, {{ auth()->user()->user_name }}!</h3>
    @endauth
</body>
