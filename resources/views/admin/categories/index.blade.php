<x-head></x-head>
<link rel="stylesheet" type="text/css" href="{{ url('css/admin.css') }}">

<body class="animation">
    <x-sidebaradmin></x-sidebaradmin>

    <div class="main">
        <x-topbaradmin></x-topbaradmin>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="detail">
            <div class="cardHeader mt-5">
                <h2>Kategori</h2>
                <!-- Call openModal() for the add category modal when button is clicked -->
                <button class="link" onclick="openModal('categoryModal')">Tambah Kategori</button>
            </div>

            <div class="user" id="user">
                <table>
                    <thead>
                        <tr>
                            <th style="padding-right: 50rem">Nama Kategori</th>
                            <th colspan="2" class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($categories->isEmpty())
                            <tr>
                                <td colspan="2" style="padding-top: 1.875rem; text-align:center;">Tidak Ada Kategori
                                    yang
                                    Ditambahkan</td>
                            </tr>
                        @else
                            @foreach ($categories as $categori)
                                <tr>
                                    <td>{{ $categori->name }}</td>
                                    <td>
                                        <!-- Open specific update modal for each category -->
                                        <button class="aksi-button" onclick="openModal('modal-{{ $categori->id }}')">
                                            Perbarui </button>
                                        <form id="delete-form-{{ $categori->id }}"
                                            action="{{ route('admin.categories.delete', $categori->id) }}"
                                            method="POST" style="display:inline;" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button class="aksi-button delete-button" type="button"
                                                data-form-id="delete-form-{{ $categori->id }}"
                                                data-item-name="{{ $categori->name }}">
                                                Hapus
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                @if ($categories->hasPages())
                    <div class="pagination">
                        @if ($categories->onFirstPage())
                            <span class="page-item disabled">Previous</span>
                        @else
                            <a class="page-item" href="{{ $categories->previousPageUrl() }}">Previous</a>
                        @endif

                        @for ($i = 1; $i <= $categories->lastPage(); $i++)
                            <a class="page-item {{ $i == $categories->currentPage() ? 'active' : '' }}"
                                href="{{ $categories->url($i) }}">{{ $i }}</a>
                        @endfor

                        @if ($categories->hasMorePages())
                            <a class="page-item" href="{{ $categories->nextPageUrl() }}">Next</a>
                        @else
                            <span class="page-item disabled">Next</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal for adding category -->
    <div class="modal" id="categoryModal" style="display: none;">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('categoryModal')">&times;</span>
            <h2>Tambah Kategori</h2>
            <form action="{{ route('admin.categories.add') }}" method="POST" id="categories-add">
                @csrf
                <label for="name">Nama Kategori:</label>
                <input type="text" id="name" name="name" required>
                <button type="submit" class="submit-btn">Kirim</button>
            </form>
        </div>
    </div>

    <!-- Modals for updating each category -->
    @foreach ($categories as $categori)
        <div class="modal" id="modal-{{ $categori->id }}" style="display: none;">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal('modal-{{ $categori->id }}')">&times;</button>
                <h2>Update Kategori</h2>
                <form action="{{ route('admin.categories.update', $categori->id) }}" method="POST"
                    id="categories-update-{{ $categori->id }}">
                    @csrf
                    @method('PUT')
                    <label for="name">Nama Kategori:</label>
                    <input type="text" name="name" value="{{ $categori->name }}" required>
                    <button type="submit" class="submit-btn">Kirim</button>
                </form>
            </div>
        </div>
    @endforeach

    <script src="{{ url('js/admins.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{ url('vendor/sweetalert/sweetalert.min.js') }}"></script>
