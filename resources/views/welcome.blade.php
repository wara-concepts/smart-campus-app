<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Campus App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Header with Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Smart Campus App</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>
                    <ul class="mb-2 mb-lg-0">
                        <a class="btn btn-outline-primary" href="login">Login</a>
                        <a class="btn btn-outline-primary" href="register">Register</a>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero py-5 bg-light">
            <div class="container text-center">
                <h2 class="display-4">Welcome to the Smart Campus</h2>
                <p class="lead">Your one-stop solution for all campus needs.</p>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-5">
            <div class="container">
                <h2 class="mb-4">Features</h2>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item">Real-time Notifications</li>
                            <li class="list-group-item">Campus Map and Navigation</li>
                            <li class="list-group-item">Event Management</li>
                            <li class="list-group-item">Course Management</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <section id="about" class="py-5 bg-light">
            <div class="container">
                <h2 class="mb-4">About Us</h2>
                <p>We aim to provide a seamless experience for students and faculty with our Smart Campus App. Discover
                    more about our features and services.</p>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-5">
            <div class="container">
                <h2 class="mb-4">Contact Us</h2>
                <p>If you have any questions, feel free to <a href="mailto:support@smartcampus.com">email us</a>.</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-3 bg-dark text-light">
        <div class="container text-center">
            <p class="mb-0">&copy; 2023 Smart Campus App | ESOFT Coursework, Software Development Practice | All
                rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
