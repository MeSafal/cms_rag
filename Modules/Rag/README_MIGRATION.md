# 📦 RAG Chatbot Migration Guide

Follow these steps to integrate the RAG Chatbot module into your existing Laravel CMS.

## 1. Prerequisites

Ensure your project has the following packages installed:

```bash
composer require nwidart/laravel-modules
composer require laravel/reverb
```

## 2. Copy Files

Copy the following files/folders from this project to your CMS project:

### Module
- **Source**: `Modules/Rag` (Entire folder)
- **Destination**: `Modules/Rag`

### Configuration
- **Source**: `config/rag.php`
- **Destination**: `config/rag.php`

### Database Migration
- **Source**: `database/migrations/2025_11_27_014343_create_data_embeddings_table.php`
- **Destination**: `database/migrations/YYYY_MM_DD_create_data_embeddings_table.php` (Use current date)

### Console Command (for generating embeddings)
- **Source**: `app/Console/Commands/GenerateEmbeddings.php`
- **Destination**: `app/Console/Commands/GenerateEmbeddings.php`

## 3. Configuration Setup

### .env File
Add the following variables to your `.env` file:

```env
# OpenRouter API Key for AI
OPENROUTER_API_KEY=your_key_here

# Reverb (WebSocket) Configuration
REVERB_APP_ID=my-app-id
REVERB_APP_KEY=my-app-key
REVERB_APP_SECRET=my-app-secret
REVERB_HOST="localhost"
REVERB_PORT=8080
REVERB_SCHEME="http"

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"
```

### config/rag.php
Open `config/rag.php` and update the `allowed_tables` array to match your CMS database structure.
- **Key**: Table name (e.g., `services`, `posts`, `products`)
- **display_name**: User-friendly name (e.g., "Services", "Blog Posts")
- **columns**: Array of columns to index (e.g., `title`, `content`, `description`)
- **id_column**: Primary key column (usually `id`)

## 4. Database Setup

1.  **Run Migrations**:
    ```bash
    php artisan migrate
    ```
    This creates the `data_embeddings` table.

2.  **Generate Embeddings**:
    Once your data is in the database, run this command to generate embeddings for search:
    ```bash
    php artisan embeddings:generate
    ```

## 5. Frontend Integration

### 1. Reverb/Echo Setup
Ensure your `resources/js/bootstrap.js` (or `echo.js`) includes the Reverb configuration:

```javascript
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
```

### 2. Add Chat Interface
Include the chat component in your main layout (e.g., `resources/views/layouts/app.blade.php`) or where you want the chatbot to appear:

```blade
@include('rag::chat.chat')
```

*Note: The `chat.blade.php` file contains its own CSS and JS. You may want to move these to your main CSS/JS files for better organization.*

## 6. Running the Chatbot

To make the chatbot work, you need 3 terminals running:

1.  **Queue Worker** (Processes AI responses):
    ```bash
    php artisan queue:work
    ```

2.  **Reverb Server** (Handles real-time updates):
    ```bash
    php artisan reverb:start
    ```

3.  **Web Server**:
    ```bash
    php artisan serve
    ```
