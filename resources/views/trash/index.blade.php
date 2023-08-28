<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trash Page</title>
    <!-- Link CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2e55eb2e88.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #85E6C5;
            font-family: 'Varela Round', sans-serif;
        }

        .container {
            padding-top: 10px;
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

        .list-group-item {
            border: none;
            border-radius: 10px;
            padding: 1.5rem 1rem;
            position: relative;
            transition: background-color 0.2s ease-in-out;
            background-color: #9ED2BE;
            margin-bottom: 15px;
        }

        .list-group-item:last-child {
            margin-bottom: 0;
        }

        .list-group-item:hover {
            background-color: #C8E4B2;
        }

        .diary-image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .diary-image:hover {
            transform: scale(1.1);
        }

        .modal-title {
            font-family: 'Varela Round', sans-serif;
            font-size: 25px;
        }

        .navbar {
            background-color: #C8FFE0;
        }

        .navbar-brand {
            font-size: 24px;
            color: #435334;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #ff3b3b;
        }

        .navbar-toggler-icon {
            background-color: #435334;
        }

        .navbar-nav .nav-item {
            margin-right: 15px;
        }

        .navbar-nav .nav-link {
            color: #435334;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ff3b3b;
        }

        .navbar-nav .nav-item.active .nav-link {
            color: #ff3b3b !important;
            font-weight: bold !important;
        }

        @media (max-width: 576px) {

            .modal-body {
                max-width: 100%;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('diary.index') }}"
                style="font-family: 'Caprasimo', cursive;">MyDiary</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ request()->routeIs('diary.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('diary.index') }}">Diary</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('diary.trash') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('diary.trash') }}">Trash</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('emoji.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('emoji.index') }}">Emoji</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h1 class="text-center mb-5" style="font-family: 'Caprasimo', cursive;">Trash Page</h1>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="col-md-6">
                                <!-- Tombol/link untuk menuju halaman Diary -->
                                <a href="{{ route('diary.index') }}" class="btn btn-success"
                                    style="font-family: 'Varela Round', sans-serif;"><i
                                        class="fa-solid fa-arrow-left fa-lg"></i> &nbsp;<strong>Diary Page</strong></a>
                            </div>
                        </div>
                        <!-- Daftar diary -->
                        <ul class="list-group mt-4">
                            @foreach ($diaries as $diary)
                                <li class="list-group-item">
                                    <p>
                                        @if ($diary->image)
                                            <img src="{{ asset('storage/' . $diary->image) }}" alt="{{ $diary->title }}"
                                                class="diary-image" data-title="{{ $diary->title }}">
                                        @endif
                                    </p>
                                    <h5 style="font-family: 'Lobster', cursive;">{{ $diary->title }}</h5>
                                    <p style="font-family: 'Signika Negative', sans-serif;">{{ $diary->content }}</p>
                                    <div class="d-flex justify-content-between">
                                        <p class="font-italic text-muted"
                                            style="font-family: 'Signika Negative', sans-serif;">
                                            Dihapus : {{ $diary->deleted_at }}
                                        </p>
                                        <div>
                                            @if ($diary->reaction)
                                                <p class="text-muted"
                                                    style="font-family: 'Signika Negative', sans-serif; font-size: 18px;">
                                                    @if ($diary->reaction->emoji)
                                                        Reaksi Anda : {{ $diary->reaction->emoji }}
                                                    @else
                                                        Tidak Ada Reaksi
                                                    @endif
                                                </p>
                                            @else
                                                <p class="text-muted"
                                                    style="font-family: 'Signika Negative', sans-serif; font-size: 18px;">
                                                    Tidak Ada
                                                    Reaksi</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <!-- Form untuk memulihkan diary -->
                                        <form action="{{ route('diary.restore', $diary->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa-solid fa-trash-can-arrow-up""></i></button>
                                        </form>
                                        <!-- Form untuk menghapus diary secara permanen -->
                                        <form
                                            onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Diary Secara Permanen ?');"
                                            action="{{ route('diary.forceDelete', $diary->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger mx-2"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background-color: #C8FFE0;">
                <div class="modal-header">
                    <!-- Judul modal dengan ID imageModalLabel -->
                    <h5 class="modal-title" id="imageModalLabel">Gambar Diary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
                <div class="modal-body" style="border-radius: 10px; max-width: 90%; margin: 1rem auto;">
                    <img class="modal-image" src="" alt="Gambar Diary" id="modalImage"
                        style="max-width: 100%; max-height: 100%; border-radius: 15px;">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif

        $(document).ready(function() {
            // Menampilkan modal saat gambar diklik
            $('.diary-image').click(function() {
                var imageUrl = $(this).attr('src');
                var diaryTitle = $(this).attr('data-title'); // Ambil judul diary dari atribut data-title
                $('#modalImage').attr('src', imageUrl);

                // Ubah judul modal sesuai dengan judul diary
                $('#imageModalLabel').text('Gambar ' + diaryTitle);

                $('#imageModal').modal('show');
            });

            // Menutup modal saat tombol silang di pojok kanan atas diklik
            $('#imageModal').on('hidden.bs.modal', function() {
                $('#modalImage').attr('src', '');
                $('#imageModalLabel').text('Gambar Diary'); // Kembalikan judul modal ke nilai awal
            });
        });
    </script>
</body>

</html>
