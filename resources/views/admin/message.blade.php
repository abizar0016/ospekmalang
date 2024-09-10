    <x-head></x-head>

    <x-sidebaradmin></x-sidebaradmin>

    <div class="main">
        <x-topbaradmin></x-topbaradmin>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="detail">
            <div class="user" id="user">
                <div class="cardHeader">
                    <h2>Pesan</h2>
                    <button onclick="openAddMessageModal()">+</button>
                </div>

                <!-- Dalam view admin.message -->
                <table>
                    <thead>
                        <tr>
                            <td>Nama</td>
                            <td>Pesan</td>
                            <td>Tujuan</td>
                            <td colspan="3">aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($messages->isEmpty())
                            <tr>
                                <td colspan="4" style="padding-top: 30px; text-align:center;">Tidak ada pesan yang
                                    ditemukan.</td>
                            </tr>
                        @else
                            @foreach ($messages as $message)
                                <tr>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->content }}</td>
                                    <!-- Periksa apakah user tidak null sebelum akses uname -->
                                    <td>{{ $message->user ? $message->user->uname : 'Tidak diketahui' }}</td>
                                    <td>
                                        <button onclick="openReplyModal({{ $message->id }})"><ion-icon
                                                name="arrow-redo-circle-outline"></ion-icon></button>
                                        <form action="{{ route('admin.message.destroy', $message->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"><ion-icon name="trash-outline"></ion-icon></button>
                                        </form>
                                    </td>
                                </tr>
                                @foreach ($message->replies as $reply)
                                    <tr>
                                        <td>-- {{ $reply->name }}</td>
                                        <td>-- {{ $reply->content }}</td>
                                        <!-- Periksa apakah user tidak null sebelum akses uname -->
                                        <td>-- {{ $reply->user ? $reply->user->uname : 'Tidak diketahui' }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal untuk balasan -->
    @if (@isset($message))
        <div id="replyModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeReplyModal()">&times;</span>
                <h2>Balas Pesan</h2>
                <form action="" method="POST">
                    @csrf

                    <input type="hidden" id="replyParentId" name="parent_id">
                    <label for="messageName">Nama:</label>
                    <input type="text" id="messageName" name="messageName" value="{{ $userCount->uname }}" readonly>


                    <label for="messageContent">Pesan:</label>
                    <textarea id="messageContent" name="messageContent" readonly>{{ $message->content }}</textarea>

                    <label for="reply">Balasan:</label>
                    <textarea name="replyName" id="replyName" required></textarea>

                    <button type="submit">Kirim</button>
                </form>
            </div>
        </div>

        <!-- Modal untuk menambahkan pesan -->
        <div id="addMessageModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeAddMessageModal()">&times;</span>
                <h2>Tambah Pesan</h2>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" id="replyParentId" name="parent_id">

                    <label for="messageName">Nama:</label>
                    <input type="text" id="messageName" name="messageName" value="{{ $currentUser->uname }}"
                        readonly>

                    <label for="messageContent">Pesan:</label>
                    <textarea id="messageContent" name="messageContent" required></textarea>

                    <label for="messageTarget">Tujuan:</label>
                    <select id="messageTarget" name="messageTarget" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->userid }}">{{ $user->uname }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Kirim</button>

                </form>
            </div>
        </div>
    @endif


    <script src="{{ url('js/admin.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
