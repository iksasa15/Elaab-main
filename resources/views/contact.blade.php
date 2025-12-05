@extends('layouts.app')

@section('title', 'Contact Us | El3bha')

@section('styles')
    <style>
        .contact-page {
            padding: 60px 0;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
            max-width: 800px;
            margin: 0 auto;
        }

        .contact-form-container {
            background: linear-gradient(145deg, var(--card-background), rgba(45, 45, 68, 0.7));
            border-radius: var(--border-radius);
            padding: 35px;
            box-shadow: var(--card-shadow);
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            color: var(--primary-text);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            background-color: rgba(30, 30, 46, 0.6);
            border: 1px solid rgba(61, 61, 92, 0.8);
            color: var(--primary-text);
            border-radius: 8px;
            font-size: 1rem;
            transition: all var(--transition-speed);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: rgba(30, 30, 46, 0.8);
        }

        .form-control::placeholder {
            color: rgba(179, 179, 201, 0.5);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .form-submit {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            color: var(--primary-text);
            border: none;
            padding: 15px 25px;
            border-radius: var(--border-radius);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
            font-size: 1rem;
            box-shadow: 0 8px 15px rgba(108, 92, 231, 0.3);
        }

        .form-submit:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(108, 92, 231, 0.4);
        }

        #success-message {
            display: none;
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            align-items: center;
            gap: 15px;
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.3);
            z-index: 1000;
            animation: slideIn 0.3s forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .success-icon {
            font-size: 1.5rem;
        }

        @media (max-width: 576px) {
            .contact-container {
                padding: 0 15px;
            }

            .contact-form-container {
                padding: 25px 20px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="contact-page">
        <div class="container">
            <div class="contact-container">
                <div class="contact-form-container">
                    <form id="contact-form" method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email address" required>
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" placeholder="How can we help you?"
                                required></textarea>
                        </div>
                        <button type="submit" class="form-submit">Send Message <i
                                class="fas fa-paper-plane ml-2"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success message notification -->
    <div id="success-message">
        <div class="success-icon"><i class="fas fa-check-circle"></i></div>
        <div>Message sent successfully! We'll get back to you soon.</div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const contactForm = document.getElementById('contact-form');
            const successMessage = document.getElementById('success-message');

            contactForm.addEventListener('submit', function (event) {
                event.preventDefault();

                // In a real application, you would send this data to a server endpoint
                // For this example, we'll just show a success message

                successMessage.style.display = 'flex';
                contactForm.reset();

                // Hide success message after 5 seconds
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000);
            });
        });
    </script>
@endsection