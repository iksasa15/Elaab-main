<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <meta name="theme-color" content="#1e1e2c">

    <title>{{ $title ?? 'El3bha | Game Rental Platform' }}</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Additional Styles -->
    @yield('styles')

    <style>
        /* Cart icon styling */
        .cart-icon {
            font-size: 24px;
            color: var(--primary-text);
            transition: color var(--transition-speed);
            position: relative;
            display: inline-block;
        }

        .cart-icon:hover {
            color: var(--primary-color);
        }

        .cart-counter {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-speed);
        }

        /* User info styling */
        .user-info {
            display: flex;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.05);
            padding: 8px 18px;
            border-radius: var(--border-radius);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .user-welcome {
            color: var(--primary-color);
            font-weight: 600;
            margin-right: 10px;
        }

        /* Logo styling */
        .logo {
            display: flex;
            align-items: center;
            /* Maintaining original container size */
        }

        .logo img {
            /* Increase just the image size while maintaining original container */
            height: auto;
            width: auto;
            max-height: 60px;
            /* Increased from original size */
            object-fit: contain;
            /* Ensures logo fits properly */
            transform: scale(1.5);
            /* Scales the logo without affecting container */
            transform-origin: left center;
            /* Scale from left side */
        }

        /* Make header responsive */
        @media (max-width: 768px) {

            .nav-links,
            .auth-buttons,
            .user-info {
                display: none;
            }

            .nav-links.mobile-active,
            .auth-buttons.mobile-active,
            .user-info.mobile-active {
                display: flex;
                flex-direction: column;
                width: 100%;
                margin-top: 20px;
            }

            .user-info.mobile-active {
                align-items: center;
                padding: 15px;
                gap: 15px;
            }

            .header-container {
                flex-wrap: wrap;
            }

            .logo img {
                /* Scale down a bit on mobile but still larger than original */
                transform: scale(1.3);
            }
        }

        /* Game modal actions */
        .game-modal-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        #rent-now-button,
        #add-to-cart-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        @media (max-width: 576px) {

            #rent-now-button,
            #add-to-cart-button {
                width: 100%;
                margin: 10px 0;
            }

            .game-modal-actions {
                flex-direction: column;
            }
        }

        /* Footer logo styling */
        .footer-logo img {
            /* Scale just the image without affecting container */
            transform: scale(1.5);
            transform-origin: left center;
            max-height: 40px;
        }

        /* Banner carousel styling */
        .banner-carousel {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
            margin-bottom: 40px;
        }

        .banner-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .banner-slide.active {
            opacity: 1;
        }

        /* تعديل: إزالة الخلفية السوداء من وراء النص في البانر */
        .banner-content {
            max-width: 800px;
            padding: 20px;
            background-color: transparent;
            /* تم تغييرها من rgba(0, 0, 0, 0.5) */
            border-radius: 10px;
            backdrop-filter: none;
            /* تم تغييرها من blur(5px) */
            -webkit-backdrop-filter: none;
            /* تم تغييرها من blur(5px) */
        }

        .banner-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.9),
                -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000;
        }

        .banner-description {
            font-size: 1.2rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.9),
                -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000;
        }

        .banner-carousel-indicators {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .carousel-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .carousel-indicator.active {
            background-color: white;
        }

        @media (max-width: 768px) {
            .banner-carousel {
                height: 400px;
            }

            .banner-title {
                font-size: 2rem;
            }

            .banner-description {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <a href="{{ route('home') }}" class="logo">
                <img src="https://c.top4top.io/p_3626qoy0p1.png" alt="El3bha Logo">
            </a>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('games.index') }}"
                        class="{{ request()->routeIs('games.*') ? 'active' : '' }}">Games</a></li>
                <li><a href="#" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                <li><a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>

            @auth
                <div class="user-info">
                    <span class="user-welcome">Welcome, {{ Auth::user()->name }}</span>
                    <!-- أيقونة السلة بجانب اسم المستخدم -->
                    <a href="{{ route('cart.index') }}" class="cart-icon" style="margin-right: 15px;">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-counter" id="cart-counter">
                            {{ App\Models\Cart::where('user_id', Auth::id())->count() }}
                        </span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline"
                            style="padding: 8px 15px; font-size: 0.9rem;">Logout</button>
                    </form>
                </div>
            @else
                <div class="auth-buttons">
                    <!-- أيقونة السلة بجانب أزرار تسجيل الدخول -->
                    <a href="{{ route('cart.index') }}" class="cart-icon" style="margin-right: 15px;">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                    <a href="{{ route('signup') }}" class="btn btn-primary">Register</a>
                </div>
            @endauth

            <div class="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="footer-container">
                <div class="footer-about">
                    <a href="{{ route('home') }}" class="footer-logo">
                        <img src="https://c.top4top.io/p_3626qoy0p1.png" alt="El3bha Logo">
                    </a>
                    <p class="footer-description">El3bha is your premier destination for game rentals. Enjoy the latest
                        titles without the commitment of a purchase.</p>

                    <div class="footer-social">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('games.index') }}">Games</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Game Categories</h4>
                    <ul>
                        @if(isset($categories) && $categories->count() > 0)
                            @foreach($categories->take(5) as $category)
                                <li><a href="{{ route('games.index', ['category' => $category->id]) }}" class="category-link"
                                        data-category="{{ $category->id }}">{{ $category->name }}</a></li>
                            @endforeach
                        @else
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Adventure</a></li>
                            <li><a href="#">RPG</a></li>
                            <li><a href="#">Sports</a></li>
                            <li><a href="#">Horror</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© {{ date('Y') }} El3bha. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Game Modal -->
    <div id="game-modal" class="game-modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="modal-body">
                <div class="game-modal-image"></div>
                <div class="game-modal-details">
                    <h2 id="modal-game-title"></h2>
                    <div class="modal-game-meta">
                        <span id="modal-game-category" class="game-category"></span>
                        <span id="modal-game-platform" class="game-platform"></span>
                    </div>
                    <p id="modal-game-description"></p>

                    <div class="rental-options">
                        <h3>Rental Duration</h3>
                        <div class="rental-duration-options">
                            <label class="duration-option">
                                <input type="radio" name="rental-duration" value="day" checked>
                                <div class="option-card">
                                    <div class="option-title">Day</div>
                                    <div class="option-price" id="day-price"></div>
                                </div>
                            </label>
                            <label class="duration-option">
                                <input type="radio" name="rental-duration" value="week">
                                <div class="option-card">
                                    <div class="option-title">Week</div>
                                    <div class="option-price" id="week-price"></div>
                                </div>
                            </label>
                            <label class="duration-option">
                                <input type="radio" name="rental-duration" value="month">
                                <div class="option-card">
                                    <div class="option-title">Month</div>
                                    <div class="option-price" id="month-price"></div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="game-modal-actions">
                        <button id="add-to-cart-button" class="btn btn-outline" onclick="addToCart()">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                        <button id="rent-now-button" class="btn btn-primary" onclick="rentNow()">
                            <i class="fas fa-gamepad"></i> Rent Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}" defer></script>

    <script>
        function addToCart() {
            const gameId = document.getElementById('add-to-cart-button').getAttribute('data-game-id');

            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    game_id: gameId
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cartCounter = document.getElementById('cart-counter');
                        if (cartCounter) {
                            cartCounter.textContent = data.count;
                        }

                        // Show success notification
                        alert(data.message);

                        // Close modal
                        closeGameModal();

                        // If not logged in, redirect to login
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // وظيفة جديدة لزر "Rent Now"
        function rentNow() {
            const gameId = document.getElementById('rent-now-button').getAttribute('data-game-id');

            // أولاً: إضافة اللعبة إلى السلة
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    game_id: gameId
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // إذا نجحت العملية، قم بتحديث عداد السلة
                        const cartCounter = document.getElementById('cart-counter');
                        if (cartCounter) {
                            cartCounter.textContent = data.count;
                        }

                        // أغلق النافذة المنبثقة
                        closeGameModal();

                        // إذا كان المستخدم غير مسجل دخول، انتقل إلى صفحة تسجيل الدخول
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            // إذا كان المستخدم مسجل دخول، انتقل إلى صفحة السلة
                            window.location.href = '{{ route("cart.index") }}';
                        }
                    } else {
                        // إذا فشلت العملية، أظهر رسالة خطأ
                        alert('Could not add game to cart. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        }

        // Close modal function
        function closeGameModal() {
            const modal = document.getElementById('game-modal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
            document.body.style.overflow = ''; // Restore scrolling
        }

        // Mobile menu toggle
        document.querySelector('.mobile-menu').addEventListener('click', function () {
            const navLinks = document.querySelector('.nav-links');
            const authButtons = document.querySelector('.auth-buttons');
            const userInfo = document.querySelector('.user-info');

            navLinks.classList.toggle('mobile-active');
            if (authButtons) {
                authButtons.classList.toggle('mobile-active');
            }
            if (userInfo) {
                userInfo.classList.toggle('mobile-active');
            }
        });

        // Modal functionality 
        window.showGameModal = function (id, name, description, category, platform, image, price) {
            // Set modal content
            document.getElementById('modal-game-title').textContent = name;
            document.getElementById('modal-game-category').textContent = category;
            document.getElementById('modal-game-platform').textContent = platform;
            document.getElementById('modal-game-description').textContent = description || 'No description available for this game.';
            document.querySelector('.game-modal-image').style.backgroundImage = `url('${image}')`;

            // Set prices based on the game's price_per_day
            document.getElementById('day-price').textContent = price + ' SAR';
            document.getElementById('week-price').textContent = (price * 5) + ' SAR'; // 5 days for a week (discount)
            document.getElementById('month-price').textContent = (price * 18) + ' SAR'; // 18 days for a month (discount)

            // Show modal
            const modal = document.getElementById('game-modal');
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('show');
            }, 10);
            document.body.style.overflow = 'hidden'; // Prevent background scrolling

            // Store game ID for rental processing
            document.getElementById('rent-now-button').setAttribute('data-game-id', id);
            document.getElementById('rent-now-button').setAttribute('data-game-price', price);
            document.getElementById('add-to-cart-button').setAttribute('data-game-id', id);
            document.getElementById('add-to-cart-button').setAttribute('data-game-price', price);
        };

        // إضافة معالج لزر الإغلاق (X) للتأكد من عمله بشكل صحيح
        document.addEventListener('DOMContentLoaded', function () {
            // إضافة معالج الحدث لزر X
            const closeButton = document.querySelector('.close-modal');
            if (closeButton) {
                closeButton.addEventListener('click', function () {
                    closeGameModal();
                });
            }

            // إضافة معالج للنقر خارج المحتوى لإغلاق النافذة
            const modal = document.getElementById('game-modal');
            if (modal) {
                modal.addEventListener('click', function (e) {
                    if (e.target === this) {
                        closeGameModal();
                    }
                });
            }
        });
    </script>

    @yield('scripts')
</body>

</html>