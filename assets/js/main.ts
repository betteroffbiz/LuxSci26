// Main TypeScript entry point
import '../css/main.css';

// Your JavaScript/TypeScript code here
console.log('WordPress theme with Vite is loaded!');

// Navigation functionality
document.addEventListener('DOMContentLoaded', () => {
  console.log('DOM is ready');
  
  // Ensure nav-loading class is removed (final cleanup)
  document.body.classList.remove('nav-loading');
  
  // Mobile menu toggle
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const hamburgerLine = mobileMenuButton?.querySelector('.hamburger-line');
  const closeLine = mobileMenuButton?.querySelector('.close-line');
  
  mobileMenuButton?.addEventListener('click', () => {
    const isOpen = mobileMenu?.classList.contains('hidden') === false;
    
    if (isOpen) {
      mobileMenu?.classList.add('hidden');
      hamburgerLine?.classList.remove('hidden');
      closeLine?.classList.add('hidden');
      mobileMenuButton.setAttribute('aria-expanded', 'false');
    } else {
      mobileMenu?.classList.remove('hidden');
      hamburgerLine?.classList.add('hidden');
      closeLine?.classList.remove('hidden');
      mobileMenuButton.setAttribute('aria-expanded', 'true');
    }
  });
  
  // Mobile dropdown toggles
  const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
  mobileDropdownToggles.forEach(toggle => {
    toggle.addEventListener('click', () => {
      const dropdown = toggle.parentElement;
      const content = dropdown?.querySelector('.mobile-dropdown-content');
      const icon = toggle.querySelector('svg');
      
      if (content?.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon?.classList.add('rotate-180');
      } else {
        content?.classList.add('hidden');
        icon?.classList.remove('rotate-180');
      }
    });
  });
  
  // Close mobile menu when clicking outside
  document.addEventListener('click', (event) => {
    const target = event.target as HTMLElement;
    const mobileMenuContainer = document.querySelector('header');
    
    if (!mobileMenuContainer?.contains(target)) {
      mobileMenu?.classList.add('hidden');
      hamburgerLine?.classList.remove('hidden');
      closeLine?.classList.add('hidden');
      mobileMenuButton?.setAttribute('aria-expanded', 'false');
    }
  });
  
  // Close mobile dropdowns when window resizes to desktop
  window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) { // lg breakpoint
      mobileMenu?.classList.add('hidden');
      hamburgerLine?.classList.remove('hidden');
      closeLine?.classList.add('hidden');
      mobileMenuButton?.setAttribute('aria-expanded', 'false');
      
      // Close all mobile dropdowns
      const mobileDropdownContents = document.querySelectorAll('.mobile-dropdown-content');
      mobileDropdownContents.forEach(content => {
        content.classList.add('hidden');
      });
    }
  });
});