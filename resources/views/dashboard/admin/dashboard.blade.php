@include('template.header')

@include('template.navbar')

<h1>Admin Dashboard</h1>
<h2>Welcome, {{ Auth()->user()->user_name }}</h2>
