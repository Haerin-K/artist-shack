# Carousel Movement Functions - Complete Reference

## Overview
This document contains all CSS and JavaScript functions that control the carousel sliding mechanism. The products move to the left while the carousel container stays fixed by using CSS `transform: translateX()` with hidden overflow.

---

## CSS - CAROUSEL MOVEMENT

### 1. Carousel Track Wrapper (Container with Hidden Overflow)
```css
.carousel-track-wrapper {
    flex: 1;
    overflow: hidden;           /* Clips products outside viewport */
    border-radius: 4px;
}
```

**Purpose**: Creates a viewport window that clips any content extending beyond its boundaries.

---

### 2. Carousel Track (The Moving Element)
```css
.carousel-track {
    display: flex;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);  /* Smooth animation */
    gap: 20px;
}
```

**Purpose**: 
- `display: flex` - Arranges items horizontally
- `transition` - Smoothly animates the transform over 0.4 seconds with cubic-bezier easing
- `gap: 20px` - Adds space between items
- This element gets the `transform: translateX()` applied

---

### 3. Carousel Item (Individual Product Container)
```css
.carousel-item {
    flex: 0 0 calc(25% - 15px);  /* Fixed width: 25% minus gap adjustment */
    min-width: 0;
    animation: slideIn 0.5s ease-out;
}
```

**Purpose**: Each item takes exactly 25% of the carousel width (4 items per view).

---

### 4. Slide-In Animation (On Page Load)
```css
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
```

**Purpose**: Products fade in and slide into position when carousel initializes.

---

### 5. Carousel Container (Fixed Outer Box)
```css
.carousel-container {
    position: relative;
    display: flex;
    align-items: center;
    gap: 20px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #eee;
}
```

**Purpose**: Fixed container that stays in place; only the track inside moves.

---

## JAVASCRIPT - CAROUSEL MOVEMENT LOGIC

### 1. Main Update Function
```javascript
updateCarousel() {
    const itemWidth = 100 / this.itemsPerView;                    // Calculate item width %
    const offset = -(this.currentIndex * itemWidth);              // Calculate negative offset

    this.$track.css({
        'transform': `translateX(${offset}%)`                     // Apply transform
    });

    // Update indicators
    this.$section.find('.indicator-dot').removeClass('active');
    const activeIndex = Math.floor(this.currentIndex / this.itemsPerView);
    this.$section.find(`.indicator-dot[data-index="${activeIndex}"]`).addClass('active');
}
```

**How it works**:
1. **itemWidth** = 100 / itemsPerView
   - If 4 items per view: itemWidth = 25%
   - If 3 items per view: itemWidth = 33.33%
   
2. **offset** = -(currentIndex × itemWidth)
   - currentIndex 0, itemWidth 25% → offset = 0% (no movement)
   - currentIndex 1, itemWidth 25% → offset = -25% (shift left by 25%)
   - currentIndex 2, itemWidth 25% → offset = -50% (shift left by 50%)
   
3. **transform: translateX(offset%)** - Moves the track left by the calculated amount

---

### 2. Navigate to Next Item
```javascript
next() {
    if (this.isAnimating) return;                                 // Prevent animation overlap
    this.isAnimating = true;

    this.currentIndex++;

    // Infinite loop: wrap around to start
    if (this.currentIndex > this.totalItems - this.itemsPerView) {
        this.currentIndex = 0;
    }

    this.updateCarousel();                                        // Apply transform

    setTimeout(() => {
        this.isAnimating = false;
    }, 400);                                                      // Wait for animation (0.4s)
}
```

**Flow**:
1. Increment currentIndex
2. Check if reached end (wrap to 0 for infinite loop)
3. Call updateCarousel() to apply the transform
4. Disable animation flag after 400ms (matches CSS transition time)

---

### 3. Navigate to Previous Item
```javascript
previous() {
    if (this.isAnimating) return;                                 // Prevent animation overlap
    this.isAnimating = true;

    this.currentIndex--;

    // Infinite loop: wrap around to end
    if (this.currentIndex < 0) {
        this.currentIndex = this.totalItems - this.itemsPerView;
    }

    this.updateCarousel();                                        // Apply transform

    setTimeout(() => {
        this.isAnimating = false;
    }, 400);                                                      // Wait for animation (0.4s)
}
```

**Flow**:
1. Decrement currentIndex
2. Check if at start (wrap to end for infinite loop)
3. Call updateCarousel() to apply the transform
4. Disable animation flag after 400ms

---

### 4. Go to Specific Slide
```javascript
goToSlide(index) {
    if (this.isAnimating) return;
    this.isAnimating = true;

    this.currentIndex = Math.max(0, Math.min(index, this.totalItems - this.itemsPerView));
    this.updateCarousel();

    setTimeout(() => {
        this.isAnimating = false;
    }, 400);
}
```

**Purpose**: Jump to a specific slide index (used by indicator dots).

---

### 5. Get Items Per View (Responsive)
```javascript
getItemsPerView() {
    const width = $(window).width();
    if (width < 576) return 1;    // Mobile: 1 item
    if (width < 768) return 2;    // Tablet: 2 items
    if (width < 1200) return 3;   // Desktop: 3 items
    return 4;                     // Large desktop: 4 items
}
```

**Purpose**: Dynamically adjust items visible based on screen size.

---

## HOW THE MOVEMENT WORKS - STEP BY STEP

### Example: 4 items showing, moving from item 0 to item 1

**Initial State**:
```
.carousel-track {
    transform: translateX(0%)     /* No movement */
}

Visible: [Item 0] [Item 1] [Item 2] [Item 3] | [Item 4 hidden]
```

**User clicks next button**:

```javascript
// In next() function:
this.currentIndex++;              // currentIndex = 1

// In updateCarousel():
itemWidth = 100 / 4 = 25%
offset = -(1 * 25%) = -25%
```

**CSS applies**:
```css
.carousel-track {
    transform: translateX(-25%);  /* Move left by 25% */
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
```

**Visual Result**:
```
.carousel-track-wrapper {
    overflow: hidden;  /* Clips outside content */
}

Before animation:  [Item 0] [Item 1] [Item 2] [Item 3] | [Item 4]
After animation:   [Item 1] [Item 2] [Item 3] [Item 4] | [Item 5]
```

The track smoothly slides left over 0.4 seconds, and the wrapper's `overflow: hidden` clips the hidden parts, creating the sliding effect.

---

## Key Timing

| Element | Duration | Purpose |
|---------|----------|---------|
| CSS Transition | 0.4s | Smooth sliding animation |
| JS Animation Lock | 400ms | Prevents multiple clicks during animation |
| Easing | cubic-bezier(0.4, 0, 0.2, 1) | Smooth acceleration and deceleration |

---

## Why the Carousel Body Doesn't Move

1. **Fixed Container**: `.carousel-container` has fixed width and positioning
2. **Transform Applied to Inner Track**: Only `.carousel-track` gets `transform: translateX()`
3. **Overflow Hidden**: `.carousel-track-wrapper` has `overflow: hidden` so content outside bounds is clipped
4. **Flex Layout**: Uses flexbox so the track and wrapper can manage internal movement independently

The outer container (carousel-container) stays completely static. Only the inner content (carousel-track) moves left/right.

