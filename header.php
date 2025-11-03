<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  
  <!-- Minimal critical CSS to prevent FOUC - full styles in main.css -->
  <style>
    .nav-loading { visibility: hidden; }
    .nav-loading header { visibility: visible; display: block; background: #fff; position: sticky; top: 0; z-index: 50; }
    .nav-loading .nav-flex { display: flex; align-items: center; justify-content: space-between; height: 4rem; }
    @media (min-width: 1024px) { .nav-loading .nav-flex { height: 5rem; } }
  </style>
  
  <?php wp_head(); ?>
  
  <!-- Remove loading class when CSS is ready -->
  <script>
    // Remove nav-loading class as early as possible
    function removeNavLoading() {
      document.body.classList.remove('nav-loading');
    }
    
    // Try multiple approaches for fastest removal
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', removeNavLoading);
    } else {
      removeNavLoading();
    }
    
    // Fallback timeout
    setTimeout(removeNavLoading, 100);
  </script>
</head>
<body <?php body_class('min-h-svh bg-white text-slate-900 antialiased nav-loading'); ?>>
  <a class="skip-link sr-only focus:not-sr-only" href="#main">Skip to content</a>
  
  <!-- Header -->
  <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="container mx-auto px-4">
      <div class="nav-flex flex items-center justify-between h-16 lg:h-20">
        
        <!-- Logo -->
        <div class="logo-container flex-shrink-0">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center hover:opacity-80 transition-opacity duration-200">
            <img src="<?php echo simple_get_asset_image('logos/horizontal-logo-dark.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="h-8 lg:h-10 w-auto">
          </a>
        </div>
        
        <!-- Desktop Navigation -->
        <nav class="desktop-nav hidden lg:flex items-center space-x-8">
          <!-- Products Dropdown -->
          <div class="nav-dropdown group relative">
            <button class="nav-link flex items-center space-x-1 px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
              <span>Products</span>
              <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="nav-dropdown-content absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-40">
              <div class="p-2">
                <a href="#" class="nav-dropdown-item flex items-start p-3 rounded-md hover:bg-gray-50 transition-colors duration-200">
                  <div>
                    <div class="font-semibold text-gray-900">Secure Email</div>
                    <div class="text-sm text-gray-600">HIPAA-compliant email solution</div>
                  </div>
                </a>
                <a href="#" class="nav-dropdown-item flex items-start p-3 rounded-md hover:bg-gray-50 transition-colors duration-200">
                  <div>
                    <div class="font-semibold text-gray-900">Secure Text</div>
                    <div class="text-sm text-gray-600">Secure patient portal access</div>
                  </div>
                </a>
                <a href="#" class="nav-dropdown-item flex items-start p-3 rounded-md hover:bg-gray-50 transition-colors duration-200">
                  <div>
                    <div class="font-semibold text-gray-900">Secure Marketing</div>
                    <div class="text-sm text-gray-600">ePHI email marketing solution</div>
                  </div>
                </a>
                <a href="#" class="nav-dropdown-item flex items-start p-3 rounded-md hover:bg-gray-50 transition-colors duration-200">
                  <div>
                    <div class="font-semibold text-gray-900">Secure Forms</div>
                    <div class="text-sm text-gray-600">Safe data collection forms</div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          
          <!-- Solutions Dropdown -->
          <div class="nav-dropdown group relative">
            <button class="nav-link flex items-center space-x-1 px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
              <span>Solutions</span>
              <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="nav-dropdown-content absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-40">
              <div class="p-2">
                <a href="#" class="nav-dropdown-item flex items-start p-3 rounded-md hover:bg-gray-50 transition-colors duration-200">
                  <div>
                    <div class="font-semibold text-gray-900">Care Management</div>
                    <div class="text-sm text-gray-600">Patient engagement solutions</div>
                  </div>
                </a>
                <a href="#" class="nav-dropdown-item flex items-start p-3 rounded-md hover:bg-gray-50 transition-colors duration-200">
                  <div>
                    <div class="font-semibold text-gray-900">Marketing</div>
                    <div class="text-sm text-gray-600">Healthcare marketing campaigns</div>
                  </div>
                </a>
                <a href="#" class="nav-dropdown-item flex items-start p-3 rounded-md hover:bg-gray-50 transition-colors duration-200">
                  <div>
                    <div class="font-semibold text-gray-900">Preventative Care</div>
                    <div class="text-sm text-gray-600">Proactive patient engagement</div>
                  </div>
                </a>
              </div>
            </div>
          </div>
          
          <!-- Resources -->
          <a href="#" class="nav-link px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">Resources</a>
          
          <!-- Company Dropdown -->
          <div class="nav-dropdown group relative">
            <button class="nav-link flex items-center space-x-1 px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
              <span>Company</span>
              <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="nav-dropdown-content absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-40">
              <div class="p-2">
                <a href="#" class="nav-dropdown-item block px-3 py-2 text-gray-900 hover:bg-gray-50 rounded-md transition-colors duration-200">About Us</a>
                <a href="#" class="nav-dropdown-item block px-3 py-2 text-gray-900 hover:bg-gray-50 rounded-md transition-colors duration-200">Leadership</a>
                <a href="#" class="nav-dropdown-item block px-3 py-2 text-gray-900 hover:bg-gray-50 rounded-md transition-colors duration-200">Careers</a>
                <a href="#" class="nav-dropdown-item block px-3 py-2 text-gray-900 hover:bg-gray-50 rounded-md transition-colors duration-200">News</a>
              </div>
            </div>
          </div>
          
          <!-- Pricing -->
          <a href="#" class="nav-link px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">Pricing</a>
        </nav>
        
        <!-- CTA Buttons -->
        <div class="hidden lg:flex items-center space-x-4">
          <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">Login</a>
          <a href="#" class="btn-secondary px-4 py-2 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 font-medium transition-all duration-200">Contact Us</a>
          <a href="#" class="btn-primary px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium transition-all duration-200">Get a Demo</a>
        </div>
        
        <!-- Mobile Menu Button -->
        <div class="lg:hidden">
          <button id="mobile-menu-button" class="mobile-toggle mobile-menu-toggle p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-gray-100 transition-colors duration-200" aria-expanded="false">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path class="hamburger-line" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              <path class="close-line hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>
      
      <!-- Mobile Navigation -->
      <div id="mobile-menu" class="lg:hidden hidden border-t border-gray-200 pt-4 pb-4">
        <div class="space-y-1">
          <!-- Mobile Products -->
          <div class="mobile-dropdown">
            <button class="mobile-dropdown-toggle w-full flex items-center justify-between px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md transition-colors duration-200">
              <span class="font-medium">Products</span>
              <svg class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="mobile-dropdown-content hidden pl-4 mt-1 space-y-1">
              <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">Secure Email</a>
              <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">Secure Text</a>
              <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">Secure Marketing</a>
              <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">Secure Forms</a>
            </div>
          </div>
          
          <!-- Mobile Solutions -->
          <div class="mobile-dropdown">
            <button class="mobile-dropdown-toggle w-full flex items-center justify-between px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md transition-colors duration-200">
              <span class="font-medium">Solutions</span>
              <svg class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="mobile-dropdown-content hidden pl-4 mt-1 space-y-1">
              <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">Care Management</a>
              <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">Marketing</a>
              <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">Preventative Care</a>
            </div>
          </div>
          
          <a href="#" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md font-medium">Resources</a>
          
          <!-- Mobile Company -->
          <div class="mobile-dropdown">
            <button class="mobile-dropdown-toggle w-full flex items-center justify-between px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md transition-colors duration-200">
              <span class="font-medium">Company</span>
              <svg class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="mobile-dropdown-content hidden pl-4 mt-1 space-y-1">
              <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">About Us</a>
              <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">Leadership</a>
              <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">Careers</a>
              <a href="#" class="block px-3 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-md">News</a>
            </div>
          </div>
          
          <a href="#" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md font-medium">Pricing</a>
          
          <!-- Mobile CTA -->
          <div class="pt-4 border-t border-gray-200 mt-4 space-y-2">
            <a href="#" class="block px-3 py-2 text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md font-medium">Login</a>
            <a href="#" class="block px-3 py-2 text-center border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 font-medium">Contact Us</a>
            <a href="#" class="block px-3 py-2 text-center bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">Get a Demo</a>
          </div>
        </div>
      </div>
    </div>
  </header>
