@extends('layout.app')

@section('title')
    منتجاتنا
@endsection

@section('content')
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title mb-5 text-center">
            <h2>منتجاتنا</h2>
            <p>اكتشف مجموعتنا الواسعة من المنتجات المتنوعة.</p>
            <hr class="text-primary mx-auto w-50">
        </div><!-- End Section Title -->

        <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="200">
                <li data-filter="*" class="filter-active">
                    <i class="bi bi-grid-3x3"></i> جميع المنتوجات
                </li>
                @foreach ($categories as $category)
                    <li data-filter=".filter-{{ $category->id }}">
                        {{ $category->name }}
                    </li>
                @endforeach
            </ul>

            <div class="row g-4 isotope-container justify-content-center" data-aos="fade-up" data-aos-delay="300">

                @foreach ($products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $product->category->id }}">
                        <article class="portfolio-entry">
                            <figure class="entry-image">
                                @if ($product->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->images->first()->path) }}" 
                                        class="img-fluid" 
                                        alt="{{ $product->name }}" 
                                        loading="lazy">
                                @else
                                    <img src="https://via.placeholder.com/400x300?text=No+Image" 
                                        class="img-fluid" 
                                        alt="No Image" 
                                        loading="lazy">
                                @endif

                                <div class="entry-overlay">
                                    <div class="overlay-content">
                                        <div class="entry-meta">{{ $product->category->name ?? 'غير مصنف' }}</div>
                                        <h3 class="entry-title">{{ $product->name }}</h3>
                                        <p class="text-white-50 small mb-3">
                                            {{ Str::limit($product->description, 80) }}
                                        </p>
                                        <div class="entry-links">
                                            <!-- View Image -->
                                            @if ($product->images->isNotEmpty())
                                                <a href="{{ asset('storage/' . $product->images->first()->path) }}" 
                                                class="glightbox" 
                                                data-gallery="portfolio-gallery-{{ $product->category->id }}"
                                                data-glightbox="title: {{ $product->name }}; description: {{ Str::limit($product->description, 120) }}">
                                                    <i class="bi bi-arrows-angle-expand"></i>
                                                </a>
                                            @endif

                                            <!-- Product Details Page -->
                                            <a href="{{ route('app.show_product', $product->id) }}">
                                                <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </figure>
                        </article>
                    </div>
                @endforeach

            </div><!-- End Portfolio Container -->

            </div>

        </div>

    </section><!-- /Portfolio Section -->

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>

@endsection

@push('styles')
    <style>
        :root { 
            --background-color: #ffffff;
            --default-color: #314862;
            --heading-color: #13447f;
            --accent-color: #065cc2;
            --surface-color: #ffffff;
            --contrast-color: #ffffff;
        }

        :root {
            --nav-color: #314862;
            --nav-hover-color: #065cc2; 
            --nav-mobile-background-color: #11427d;
            --nav-dropdown-background-color: #065cc2; 
            --nav-dropdown-color: #acc4e0;
            --nav-dropdown-hover-color: #ffffff;
        }

        .portfolio .portfolio-filters {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 0;
            margin: 0 0 40px;
            list-style: none;
        }

        .portfolio .portfolio-filters li {
            font-size: 15px;
            font-weight: 500;
            padding: 12px 25px;
            cursor: pointer;
            background: var(--surface-color);
            color: var(--default-color);
            border-radius: 30px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .portfolio .portfolio-filters li i {
            font-size: 1.1em;
            transition: transform 0.3s ease;
        }

        .portfolio .portfolio-filters li:hover {
            color: var(--accent-color);
            transform: translateY(-2px);
            background: color-mix(in srgb, var(--accent-color), transparent 92%);
            border-color: var(--accent-color);
        }

        .portfolio .portfolio-filters li:hover i {
            transform: scale(1.1);
        }

        .portfolio .portfolio-filters li.filter-active {
            background: var(--accent-color);
            color: var(--contrast-color);
            border-color: var(--accent-color);
        }

        @media (max-width: 768px) {
            .portfolio .portfolio-filters {
                gap: 10px;
            }

            .portfolio .portfolio-filters li {
                padding: 8px 20px;
                font-size: 14px;
            }
        }

        .portfolio .portfolio-entry {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            background: var(--surface-color);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .portfolio .portfolio-entry:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .portfolio .portfolio-entry .entry-image {
            position: relative;
            margin: 0;
            overflow: hidden;
            aspect-ratio: 4/3;
        }

        .portfolio .portfolio-entry .entry-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .portfolio .portfolio-entry .entry-image .entry-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.85) 100%);
            display: flex;
            align-items: flex-end;
            padding: 30px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .portfolio .portfolio-entry .entry-image .entry-overlay .overlay-content {
            width: 100%;
            transform: translateY(20px);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .portfolio .portfolio-entry .entry-image .entry-overlay .entry-meta {
            color: var(--accent-color);
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .portfolio .portfolio-entry .entry-image .entry-overlay .entry-title {
            color: var(--contrast-color);
            font-size: 20px;
            font-weight: 600;
            margin: 0 0 15px;
            line-height: 1.3;
        }

        .portfolio .portfolio-entry .entry-image .entry-overlay .entry-links {
            display: flex;
            gap: 12px;
        }

        .portfolio .portfolio-entry .entry-image .entry-overlay .entry-links a {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--surface-color);
            color: var(--accent-color);
            border-radius: 12px;
            font-size: 18px;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
            text-decoration: none;
        }

        .portfolio .portfolio-entry .entry-image .entry-overlay .entry-links a:hover {
            background: var(--accent-color);
            color: var(--contrast-color);
            transform: translateY(-2px);
        }

        .portfolio .portfolio-entry .entry-image .entry-overlay .entry-links a:nth-child(1) {
            transition-delay: 0.1s;
        }

        .portfolio .portfolio-entry .entry-image .entry-overlay .entry-links a:nth-child(2) {
            transition-delay: 0.2s;
        }

        .portfolio .portfolio-entry:hover .entry-image img {
            transform: scale(1.05);
        }

        .portfolio .portfolio-entry:hover .entry-image .entry-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        .portfolio .portfolio-entry:hover .entry-image .entry-overlay .overlay-content {
            transform: translateY(0);
        }

        .portfolio .portfolio-entry:hover .entry-image .entry-overlay .entry-links a {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .portfolio .portfolio-entry .entry-image .entry-overlay {
                padding: 20px;
            }

            .portfolio .portfolio-entry .entry-image .entry-overlay .entry-title {
                font-size: 18px;
                margin-bottom: 12px;
            }

            .portfolio .portfolio-entry .entry-image .entry-overlay .entry-links a {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
        }

        @media (min-width: 768px) {
            .portfolio .row {
                margin-left: -10px;
                margin-right: -10px;
            }

            .portfolio .row .portfolio-item {
                padding-left: 10px;
                padding-right: 10px;
            }
        }

        @media (min-width: 992px) {
            .portfolio .row {
                margin-left: -12px;
                margin-right: -12px;
            }

            .portfolio .row .portfolio-item {
                padding-left: 12px;
                padding-right: 12px;
            }
        }

        @media (min-width: 1200px) {
            .portfolio .row {
                margin-left: -15px;
                margin-right: -15px;
            }

            .portfolio .row .portfolio-item {
                padding-left: 15px;
                padding-right: 15px;
            }
        }
    </style>
@endpush

@push('scripts')
    <!-- Include Isotope Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize Isotope after images are loaded
        const grid = document.querySelector('.isotope-container');
        
        if (grid) {
            // Wait for images to load before initializing Isotope
            imagesLoaded(grid, function() {
                const iso = new Isotope(grid, {
                    itemSelector: '.portfolio-item',
                    layoutMode: 'fitRows',
                    masonry: {
                        columnWidth: '.portfolio-item',
                        gutter: 20
                    },
                    transitionDuration: '0.6s'
                });

                // Filter buttons
                const filterButtons = document.querySelectorAll('.portfolio-filters li');
                
                filterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Remove active class from all buttons
                        filterButtons.forEach(btn => btn.classList.remove('filter-active'));
                        
                        // Add active class to clicked button
                        this.classList.add('filter-active');
                        
                        // Get filter value
                        const filterValue = this.getAttribute('data-filter');
                        
                        // Apply filter
                        iso.arrange({ filter: filterValue });
                    });
                });

                // Add resize event to recalculate layout
                window.addEventListener('resize', function() {
                    iso.layout();
                });
            });
        }

        // Add click event listeners to filter buttons as fallback
        const filterButtons = document.querySelectorAll('.portfolio-filters li');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filterValue = this.getAttribute('data-filter');
                
                // Show all items if filter is '*'
                if (filterValue === '*') {
                    document.querySelectorAll('.portfolio-item').forEach(item => {
                        item.style.display = 'block';
                    });
                } else {
                    // Hide all items first
                    document.querySelectorAll('.portfolio-item').forEach(item => {
                        item.style.display = 'none';
                    });
                    
                    // Show items with matching class
                    document.querySelectorAll(filterValue).forEach(item => {
                        item.style.display = 'block';
                    });
                }
                
                // Update active class
                filterButtons.forEach(btn => btn.classList.remove('filter-active'));
                this.classList.add('filter-active');
            });
        });
    });

    // Fallback for imagesLoaded if not available
    if (typeof imagesLoaded === 'undefined') {
        window.imagesLoaded = function(elem, callback) {
            const images = elem.querySelectorAll('img');
            let count = images.length;
            
            if (count === 0) {
                callback();
                return;
            }
            
            images.forEach(img => {
                if (img.complete) {
                    done();
                } else {
                    img.addEventListener('load', done);
                    img.addEventListener('error', done);
                }
            });
            
            function done() {
                count--;
                if (count === 0) {
                    callback();
                }
            }
        };
    }
    </script>
@endpush