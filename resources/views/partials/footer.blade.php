<footer class="bn-footer">
    <div class="bn-footer-grid">

        <div class="bn-footer-brand">
            <h3>Book<span>Nest</span>.</h3>
            <p>
                A campus-based platform for students to exchange, resell used academic books
                and access free PYQ papers.
            </p>
        </div>

        <div class="bn-footer-col">
            <h6>Platform</h6>
            <a href="#">Browse Books</a>
            <a href="#">List a Book</a>
            <a href="#">PYQ Papers</a>
            <a href="#">My Requests</a>
        </div>

        <div class="bn-footer-col">
            <h6>Account</h6>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register Free</a>
            <a href="#">My Profile</a>
        </div>

        <div class="bn-footer-col">
            <h6>Support</h6>
            <a href="#">How It Works</a>
            <a href="#">FAQ</a>
            <a href="#">Contact Admin</a>
           
        </div>

    </div>

    <div class="bn-footer-bottom">
        <span>© {{ date('Y') }} BookNest. Made with 💚 for campus students.</span>
        <span>All exchanges happen offline on campus.</span>
    </div>
</footer>