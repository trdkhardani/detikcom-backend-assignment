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
    <div class="list-group" style="max-width: 600px; margin: auto;">
        <h4>Klik kategori untuk memperbarui</h4>
        @foreach ($categories as $category)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <a href="/admin/edit-category/{{ $category->category_id }}" class="text-decoration-none text-dark">
                    {{ $category->category_name }}
                </a>
                <form action="/admin/delete-category/{{ $category->category_id }}" method="post"
                    onsubmit="return confirm('Apakah anda yakin ingin mengapus kategori {{ $category->category_name }}?');">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        @endforeach
    </div>
</div>

</body>
