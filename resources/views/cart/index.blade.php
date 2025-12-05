@extends('layouts.app')

@section('title', 'Your Cart - El3bha')

@section('content')
    <div class="container">
        <div class="cart-page">
            <h1>Your Cart</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($cartItems->count() > 0)
                    <div class="cart-items">
                        @foreach($cartItems as $item)
                            <div class="cart-item">
                                <div class="cart-item-image">
                                    <img src="{{ $item->game->image }}" alt="{{ $item->game->title }}">
                                </div>
                                <div class="cart-item-details">
                                    <h3>{{ $item->game->title }}</h3>
                                    <div class="game-info">
                                        <span class="game-platform"><i class="fas fa-gamepad"></i> {{ $item->game->platform }}</span>
                                        <span class="game-category"><i class="fas fa-tag"></i> {{ $item->game->category->name }}</span>
                                    </div>
                                    <div class="game-description">
                                        <p>{{ Str::limit($item->game->description, 120) }}</p>
                                    </div>
                                    <div class="rental-details">
                                        <div class="rental-duration">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>3 Days Rental</span>
                                        </div>
                                        <div class="cart-item-price">{{ $item->game->price_per_day }} SAR/day</div>
                                    </div>
                                </div>
                                <div class="cart-item-actions">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="cart-summary">
                        <h2>Summary</h2>
                        <div class="summary-row">
                            <span>Items:</span>
                            <span>{{ $cartItems->count() }}</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total (per day):</span>
                            <span>{{ $cartItems->sum(function ($item) {
                    return $item->game->price_per_day;
                }) }} SAR</span>
                        </div>
                        <div class="cart-actions">
                            <a href="{{ route('checkout') }}" class="btn btn-primary checkout-btn">Proceed to Checkout</a>
                            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline clear-cart-btn">Clear Cart</button>
                            </form>
                        </div>
                    </div>
            @else
                <div class="empty-cart">
                    <div class="empty-cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h2>Your cart is empty</h2>
                    <p>Looks like you haven't added any games to your cart yet.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Browse Games</a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .cart-page {
            padding: 40px 0;
        }

        .cart-page h1 {
            margin-bottom: 30px;
            font-size: 28px;
            color: var(--primary-text);
        }

        .cart-items {
            margin-bottom: 30px;
        }

        .cart-item {
            display: flex;
            background: linear-gradient(145deg, var(--card-bg), rgba(45, 45, 68, 0.7));
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 20px;
            margin-bottom: 20px;
            transition: all var(--transition-speed);
            border: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
            overflow: hidden;
        }

        .cart-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(108, 92, 231, 0.05));
            pointer-events: none;
        }

        .cart-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .cart-item-image {
            width: 150px;
            height: 170px;
            overflow: hidden;
            border-radius: var(--border-radius);
            margin-right: 25px;
            flex-shrink: 0;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .cart-item:hover .cart-item-image img {
            transform: scale(1.05);
        }

        .cart-item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .cart-item-details h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: var(--primary-text);
            font-weight: 600;
        }

        .game-info {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .game-platform,
        .game-category {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
        }

        .game-platform {
            background-color: rgba(9, 132, 227, 0.1);
            color: #0984e3;
        }

        .game-category {
            background-color: rgba(108, 92, 231, 0.1);
            color: var(--primary-color);
        }

        .game-description {
            margin-bottom: 15px;
            color: var(--secondary-text);
            font-size: 15px;
            line-height: 1.6;
            flex-grow: 1;
        }

        .rental-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            background-color: rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            border-radius: 10px;
        }

        .rental-duration {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--secondary-text);
        }

        .cart-item-price {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 18px;
        }

        .cart-item-actions {
            display: flex;
            align-items: flex-start;
            padding-left: 20px;
            margin-left: 10px;
            border-left: 1px solid rgba(255, 255, 255, 0.05);
        }

        .cart-item-actions .btn {
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-danger {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            border: 1px solid rgba(231, 76, 60, 0.3);
        }

        .btn-danger:hover {
            background-color: #e74c3c;
            color: white;
            transform: translateY(-3px);
        }

        .cart-summary {
            background: linear-gradient(145deg, var(--card-bg), rgba(45, 45, 68, 0.7));
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .cart-summary h2 {
            margin-bottom: 25px;
            font-size: 22px;
            color: var(--primary-text);
            position: relative;
            padding-bottom: 10px;
        }

        .cart-summary h2::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            color: var(--secondary-text);
        }

        .summary-row.total {
            font-weight: 700;
            font-size: 20px;
            color: var(--primary-text);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 15px;
            margin-top: 15px;
        }

        .cart-actions {
            margin-top: 25px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .checkout-btn {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: 600;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border: none;
            box-shadow: 0 10px 20px rgba(108, 92, 231, 0.2);
            transition: all 0.3s;
        }

        .checkout-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(108, 92, 231, 0.3);
        }

        .clear-cart-btn {
            width: 100%;
            padding: 12px;
            font-weight: 600;
            border: 2px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s;
        }

        .clear-cart-btn:hover {
            border-color: rgba(231, 76, 60, 0.5);
            color: #e74c3c;
        }

        .empty-cart {
            text-align: center;
            padding: 60px 30px;
            background: linear-gradient(145deg, var(--card-bg), rgba(45, 45, 68, 0.7));
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .empty-cart-icon {
            font-size: 70px;
            color: var(--text-muted);
            margin-bottom: 25px;
            opacity: 0.5;
        }

        .empty-cart h2 {
            margin-bottom: 15px;
            color: var(--primary-text);
            font-weight: 600;
        }

        .empty-cart p {
            margin-bottom: 30px;
            color: var(--text-muted);
            font-size: 16px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .empty-cart .btn {
            padding: 12px 25px;
            font-weight: 600;
        }

        .alert {
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: rgba(46, 204, 113, 0.1);
            border: 1px solid rgba(46, 204, 113, 0.2);
            color: #2ecc71;
        }

        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.2);
            color: #e74c3c;
        }

        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
            }

            .cart-item-image {
                width: 100%;
                height: 200px;
                margin-right: 0;
                margin-bottom: 20px;
            }

            .cart-item-actions {
                margin-top: 20px;
                margin-left: 0;
                padding-left: 0;
                border-left: none;
                border-top: 1px solid rgba(255, 255, 255, 0.05);
                padding-top: 20px;
                width: 100%;
                justify-content: flex-end;
            }

            .rental-details {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .cart-item-price {
                align-self: flex-end;
            }
        }
    </style>
@endsection