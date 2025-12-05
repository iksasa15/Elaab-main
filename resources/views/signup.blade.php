@extends('layouts.app')

@section('title', 'Create Account - El3bha')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form id="signup-form" method="POST" action="{{ route('signup.register') }}" class="p-4 p-md-5"
                    style="max-width: 450px; margin: 0 auto; background-color: var(--page-background); border-radius: 8px;">
                    @csrf

                    <h1 style="font-size: 2.2rem; font-weight: 600; color: var(--primary-color); margin-bottom: 10px;">
                        Create Account</h1>
                    <p style="color: var(--secondary-text); font-size: 1rem; margin-bottom: 1.8rem;">Join us today! Create
                        your account to get started</p>

                    @if ($errors->any())
                        <div class="mb-4"
                            style="background-color: rgba(231, 76, 60, 0.1); border-radius: 8px; padding: 0.75rem; border-left: 4px solid var(--danger-color);">
                            <ul style="margin: 0; padding-left: 1rem; color: var(--danger-color);">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="username"
                            style="display: block; margin-bottom: 0.6rem; color: var(--primary-text); font-weight: 500; font-size: 1rem;">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required
                            value="{{ old('username') }}"
                            style="width: 100%; padding: 14px 16px; background-color: #262640; border: 1px solid #393959; color: var(--primary-text); border-radius: 8px; font-size: 0.95rem; transition: all var(--transition-speed);">
                    </div>

                    <div class="mb-4">
                        <label for="fullname"
                            style="display: block; margin-bottom: 0.6rem; color: var(--primary-text); font-weight: 500; font-size: 1rem;">Full
                            Name</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required
                            value="{{ old('fullname') }}"
                            style="width: 100%; padding: 14px 16px; background-color: #262640; border: 1px solid #393959; color: var(--primary-text); border-radius: 8px; font-size: 0.95rem; transition: all var(--transition-speed);">
                    </div>

                    <div class="mb-4">
                        <label for="email"
                            style="display: block; margin-bottom: 0.6rem; color: var(--primary-text); font-weight: 500; font-size: 1rem;">Email
                            Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email address" required
                            value="{{ old('email') }}"
                            style="width: 100%; padding: 14px 16px; background-color: #262640; border: 1px solid #393959; color: var(--primary-text); border-radius: 8px; font-size: 0.95rem; transition: all var(--transition-speed);">
                    </div>

                    <div class="mb-4">
                        <label for="password"
                            style="display: block; margin-bottom: 0.6rem; color: var(--primary-text); font-weight: 500; font-size: 1rem;">Password</label>
                        <input type="password" id="password" name="password" placeholder="Create a password" required
                            style="width: 100%; padding: 14px 16px; background-color: #262640; border: 1px solid #393959; color: var(--primary-text); border-radius: 8px; font-size: 0.95rem; transition: all var(--transition-speed);">
                    </div>

                    <div class="mb-4">
                        <button type="submit" id="signup-btn"
                            style="width: 100%; padding: 14px; font-size: 1rem; font-weight: 600; background-color: var(--primary-color); border: none; color: var(--primary-text); border-radius: 8px; transition: all var(--transition-speed); cursor: pointer; margin-top: 10px;">
                            Create Account
                        </button>
                    </div>

                    <div style="color: var(--secondary-text); font-size: 0.95rem; text-align: center; margin-top: 12px;">
                        Already have an account? <a href="{{ route('login') }}"
                            style="color: var(--primary-color); text-decoration: none; font-weight: 500; transition: all var(--transition-speed);">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        input:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: #262640;
        }

        #signup-btn:hover {
            background-color: var(--primary-hover);
        }

        a:hover {
            color: var(--secondary-color) !important;
        }

        @media (max-width: 576px) {
            #signup-form {
                max-width: 100%;
            }
        }
    </style>
@endpush