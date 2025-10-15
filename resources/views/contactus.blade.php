<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - ManaEvent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #fffaf3;
            color: #333;
            line-height: 1.6;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        header {
            text-align: center;
            margin-bottom: 50px;
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #1a1a1a;
        }

        .subtitle {
            font-size: 16px;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .contact-info {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .contact-form {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 24px;
            color: #1a1a1a;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .info-item i {
            background: #fff7e5;
            color: #ff9d00;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-right: 16px;
            flex-shrink: 0;
        }

        .info-content h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1a1a1a;
        }

        .info-content p {
            color: #6b7280;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }

        input, textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            transition: all 0.2s ease;
            font-family: 'Poppins', sans-serif;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #ff9d00;
            box-shadow: 0 0 0 3px rgba(255, 157, 0, 0.1);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: #ff9d00;
            color: white;
            width: 100%;
        }

        .btn-primary:hover {
            background: #e68a00;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 157, 0, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(255, 157, 0, 0.3);
        }

        .btn i {
            margin-right: 8px;
        }

        .response-time {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 16px;
            margin-top: 20px;
            text-align: center;
        }

        .response-time h4 {
            color: #166534;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .response-time p {
            color: #6b7280;
            font-size: 12px;
        }

        @media (max-width: 968px) {
            .content-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }
            
            .contact-info, .contact-form {
                padding: 20px;
            }
            
            .info-item {
                flex-direction: column;
            }
            
            .info-item i {
                margin-bottom: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Contact Us</h1>
            <p class="subtitle">We're here to help! Get in touch with our team for any questions or support.</p>
        </header>

        <div class="content-grid">
            <!-- Contact Information -->
            <div class="contact-info">
                <h2>Get In Touch</h2>
                
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <div class="info-content">
                        <h4>Phone Number</h4>
                        <p>+673 825 2425<br>Mon-Fri, 9am-6pm</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div class="info-content">
                        <h4>Email Address</h4>
                        <p>ManaEvent@gmail.com</p>
                    </div>
                </div>
                
                <div class="response-time">
                    <h4>Quick Response Time</h4>
                    <p>We typically respond within 2-4 hours during business hours</p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">
                <h2>Send Us a Message</h2>
                
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" placeholder="Enter your full name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" placeholder="Enter your email address" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" placeholder="Tell us how we can help you..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Form submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;
            
            // In a real application, you would send this data to a server
            // For demo purposes, we'll just show an alert
            alert(`Thank you, ${name}! Your message has been sent successfully. We'll get back to you at ${email} soon.`);
            
            // Reset form
            document.getElementById('contactForm').reset();
        });
    </script>
</body>
</html>