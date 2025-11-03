# Blog Grid Layout

## Overview
The blog index page now displays posts in a responsive 3-column grid layout.

## Layout Structure
Each post card contains:
1. **Featured Image** (16:9 aspect ratio)
2. **Meta Information** (Date • Author)
3. **Post Title** (linked to full post)
4. **Excerpt** (automatic WordPress excerpt)
5. **Read More Button** (linked to full post)

## Responsive Behavior
- **Mobile (< md)**: 1 column
- **Tablet (md)**: 2 columns  
- **Desktop (lg+)**: 3 columns

## Styling
- Minimal styling using Tailwind utility classes
- Clean white cards with subtle shadows
- Blue hover effects on links and buttons
- Proper spacing and typography hierarchy

## Custom Image Size
A new image size `grid-thumbnail` (400x225px, 16:9 ratio) has been added for optimal grid display.

## Files Modified
- `index.php` - Updated to grid layout
- `inc/setup.php` - Added custom image size

## Usage
The layout automatically applies to:
- Blog home page
- Category archive pages
- Tag archive pages
- Search results (if using same template)

No additional configuration needed - posts will display in the grid format automatically!