# Product Creation & Carousel Display Guide

## Overview
Your Artist Shack application is now fully configured to allow admin users to create products that automatically appear in carousels on the shop page. Products are organized by category with beautiful Bootstrap-styled forms and components.

---

## How to Add a Product

### Step 1: Access the Admin Panel
1. Navigate to `/admin` in your browser
2. You will be redirected to login if not authenticated
3. Log in with an admin account

### Step 2: Navigate to Products
1. From the admin dashboard, click **Products** in the navigation
2. Or go directly to `/admin/products`

### Step 3: Click "Add Product"
1. On the Products page, click the **<i class="fa fa-plus"></i> Add Product** button (top right)
2. Or go directly to `/admin/products/create`

### Step 4: Fill Out the Product Form
The form has the following fields:

| Field | Required | Description |
|-------|----------|-------------|
| **Product Name** | ✓ | The name of the product (e.g., "Sakuya Plushie") |
| **Category** | ✓ | Select from: Plushies, Stickers, Keychains |
| **Description** | ✓ | Detailed description of the product |
| **Price** | ✓ | Price in USD (e.g., 19.99) |
| **Stock Quantity** | ✓ | How many units are available |
| **SKU** | ✓ | Unique stock keeping unit (e.g., PLUSH-001) |
| **Product Images** | Optional | Upload one or multiple product images (JPEG, PNG, GIF - max 2MB each) |

### Step 5: Submit the Form
1. Click the **<i class="fa fa-save"></i> Create Product** button
2. You'll be redirected to the Products list page
3. Your new product will appear in the list with status "Active"

---

## How Products Display in the Carousel

### Automatic Display
Once you create a product with status "Active":
1. The product automatically appears in the carousel on the **Shop** page (`/shop`)
2. The carousel is organized by category groups
3. Products are grouped with others in the same category

### Carousel Features
- **4 Items Display**: Desktop view shows 4 items at a time
- **Left/Right Navigation**: Use arrow buttons to scroll through products
- **View All Button**: Click to see all products in a grid view
- **Minimize Button**: Collapse the grid view back to carousel

### Product Information in Carousel
Each product card displays:
- Product image (first uploaded image)
- Product name
- Price
- Partial description
- Rating (if implemented)
- Action buttons:
  - 👁️ **View** - See full product details
  - ❤️ **Wishlist** - Add to wishlist (if implemented)
  - 🛒 **Add to Cart** - Add to shopping cart

---

## Category Management

### Current Categories
Your application has three product categories:
1. **Plushies** - Soft toy characters
2. **Stickers** - Decorative stickers
3. **Keychains** - Key accessories

### How Carousels are Organized
- Each category gets its own carousel section on the shop page
- Section appears only if products exist in that category
- Products automatically sort into carousels by their assigned category

---

## Product Status & Visibility

### Active Products
- Status: **Active** (green badge)
- Visibility: **Appears in carousels**
- Condition: `is_active = true` and `deleted_at = NULL`

### Inactive Products
- Status: **Inactive** (red badge)
- Visibility: **Hidden from carousels**
- How to activate: Edit the product (from Products list)

### Deleted Products
- Status: **Deleted** (gray badge)
- Visibility: **Hidden from carousels**
- Action: Can be restored from Products list

---

## Example Workflow

### Adding a New Sticker Product

1. **Access Form**
   - Go to `/admin/products/create`

2. **Fill Details**
   ```
   Product Name: Genshin Impact Character Sticker
   Category: Stickers
   Description: High-quality vinyl sticker featuring popular Genshin Impact characters. Weather-resistant and perfect for laptops, water bottles, and more.
   Price: 4.99
   Stock Quantity: 100
   SKU: STICK-GENSHIN-001
   Images: (Select sticker_1.png, sticker_2.png)
   ```

3. **Submit Form**
   - Click "Create Product"

4. **View in Carousel**
   - Navigate to `/shop`
   - Scroll to the "Stickers" carousel section
   - Your new sticker appears with other stickers

---

## Managing Products

### Editing a Product
1. Go to `/admin/products`
2. Find the product in the list
3. Click the **Edit** button (blue)
4. Modify any fields (slug auto-updates with name changes)
5. Click **Update Product**

### Deleting a Product
1. Go to `/admin/products`
2. Find the product in the list
3. Click the **Delete** button (red)
4. Confirm deletion
5. Product moves to "Deleted" status (won't appear in carousels)

### Restoring a Deleted Product
1. Go to `/admin/products`
2. Find the deleted product (Status: "Deleted")
3. Click the **Restore** button (green)
4. Product returns to "Active" status and reappears in carousels

---

## Technical Details

### Database Schema
Products are stored with:
- `id` - Unique identifier
- `name` - Product name (auto-generates URL slug)
- `slug` - URL-friendly version of name
- `category_id` - Links to category
- `description` - Full product details
- `price` - In USD format (decimal 10,2)
- `stock` - Inventory quantity
- `sku` - Stock keeping unit (unique)
- `images` - JSON array of image paths
- `is_active` - Boolean (true = visible)
- `timestamps` - Created/updated dates
- `deleted_at` - Soft delete timestamp

### Image Storage
- Images uploaded to: `/storage/app/public/products/`
- Accessible via: `asset('storage/products/filename')`
- Supported formats: JPEG, PNG, GIF
- Maximum size: 2MB per image

### Routes
- **Create**: `POST /admin/products` (admin.products.store)
- **List**: `GET /admin/products` (admin.products.index)
- **Edit**: `POST /admin/products/{id}` (admin.products.update)
- **Delete**: `DELETE /admin/products/{id}` (admin.products.destroy)
- **View**: `GET /shop/product/{slug}` (product.show)

---

## Troubleshooting

### Product doesn't appear in carousel
**Possible causes:**
- Status is "Inactive" - Edit and ensure `is_active` is true
- Product was just created - Clear cache: `php artisan cache:clear`
- Category has no other products - Ensure products exist in category

**Solution:**
```bash
php artisan cache:clear
php artisan view:clear
```

### Image not displaying
**Possible causes:**
- Storage not linked - Run: `php artisan storage:link`
- Image file corrupted - Try re-uploading

### Form validation errors
**Check field requirements:**
- All required fields marked with * (red asterisk)
- Price must be numeric with up to 2 decimals
- SKU must be unique (not used by another product)
- Image files must be JPEG, PNG, or GIF

---

## Best Practices

✅ **DO:**
- Use descriptive product names
- Write detailed descriptions (help customers understand the product)
- Upload 2-3 images per product (first image shows in carousel)
- Use consistent naming for SKUs (e.g., CATEG-###-001)
- Keep stock quantities accurate
- Archive products instead of deleting (use soft delete)

❌ **DON'T:**
- Use generic names like "Product 1"
- Leave descriptions blank
- Upload corrupted or oversized images
- Reuse SKU numbers
- Publish products without images

---

## Sample Data

Your database comes pre-loaded with 25 sample products:

### Plushies (7 products)
- Sakuya Plushie, Reimu Plushie, Marisa Plushie, Patchouli Plushie, Flandre Plushie, Youmu Plushie, Ran Plushie

### Stickers (7 products)
- Genshin Stickers, Aesthetic Mix, Retro Pack, Meme Collection, Nature Series, Kawaii Pack, Holographic Set

### Keychains (8 products)
- Cat Keychain, Moon Keychain, Music Keychain, Enamel Keychain, Galaxy Keychain, Leather Keychain, Wooden Keychain, Charm Keychain

Edit any of these to see how changes immediately reflect in the carousels!

---

## Support Commands

### Clear all caches after changes:
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Reseed sample data:
```bash
php artisan db:seed
```

### Reset and start fresh:
```bash
php artisan migrate:fresh --seed
```
