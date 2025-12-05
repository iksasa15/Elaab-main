@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="category-header">
            <div class="category-title-container">
                <h1 class="category-title">{{ $category->name }}</h1>
                @if($category->description)
                    <p class="category-description">{{ $category->description }}</p>
                @endif
            </div>
            <div class="back-button-container">
                <a href="{{ url('/categories') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Return to Categories
                </a>
            </div>
        </div>

        <div class="games-grid">
            @if($category->games->count() > 0)
                @foreach($category->games as $game)
                    <div class="game-card">
                        <div class="game-image" style="background-image: url('{{ $game->image }}')"></div>
                        <div class="game-info">
                            <h3 class="game-title">{{ $game->name }}</h3>
                            <div class="game-meta">
                                <span class="game-category">{{ $category->name }}</span>
                                <span class="game-rating"><i class="fas fa-star"></i> 4.8</span>
                            </div>
                            <div class="game-price">{{ $game->price_per_day }} SAR / day</div>
                            <div class="game-actions">
                                <a href="#" class="btn btn-primary btn-sm">Details</a>
                                <a href="#" class="btn btn-success btn-sm">Rent</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-games">
                    <i class="fas fa-ghost"></i>
                    <h3>No games currently available in this category</h3>
                    <p>New games will be added soon, please check back later.</p>
                </div>
            @endif
        </div>
    </div>

    <style>
        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .category-title {
            font-size: 2.2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .category-description {
            color: #6c757d;
            margin-bottom: 0;
        }

        .back-button-container {
            text-align: right;
        }

        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .game-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .game-card:hover {
            transform: translateY(-5px);
        }

        .game-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .game-info {
            padding: 20px;
        }

        .game-title {
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: #333;
        }

        .game-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .game-category {
            color: #6c757d;
            background-color: #f8f9fa;
            padding: 3px 10px;
            border-radius: 15px;
        }

        .game-rating {
            color: #ffc107;
        }

        .game-price {
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: #28a745;
        }

        .game-actions {
            display: flex;
            justify-content: space-between;
        }

        .no-games {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 0;
            background-color: #f8f9fa;
            border-radius: 10px;
            color: #6c757d;
        }

        .no-games i {
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .no-games h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .no-games p {
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
@endsection