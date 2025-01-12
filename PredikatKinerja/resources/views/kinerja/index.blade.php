<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediksi Kinerja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        #hasil-prediksi {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Prediksi Kinerja Pegawai</h1>

        <div class="form-group">
            <label for="hasil_kerja">Hasil Kerja:</label>
            <select class="form-control" id="hasil_kerja">
                <option value="Diatas ekspektasi">Diatas Ekspektasi</option>
                <option value="Sesuai ekspektasi">Sesuai Ekspektasi</option>
                <option value="Dibawah ekspektasi">Dibawah Ekspektasi</option>
            </select>
        </div>

        <div class="form-group">
            <label for="perilaku">Perilaku:</label>
            <select class="form-control" id="perilaku">
                <option value="Diatas ekspektasi">Diatas Ekspektasi</option>
                <option value="Sesuai ekspektasi">Sesuai Ekspektasi</option>
                <option value="Dibawah ekspektasi">Dibawah Ekspektasi</option>
            </select>
        </div>

        <button class="btn btn-primary" id="prediksi-button">Prediksi</button>

        <div id="hasil-prediksi">
            Hasil Prediksi: <span id="hasil"></span>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#prediksi-button').click(function() {
                var hasil_kerja = $('#hasil_kerja').val();
                var perilaku = $('#perilaku').val();

                $.ajax({
                    url: '/prediksi',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        hasil_kerja: hasil_kerja,
                        perilaku: perilaku
                    },
                    success: function(response) {
                        $('#hasil').text(response.prediksi);
                    },
                    error: function(error) {
                      console.log(error);
                      alert("Terjadi kesalahan. Silakan coba lagi.");
                    }
                });
            });
        });
    </script>
</body>
</html>
