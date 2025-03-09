<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Campus App</title>
    @vite('resources/css/homepage.css')
</head>
<body>
    <header>
        <div class="container">
            <h1>Smart Campus App</h1>
            <nav>
                <ul>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <a class="login-btn" href="login">Login</a>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Welcome to the Smart Campus</h2>
                <p>Your one-stop solution for all campus needs.</p>
                <a class="cta-btn" href="login.html">Get Started</a>
            </div>
        </section>

        <section id="features">
            <h2>Features</h2>
            <ul>
                <li>Real-time Notifications</li>
                <li>Campus Map and Navigation</li>
                <li>Event Management</li>
                <li>Course Management</li>
            </ul>
        </section>
        
        <section id="about">
            <h2>About Us</h2>
            <p>We aim to provide a seamless experience for students and faculty with our Smart Campus App. Discover more about our features and services.</p>
        </section>

        <section id="contact">
            <h2>Contact Us</h2>
            <p>If you have any questions, feel free to <a href="mailto:support@smartcampus.com">email us</a>.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Smart Campus App. All rights reserved.</p>
    </footer>
</body>
</html>