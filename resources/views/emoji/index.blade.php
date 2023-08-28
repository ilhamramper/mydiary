<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Emoji</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caprasimo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2e55eb2e88.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #85E6C5;
            font-family: 'Varela Round', sans-serif;
        }

        .container {
            margin-top: 30px;
            padding: 20px;
            background-color: #C8FFE0;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px 15px;
            text-align: center;
        }

        th {
            background-color: #435334;
            color: whitesmoke;
            font-weight: 600;
        }

        tr {
            background-color: #9EB384;
        }

        tr:nth-child(even) {
            background-color: #CEDEBD;
        }

        .btn-primary {
            background-color: #ff3b3b;
            border-color: #ff3b3b;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
        }

        .btn-delete {
            background-color: #ff3b3b;
            border-color: #ff3b3b;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
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

    <div class="container mt-4">
        <h1 class="text-center" style="font-family: 'Signika Negative', sans-serif;"><strong>List Emoji</strong></h1>
        <a href="{{ route('emoji.create') }}" class="btn btn-primary mt-1 mb-1"><i
                class="fa-solid fa-square-plus fa-lg"></i> &nbsp;<strong>New Emoji</strong></a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Unicode Hex</th>
                    <th>Emoji</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emojis as $emoji)
                    <tr>
                        <td class="align-middle">{{ $emoji->unicode_hex }}</td>
                        <td style="font-size: 25px;">{!! $emoji->emoji !!}</td>
                        <td>
                            <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Emoji ?');"
                                action="{{ route('emoji.destroy', $emoji->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        //message with toastr
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
</body>

</html>
