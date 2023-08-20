@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Public Color Palettes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .color-box {
            display: inline-block;
            width: 30px;
            height: 30px;
            margin: 0 5px;
            border: 1px solid #ccc;
        }
        
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Public Color Palettes</h2>
        <div class="row">
            <div class="col-md-4">
                <form action="{{ url('search-by-color') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Search by color code or name">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Color Palette Name</th>
                    <th>Colors</th>
                    @auth
                    <th>Favorite</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($colorPalettes as $palette)
                    <tr>
                        <td>{{ $palette->name }}</td>
                        <td>
                            <div class="d-flex">
                                @foreach ($palette->colors as $color)
                                    <span class="color-box" style="background-color: {{ $color->color_code }}">COLOR</span>
                                @endforeach
                            </div>
                        </td>
                         @auth
                        <td>
                          
                            <input type="checkbox" class="favorite-toggle" data-palette-id="{{ $palette->id }}" {{ $palette->is_favorite ? 'checked' : '' }}>
                            
                        </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
    // Toggle favorite
    const favoriteToggles = document.querySelectorAll('.favorite-toggle');
    favoriteToggles.forEach(toggle => {
        toggle.addEventListener('change', () => {
            const paletteId = toggle.dataset.paletteId;
            const isFavorite = toggle.checked;

            // Implement logic to update favorite status via AJAX
            const formData = new FormData();
            formData.append('is_favorite', isFavorite);

            fetch(`color-palettes/${paletteId}/favorite`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                // You can handle the response data here
                console.log(data.message);
            })
            .catch(error => {
                // Handle error
                console.error('Error:', error);
            });
        });
    });
</script>

</body>
</html>

@endsection

