    <x-head></x-head>

    <x-sidebaradmin></x-sidebaradmin>

    <div class="main">
        <x-topbaradmin></x-topbaradmin>
        <div class="detail">
            <div class="user" id="user">
                <div class="cardHeader">
                    <h2>Pesan</h2>
                    <button onclick="openAddMessageModal()">+</button>
                </div>

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
                        @foreach ($messages as $message)
                            <tr>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->content }}</td>
                                <td>{{ $message->user->uname }}</td>
                                <td>
                                    <button onclick="openReplyModal({{ $message->id }})">Balas</button>
                                    <button>Perbarui</button>
                                    <button>Hapus</button>
                                </td>
                            </tr>
                            @foreach ($message->replies as $reply)
                                <tr>
                                    <td>-- {{ $reply->name }}</td>
                                    <td>-- {{ $reply->content }}</td>
                                    <td>-- {{ $reply->user->uname }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk balasan -->
    <div id="replyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeReplyModal()">&times;</span>
            <h2>Balas Pesan</h2>
            <form action="{{ route('admin.message.save') }}" method="POST">
                @csrf

                <input type="hidden" id="replyParentId" name="parent_id">
                <label for="messageName">Nama:</label>
                <input type="text" id="messageName" name="messageName" value="{{ $currentUser->uname }}" readonly>


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
            <form action="{{ route('admin.message.save') }}" method="POST">
                @csrf
                <input type="hidden" id="replyParentId" name="parent_id">
                <label for="messageName">Nama:</label>
                <input type="text" id="messageName" name="messageName" value="{{ $currentUser->uname }}" readonly>

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


    <script src="{{ url('js/admin.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
