@extends('layouts.app')

@section('content')

    <div class="featured-section">
        <div class="container featured-content">
            <div class="featured-tag">Featured Game</div>
            <h1 class="featured-title">Silent Hill 4</h1>
            <p class="featured-subtitle">The most terrifying horror adventure.</p>

            <div class="call-to-action">
                <a href="#best-rentals-section" class="btn btn-primary">Rent Now</a>
            </div>
        </div>
    </div>

    <section class="category-section">
        <div class="container">
            <!-- Categories section -->
            <div class="main-categories">
                <div class="section-header">
                    <h2 class="section-title">Game Categories</h2>
                </div>

                <div class="categories-wrapper">
                    <a href="#all-categories" class="category-badge">All Categories</a>
                    @foreach ($categories as $category)
                        <a href="#category-{{ $category->id }}" class="category-badge">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            @foreach ($categories as $category)
                <div id="category-{{ $category->id }}" class="category-block">
                    <div class="section-header">
                        <h2 class="section-title">{{ $category->name }}</h2>
                        <a href="#" class="see-all">See All</a>
                    </div>

                    <div class="carousel-container" id="category-{{ $category->id }}-carousel">
                        <button class="carousel-button prev">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <div class="carousel-wrapper">
                            @foreach ($category->games as $game)
                                <div class="game-card">
                                    <div class="game-image" style="background-image: url('{{ $game->image }}')"></div>
                                    <div class="game-info">
                                        <h3 class="game-title">{{ $game->name }}</h3>
                                        <div class="game-meta">
                                            <span class="game-category">{{ $category->name }}</span>
                                            <span class="game-rating"><i class="fas fa-star"></i> 4.8</span>
                                        </div>
                                        <div class="game-price">$10 / day</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-button next">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

    </section>

    <div class="contact-section">
        <div class="container">
            <h2 class="contact-title">Stay Updated</h2>
            <p class="contact-subtitle">Subscribe to get latest offers & new games.</p>

            <form id="contact-form" class="email-form">
                <input type="email" class="email-input" placeholder="Your email address" required>
                <button type="submit" class="submit-button">Subscribe</button>
            </form>
        </div>
    </div>

@endsection

@section('styles')
    <style>
        .main-categories {
            margin-bottom: 40px;
            background-color: var(--card-background);
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
        }

        .categories-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 15px 0 5px;
        }

        .category-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: var(--primary-text);
            padding: 10px 20px;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(108, 92, 231, 0.2);
        }

        .category-badge:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(108, 92, 231, 0.3);
            color: white;
            text-decoration: none;
        }

        .category-block {
            scroll-margin-top: 100px;
            margin-bottom: 60px;
        }
    </style>
@endsection