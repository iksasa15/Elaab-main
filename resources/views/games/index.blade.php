@extends('layouts.app')

@section('title', 'All Games - El3bha')

@section('content')
    <div class="games-header">
        <div class="container">
            <div class="games-header-content">
                <h1 class="games-title">Browse All Games</h1>
                <p class="games-subtitle">Discover and rent from our collection of games</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="games-filter-bar">
            <div class="filter-section">
                <div class="filter-title">Filter by Category:</div>
                <div class="filter-options">
                    <a href="{{ route('games.index') }}" class="filter-option {{ !request()->has('category') ? 'active' : '' }}">All Games</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('games.index', ['category' => $category->id]) }}" 
                           class="filter-option {{ request('category') == $category->id ? 'active' : '' }}">
                           {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <div class="sort-section">
                <div class="sort-title">Sort by:</div>
                <select id="sort-options" class="sort-select" onchange="window.location = this.value;">
                    <option value="{{ route('games.index', array_merge(request()->except('sort'), ['sort' => 'default'])) }}" 
                            {{ $sortBy == 'default' ? 'selected' : '' }}>Default</option>
                    <option value="{{ route('games.index', array_merge(request()->except('sort'), ['sort' => 'a-z'])) }}" 
                            {{ $sortBy == 'a-z' ? 'selected' : '' }}>Name (A-Z)</option>
                    <option value="{{ route('games.index', array_merge(request()->except('sort'), ['sort' => 'z-a'])) }}" 
                            {{ $sortBy == 'z-a' ? 'selected' : '' }}>Name (Z-A)</option>
                    <option value="{{ route('games.index', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" 
                            {{ $sortBy == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="{{ route('games.index', array_merge(request()->except('sort'), ['sort' => 'popular'])) }}" 
                            {{ $sortBy == 'popular' ? 'selected' : '' }}>Most Popular</option>
                </select>
            </div>
        </div>

        <div class="games-grid">
            @if($games->count() > 0)
                @foreach($games as $game)
                    <div class="game-card" onclick="showGameModal('{{ $game->id }}', '{{ $game->name }}', '{{ $game->description }}', '{{ $game->category->name }}', '{{ $game->platform }}', '{{ $game->image }}', '{{ $game->price_per_day }}')">
                        <div class="game-image" style="background-image: url('{{ $game->image }}')"></div>
                        <div class="game-info">
                            <h3 class="game-title">{{ $game->name }}</h3>
                            <div class="game-meta">
                                <span class="game-category">{{ $game->category->name }}</span>
                                <span class="game-platform">{{ $game->platform }}</span>
                            </div>
                            <div class="game-price">{{ $game->price_per_day }} SAR / day</div>
                            <div class="game-actions">
                                <button class="btn-view-details">View Details</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-games-found">
                    <div class="no-games-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <h2>No games found</h2>
                    <p>Try changing your filters or check back later for new games.</p>
                </div>
            @endif
        </div>

        <div class="pagination-container">
            {{ $games->appends(request()->except('page'))->links() }}
        </div>
    </div>
@endsection

@section('styles')
<style>
    /* Games header styles */
    .games-header {
        background: linear-gradient(135deg, #3A1C71 0%, #D76D77 50%, #FFAF7B 100%);
        padding: 60px 0;
        text-align: center;
        color: white;
        margin-bottom: 40px;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    }

    .games-header-content {
        max-width: 800px;
        margin: 0 auto;
    }

    .games-title {
        font-size: 48px;
        font-weight: 800;
        margin-bottom: 15px;
        text-transform: uppercase;
        line-height: 1.1;
        letter-spacing: -1px;
        text-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.8s ease-out;
    }

    .games-subtitle {
        font-size: 20px;
        opacity: 0.9;
        margin-bottom: 0;
        animation: fadeInUp 1s ease-out;
    }

    /* Filter bar styles */
    .games-filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: var(--card-background);
        border-radius: var(--border-radius);
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: var(--card-shadow);
        flex-wrap: wrap;
    }

    .filter-section, .sort-section {
        margin: 5px 0;
    }

    .filter-title, .sort-title {
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--primary-text);
    }

    .filter-options {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .filter-option {
        display: inline-block;
        padding: 8px 16px;
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        color: var(--secondary-text);
        text-decoration: none;
        transition: all var(--transition-speed);
        font-size: 14px;
    }

    .filter-option:hover {
        background-color: rgba(108, 92, 231, 0.2);
        color: var(--primary-text);
    }

    .filter-option.active {
        background-color: var(--primary-color);
        color: white;
    }

    .sort-select {
        padding: 10px 15px;
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--border-radius);
        color: var(--primary-text);
        min-width: 180px;
        font-size: 14px;
        cursor: pointer;
    }

    .sort-select:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    /* Games grid styles */
    .games-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .game-actions {
        margin-top: 15px;
    }

    .btn-view-details {
        width: 100%;
        padding: 8px;
        background-color: var(--secondary-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-size: 14px;
        cursor: pointer;
        transition: all var(--transition-speed);
    }

    .btn-view-details:hover {
        background-color: var(--secondary-hover);
        transform: translateY(-2px);
    }

    .game-platform {
        color: var(--secondary-text);
        font-size: 14px;
        background-color: rgba(9, 132, 227, 0.1);
        padding: 5px 12px;
        border-radius: 20px;
    }

    /* Empty state */
    .no-games-found {
        grid-column: 1 / -1;
        text-align: center;
        background-color: var(--card-background);
        padding: 60px 20px;
        border-radius: var(--border-radius);
        color: var(--secondary-text);
    }

    .no-games-icon {
        font-size: 60px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .no-games-found h2 {
        font-size: 24px;
        margin-bottom: 10px;
        color: var(--primary-text);
    }

    /* Pagination styles */
    .pagination-container {
        margin: 40px 0;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 5px;
    }

    .pagination li {
        margin: 0 2px;
    }

    .pagination li a, .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: var(--card-background);
        color: var(--secondary-text);
        border-radius: 50%;
        text-decoration: none;
        transition: all var(--transition-speed);
    }

    .pagination li.active span {
        background-color: var(--primary-color);
        color: white;
    }

    .pagination li a:hover {
        background-color: rgba(108, 92, 231, 0.2);
        color: var(--primary-text);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .games-filter-bar {
            flex-direction: column;
            align-items: flex-start;
        }

        .sort-section {
            width: 100%;
            margin-top: 15px;
        }

        .sort-select {
            width: 100%;
        }

        .games-header {
            padding: 40px 0;
        }

        .games-title {
            font-size: 36px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Game modal functionality is already in the main app.blade.php
    });
</script>
@endsection