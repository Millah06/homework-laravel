@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-300 bg-clip-text text-transparent">
                Profile Settings
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2 text-lg">Manage your account settings and preferences</p >
        </div>

        <div class="space-y-6">
            <!-- Profile Information Card -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-700/50 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Profile Information</h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Update your account's profile information and email address</p >
                    </div>
                    <div class="p-3 bg-blue-500/10 rounded-xl">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password Card -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-700/50 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Update Password</h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Ensure your account is using a long, random password to stay secure</p >
                    </div>
                    <div class="p-3 bg-green-500/10 rounded-xl">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete Account Card -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50 dark:border-gray-700/50 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Delete Account</h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Permanently delete your account and all of its data</p >
                    </div>
                    <div class="p-3 bg-red-500/10 rounded-xl">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </div>
                </div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

<!-- Add some custom styling for the forms -->
<style>
    .profile-form input:focus {
        border-color: #3b82f6;
        ring-color: #3b82f6;
    }
    
    .profile-form button:hover {
        transform: translateY(-1px);
        transition: all 0.2s ease-in-out;
    }
</style>
@endsection