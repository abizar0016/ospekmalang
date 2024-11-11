<x-head></x-head>

<body class="animsition">
    <!-- Header -->
    @include('components.userheader')

    <div class="container" style="margin-top: 80px">
        <div class="profile-card">
            <h2 class="mb-4">Profile Pengguna</h2>

            <!-- Profile View Mode -->
            <div id="profileView">
                <!-- Profile Picture -->
                <div class="input-row">
                    <div class="input-grup">
                        <div class="image-profile ml-3">
                            <img src="{{ $users->image ? asset($users->image) : asset('images/default-profile.jpg') }}"
                                alt="Profil Pengguna" id="imgPreview-{{ $users->id }}" class="img-preview">
                        </div>
                    </div>
                    <div class="input-grup">
                        <div class="mb-3">
                            <label>Nama:</label>
                            <input readonly type="text" id="userName" value="{{ $users->uname }}"></input>
                        </div>
                        <div class="mb-3">
                            <label>Email:</label>
                            <input readonly type="text" id="userEmail" value="{{ $users->email }}"></input>
                        </div>
                    </div>
                </div>


                <div class="input-row">
                    <div class="input-grup">
                        <div class="mb-3">
                            <label>Telepon:</label>
                            <input readonly type="text" id="userPhone" value="{{ $users->phone }}"></input>
                        </div>
                    </div>
                    <div class="input-grup">
                        <div class="mb-3">
                            <label>Tanggal Lahir:</label>
                            <input readonly type="text" id="userBirthday" value="{{ $users->dob }}"></input>
                        </div>
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-grup">
                        <div class="mb-3">
                            <label>Kota:</label>
                            <input readonly type="text" id="userCity" value="{{ $users->city }}"></input>
                        </div>
                    </div>
                    <div class="input-grup">
                        <div class="mb-3">
                            <label>Bio:</label>
                            <input type="text" readonly id="userBio" value="{{ $users->bio }}"></input>
                        </div>
                    </div>
                </div>
                <button id="editButton" class="btn">Edit</button>
            </div>

            <!-- Profile Edit Mode -->
            <div id="profileEdit" style="display: none;">
                <form action="{{ route('user.profile.update', $users->id)}}" method="POST" id="user-update-{{ $users->id }}">
                    @csrf
                    @method('PUT')
                    <!-- Profile Picture -->
                    <div class="input-row">
                        <div class="input-grup">
                            <!-- Container Gambar Profil -->
                            <div class="image-profile edit-profile ml-3"
                                onclick="document.getElementById('imageUpload').click();">
                                <img src="{{ $users->image ? asset($users->image) : asset('images/default-profile.jpg') }}"
                                    alt="Profil Pengguna" id="imgPreview" class="img-preview">
                            </div>

                            <!-- Input File (disembunyikan) -->
                            <input type="file" id="imageUpload" name="image" style="display: none;"
                                onchange="userImageUpdate()">
                        </div>
                        <div class="input-grup">
                            <div class="mb-3">
                                <label>Nama:</label>
                                <input type="text" id="userName" name="uname" value="{{ $users->uname }}"></input>
                            </div>
                            <div class="mb-3">
                                <label>Email:</label>
                                <input type="text" id="userEmail" name="email" value="{{ $users->email }}"></input>
                            </div>
                        </div>
                        
                    </div>


                    <div class="input-row">
                        <div class="input-grup">
                            <div class="mb-3">
                                <label>Telepon:</label>
                                <input type="text" id="userPhone" name="phone" value="{{ $users->phone }}"></input>
                            </div>
                        </div>
                        <div class="input-grup">
                            <div class="mb-3">
                                <label>Tanggal Lahir:</label>
                                <input type="text" id="userBirthday" name="dob" value="{{ $users->dob }}"></input>
                            </div>
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-grup">
                            <div class="mb-3">
                                <label>Kota:</label>
                                <input type="text" id="userCity" name="city" value="{{ $users->city }}"></input>
                            </div>
                        </div>
                        <div class="input-grup">
                            <div class="mb-3">
                                <label>Bio:</label>
                                <input type="text" id="userBio" name="bio" value="{{ $users->bio }}"></input>
                            </div>
                        </div>
                    </div>
                    <button id="saveButton" class="btn">Kirim</button>
                    <button id="cancelButton" class="btn">Batal</button>
                </form>
            </div>
        </div>
    </div>

    <x-script></x-script>
</body>
