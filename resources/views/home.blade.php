@extends('layouts.app')

@section('content')
    <!-- Banner Carousel - Now only on the home page -->
    <div class="banner-carousel">
        <!-- Slide 1 -->
        <div id="banner-slide-1" class="banner-slide active"
            style="background-image: url('https://e.top4top.io/p_36269u1m31.png');">
            <div class="banner-content">
                <h2 class="banner-title">Epic Gaming Adventures</h2>
                <p class="banner-description">Discover new worlds and exciting challenges</p>
                <a href="{{ route('games.index') }}" class="btn btn-primary">Browse Games</a>
            </div>
        </div>

        <!-- Slide 2 - تم حذف زر Rent Now -->
        <div id="banner-slide-2" class="banner-slide"
            style="background-image: url('https://f.top4top.io/p_3626g7d051.png');">
            <div class="banner-content">
                <h2 class="banner-title">Premium Game Rentals</h2>
                <p class="banner-description">Play more for less with our affordable rental plans</p>
                <!-- الزر تم حذفه من هنا -->
            </div>
        </div>

        <!-- Slide 3 -->
        <div id="banner-slide-3" class="banner-slide"
            style="background-image: url('https://g.top4top.io/p_3626gduyy1.png');">
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
        /* إزالة الخلفية السوداء من وراء النص في البانر */
        .banner-content {
            background-color: transparent !important;
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            box-shadow: none !important;
            padding: 20px !important;
        }

        /* تعزيز وضوح النص بدون خلفية */
        .banner-title,
        .banner-description {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.9),
                -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000 !important;
        }

        /* إخفاء زر Rent Now في الشريحة الثانية */
        #banner-slide-2 .btn {
            display: none !important;
        }

        /* تنسيقات أخرى */
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

        // إضافة كود JavaScript لإزالة أي خلفية تحت النص عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function () {
            // تأكد من إزالة أي عناصر أو خلفيات إضافية
            document.querySelectorAll('.banner-content, .banner-title, .banner-description').forEach(elem => {
                elem.style.background = 'none';
                elem.style.backgroundColor = 'transparent';
                elem.style.backdropFilter = 'none';
                elem.style.webkitBackdropFilter = 'none';
                elem.style.boxShadow = 'none';
            });

            // تأكد من عدم وجود زر في الشريحة الثانية
            const secondSlide = document.getElementById('banner-slide-2');
            if (secondSlide) {
                const buttons = secondSlide.querySelectorAll('.btn');
                buttons.forEach(button => {
                    button.remove();
                });
            }
        });

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

            // كود دوارات الألعاب
            const carousels = document.querySelectorAll('.carousel-container');
            carousels.forEach(carousel => {
                const wrapper = carousel.querySelector('.carousel-wrapper');
                const prevButton = carousel.querySelector('.carousel-button.prev');
                const nextButton = carousel.querySelector('.carousel-button.next');

                let scrollAmount = 0;
                const cardWidth = 280; // عرض بطاقة اللعبة + الهامش

                nextButton.addEventListener('click', function () {
                    scrollAmount += cardWidth;
                    if (scrollAmount > wrapper.scrollWidth - wrapper.clientWidth) {
                        scrollAmount = wrapper.scrollWidth - wrapper.clientWidth;
                    }
                    wrapper.scrollTo({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });

                prevButton.addEventListener('click', function () {
                    scrollAmount -= cardWidth;
                    if (scrollAmount < 0) {
                        scrollAmount = 0;
                    }
                    wrapper.scrollTo({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
@endsection