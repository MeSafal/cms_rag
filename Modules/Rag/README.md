# RAG Chatbot Module

This module implements a real-time Retrieval-Augmented Generation (RAG) chatbot using Laravel Reverb for WebSockets and OpenRouter for AI responses.

## 🌟 Features

- **Real-time Chat:** Instant message delivery via WebSockets (Laravel Reverb).
- **Session Isolation:** Each user has a private channel based on their session ID.
- **Queue-based Processing:** AI generation happens in the background to prevent timeouts.
- **Fallback Mechanism:** Automatically falls back to polling if WebSocket connection fails.
- **Modular Design:** Self-contained module using `nwidart/laravel-modules`.

## 🏗 Architecture

### 1. Frontend (`resources/views/chat/chat.blade.php`)
- Uses **Pusher.js** to connect to local Reverb server.
- Subscribes to `chat.{session_id}` channel.
- Handles real-time events (`message.received`).
- Includes automatic reconnection and polling fallback logic.

### 2. Backend Flow
1. **Controller (`ChatController`):** Receives user message, saves to session history, and dispatches job.
2. **Job (`ProcessOpenRouterMessage`):** 
   - Calls OpenRouter API.
   - Broadcasts `ChatMessageEvent` with the response.
3. **Event (`ChatMessageEvent`):** Implements `ShouldBroadcastNow` for immediate delivery.
4. **Broadcasting:** Laravel sends event to Reverb server via HTTP.
5. **Reverb:** Pushes message to connected WebSocket client.

## 📂 Key Files

- `app/Http/Controllers/ChatController.php`: Handles HTTP requests.
- `app/Jobs/ProcessOpenRouterMessage.php`: Background job for AI processing.
- `app/Events/ChatMessageEvent.php`: WebSocket event definition.
- `routes/web.php`: Module routes (wrapped in `web` middleware).
- `routes/channels.php`: Channel authorization rules.

## 🎨 Frontend Integration (How to use in any project)

You can drop this chat interface into **any** HTML page or Blade template.

### 1. Dependencies
Include these libraries in your `<head>` or before the closing `</body>` tag:
```html
<!-- jQuery (Required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Pusher JS (Required for WebSockets) -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
```

### 2. HTML Structure
You need a container for messages, an input field, and a send button. You can name them whatever you want, as long as you update the config later.

Example:
```html
<div id="my-chat-container">
    <div id="messages-area"></div>
    <input type="text" id="chat-input" placeholder="Type a message...">
    <button id="btn-send">Send</button>
</div>
```

### 3. The Script
1. Open `Modules/Rag/resources/views/chat/chat.blade.php`.
2. Scroll to the bottom script section.
3. Copy everything between `/*============== COPY FROM HERE ... */` and `/*============== TO HERE ... */`.
4. Paste it into your project's script file.

### 4. Configuration
Update the `RAG_CONFIG` object at the top of the pasted script to match your HTML IDs:

```javascript
const RAG_CONFIG = {
    selectors: {
        messageContainer: '#messages-area', // ID of the div where messages appear
        inputField: '#chat-input',          // ID of the input box
        sendButton: '#btn-send',            // ID of the send button
        
        // Optional: If you have a toggleable chat window
        chatWindow: '#my-chat-container',   
        toggleButton: '#open-chat-btn',     
        closeButton: '#close-chat-btn'      
    },
    endpoints: {
        // Ensure these point to your Laravel backend
        send: '/chat/send',
        response: '/chat/response',
        // CSRF Token is required for Laravel POST requests
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
    },
    pusher: {
        key: 'qskwvj5qfsqqjsibjws6', // Your Reverb App Key
        host: 'localhost',
        port: 8080
    }
};
```

That's it! The script will automatically handle:
*   Sending messages to the backend.
*   Connecting to WebSockets.
*   Listening for real-time responses.
*   Falling back to polling if WebSockets fail.

---

## 🚀 Migration Guide (How to move backend to another project)

To move this module to a new Laravel 11 project, follow these steps:

### 1. Prerequisites
Ensure the target project has the following installed:
```bash
composer require nwidart/laravel-modules
composer require laravel/reverb
composer require pusher/pusher-php-server
```

### 2. Copy Module
Copy the entire `Modules/Rag` directory to the `Modules/` directory of your new project.

### 3. Configuration (`.env`)
Add these variables to your `.env` file:

```env
# OpenRouter API
OPENROUTER_API_KEY=your_api_key_here

# Reverb / WebSocket Configuration
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=chatbot-app
REVERB_APP_KEY=qskwvj5qfsqqjsibjws6
REVERB_APP_SECRET=local-secret
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http

# Session Driver (File is recommended for dev)
SESSION_DRIVER=file
```

### 4. Enable Broadcasting
In Laravel 11, you must manually enable the BroadcastServiceProvider.

1. Create `app/Providers/BroadcastServiceProvider.php` if it doesn't exist:
   ```php
   <?php
   namespace App\Providers;
   use Illuminate\Support\ServiceProvider;
   
   class BroadcastServiceProvider extends ServiceProvider
   {
       public function boot(): void
       {
           require base_path('routes/channels.php');
       }
   }
   ```

2. Register it in `bootstrap/providers.php`:
   ```php
   return [
       App\Providers\AppServiceProvider::class,
       App\Providers\BroadcastServiceProvider::class, // Add this line
       // ...
   ];
   ```

### 5. Session Storage
Ensure session storage directory exists (if using file driver):
```bash
mkdir -p storage/framework/sessions
```

### 6. Start Services
You need three terminal windows running:

1. **Laravel Server:** `php artisan serve`
2. **Queue Worker:** `php artisan queue:work`
3. **Reverb Server:** `php artisan reverb:start`

## 🛠 Troubleshooting

- **"Session ID changed":** Ensure routes are wrapped in `web` middleware.
- **No WebSocket activity:** Check `.env` keys match in frontend and backend.
- **401 Unauthorized:** Ensure `BroadcastServiceProvider` is NOT calling `Broadcast::routes()`.
