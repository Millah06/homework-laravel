<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Share Your Stories</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .hero-gradient {
            background: #111827;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('register') }}" class="text-2xl font-bold text-gray-900">StoryHub</a >
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="#features" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-sm font-medium">Features</a >
                        <a href="#about" class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium">About</a >
                        <a href="{{ route('contact') }}" class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium">Contact</a >
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 text-sm font-medium">Dashboard</a >
                         <div style="width:20px"> </div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-blue-600 text-sm font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 text-sm font-medium">Login</a >
                        <div style="width:20px"> </div>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Get Started</a >
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-6">Share Your Stories with the World</h1>
                <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
                    A beautiful platform to express your thoughts, share experiences, and connect with like-minded writers. 
                    Join our community of storytellers today.
                </p >
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                            Go to Dashboard
                        </a >
                    @else
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                            Start Writing Now
                        </a >
                        <a href="#features" class="border border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                            Learn More
                        </a >
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div style="height:20px"> </div>
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose StoryHub?</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Powerful features designed for modern writers and content creators</p >
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-gray-50 rounded-xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Easy Writing</h3>
                    <p class="text-gray-600">Beautiful editor with real-time preview. Focus on your content while we handle the formatting.</p >
                </div>

                <!-- Feature 2 -->
                <div class="feature-card bg-gray-50 rounded-xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Engage Community</h3>
                    <p class="text-gray-600">Connect with readers and other writers. Build your audience and get valuable feedback.</p >
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-gray-50 rounded-xl p-8 border border-gray-200 shadow-sm">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Secure Platform</h3>
                    <p class="text-gray-600">Your content is safe with us. Advanced security features to protect your intellectual property.</p >
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl font-bold mb-2">{{ \App\Models\Post::count() }}+</div>
                    <div class="text-gray-400">Posts Published</div>
                </div>
                <div>
                    <div class="text-3xl font-bold mb-2">{{ \App\Models\User::count() }}+</div>
                    <div class="text-gray-400">Active Writers</div>
                </div>
                <div>
                    <div class="text-3xl font-bold mb-2">24/7</div>
                    <div class="text-gray-400">Support</div>
                </div>
                <div>
                    <div class="text-3xl font-bold mb-2">100%</div>
                    <div class="text-gray-400">Free</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-blue-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to Start Your Writing Journey?</h2>
            <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                Join thousands of writers who are already sharing their stories on our platform.
            </p >
            @auth
                <a href="{{ route('crud.create') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                    Write Your First Post
                </a >
            @else
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                    Join Now - It's Free
                </a >
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">StoryHub</h3>
                    <p class="text-gray-400">A platform for writers to share their stories and connect with readers worldwide.</p >
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#features" class="hover:text-white transition-colors">Features</a ></li>
                        <li><a href="#about" class="hover:text-white transition-colors">About Us</a ></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a ></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Account</h4>
                    <ul class="space-y-2 text-gray-400">
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Dashboard</a ></li>
                            <li><a href="{{ route('profile.edit') }}" class="hover:text-white transition-colors">Profile</a ></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Login</a ></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Register</a ></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a ></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a ></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 StoryHub. All rights reserved.</p >
            </div>
        </div>
    </footer>
</body>
</html>