<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

# 🚀 CMS + RAG Chatbot System

A powerful **Content Management System** integrated with an **AI-Powered RAG (Retrieval-Augmented Generation) Chatbot**. This project combines traditional content management with cutting-edge AI capabilities to deliver a smart, context-aware user experience.

---

## 🌟 Features

### 1. Advanced CMS (Content Management System)
- **⚡ Instant CRUD Generation**: Scaffold full modules with artisan commands.
- **🔐 Role-Based Access Control**: Granular permissions using Spatie.
- **🔄 Dynamic Routing**: Automatic route registration.
- **📊 Dashboard Analytics**: At-a-glance system overview.
- **📱 Responsive Design**: Mobile-friendly interface.

### 2. 🧠 RAG Chatbot (AI Module)
- **🔍 Hybrid Search**: Combines **Semantic Search** (Vector Embeddings) with **Keyword Search** for high accuracy.
- **🎯 Intent Classification**: Smartly routes queries to DB (for facts) or LLM (for casual chat).
- **⚡ Real-time Feedback**: "Thinking..." UI updates via WebSockets (Reverb).
- **🛡️ Anti-Hallucination**: Strict prompts ensure the AI only answers from your data.
- **🔌 Modular Design**: Built as a standalone Laravel Module (`Modules/Rag`).

---

## 🏗️ Architecture Overview

### CMS Architecture
The CMS uses a modular structure where features are generated via custom artisan commands. It leverages Spatie for permissions and standard Laravel patterns for MVC.

### RAG Chatbot Architecture
The Chatbot acts as an intelligent layer over your CMS data:
1.  **Data Ingestion**: Content (Blogs, Services, Teams) is embedded into vectors.
2.  **Query Processing**:
    -   **Intent Classifier**: Decides if the user needs facts or chat.
    -   **Query Expander**: Adds synonyms (e.g., "classes" -> "workshops") to improve recall.
3.  **Retrieval**: Fetches relevant data from the database using Cosine Similarity.
4.  **Generation**: An LLM (via OpenRouter) generates a natural response using the retrieved data.

---

## 🚀 Installation & Setup

### 1. Prerequisites
- PHP 8.2+
- MySQL 8.0+
- Node.js 18+
- Composer 2.5+

### 2. Clone & Install
```bash
git clone https://github.com/MeSafal/cms-fms.git
cd cms-fms
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
```

### 3. Configure Environment (.env)
Add your AI and WebSocket keys:
```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=

# AI (OpenRouter)
OPENROUTER_API_KEY=sk-or-v1-...

# WebSockets (Reverb)
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

### 4. Database Setup
```bash
php artisan migrate
php artisan db:seed
# Generate embeddings for search
php artisan embeddings:generate
```

---

## 🏃‍♂️ Running the System

To run the full system (CMS + Chatbot), you need **3 terminals**:

### Terminal 1: Web Server
```bash
php artisan serve
```

### Terminal 2: Queue Worker (For AI Processing)
```bash
php artisan queue:work
```

### Terminal 3: WebSocket Server (For Real-time Chat)
```bash
php artisan reverb:start
```

---

## 📚 Documentation

-   **[CMS Documentation](#)**: See the `docs/` folder (if available).
-   **[Chatbot Migration Guide](Modules/Rag/README_MIGRATION.md)**: How to move the chatbot to another project.
-   **[Chatbot Architecture](Modules/Rag/README_PUBLIC.md)**: Deep dive into the RAG system design.

---

## 🤝 Contribution

Feel free to fork and submit PRs!

## 📄 License

MIT
