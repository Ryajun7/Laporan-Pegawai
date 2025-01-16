<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            background-color: #fff;
        }

        .register-form {
            max-width: 400px;
            margin: 20px auto;
            /* Added top/bottom margin for spacing */
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            /* Added a subtle shadow */
        }

        .dropdown-menu.show {
            background-color: #fff;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            background-color: #d4edda;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">Register</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="/register" class="register-form">
                    @csrf
                    <div class="mb-3">
                        <label for="NIP" class="form-label">NIP</label>
                        <input type="text" name="NIP" id="NIP" class="form-control" placeholder="Enter NIP"
                            required value="{{ old('NIP') }}">
                    </div>
                    <div class="mb-3">
                        <label for="Nama" class="form-label">Nama</label>
                        <input type="text" name="Nama" id="Nama" class="form-control"
                            placeholder="Enter Nama" required value="{{ old('Nama') }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Enter Email" required value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="Jabatan" class="form-label">Jabatan</label>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle w-100" type="button" id="dropdownJabatan"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ old('Jabatan') ? old('Jabatan') : 'Pilih Jabatan' }}
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="dropdownJabatan">
                                <li><a class="dropdown-item" href="#" data-value="Kepala Dinas">Kepala Dinas</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-value="Kepala Bidang">Kepala Bidang</a>
                                </li>
                                <li><a class="dropdown-item" href="#" data-value="Pegawai">Pegawai</a></li>
                            </ul>
                            <input type="hidden" name="Jabatan" id="jabatanInput" value="{{ old('Jabatan') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Enter Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control" placeholder="Konfirmasi Password" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>
                <div class="text-center mt-3">
                    Sudah punya akun? <a href="/">Login</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownItems = document.querySelectorAll('.dropdown-item');
            const dropdownButton = document.getElementById('dropdownJabatan');
            const jabatanInput = document.getElementById('jabatanInput');

            dropdownItems.forEach(item => {
                item.addEventListener('click', function(event) {
                    event.preventDefault();
                    const value = this.dataset.value;
                    dropdownButton.textContent = this.textContent;
                    jabatanInput.value = value;
                });
            });
        });
    </script>
</body>

</html>
