<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $home->title }}</title>
</head>
<body>
    <h1>{{ $home->title }}</h1>
    <p>{{ $home->description }}</p>

    @if ($home->main_image)
        <img src="{{ $home->main_image ? \Storage::url($home->main_image) : '' }}" alt="{{ $home->title }}" width="300">
    @endif

    <h2>Images:</h2>
    @if ($home->homeImages->isNotEmpty())
        @foreach ($home->homeImages as $image)
            <img src="{{ $image->image ? \Storage::url($image->image) : '' }}" alt="{{ $image->caption }}" width="150">
        @endforeach
    @else
        <p>No images available.</p>
    @endif

    <a href="{{ route('page.homes.index') }}">Back to Home List</a>
</body>
</html>
