# CTA Button System - LuxSci.com Style

## Overview
The button system has been updated to match LuxSci.com's design language while maintaining our established naming conventions and using primarily Tailwind CSS classes.

## Button Types

### Primary Buttons (`.btn-primary`)
- **Use**: Main call-to-action buttons (Contact Us with arrow icon)
- **Style**: Dark blue background (`#172c4c`) with white text and right arrow
- **Colors**: `#172c4c` background → hover inverts to white background with `#172c4c` text
- **Typography**: Montserrat Semi-bold (600), includes arrow icon
- **Example**: 
```html
<a href="#" class="btn-primary">
  Contact Us
  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
  </svg>
</a>
```

### Secondary Buttons (`.btn-secondary`)
- **Use**: Secondary actions (Login button in header)
- **Style**: White background with `#172c4c` border and text
- **Colors**: White background with `#172c4c` border/text (no hover color change)
- **Typography**: Montserrat Semi-bold (600)
- **Example**:
```html
<a href="#" class="btn-secondary">Login</a>
```

### Blog Buttons (`.btn-blog`)
- **Use**: Blog "Read More" buttons on homepage
- **Style**: Bright blue background (`#109dce`) with white text and right arrow
- **Colors**: `#109dce` background → hover inverts to white background with `#172c4c` text
- **Typography**: Montserrat Semi-bold (600), includes arrow icon
- **Example**:
```html
<a href="#" class="btn-blog">
  Read More
  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
  </svg>
</a>
```

### Tertiary Buttons (`.btn-tertiary`)
- **Use**: Text-only links with subtle styling
- **Style**: Blue text with underline on hover
- **Example**:
```html
<a href="#" class="btn-tertiary">Learn more</a>
```

## Button Size Variants

### Small (`.btn-sm`)
- Smaller padding and text size
- Can be combined with any button type
- Example: `class="btn-primary btn-sm"`

### Large (`.btn-lg`)
- Larger padding and text size
- Can be combined with any button type  
- Example: `class="btn-primary btn-lg"`

## Additional Button Styles

### Outline Orange (`.btn-outline-orange`)
- Orange border with white background
- Useful for alternative primary actions
- Example: `class="btn-outline-orange"`

### Ghost (`.btn-ghost`)
- Minimal styling, gray text
- Useful for subtle actions
- Example: `class="btn-ghost"`

## Implementation Details

### Tailwind-First Approach
- All button styles use `@apply` with Tailwind utilities
- Minimal custom CSS properties
- Maintains design system consistency

### Color Palette
- **Primary Dark Blue**: `#172c4c` (LuxSci.com main brand color)
- **Blog Blue**: `#109dce` (bright blue for blog read more buttons)
- **White/Border**: White background with `#172c4c` borders for secondary actions

### Design Features
- **Arrow Icons**: Primary and blog buttons include right-pointing chevron icons
- **Hover Inversions**: Most buttons invert colors on hover (background ↔ border/text colors)
- **Montserrat Typography**: Consistent with site-wide font system (600 weight)
- **Consistent Spacing**: All buttons use same padding and border-radius
- **Professional Feel**: Clean, corporate styling matching LuxSci.com's aesthetic

### Interactive States
All buttons include:
- ✅ Hover states with color transitions
- ✅ Focus states with ring indicators (accessibility)
- ✅ Active states with subtle scale animation
- ✅ Smooth transitions (200ms ease-in-out)

### Mobile Responsiveness
- Buttons work across all screen sizes
- Mobile menu uses `w-full` for full-width buttons
- Touch-friendly sizing (min 44px tap targets)

## Usage Guidelines

### When to Use Each Button Type

**Primary (Orange)**:
- Main conversion goals: "Get a Demo", "Start Free Trial", "Sign Up"
- Should have only 1 primary button per view/section

**Secondary (Blue Outline)**:
- Supporting actions: "Contact Us", "Learn More", "View Details"
- Can have multiple per view

**Tertiary (Text Link)**:
- Low-priority actions: "Read documentation", "View all features"
- Navigation-style links within content

### Accessibility Features
- Focus indicators for keyboard navigation
- Proper color contrast ratios
- Clear hover/active states
- Screen reader friendly markup

### Button Combinations
```html
<!-- Header CTA section -->
<div class="space-x-4">
  <a href="#" class="btn-secondary">Contact Us</a>
  <a href="#" class="btn-primary">Get a Demo</a>
</div>

<!-- Hero section with size variant -->
<div class="space-y-4">
  <a href="#" class="btn-primary btn-lg">Get Started Today</a>
  <a href="#" class="btn-tertiary">Learn more about our solutions</a>
</div>

<!-- Card with multiple actions -->
<div class="space-x-2">
  <a href="#" class="btn-secondary btn-sm">Learn More</a>
  <a href="#" class="btn-outline-orange btn-sm">Try It Free</a>
</div>
```

## File Locations

### CSS Definitions
- **File**: `assets/css/main.css`
- **Layer**: `@layer components`
- **Lines**: Button styles and loading states

### Usage Examples
- **Header**: `header.php` - Navigation CTA buttons
- **Mobile Menu**: `header.php` - Full-width mobile buttons
- **Content**: Can be used in any template file

## Development Notes

### Loading States (FOUC Prevention)
- Critical CSS includes basic button styling for `.nav-loading` state
- Ensures buttons appear correctly during page load
- Loading styles match final button appearance

### Customization
- Button colors can be easily modified by updating Tailwind classes
- Size variants can be extended by adding new utility combinations
- Additional button types can be created following the same pattern

### Performance
- Uses Tailwind's utility classes for optimal CSS generation
- No custom CSS properties or complex calculations
- Leverages Tailwind's built-in color palette and spacing system

## Testing Checklist

- [ ] Primary buttons display with orange background
- [ ] Secondary buttons show blue border and text
- [ ] Hover states work correctly
- [ ] Focus states show ring indicators
- [ ] Mobile buttons scale to full width
- [ ] Loading states prevent FOUC
- [ ] Buttons maintain accessibility standards
- [ ] Color contrast meets WCAG guidelines