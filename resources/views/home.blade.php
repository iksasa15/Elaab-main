@extends('layouts.app')

@section('content')
    <!-- Banner Carousel - Now only on the home page -->
    <div class="banner-carousel">
        <!-- Slide 1 -->
        <div class="banner-slide active" style="background-image: url('https://e.top4top.io/p_36269u1m31.png');">
            <div class="banner-content">
                <h2 class="banner-title">Epic Gaming Adventures</h2>
                <p class="banner-description">Discover new worlds and exciting challenges</p>
                <a href="{{ route('games.index') }}" class="btn btn-primary">Browse Games</a>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="banner-slide" style="background-image: url('https://f.top4top.io/p_3626g7d051.png');">
            <div class="banner-content">
                <h2 class="banner-title">Premium Game Rentals</h2>
                <p class="banner-description">Play more for less with our affordable rental plans</p>
                <a href="{{ route('games.index') }}" class="btn btn-primary">Rent Now</a>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="banner-slide" style="background-image: url('https://g.top4top.io/p_3626gduyy1.png');">
            <div class="banner-content">
                <h2 class="banner-title">Game On, Save Big</h2>
                <p class="banner-description">Unlimited gaming without breaking the bank</p>
                <a href="{{ route('games.index') }}" class="btn btn-primary">Explore</a>
            </div>
        </div>

        <!-- Carousel indicators -->
        <div class="banner-carousel-indicators">
            <span class="carousel-indicator active" onclick="setSlide(0)"></span>
            <span class="carousel-indicator" onclick="setSlide(1)"></span>
            <span class="carousel-indicator" onclick="setSlide(2)"></span>
        </div>
    </div>

    <section class="category-section">
        <div class="container">
            <!-- زر التصنيفات -->
            <div class="categories-filter-container">
                <div class="categories-filter">
                    <button class="btn btn-category active" data-category="all">All Categories </button>
                    @foreach ($categories as $category)
                        <button class="btn btn-category" data-category="{{ $category->id }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>

            @foreach ($categories as $category)
                <div class="category-content" data-category-id="{{ $category->id }}">
                    <div class="section-header">
                        <h2 class="section-title">{{ $category->name }}</h2>
                        <a href="{{ route('games.index', ['category' => $category->id]) }}" class="see-all">See All</a>
                    </div>

                    <div class="carousel-container" id="category-{{ $category->id }}-carousel">
                        <button class="carousel-button prev">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <div class="carousel-wrapper">
                            @foreach ($category->games as $game)
                                <div class="game-card"
                                    onclick="showGameModal('{{ $game->id }}', '{{ $game->name }}', '{{ $game->description }}', '{{ $category->name }}', '{{ $game->platform }}', '{{ $game->image }}', '{{ $game->price_per_day }}')">
                                    <div class="game-image" style="background-image: url('{{ $game->image }}')"></div>
                                    <div class="game-info">
                                        <h3 class="game-title">{{ $game->name }}</h3>
                                        <div class="game-meta">
                                            <span class="game-category">{{ $category->name }}</span>
                                            <span class="game-rating"><i class="fas fa-star"></i> 4.8</span>
                                        </div>
                                        <div class="game-price">{{ $game->price_per_day }} SAR / day</div>
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
        .categories-filter-container {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
        }

        .categories-filter {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            max-width: 100%;
            overflow-x: auto;
            padding: 10px 0;
        }

        .btn-category {
            background-color: #f1f1f1;
            color: #333;
            border: none;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-category.active,
        .btn-category:hover {
            background-color: #6c5ce7;
            color: white;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Banner carousel functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.banner-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');
        const totalSlides = slides.length;

        // Function to show specific slide
        function setSlide(slideIndex) {
            slides.forEach(slide => slide.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));

            currentSlide = slideIndex;
            slides[currentSlide].classList.add('active');
            indicators[currentSlide].classList.add('active');
        }

        // Function to show next slide
        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            setSlide(currentSlide);
        }

        // Auto-rotate slides
        setInterval(nextSlide, 5000);

        document.addEventListener('DOMContentLoaded', function () {
            const categoryButtons = document.querySelectorAll('.btn-category');
            const categoryContents = document.querySelectorAll('.category-content');

            // عند النقر على زر تصنيف
            categoryButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // إزالة الكلاس "active" من جميع الأزرار
                    categoryButtons.forEach(btn => btn.classList.remove('active'));

                    // إضافة الكلاس "active" للزر الحالي
                    this.classList.add('active');

                    const selectedCategory = this.getAttribute('data-category');

                    if (selectedCategory === 'all') {
                        // إظهار جميع التصنيفات
                        categoryContents.forEach(content => {
                            content.style.display = 'block';
                        });
                    } else {
                        // إخفاء جميع التصنيفات
                        categoryContents.forEach(content => {
                            content.style.display = 'none';
                        });

                        // إظهار التصنيف المحدد فقط
                        document.querySelector(`.category-content[data-category-id="${selectedCategory}"]`).style.display = 'block';
                    }
                });
            });

            // إظهار جميع ألعاب التصنيف عند النقر على "See All"
            window.showAllGames = function (categoryId) {
                // إزالة الكلاس "active" من جميع الأزرار
                categoryButtons.forEach(btn => btn.classList.remove('active'));

                // إضافة الكلاس "active" للزر المناسب
                document.querySelector(`.btn-category[data-category="${categoryId}"]`).classList.add('active');

                // إخفاء جميع التصنيفات
                categoryContents.forEach(content => {
                    content.style.display = 'none';
                });

                // إظهار التصنيف المحدد فقط
                document.querySelector(`.category-content[data-category-id="${categoryId}"]`).style.display = 'block';

                // التمرير إلى هذا التصنيف
                document.querySelector(`.category-content[data-category-id="${categoryId}"]`).scrollIntoView({
                    behavior: 'smooth'
                });
            };

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
            };

            // Close modal when clicking the X button
            document.querySelector('.close-modal').addEventListener('click', function () {
                closeGameModal();
            });

            // Close modal when clicking outside the modal content
            document.getElementById('game-modal').addEventListener('click', function (event) {
                if (event.target === this) {
                    closeGameModal();
                }
            });

            // Close modal function
            function closeGameModal() {
                const modal = document.getElementById('game-modal');
                modal.classList.remove('show');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
                document.body.style.overflow = ''; // Restore scrolling
            }

            // Make closeGameModal available to window scope
            window.closeGameModal = closeGameModal;

            // Handle rental button click
            document.getElementById('rent-now-button').addEventListener('click', function () {
                const gameId = this.getAttribute('data-game-id');
                const gamePrice = this.getAttribute('data-game-price');
                const duration = document.querySelector('input[name="rental-duration"]:checked').value;
                const durationText = document.querySelector('input[name="rental-duration"]:checked').closest('.duration-option').querySelector('.option-title').textContent;
                const price = document.querySelector('input[name="rental-duration"]:checked').closest('.duration-option').querySelector('.option-price').textContent;

                // Here you would typically send this data to the server
                // For now, just show an alert
                alert(`Game rental request submitted!\n\nGame ID: ${gameId}\nDuration: ${durationText}\nPrice: ${price}`);

                // Close modal after submission
                closeGameModal();
            });
        });
    </script>
@endsection