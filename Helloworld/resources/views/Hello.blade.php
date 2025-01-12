<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">
                        <h1>HelloWorld ({{ $n ?? '' }})</h1>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('hello.process') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="n" class="form-label">Masukkan angka:</label>
                                <input type="number" name="n" id="n" class="form-control" value="{{ $n ?? '' }}" required min="1">
                                @error('n')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Result</button>
                        </form>

                        @if (isset($result))
                            <div class="mt-3">
                                <h2>Hasil:</h2>
                                <p class="lead">{{ $result }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
