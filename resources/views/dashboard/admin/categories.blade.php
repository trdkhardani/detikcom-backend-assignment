@include('template.header')

@include('template.navbar')

<div class="container mt-4">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <h1 class="text-center">{{ $title }}</h1>
    <h4>Klik kategori untuk memperbarui</h4>
    <div class="list-group">
        @foreach ($categories as $category)
            <a href="/admin/edit-category/{{ $category->category_id }}" class="list-group-item list-group-item-action">
                {{ $category->category_name }}
            </a>
        @endforeach
    </div>
</div>

</body>
