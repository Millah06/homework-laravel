@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Create New Post</h1>
            <p class="text-gray-600 dark:text-gray-400">Share your thoughts with the world</p >
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('crud.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Title Field -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Post Title <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title"
                            required
                            maxlength="255"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition duration-200"
                            placeholder="Enter a captivating title..."
                            value="{{ old('title') }}"
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p >
                        @enderror
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            <span id="title-counter">0</span>/255 characters
                        </div>
                    </div>

                    <!-- Content Field -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Post Content <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="content" 
                            id="content"
                            required
                            rows="12"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition duration-200 resize-vertical"
                            placeholder="Write your post content here... Share your ideas, stories, or knowledge with the community."
                        >{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p >
                        @enderror
                    </div>

                    <!-- Author Info (Display only) -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <p class="text-sm text-blue-700 dark:text-blue-300">
                            <strong>Author:</strong> {{ auth()->user()->name }}
                        </p >
                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                            This post will be published under your name
                        </p >
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button 
                            type="submit" 
                            class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition duration-200 transform hover:-translate-y-0.5"
                        >
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Publish Post
                        </button>
                        
                        <a 
                            href=" {{ route('crud.index') }}" 
                            class="flex-1 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-3 px-6 rounded-lg text-center transition duration-200"
                        >
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Posts
                        </a >
                    </div>
                </form>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="mt-8 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200 mb-2">💡 Writing Tips</h3>
            <ul class="text-yellow-700 dark:text-yellow-300 text-sm space-y-1">
                <li>• Write a clear and engaging title</li>
                <li>• Break content into paragraphs for better readability</li>
                <li>• Use proper formatting and punctuation</li>
                <li>• Make sure your content is original and valuable</li>
            </ul>
        </div>
    </div>
</div>

<!-- JavaScript for Character Counter -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title');
        const titleCounter = document.getElementById('title-counter');
        
        titleInput.addEventListener('input', function() {
            const count = this.value.length;
            titleCounter.textContent = count;
            
            if (count > 250) {
                titleCounter.classList.add('text-red-500');
                titleCounter.classList.remove('text-gray-500');
            } else {
                titleCounter.classList.remove('text-red-500');
                titleCounter.classList.add('text-gray-500');
            }
        });
        
        // Initialize counter
        titleCounter.textContent = titleInput.value.length;
    });
</script>

<style>
    .resize-vertical {
        resize: vertical;
        min-height: 200px;
    }
    
    textarea:focus, input:focus {
        outline: none;
        ring: 2px;
    }
</style>
@endsection