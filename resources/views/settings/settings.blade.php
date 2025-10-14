<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            background-color: #fffaf3;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: 30px;
        }

        .sidebar {
            width: 280px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            padding: 24px;
            height: fit-content;
        }

        .main-content {
            flex: 1;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            padding: 32px;
        }

        h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 24px;
            color: #1a1a1a;
        }

        h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 24px;
            color: #1a1a1a;
        }

        h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #1a1a1a;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #4b5563;
        }

        .nav-item:hover {
            background-color: #fff7e5;
        }

        .nav-item.active {
            background-color: #fff7e5;
            color: #ff9d00;
            font-weight: 600;
            border-left: 4px solid #ff9d00;
        }

        .nav-item i {
            margin-right: 12px;
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .card {
            background: #fffaf3;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid #ffebcc;
        }

        .profile-picture {
            display: flex;
            align-items: center;
            margin-bottom: 32px;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffb84d, #ff9d00);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin-right: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: #ff9d00;
            color: white;
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

        .btn-outline {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .btn-outline:hover {
            background: #f9fafb;
            border-color: #ff9d00;
            color: #ff9d00;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.3);
        }

        .btn-danger:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(220, 38, 38, 0.3);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
        }

        input, select {
            width: 100%;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 16px;
            transition: all 0.2s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #ff9d00;
            box-shadow: 0 0 0 3px rgba(255, 157, 0, 0.1);
        }

        .toggle {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 28px;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #d1d5db;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #ff9d00;
        }

        input:checked + .slider:before {
            transform: translateX(24px);
        }

        .toggle-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .toggle-item:last-child {
            border-bottom: none;
        }

        .toggle-label {
            margin-bottom: 0;
        }

        .toggle-text {
            font-size: 14px;
            color: #6b7280;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 32px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            color: #dc2626;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 24px;
        }

        .logout-btn:hover {
            background: #fef2f2;
            border-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.1);
        }

        .logout-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(220, 38, 38, 0.1);
        }

        .logout-btn i {
            margin-right: 8px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 24px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #6b7280;
        }

        .modal-close:hover {
            color: #374151;
        }

        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #10b981;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            z-index: 1001;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast i {
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <h1>Settings</h1>
            <div class="nav-item active">
                <i class="fas fa-user"></i>
                <span>Account</span>
            </div>
            <div class="nav-item">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Account Section -->
            <div id="account-section">
                <h2>ACCOUNT</h2>
                <div class="card">
                    <div class="profile-picture">
                        <div class="avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h3>Edit Your Profile Picture</h3>
                            <button class="btn btn-primary" id="upload-photo-btn">Upload New Photo</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" value="user@example.com">
                    </div>
                    
                    <h3>Change Password</h3>
                    <div class="form-group">
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" placeholder="Enter current password">
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" placeholder="Enter new password">
                    </div>
                    <div class="form-group">
                        <label for="retype-password">Retype New Password</label>
                        <input type="password" id="retype-password" placeholder="Retype new password">
                    </div>
                    
                    <button class="logout-btn" id="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </div>
            </div>

            <!-- Notifications Section -->
            <div id="notifications-section" style="display: none;">
                <h2>NOTIFICATIONS</h2>
                <div class="card">
                    <div class="toggle-item">
                        <div>
                            <h3 class="toggle-label">Upcoming Events</h3>
                            <p class="toggle-text">Get notified about upcoming events</p>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" id="upcoming-events-toggle" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    
                    <div class="toggle-item">
                        <div>
                            <h3 class="toggle-label">New Events Posted</h3>
                            <p class="toggle-text">Receive alerts when new events are posted</p>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" id="new-events-toggle" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    
                    <div class="toggle-item">
                        <div>
                            <h3 class="toggle-label">Email Notifications</h3>
                            <p class="toggle-text">Receive notifications via email</p>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" id="email-notifications-toggle">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <button class="btn btn-primary" id="save-changes-btn">Save Changes</button>
                <button class="btn btn-outline" id="cancel-btn">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal" id="upload-photo-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Upload Profile Photo</h3>
                <button class="modal-close" id="close-upload-modal">&times;</button>
            </div>
            <p>Select a new profile photo from your device:</p>
            <div style="margin-top: 16px;">
                <input type="file" id="photo-file" accept="image/*">
            </div>
            <div class="action-buttons" style="margin-top: 24px;">
                <button class="btn btn-primary" id="confirm-upload-btn">Upload</button>
                <button class="btn btn-outline" id="cancel-upload-btn">Cancel</button>
            </div>
        </div>
    </div>

    <div class="modal" id="logout-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirm Logout</h3>
                <button class="modal-close" id="close-logout-modal">&times;</button>
            </div>
            <p>Are you sure you want to logout? You'll need to sign in again to access your account.</p>
            <div class="action-buttons" style="margin-top: 24px;">
                <button class="btn btn-danger" id="confirm-logout-btn">Yes, Logout</button>
                <button class="btn btn-outline" id="cancel-logout-btn">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i class="fas fa-check-circle"></i>
        <span id="toast-message">Changes saved successfully!</span>
    </div>

    <script>
        // Navigation functionality
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all nav items
                document.querySelectorAll('.nav-item').forEach(nav => {
                    nav.classList.remove('active');
                });
                
                // Add active class to clicked nav item
                this.classList.add('active');
                
                // Hide all sections
                document.getElementById('account-section').style.display = 'none';
                document.getElementById('notifications-section').style.display = 'none';
                
                // Show the selected section
                const text = this.querySelector('span').textContent;
                if (text === 'Account') {
                    document.getElementById('account-section').style.display = 'block';
                } else if (text === 'Notifications') {
                    document.getElementById('notifications-section').style.display = 'block';
                }
            });
        });

        // Upload Photo Button
        document.getElementById('upload-photo-btn').addEventListener('click', function() {
            document.getElementById('upload-photo-modal').style.display = 'flex';
        });

        // Close Upload Modal
        document.getElementById('close-upload-modal').addEventListener('click', function() {
            document.getElementById('upload-photo-modal').style.display = 'none';
        });

        document.getElementById('cancel-upload-btn').addEventListener('click', function() {
            document.getElementById('upload-photo-modal').style.display = 'none';
        });

        // Confirm Upload
        document.getElementById('confirm-upload-btn').addEventListener('click', function() {
            const fileInput = document.getElementById('photo-file');
            if (fileInput.files.length > 0) {
                showToast('Profile photo updated successfully!');
                document.getElementById('upload-photo-modal').style.display = 'none';
            } else {
                alert('Please select a photo to upload.');
            }
        });

        // Logout Button
        document.getElementById('logout-btn').addEventListener('click', function() {
            document.getElementById('logout-modal').style.display = 'flex';
        });

        // Close Logout Modal
        document.getElementById('close-logout-modal').addEventListener('click', function() {
            document.getElementById('logout-modal').style.display = 'none';
        });

        document.getElementById('cancel-logout-btn').addEventListener('click', function() {
            document.getElementById('logout-modal').style.display = 'none';
        });

        // Confirm Logout
        document.getElementById('confirm-logout-btn').addEventListener('click', function() {
            showToast('You have been logged out successfully.');
            document.getElementById('logout-modal').style.display = 'none';
            // In a real app, you would redirect to login page
        });

        // Save Changes Button
        document.getElementById('save-changes-btn').addEventListener('click', function() {
            showToast('All changes saved successfully!');
        });

        // Cancel Button
        document.getElementById('cancel-btn').addEventListener('click', function() {
            // Reset form values to original state
            document.getElementById('email').value = 'user@example.com';
            document.getElementById('current-password').value = '';
            document.getElementById('new-password').value = '';
            document.getElementById('retype-password').value = '';
            
            showToast('Changes discarded.');
        });

        // Toast Notification Function
        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            
            toastMessage.textContent = message;
            toast.classList.add('show');
            
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            const uploadModal = document.getElementById('upload-photo-modal');
            const logoutModal = document.getElementById('logout-modal');
            
            if (event.target === uploadModal) {
                uploadModal.style.display = 'none';
            }
            if (event.target === logoutModal) {
                logoutModal.style.display = 'none';
            }
        });
    </script>
</body>
</html>