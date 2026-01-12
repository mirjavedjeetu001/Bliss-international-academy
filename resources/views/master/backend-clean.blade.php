<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Admin Dashboard - Katunia Rajbari College')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/images/brand/favicon.ico') }}" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- TinyMCE Rich Text Editor -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.7.2/tinymce.min.js" referrerpolicy="origin"></script>
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --sidebar-width: 280px;
            --header-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
            line-height: 1.6;
        }

        /* Header Styles */
        .admin-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: white;
            border-bottom: 1px solid #e2e8f0;
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--secondary-color);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .sidebar-toggle:hover {
            background-color: #f1f5f9;
            color: var(--primary-color);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--dark-color);
        }

        .logo img {
            width: 40px;
            height: 40px;
            border-radius: 0.5rem;
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .header-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-input {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            width: 300px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            color: var(--secondary-color);
            font-size: 0.875rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .user-menu:hover {
            background-color: #f1f5f9;
        }

        .user-dropdown {
            min-width: 200px;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 0.5rem 0;
        }

        .user-dropdown .dropdown-header {
            padding: 0.5rem 1rem;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .user-dropdown .dropdown-item {
            padding: 0.5rem 1rem;
            color: var(--dark-color);
            transition: all 0.2s ease;
        }

        .user-dropdown .dropdown-item:hover {
            background-color: #f1f5f9;
            color: var(--primary-color);
        }

        .user-dropdown .dropdown-item.text-danger:hover {
            background-color: #fef2f2;
            color: var(--danger-color);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--secondary-color);
        }

        /* Sidebar Styles */
        .admin-sidebar {
            position: fixed;
            top: var(--header-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            background: white;
            border-right: 1px solid #e2e8f0;
            z-index: 999;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-collapsed {
            transform: translateX(-100%);
        }

        .sidebar-menu {
            padding: 1.5rem 0;
        }

        .menu-section {
            margin-bottom: 2rem;
        }

        .menu-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--secondary-color);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0 1.5rem;
            margin-bottom: 0.75rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: var(--secondary-color);
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background-color: #f8fafc;
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }

        .menu-item.active {
            background-color: #eff6ff;
            color: var(--primary-color);
            border-left-color: var(--primary-color);
        }

        .menu-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-text {
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height));
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        /* Tables */
        .table {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .table thead th {
            background: #f8fafc;
            border: none;
            font-weight: 600;
            color: var(--dark-color);
            padding: 1rem;
        }

        .table tbody td {
            border: none;
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr {
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Badges */
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .search-input {
                width: 200px;
            }

            .header-left {
                gap: 0.5rem;
            }

            .logo-text {
                display: none;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.3s ease;
        }

        /* Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
            display: none;
        }

        .sidebar-overlay.show {
            display: block;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="admin-header">
        <div class="header-left">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('backend/assets/images/brand/logo.png') }}" alt="Logo">
                <span class="logo-text">Katunia Rajbari College</span>
            </a>
        </div>
        
        <div class="header-right">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search...">
            </div>
            
            <div class="dropdown">
                <div class="user-menu" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div class="user-role">Administrator</div>
                    </div>
                    <i class="fas fa-chevron-down"></i>
                </div>
                
                <ul class="dropdown-menu dropdown-menu-end user-dropdown">
                    <li>
                        <div class="dropdown-header">
                            <div class="fw-semibold">{{ Auth::user()->name ?? 'Admin' }}</div>
                            <small class="text-muted">{{ Auth::user()->email ?? 'admin@example.com' }}</small>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user me-2"></i>Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cog me-2"></i>Settings
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('backend.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <nav class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-title">Main</div>
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home menu-icon"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Content Management</div>
                <a href="{{ route('backend.page.index') }}" class="menu-item {{ request()->routeIs('backend.page.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt menu-icon"></i>
                    <span class="menu-text">Pages</span>
                </a>
                <a href="{{ route('backend.slider.index') }}" class="menu-item {{ request()->routeIs('backend.slider.*') ? 'active' : '' }}">
                    <i class="fas fa-images menu-icon"></i>
                    <span class="menu-text">Manage Slider</span>
                </a>
                <a href="{{ route('backend.pastevent.index') }}" class="menu-item {{ request()->routeIs('backend.pastevent.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt menu-icon"></i>
                    <span class="menu-text">Past Events</span>
                </a>
                <a href="{{ route('backend.latestupdate.index') }}" class="menu-item {{ request()->routeIs('backend.latestupdate.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper menu-icon"></i>
                    <span class="menu-text">Latest Updates</span>
                </a>
                <a href="{{ route('backend.teacher.index') }}" class="menu-item {{ request()->routeIs('backend.teacher.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher menu-icon"></i>
                    <span class="menu-text">Manage Teacher</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Manage Media</div>
                <a href="{{ route('backend.mediacategory.index') }}" class="menu-item {{ request()->routeIs('backend.mediacategory.*') ? 'active' : '' }}">
                    <i class="fas fa-folder menu-icon"></i>
                    <span class="menu-text">Media Category</span>
                </a>
                <a href="{{ route('backend.photogallery.index') }}" class="menu-item {{ request()->routeIs('backend.photogallery.*') ? 'active' : '' }}">
                    <i class="fas fa-camera menu-icon"></i>
                    <span class="menu-text">Photo Gallery</span>
                </a>
                <a href="{{ route('backend.videogallery.index') }}" class="menu-item {{ request()->routeIs('backend.videogallery.*') ? 'active' : '' }}">
                    <i class="fas fa-video menu-icon"></i>
                    <span class="menu-text">Video Gallery</span>
                </a>
                <a href="{{ route('backend.book.index') }}" class="menu-item {{ request()->routeIs('backend.book.*') ? 'active' : '' }}">
                    <i class="fas fa-book menu-icon"></i>
                    <span class="menu-text">Manage Books</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">Communication</div>
                <a href="{{ route('backend.contact.index') }}" class="menu-item {{ request()->routeIs('backend.contact.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope menu-icon"></i>
                    <span class="menu-text">Contact Messages</span>
                </a>
            </div>

            <div class="menu-section">
                <div class="menu-title">User Management</div>
                @can('manage users')
                    <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users-cog menu-icon"></i>
                        <span class="menu-text">Users</span>
                    </a>
                @endcan
                @can('manage roles')
                    <a href="{{ route('admin.roles.index') }}" class="menu-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                        <i class="fas fa-user-shield menu-icon"></i>
                        <span class="menu-text">Roles</span>
                    </a>
                @endcan
                @can('manage permissions')
                    <a href="{{ route('admin.permissions.index') }}" class="menu-item {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                        <i class="fas fa-lock menu-icon"></i>
                        <span class="menu-text">Permissions</span>
                    </a>
                @endcan
                <a href="{{ route('admin.users.change-password.form') }}" class="menu-item {{ request()->routeIs('admin.users.change-password.form') ? 'active' : '' }}">
                    <i class="fas fa-key menu-icon"></i>
                    <span class="menu-text">Change Password</span>
                </a>
                <a href="{{ route('admin.menus.index') }}" class="menu-item {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                    <i class="fas fa-bars menu-icon"></i>
                    <span class="menu-text">Menu Management</span>
                </a>
                <a href="{{ route('admin.site-settings.index') }}" class="menu-item {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cogs menu-icon"></i>
                    <span class="menu-text">Site Settings</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const adminSidebar = document.getElementById('adminSidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            // Sidebar toggle functionality
            sidebarToggle.addEventListener('click', function() {
                adminSidebar.classList.toggle('sidebar-collapsed');
                mainContent.classList.toggle('expanded');
                sidebarOverlay.classList.toggle('show');
            });
            
            // Close sidebar when clicking overlay
            sidebarOverlay.addEventListener('click', function() {
                adminSidebar.classList.add('sidebar-collapsed');
                mainContent.classList.add('expanded');
                sidebarOverlay.classList.remove('show');
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    adminSidebar.classList.remove('sidebar-collapsed');
                    mainContent.classList.remove('expanded');
                    sidebarOverlay.classList.remove('show');
                }
            });
            
            // Add fade-in animation to content
            const content = document.querySelector('.main-content');
            if (content) {
                content.classList.add('fade-in');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
