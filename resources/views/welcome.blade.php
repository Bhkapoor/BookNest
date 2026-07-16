@extends('layouts.app')

@section('content')

<section class="hero-section">
    <div class="hero-overlay">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-7">
                    <span class="hero-badge">🎓 Campus-Only Platform</span>

                    <h1 class="hero-title">
                        Exchange Books,<br>
                        <span>Save Money,</span><br>
                        Support Each Other.
                    </h1>

                    <p class="hero-text">
                        BookNest is a trusted campus-based platform where students can buy,
                        sell, and exchange used academic books easily through offline meetups.
                    </p>

                    <form class="hero-search d-flex">
                        <input type="text" class="form-control" placeholder="Search by subject, semester, or title...">
                        <button class="btn btn-warning ms-2" type="submit">Search</button>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-warning btn-lg me-2">Browse Books</a>

                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-outline-light btn-lg">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">List Your Book</a>
                        @endauth
                    </div>
                </div>

                <div class="col-lg-5 d-none d-lg-block">
                    <div class="hero-card">
                        <h4>Why BookNest?</h4>
                        <ul>
                            <li>✔ Buy second-hand books at low price</li>
                            <li>✔ Exchange books with other students</li>
                            <li>✔ Campus meetup system</li>
                            <li>✔ Registration ID based verification</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="section-title">How BookNest Works</h2>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-icon">📝</div>
                    <h5>Register</h5>
                    <p>Create your student account.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-icon">📚</div>
                    <h5>List Book</h5>
                    <p>Add your used books for sale or exchange.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-icon">🔍</div>
                    <h5>Browse</h5>
                    <p>Search books by subject or semester.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-icon">🤝</div>
                    <h5>Meetup</h5>
                    <p>Complete exchange offline on campus.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="about-us" class="bn-about-section">
    <div class="container">

        <div class="text-center mb-5">
            {{-- <p class="bn-label">About BookNest</p> --}}
            <h2 class="bn-section-title">
                About
                <span>BookNest</span>
            </h2>
        </div>

        <div class="row align-items-center g-5">

            <div class="col-lg-6">
                <div class="bn-about-card">
                    <h3>📚 What is BookNest?</h3>

                    <p>
                        BookNest is a campus-based book exchange and resale platform
                        designed to help students buy, sell, and exchange academic books
                        at affordable prices.
                    </p>

                    <p>
                        Instead of purchasing expensive new books every semester,
                        students can connect with seniors and classmates to reuse
                        academic resources.
                    </p>

                    <p>
                        Our platform also provides Previous Year Question Papers (PYQs),
                        helping students prepare effectively for examinations.
                    </p>
                </div>
            </div>

            <div class="col-lg-6">

                <div class="row g-3">

                    <div class="col-6">
                        <div class="bn-about-box">
                            <h3>💰</h3>
                            <h5>Save Money</h5>
                            <p>Affordable second-hand books.</p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="bn-about-box">
                            <h3>♻️</h3>
                            <h5>Reuse Books</h5>
                            <p>Reduce waste through exchange.</p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="bn-about-box">
                            <h3>🎓</h3>
                            <h5>Student Verified</h5>
                            <p>Campus-only trusted community.</p>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="bn-about-box">
                            <h3>📄</h3>
                            <h5>PYQ Access</h5>
                            <p>Previous year papers available.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection