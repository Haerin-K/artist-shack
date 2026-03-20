# Bootstrap 4.5.2 Migration Reference

## Overview
All admin interface components have been converted from Tailwind CSS to Bootstrap 4.5.2 for consistency with the main application design.

---

## Admin Pages Converted to Bootstrap

| Page | Location | Status |
|------|----------|--------|
| Dashboard | `resources/views/admin/dashboard.blade.php` | ✅ Converted |
| Products List | `resources/views/admin/products/index.blade.php` | ✅ Converted |
| Create Product | `resources/views/admin/products/create.blade.php` | ✅ Converted |
| Edit Product | `resources/views/admin/products/edit.blade.php` | ✅ Converted |
| Product Component | `resources/views/components/carousel.blade.php` | ✅ Converted |
| Shop Index | `resources/views/shop/index.blade.php` | ✅ Converted |
| Header Component | `resources/views/components/header.blade.php` | ✅ Converted |
| Footer Component | `resources/views/components/footer.blade.php` | ✅ Converted |

---

## Bootstrap Class Mappings

### Layout & Container
| Tailwind | Bootstrap | Purpose |
|----------|-----------|---------|
| `max-w-7xl mx-auto px-4` | `container` | Full-width container |
| `mx-auto` | `mx-auto` | Center horizontally |
| `grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5` | `row` with `col-lg-2` | Responsive grid |
| `flex` | `d-flex` | Flexbox |
| `gap-4` | `g-3` or `g-4` | Grid gap spacing |

### Text Styling
| Tailwind | Bootstrap | Purpose |
|----------|-----------|---------|
| `text-4xl font-bold` | `h2` or `display-4` | Large heading |
| `text-gray-800` | `text-dark` | Dark text |
| `text-gray-600` | `text-muted` | Muted text |
| `text-red-600` | `text-danger` | Red text (error) |
| `font-semibold` | `font-weight-bold` | Bold text |

### Forms & Inputs
| Tailwind | Bootstrap | Purpose |
|----------|-----------|---------|
| `input-field` | `form-control` | Standard input |
| `border-red-500` | `is-invalid` | Invalid state |
| `rounded-full` | `rounded-pill` | Pill-shaped |
| `px-3 py-1` | `px-2 py-1` | Padding |

### Buttons
| Tailwind | Bootstrap | Purpose |
|----------|-----------|---------|
| `btn-primary` | `btn btn-primary` | Primary button |
| `btn-secondary` | `btn btn-secondary` | Secondary button |
| `py-3` | `py-2` or `py-3` | Vertical padding |
| `text-center block` | `btn-block` | Full-width button |

### Cards & Components
| Tailwind | Bootstrap | Purpose |
|----------|-----------|---------|
| `bg-white rounded-lg shadow-md p-6` | `card` | Card container |
| `bg-purple-50` | `table-light` or `bg-light` | Light background |
| `rounded-lg` | `rounded` | Border radius |
| `shadow-md` | `shadow` or `shadow-sm` | Box shadow |

### Table Styling
| Tailwind | Bootstrap | Purpose |
|----------|-----------|---------|
| `w-full` | `table` | Full-width table |
| `border-b` | (Built-in) | Table borders |
| `hover:bg-purple-50` | `table-hover` | Hover effect |
| `px-6 py-3` | (Cell padding) | Cell spacing |

### Spacing
| Tailwind | Bootstrap | Purpose |
|----------|-----------|---------|
| `mb-12` | `mb-4` | Margin bottom |
| `mt-8` | `mt-4` | Margin top |
| `py-12` | `py-5` | Padding vertical |
| `space-y-6` | `mb-3` on children | Vertical spacing |

### Badges
| Tailwind | Bootstrap | Purpose |
|----------|-----------|---------|
| `px-3 py-1 rounded-full text-xs font-semibold` | `badge` | Badge component |
| `bg-green-100 text-green-700` | `badge-success` | Success badge |
| `bg-red-100 text-red-700` | `badge-danger` | Danger badge |
| `bg-yellow-100 text-yellow-700` | `badge-warning` | Warning badge |
| `bg-gray-100 text-gray-700` | `badge-secondary` | Secondary badge |

---

## Color Mapping

### Text Colors
| Tailwind | Bootstrap |
|----------|-----------|
| `text-purple-600` | `text-primary` |
| `text-blue-600` | `text-info` |
| `text-green-600` | `text-success` |
| `text-red-600` | `text-danger` |
| `text-yellow-600` | `text-warning` |
| `text-gray-600` | `text-muted` |
| `text-gray-800` | `text-dark` |

### Background Colors
| Tailwind | Bootstrap |
|----------|-----------|
| `bg-purple-50` | `bg-light` |
| `bg-white` | `bg-white` |
| `bg-gray-100` | `bg-light` |
| `bg-green-600` | `bg-success` |
| `bg-red-600` | `bg-danger` |

---

## Responsive Grid

### Breakpoints
```
xs (< 576px)  - No prefix (col-)
sm (≥ 576px)  - col-sm-
md (≥ 768px)  - col-md-
lg (≥ 992px)  - col-lg-
xl (≥ 1200px) - col-xl-
```

### Examples
```html
<!-- 100% on mobile, 50% on tablet, 33% on desktop -->
<div class="col-12 col-md-6 col-lg-4"></div>

<!-- 100% on mobile, 50% on tablet and desktop -->
<div class="col-12 col-md-6"></div>

<!-- 100% on mobile, 50% on tablet, 25% on desktop -->
<div class="col-12 col-md-6 col-lg-3"></div>
```

---

## Common Form Patterns

### Text Input with Validation
```blade
<div class="form-group">
    <label for="name" class="form-label font-weight-bold">
        Name <span class="text-danger">*</span>
    </label>
    <input type="text" id="name" name="name" value="{{ old('name') }}" 
        required class="form-control @error('name') is-invalid @enderror">
    @error('name')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
```

### Select Dropdown
```blade
<div class="form-group">
    <label for="category" class="form-label font-weight-bold">Category</label>
    <select id="category" name="category" class="form-control @error('category') is-invalid @enderror">
        <option value="">Select a category</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>
</div>
```

### Button Group
```blade
<div class="form-group mt-5">
    <button type="submit" class="btn btn-primary me-2">
        <i class="fa fa-save"></i> Save
    </button>
    <a href="{{ route('back') }}" class="btn btn-secondary">
        <i class="fa fa-times"></i> Cancel
    </a>
</div>
```

---

## Utility Classes

| Bootstrap | Purpose |
|-----------|---------|
| `d-flex` | Display flex |
| `justify-content-between` | Space between |
| `align-items-center` | Center vertically |
| `mb-3` | Margin bottom 1rem |
| `mt-5` | Margin top 3rem |
| `px-2` | Horizontal padding 0.5rem |
| `py-3` | Vertical padding 1rem |
| `me-2` | Margin right 0.5rem |
| `w-100` | Width 100% |
| `text-center` | Center text |
| `d-block` | Display block |
| `d-inline` | Display inline |
| `d-none` | Display none |

---

## Migration Workflow

When converting new pages:

1. **Replace Tailwind Layout**
   ```
   Before: <div class="max-w-7xl mx-auto px-4">
   After:  <div class="container">
   ```

2. **Convert Grid System**
   ```
   Before: <div class="grid grid-cols-1 md:grid-cols-3">
   After:  <div class="row">
           <div class="col-12 col-md-4">
   ```

3. **Update Spacing**
   ```
   Before: <div class="mb-12 mt-8 py-12">
   After:  <div class="mb-4 mt-4 py-5">
   ```

4. **Convert Colors**
   ```
   Before: <span class="text-purple-600 bg-purple-50">
   After:  <span class="text-primary bg-light">
   ```

5. **Update Forms**
   ```
   Before: <input class="input-field">
   After:  <input class="form-control">
   ```

6. **Test Responsiveness**
   - Desktop (≥1200px)
   - Tablet (768px - 991px)
   - Mobile (< 576px)

---

## CSS Files

### Bootstrap Integration
- Bootstrap loaded via CDN in `layouts/app.blade.php`
- Custom CSS files in `public/css/`:
  - `header.css` - Header component styling
  - `footer.css` - Footer component styling
  - `carousel.css` - Carousel component styling
  - `main.css` - Global utility styles

### Custom CSS Additions
If Bootstrap utilities are insufficient, add custom CSS to `public/css/main.css`

Example:
```css
.custom-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    padding: 20px;
}
```

---

## Validation & Errors

### Invalid Input Styling
```blade
<input class="form-control @error('field') is-invalid @enderror">
@error('field')
    <div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
```

### Status Badges
```blade
<span class="badge badge-success">Active</span>
<span class="badge badge-danger">Inactive</span>
<span class="badge badge-warning">Pending</span>
```

---

## Testing Bootstrap Layout

Use browser DevTools:
1. Press `F12` to open DevTools
2. Toggle device toolbar (Ctrl+Shift+M)
3. Test at different breakpoints:
   - Mobile: 375px, 414px
   - Tablet: 768px, 1024px
   - Desktop: 1200px, 1400px

---

## Bootstrap Documentation Reference

- Official: https://getbootstrap.com/docs/4.6/
- Components: https://getbootstrap.com/docs/4.6/components/
- Utilities: https://getbootstrap.com/docs/4.6/utilities/
- Grid: https://getbootstrap.com/docs/4.6/layout/grid/

---

## Performance Notes

- Bootstrap CSS is minified (~150KB)
- JavaScript is optional (carousel uses custom JS)
- No dependency on jQuery in custom carousel code
- All forms use native HTML5 validation

---

## Future Updates

When adding new pages or components:

1. Always use Bootstrap classes for consistency
2. Avoid mixing Tailwind and Bootstrap
3. Test on mobile, tablet, and desktop
4. Use semantic HTML5 elements
5. Add custom CSS to main.css only when necessary

---

**Last Updated:** February 2026
**Bootstrap Version:** 4.5.2
**Laravel Version:** 11.x
