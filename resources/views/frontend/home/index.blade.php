<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homes List</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .home-card {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .tag-filter {
            margin: 20px 0;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 4px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }
        .tag-button {
            padding: 8px 16px;
            border: 2px solid #ddd;
            border-radius: 20px;
            background: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        .tag-button:hover {
            background: #e9ecef;
        }
        .tag-button.active {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }
        .hidden {
            display: none;
        }
        .home-image {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin: 10px 0;
        }
        .tag-badge {
            display: inline-block;
            padding: 4px 8px;
            margin: 2px;
            background: #e9ecef;
            border-radius: 4px;
            font-size: 14px;
        }
        .home-title {
            color: #333;
            text-decoration: none;
            font-size: 24px;
        }
        .home-title:hover {
            color: #007bff;
        }
        .home-description {
            color: #666;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Our Homes</h1>

        <!-- Horizontal Tag Filter -->
        <div class="tag-filter">
            <button class="tag-button active" data-tag="all">All Homes</button>
            @php
                $uniqueTags = $homes->flatMap(function($home) {
                    return $home->taghomes;
                })->unique('id')->values();
            @endphp
            @foreach ($uniqueTags as $tag)
                <button class="tag-button" data-tag="{{ $tag->id }}">
                    {{ $tag->name }}
                </button>
            @endforeach
        </div>

        <!-- Homes List -->
        <div id="homes-container">
            @foreach ($homes as $home)
                <div class="home-card"
                     data-tags="{{ $home->taghomes->pluck('id')->join(',') }}">
                    <h2>
                        <a href="{{ route('page.homes.show', $home->id) }}" class="home-title">
                            {{ $home->title }}
                        </a>
                    </h2>

                    <p class="home-description">{{ $home->description }}</p>

                    @if ($home->main_image)
                        <img src="{{ Storage::url($home->main_image) }}"
                             alt="{{ $home->title }}"
                             class="home-image">
                    @elseif ($home->homeImages->isNotEmpty())
                        <img src="{{ Storage::url($home->homeImages->first()->image_path) }}"
                             alt="{{ $home->title }}"
                             class="home-image">
                    @endif

                    <div class="tags">
                        <h3>Tags:</h3>
                        @foreach ($home->taghomes as $tag)
                            <span class="tag-badge">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tagButtons = document.querySelectorAll('.tag-button');

            tagButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    tagButtons.forEach(btn => btn.classList.remove('active'));

                    // Add active class to clicked button
                    this.classList.add('active');

                    // Get selected tag
                    const selectedTag = this.dataset.tag;

                    // Filter homes
                    filterHomes(selectedTag);
                });
            });
        });

        function filterHomes(selectedTag) {
            const homes = document.querySelectorAll('.home-card');

            homes.forEach(home => {
                if (selectedTag === 'all') {
                    home.classList.remove('hidden');
                    return;
                }

                const homeTags = home.dataset.tags.split(',');
                if (homeTags.includes(selectedTag)) {
                    home.classList.remove('hidden');
                } else {
                    home.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>
