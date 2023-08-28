<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Diary</title>
    <!-- Link CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2e55eb2e88.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #85E6C5;
        }

        .container {
            padding-top: 30px;
            padding-bottom: 30px;
            border-radius: 10px;
            background-color: #85E6C5;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            background-color: #C8FFE0;
        }

        @media (max-width: 576px) {
            .container {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary float-right"
                                onclick="window.location.href='{{ route('diary.index') }}'">
                                <i class="fa-solid fa-times"></i>
                            </button>
                        </div>
                        <div class="mt-4">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('diary.store') }}"
                                method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="form-group">
                                    <label class="font-weight-bold"
                                        style="font-family: 'Signika Negative', sans-serif;">GAMBAR</label>
                                    <input style="font-family: 'Varela Round', sans-serif;" type="file"
                                        class="form-control @error('image') is-invalid @enderror" name="image">

                                    <!-- error message untuk title -->
                                    @error('image')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold"
                                        style="font-family: 'Signika Negative', sans-serif;">JUDUL</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ old('title') }}" placeholder="Masukkan Judul Post"
                                        style="font-family: 'Varela Round', sans-serif;">

                                    <!-- error message untuk title -->
                                    @error('title')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold"
                                        style="font-family: 'Signika Negative', sans-serif;">KONTEN</label>
                                    <textarea style="font-family: 'Varela Round', sans-serif;" class="form-control @error('content') is-invalid @enderror"
                                        name="content" rows="5" placeholder="Masukkan Konten Post">{{ old('content') }}</textarea>

                                    <!-- error message untuk content -->
                                    @error('content')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="font-family: 'Signika Negative', sans-serif;" for="emoji"
                                        class="font-weight-bold">EMOJI</label>
                                    <select style="font-family: 'Varela Round', sans-serif;" class="form-control"
                                        id="emoji" name="emoji">
                                        <option value="">Pilih Emoji</option>
                                        @foreach ($emojis as $emoji)
                                            <option value="{{ $emoji->id }}">
                                                {{ $emoji->emoji }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary"><i
                                        class="fa-solid fa-floppy-disk"></i></button>
                                <button type="reset" class="btn btn-danger mx-2"><i
                                        class="fa-solid fa-rotate-left"></i></button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
