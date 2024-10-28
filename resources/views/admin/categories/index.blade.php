<x-head></x-head>

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
            <div class="cardHeader">
                <h2>Kategori</h2>
                <!-- Call openModal() for the add category modal when button is clicked -->
                <button class="btn-categori" onclick="openModal('categoryModal')">Tambah Kategori</button>
            </div>

            <div class="user" id="user">
                <table>
                    <thead>
                        <tr>
                            <td>Nama Kategori</td>
                            <td colspan="3">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($categories->isEmpty())
                            <tr>
                                <td colspan="6" style="padding-top: 30px; text-align:center;">Tidak Ada Kategori yang
                                    Ditambahkan</td>
                            </tr>
                        @else
                            @foreach ($categories as $categori)
                                <tr>
                                    <td>{{ $categori->name }}</td>
                                    <td>
                                        <!-- Open specific update modal for each category -->
                                        <button onclick="openModal('modal-{{ $categori->id }}')">
                                            <ion-icon name="pencil-outline"></ion-icon>
                                        </button>
                                        <form action="{{ route('admin.categories.delete', $categori->id) }}"
                                            method="POST" style="display:inline;" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this order?')">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
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
                <button type="submit" class="add-btn">Tambah</button>
            </form>
        </div>
    </div>

    <!-- Modals for updating each category -->
    @foreach ($categories as $categori)
        <div class="modal" id="modal-{{ $categori->id }}" style="display: none;">
            <div class="modal-content">
                <span class="close-btn" onclick="closeModal('modal-{{ $categori->id }}')">&times;</span>
                <h2>Update Kategori</h2>
                <form action="{{ route('admin.categories.update', $categori->id) }}" method="POST"
                    id="categories-update-{{ $categori->id }}">
                    @csrf
                    @method('PUT')
                    <label for="name">Nama Kategori:</label>
                    <input type="text" name="name" value="{{ $categori->name }}" required>
                    <button type="submit" class="add-btn">Update</button>
                </form>
            </div>
        </div>
    @endforeach

    <script src="{{ url('js/admins.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
