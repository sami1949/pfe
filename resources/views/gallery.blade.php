<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Galerie - Élégance Vibe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- مهم للريسبونسيف -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            padding: 30px;
            background-color: #fffBE9;
            margin: 0;
        }

        h2 {
            color: #CEAB93;
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            text-align: center;
            margin-bottom: 30px;
        }

        .filters {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }

        .filters a {
            padding: 10px 20px;
            background-color: #f1e4e6;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: 0.3s;
        }

        .filters a:hover {
            background-color: #e3c0c2;
        }

        .filters .active {
            background-color: #CEAB93;
            color: white;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .gallery img {
            width: 100%;
            height: 330px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .scroll-down-container {
            position: fixed;
            top: 40%;
            right: 20px;
            z-index: 999;
        }

        .scroll-down {
            background-color: #CEAB93;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 26px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: transform 0.2s;
        }

        .scroll-down:hover {
            transform: scale(1.1);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .gallery {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .gallery {
                grid-template-columns: 1fr;
            }

            .scroll-down-container {
                right: 10px;
                top: 85%;
            }

            .scroll-down {
                width: 45px;
                height: 45px;
                font-size: 22px;
            }
        }
    </style>
</head>
<body>

    <h2>Galerie Élégance Vibe</h2>
    <p>Découvrez en images l’univers chic et raffiné d’Élégance Vibe, où chaque détail célèbre la beauté.</p>

    <div class="filters">
        <a href="{{ route('galerie', ['gender' => 'all']) }}" class="{{ $gender == 'all' ? 'active' : '' }}">Tous</a>
        <a href="{{ route('galerie', ['gender' => 'women']) }}" class="{{ $gender == 'women' ? 'active' : '' }}">Femmes</a>
        <a href="{{ route('galerie', ['gender' => 'men']) }}" class="{{ $gender == 'men' ? 'active' : '' }}">Hommes</a>
    </div>

    <div class="scroll-down-container">
        <button onclick="scrollToGalleryEnd()" class="scroll-down">↓</button>
    </div>

    <div class="gallery">
        @foreach ($images as $img)
            <img src="{{ asset($img['url']) }}" alt="photo">
        @endforeach
    </div>

    <div id="gallery-end" style="padding-bottom: 50px;"></div>

    <script>
        function scrollToGalleryEnd() {
            document.getElementById("gallery-end").scrollIntoView({ behavior: 'smooth' });
        }
    </script>

</body>
</html>
