@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Create Color Palette</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .color-box {
            display: inline-block;
            width: 40px;
            height: 40px;
            margin: 0 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Create Color Palette</h2>
        <form method="POST" action="{{ url('color-palettes-store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Palette Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="is_public">Palette Visibility:</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_public" name="is_public">
                    <label class="form-check-label" for="is_public">Public</label>
                </div>
            </div>
            <div class="form-group">
                <label for="dominant_colors">Dominant Color(s):</label>
                <div class="d-flex">
                    <input type="color" class="form-control color-picker" id="dominant_color_1" name="colors[1][]" required>
                    <input type="color" class="form-control color-picker" id="dominant_color_2" name="colors[1][]">
                </div>
            </div>
            <div class="form-group">
                <label for="accent_colors">Accent Color(s):</label>
                <div class="d-flex">
                    <input type="color" class="form-control color-picker" id="accent_color_1" name="colors[2][]" required>
                    <input type="color" class="form-control color-picker" id="accent_color_2" name="colors[2][]">
                    <input type="color" class="form-control color-picker" id="accent_color_3" name="colors[2][]">
                    <input type="color" class="form-control color-picker" id="accent_color_4" name="colors[2][]">
                </div>
            </div>
            <!-- Add other fields as needed -->
            <button type="submit" class="btn btn-primary">Create Palette</button>
        </form>
    </div>

    <script>
        // Display color codes below color pickers
        const colorPickers = document.querySelectorAll('.color-picker');
        colorPickers.forEach(picker => {
            picker.addEventListener('input', () => {
                const colorCode = picker.value;
                const colorBox = picker.nextElementSibling;
                colorBox.style.backgroundColor = colorCode;
                colorBox.innerText = colorCode;
            });
        });
    </script>
</body>
</html>


@endsection
