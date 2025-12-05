@extends('layouts.app')

@section('title', 'All Games - El3bha')

@section('content')
    <!-- Header section with gradient background -->
    <div class="games-header">
        <div class="container">
            <div class="games-header-content">
                <h1 class="games-title">Browse All Games</h1>
                <p class="games-subtitle">Discover and rent from our collection of games</p>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Filter and sort bar -->
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

        <!-- Games grid -->
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

        <!-- Pagination section - IMPROVED DESIGN -->
        <div class="pagination-container">
            <div class="pagination-wrapper">
                <div class="pagination-nav">
                    <!-- السابق والمعلومات والتالي -->
                    <div class="nav-buttons">
                        @if ($games->onFirstPage())
                            <span class="nav-prev disabled">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Previous
                            </span>
                        @else
                            <a href="{{ $games->previousPageUrl() }}" class="nav-prev">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Previous
                            </a>
                        @endif
                        
                        <div class="pagination-info">
                            Showing {{ $games->firstItem() ?? 0 }} to {{ $games->lastItem() ?? 0 }} of {{ $games->total() }} results
                        </div>
                        
                        @if ($games->hasMorePages())
                            <a href="{{ $games->nextPageUrl() }}" class="nav-next">
                                Next
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        @else
                            <span class="nav-next disabled">
                                Next
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- أرقام الصفحات -->
                <div class="page-numbers">
                    @for ($i = 1; $i <= $games->lastPage(); $i++)
                        <a href="{{ $games->url($i) }}" class="page-number {{ $games->currentPage() == $i ? 'active' : '' }}">
                            {{ $i }}
                        </a>
                    @endfor
                </div>
            </div>
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
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
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

    .game-card {
        background-color: var(--card-background);
        border-radius: var(--border-radius);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: var(--card-shadow);
        cursor: pointer;
    }

    .game-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .game-image {
        height: 180px;
        background-size: cover;
        background-position: center;
        transition: transform 0.5s ease;
    }

    .game-card:hover .game-image {
        transform: scale(1.05);
    }

    .game-info {
        padding: 15px;
    }

    .game-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--primary-text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .game-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }

    .game-category {
        color: var(--primary-color);
        font-size: 14px;
        background-color: rgba(108, 92, 231, 0.1);
        padding: 5px 12px;
        border-radius: 20px;
        display: inline-block;
    }

    .game-platform {
        color: var(--secondary-text);
        font-size: 14px;
        background-color: rgba(9, 132, 227, 0.1);
        padding: 5px 12px;
        border-radius: 20px;
        display: inline-block;
    }

    .game-price {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary-color);
        margin: 12px 0;
    }

    .game-actions {
        margin-top: 15px;
    }

    .btn-view-details {
        width: 100%;
        padding: 10px;
        background-color: var(--secondary-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all var(--transition-speed);
    }

    .btn-view-details:hover {
        background-color: var(--secondary-hover);
        transform: translateY(-2px);
    }

    /* Empty state */
    .no-games-found {
        grid-column: 1 / -1;
        text-align: center;
        background-color: var(--card-background);
        padding: 60px 20px;
        border-radius: var(--border-radius);
        color: var(--secondary-text);
        box-shadow: var(--card-shadow);
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

    /* UPDATED PAGINATION STYLES */
    .pagination-container {
        margin: 40px 0;
    }

    .pagination-wrapper {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .pagination-nav {
        width: 100%;
    }

    .nav-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .nav-prev, .nav-next {
        display: flex;
        align-items: center;
        font-size: 16px;
        font-weight: 500;
        color: #8C7DFF;
        text-decoration: none;
        padding: 10px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .nav-prev svg, .nav-next svg {
        width: 24px;
        height: 24px;
        stroke: currentColor;
        stroke-width: 2;
    }

    .nav-prev svg {
        margin-right: 8px;
    }

    .nav-next svg {
        margin-left: 8px;
    }

    .nav-prev:hover, .nav-next:hover {
        background-color: rgba(140, 125, 255, 0.1);
    }

    .nav-prev.disabled, .nav-next.disabled {
        color: rgba(140, 125, 255, 0.5);
        pointer-events: none;
    }

    .pagination-info {
        font-size: 16px;
        color: #B2B2CC;
        text-align: center;
    }

    .page-numbers {
        display: flex;
        justify-content: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .page-number {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        font-size: 16px;
        font-weight: 500;
        color: #8C7DFF;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        padding: 0 10px;
        background-color: #2A2A3D;
    }

    .page-number:hover {
        background-color: #383859;
        transform: translateY(-2px);
    }

    /* Updated Active Page Number */
    .page-number.active {
        background-color: #2F3CFF; /* أزرق داكن متناسق مع الخلفية الداكنة */
        color: white;
        box-shadow: 0 0 15px rgba(47, 60, 255, 0.5);
        transform: scale(1.05);
    }

    /* Animation for pagination */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .games-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .games-filter-bar {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-section, .sort-section {
            width: 100%;
        }

        .sort-section {
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

        .games-subtitle {
            font-size: 18px;
        }

        .filter-options {
            margin-bottom: 15px;
            flex-wrap: nowrap;
            overflow-x: auto;
            padding-bottom: 10px;
            -webkit-overflow-scrolling: touch;
        }

        .filter-option {
            white-space: nowrap;
            flex-shrink: 0;
        }
        
        .nav-buttons {
            flex-direction: column;
            gap: 15px;
        }
        
        .pagination-info {
            order: -1;
            margin-bottom: 10px;
        }
        
        .page-number {
            min-width: 36px;
            height: 36px;
            font-size: 15px;
        }
    }

    @media (max-width: 576px) {
        .games-grid {
            grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
        }

        .games-title {
            font-size: 30px;
        }

        .games-header {
            padding: 30px 0;
        }

        .game-card {
            display: flex;
            align-items: center;
        }

        .game-image {
            width: 100px;
            height: 100px;
            flex-shrink: 0;
        }

        .game-info {
            flex: 1;
        }
        
        .nav-prev, .nav-next {
            font-size: 14px;
        }
        
        .pagination-info {
            font-size: 14px;
        }
        
        .page-numbers {
            gap: 8px;
        }
        
        .page-number {
            min-width: 34px;
            height: 34px;
            font-size: 14px;
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