@extends('layouts.app')

@section('title', 'Checkout - El3bha')

@section('content')
    <div class="container">
        <div class="checkout-page">
            <h1>Checkout</h1>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="checkout-container">
                <div class="checkout-form">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="rental_duration" value="3">

                        <div class="form-section payment-section">
                            <h3>Payment Method</h3>
                            <div class="payment-options">
                                <div class="payment-option">
                                    <input type="radio" id="credit_card" name="payment_method" value="credit_card" checked>
                                    <label for="credit_card">
                                        <div class="payment-icon credit-card-icon">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <span>Credit Card</span>
                                    </label>
                                </div>
                                <div class="payment-option">
                                    <input type="radio" id="paypal" name="payment_method" value="paypal">
                                    <label for="paypal">
                                        <div class="payment-icon paypal-icon">
                                            <i class="fab fa-paypal"></i>
                                        </div>
                                        <span>PayPal</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary checkout-submit">Complete Order</button>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline back-to-cart">Back to Cart</a>
                        </div>
                    </form>
                </div>

                <div class="order-summary">
                    <h3>Order Summary</h3>
                    <div class="cart-items-summary">
                        @foreach($cartItems as $item)
                            <div class="cart-item-summary">
                                <div class="item-image">
                                    <img src="{{ $item->game->image }}" alt="{{ $item->game->title }}">
                                </div>
                                <div class="item-details">
                                    <h4>{{ $item->game->title }}</h4>
                                    <div class="item-meta">
                                        <span class="platform-badge">
                                            <i class="fas fa-gamepad"></i> {{ $item->game->platform }}
                                        </span>
                                        <span class="rental-badge">
                                            <i class="fas fa-clock"></i> 3 Days
                                        </span>
                                    </div>
                                    <p class="item-price">{{ $item->game->price_per_day }} SAR/day</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="summary-totals">
                        <div class="summary-row">
                            <span>Items:</span>
                            <span>{{ $cartItems->count() }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Subtotal (per day):</span>
                            <span>{{ $totalPrice }} SAR</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span id="total-price">{{ $totalPrice }} SAR × 3 days = {{ $totalPrice * 3 }} SAR</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .checkout-page {
            padding: 60px 0;
        }

        .checkout-page h1 {
            margin-bottom: 35px;
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-text);
            text-align: center;
        }

        .checkout-container {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 30px;
        }

        .checkout-form {
            background: linear-gradient(145deg, var(--card-bg), rgba(45, 45, 68, 0.7));
            border-radius: var(--border-radius);
            padding: 35px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .form-section {
            margin-bottom: 40px;
            position: relative;
        }

        .form-section h3 {
            margin-bottom: 25px;
            font-size: 22px;
            color: var(--primary-text);
            position: relative;
            display: inline-block;
        }

        .form-section h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
        }

        .payment-section {
            padding-bottom: 20px;
        }

        .payment-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 25px;
        }

        .payment-option {
            position: relative;
        }

        .payment-option input[type="radio"] {
            display: none;
        }

        .payment-option label {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            background: linear-gradient(145deg, rgba(45, 45, 68, 0.8), rgba(30, 30, 46, 0.8));
            border: 2px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 25px 20px;
            text-align: center;
            transition: all var(--transition-speed);
            height: 100%;
        }

        .payment-option label:hover {
            transform: translateY(-5px);
            border-color: rgba(108, 92, 231, 0.3);
        }

        .payment-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 5px;
            transition: all var(--transition-speed);
        }

        .credit-card-icon {
            background-color: rgba(9, 132, 227, 0.1);
            color: #0984e3;
        }

        .paypal-icon {
            background-color: rgba(0, 122, 204, 0.1);
            color: #0070ba;
        }

        .payment-option label span {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-text);
            transition: all var(--transition-speed);
        }

        .payment-option input[type="radio"]:checked+label {
            border-color: var(--primary-color);
            background: linear-gradient(135deg, rgba(108, 92, 231, 0.15) 0%, rgba(90, 75, 209, 0.05) 100%);
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .payment-option input[type="radio"]:checked+label .payment-icon {
            transform: scale(1.1);
        }

        .payment-option input[type="radio"]:checked+label .credit-card-icon {
            background-color: rgba(9, 132, 227, 0.2);
            color: #0984e3;
        }

        .payment-option input[type="radio"]:checked+label .paypal-icon {
            background-color: rgba(0, 122, 204, 0.2);
            color: #0070ba;
        }

        .submit-section {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .checkout-submit {
            padding: 18px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            border: none;
            box-shadow: 0 10px 20px rgba(108, 92, 231, 0.3);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .checkout-submit:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(108, 92, 231, 0.4);
        }

        .back-to-cart {
            text-align: center;
            padding: 16px;
            font-weight: 600;
            border-radius: 12px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s;
        }

        .back-to-cart:hover {
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
            background-color: rgba(255, 255, 255, 0.05);
        }

        .order-summary {
            background: linear-gradient(145deg, var(--card-bg), rgba(45, 45, 68, 0.7));
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--card-shadow);
            height: fit-content;
            border: 1px solid rgba(255, 255, 255, 0.05);
            position: sticky;
            top: 20px;
        }

        .order-summary h3 {
            margin-bottom: 25px;
            font-size: 22px;
            color: var(--primary-text);
            position: relative;
            display: inline-block;
        }

        .order-summary h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
        }

        .cart-items-summary {
            max-height: 350px;
            overflow-y: auto;
            margin-bottom: 25px;
            padding-right: 10px;
            mask-image: linear-gradient(to bottom, black 90%, transparent 100%);
            -webkit-mask-image: linear-gradient(to bottom, black 90%, transparent 100%);
        }

        .cart-item-summary {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            transition: transform 0.3s;
        }

        .cart-item-summary:hover {
            transform: translateY(-3px);
        }

        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            overflow: hidden;
            margin-right: 20px;
            border: 2px solid rgba(108, 92, 231, 0.2);
            transition: all 0.3s;
        }

        .cart-item-summary:hover .item-image {
            border-color: var(--primary-color);
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .cart-item-summary:hover .item-image img {
            transform: scale(1.05);
        }

        .item-details {
            flex: 1;
        }

        .item-details h4 {
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--primary-text);
            font-weight: 600;
        }

        .item-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 10px;
        }

        .platform-badge,
        .rental-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 13px;
        }

        .platform-badge {
            background-color: rgba(9, 132, 227, 0.1);
            color: #0984e3;
        }

        .rental-badge {
            background-color: rgba(108, 92, 231, 0.1);
            color: var(--primary-color);
        }

        .item-price {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 16px;
            margin-top: 5px;
        }

        .summary-totals {
            margin-top: 25px;
            background-color: rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            padding: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
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

        .summary-row.total span:last-child {
            color: var(--primary-color);
        }

        .alert {
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 25px;
            text-align: center;
        }

        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.2);
            color: #e74c3c;
        }

        @media (max-width: 992px) {
            .checkout-container {
                grid-template-columns: 1fr;
            }

            .order-summary {
                position: static;
            }
        }

        @media (max-width: 576px) {
            .checkout-page {
                padding: 30px 0;
            }

            .checkout-form,
            .order-summary {
                padding: 25px 20px;
            }

            .payment-options {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection