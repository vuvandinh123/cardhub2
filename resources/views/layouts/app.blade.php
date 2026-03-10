<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('https://howokiman.vn/thumbs/206x40x2/upload/photo/2022-logo-chuan-03-6846.png') }}" type="image/x-icon">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @yield('meta')
    @yield('styles')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/framer-motion@11.0.8/dist/framer-motion.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>

<body class="bg-gray-50 overflow-x-hidden">
    <div class="pt">
        @yield('content')
    </div>
    @include('partials.floating-contacts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
        integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        const { motion } = window.Motion;

        // Header scroll effect
        let lastScroll = 0;
        const header = document.getElementById('header');
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                header.style.boxShadow = '0 4px 20px rgba(0,0,0,0.1)';
            } else {
                header.style.boxShadow = '0 1px 3px rgba(0,0,0,0.1)';
            }
            
            lastScroll = currentScroll;
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Slider animations
        const sliderContent = document.getElementById('slider-content');
        const sliderImage = document.getElementById('slider-image');
        
        sliderContent.style.opacity = '0';
        sliderContent.style.transform = 'translateX(-50px)';
        sliderImage.style.opacity = '0';
        sliderImage.style.transform = 'translateX(50px)';
        
        setTimeout(() => {
            sliderContent.style.transition = 'all 0.8s ease-out';
            sliderImage.style.transition = 'all 0.8s ease-out 0.2s';
            sliderContent.style.opacity = '1';
            sliderContent.style.transform = 'translateX(0)';
            sliderImage.style.opacity = '1';
            sliderImage.style.transform = 'translateX(0)';
        }, 100);

        // About section animations
        const aboutImage = document.getElementById('about-image');
        const aboutContent = document.getElementById('about-content');
        
        aboutImage.style.opacity = '0';
        aboutImage.style.transform = 'translateY(50px)';
        aboutContent.style.opacity = '0';
        aboutContent.style.transform = 'translateY(50px)';
        
        observer.observe(aboutImage);
        observer.observe(aboutContent);

        // Categories animations
        const categoryCards = document.querySelectorAll('.category-card');
        categoryCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px)';
            card.style.transition = `all 0.6s ease-out ${index * 0.1}s`;
            observer.observe(card);
        });

        // Products animations
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';
            card.style.transition = `all 0.6s ease-out ${index * 0.1}s`;
            observer.observe(card);
        });

        // Features animations
        const featureItems = document.querySelectorAll('.feature-item');
        featureItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = `all 0.5s ease-out ${index * 0.1}s`;
            observer.observe(item);
        });

        // Blog animations
        const blogCards = document.querySelectorAll('.blog-card');
        blogCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px)';
            card.style.transition = `all 0.6s ease-out ${index * 0.15}s`;
            observer.observe(card);
        });

        // Contact animations
        const contactInfo = document.getElementById('contact-info');
        const contactForm = document.getElementById('contact-form');
        
        contactInfo.style.opacity = '0';
        contactInfo.style.transform = 'translateX(-50px)';
        contactForm.style.opacity = '0';
        contactForm.style.transform = 'translateX(50px)';
        
        observer.observe(contactInfo);
        observer.observe(contactForm);

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add hover effects to cards
        const allCards = document.querySelectorAll('.category-card, .product-card, .blog-card');
        allCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
    @yield('scripts')
</body>
</html>