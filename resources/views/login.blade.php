@extends('layouts.app')

@section('title', 'Login - El3bha')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form id="login-form" method="POST" action="{{ route('login.authenticate') }}" class="p-4 p-md-5"
                    style="max-width: 450px; margin: 0 auto; background-color: var(--page-background); border-radius: 8px;">
                    @csrf

                    <h1 style="font-size: 2.2rem; font-weight: 600; color: var(--primary-color); margin-bottom: 10px;">Login
                    </h1>
                    <p style="color: var(--secondary-text); font-size: 1rem; margin-bottom: 1.8rem;">Welcome back! Please
                        login to continue</p>

                    @if ($errors->any())
                        <div class="mb-4"
                            style="background-color: rgba(231, 76, 60, 0.1); border-radius: var(--border-radius); padding: 0.75rem; border-left: 4px solid var(--danger-color);">
                            <ul style="margin: 0; padding-left: 1rem; color: var(--danger-color);">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="username-email"
                            style="display: block; margin-bottom: 0.6rem; color: var(--primary-text); font-weight: 500; font-size: 1rem;">Username
                            or Email</label>
                        <input type="text" id="username-email" name="username-email"
                            placeholder="Enter your username or email" required value="{{ old('username-email') }}"
                            style="width: 100%; padding: 14px 16px; background-color: #262640; border: 1px solid #393959; color: var(--primary-text); border-radius: 8px; font-size: 0.95rem; transition: all var(--transition-speed);">
                    </div>

                    <div class="mb-4">
                        <label for="password"
                            style="display: block; margin-bottom: 0.6rem; color: var(--primary-text); font-weight: 500; font-size: 1rem;">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required
                            style="width: 100%; padding: 14px 16px; background-color: #262640; border: 1px solid #393959; color: var(--primary-text); border-radius: 8px; font-size: 0.95rem; transition: all var(--transition-speed);">
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="btn"
                            style="width: 100%; padding: 14px; font-size: 1rem; font-weight: 600; background-color: var(--primary-color); border: none; color: var(--primary-text); border-radius: 8px; transition: all var(--transition-speed); cursor: pointer; margin-top: 10px;">
                            Login
                        </button>
                    </div>

                    <div style="color: var(--secondary-text); font-size: 0.95rem; text-align: center; margin-top: 12px;">
                        Don't have an account? <a href="{{ route('signup') }}"
                            style="color: var(--primary-color); text-decoration: none; font-weight: 500; transition: all var(--transition-speed);">Create
                            new account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        #username-email:focus,
        #password:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: #262640;
        }

        button[type="submit"]:hover {
            background-color: var(--primary-hover);
        }

        a:hover {
            color: var(--secondary-color) !important;
        }

        @media (max-width: 576px) {
            #login-form {
                max-width: 100%;
            }
        }
    </style>
@endpush