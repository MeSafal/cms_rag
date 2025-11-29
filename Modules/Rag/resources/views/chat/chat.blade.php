<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- WebSocket Libraries -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .chat-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        /* Chat Icon */
        .chat-icon {
            width: 60px;
            height: 60px;
            background-color: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s;
        }

        .chat-icon svg {
            width: 28px;
            height: 28px;
            fill: white;
        }

        .chat-icon:hover {
            background-color: #0069d9;
        }

        /* Chat Window */
        .chat-window {
            position: fixed;
            bottom: 110px;
            right: 30px;
            width: 400px;
            height: 500px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            display: none;
            flex-direction: column;
            z-index: 1000;
            overflow: hidden;
        }

        .chat-header {
            padding: 16px;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-header h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
            padding: 0 8px;
        }

        .close-btn:hover {
            color: #333;
        }

        .chat-messages {
            flex: 1;
            padding: 16px;
            overflow-y: auto;
            background: #fff;
        }

        .chat-input {
            padding: 16px;
            background: #f8f9fa;
            border-top: 1px solid #eee;
            display: flex;
            gap: 8px;
        }

        .chat-input input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
        }

        .chat-input input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }

        #send-btn {
            background: #007bff;
            border: none;
            padding: 12px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
        }

        #send-btn:hover {
            background: #0069d9;
        }

        #send-btn svg {
            width: 20px;
            height: 20px;
            fill: white;
        }

        /* Messages */
        .message {
            max-width: 80%;
            margin-bottom: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .user-message {
            background: #007bff;
            color: white;
            margin-left: auto;
        }

        .bot-message {
            background: #f1f1f1;
            color: #333;
            margin-right: auto;
        }

        .loading-message {
            color: #666;
            font-style: italic;
            padding: 12px 16px;
        }

        .error-message {
            background: #dc3545;
            color: white;
            padding: 12px 16px;
            border-radius: 8px;
            margin: 8px 0;
        }

        .scroll-hide {
            transform: translateY(100px);
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        /* Thinking Card - Ultra Minimal */
        .thinking-card {
            font-size: 0.75em;
            color: #999;
            margin: 2px 0;
        }

        .thinking-card.collapsed {
            cursor: pointer;
        }

        .thinking-card.collapsed:hover .thinking-header {
            color: #007bff;
        }

        .thinking-card.collapsed .thinking-steps {
            display: none;
        }

        .thinking-card.expanded .thinking-steps {
            background: #f8f9fa;
            border-left: 2px solid #007bff;
            padding: 8px;
            margin-top: 4px;
            font-size: 0.85em;
        }

        .thinking-steps {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .thinking-steps li {
            margin-top: 3px;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            max-width: 700px;
        }
    </style>
</head>

<body>
    <div class="mb-3 justify-content-center">
        <button type="button" class="btn btn-primary" id="generate-blog-btn">
            <i class="fas fa-robot"></i> Generate Blog with AI
        </button>
    </div>

    <!-- Add Blog Generation Modal -->
    <div class="modal fade" id="blogGenModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generate Blog Content</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Blog Title</label>
                        <input type="text" id="ai-blog-title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Initial Tags/Keywords</label>
                        <input type="text" id="ai-initial-tags" class="form-control"
                            placeholder="(optional) Provide some keywords to help AI">
                    </div>
                    <div class="alert alert-info">
                        AI will first generate relevant tags, then create content based on those tags.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancel-generation"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="start-generation-btn">
                        Generate Content
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="z-index: -1;">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Create New Blog Post</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="6" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select" required>
                            <option value="">Select Category</option>
                            <option value="Technology">Technology</option>
                            <option value="Business">Business</option>
                            <option value="Health">Health</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tags</label>
                        <input type="text" name="tags" class="form-control" placeholder="Comma-separated tags">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Publish</button>
                    <a href="{{ route('blogs.index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i>
                        Back</a>
                </form>
            </div>
        </div>
    </div>

    {{-- Reusable RAG chat widget component --}}
    @include('rag::components.chat-widget')
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ==========================================
        // Blog Generation Logic (Specific to this page)
        // ==========================================
        $(document).ready(function() {
            // Blog generation elements
            const generateBtn = $('#generate-blog-btn');
            const blogModal = new bootstrap.Modal('#blogGenModal');
            const startGenBtn = $('#start-generation-btn');
            const aiBlogTitle = $('#ai-blog-title');
            const aiInitialTags = $('#ai-initial-tags');

            generateBtn.click(() => blogModal.show());
            
            $("#generate-blog-btn").click(function() {
                $('#chat-icon').addClass('scroll-hide');
            });
            $("#cancel-generation").click(function() {
                $('#chat-icon').removeClass('scroll-hide');
            });

            startGenBtn.click(async function() {
                const title = aiBlogTitle.val().trim();
                if (!title) {
                    alert('Please enter a blog title');
                    return;
                }

                $('input[name="title"]').val(title);

                startGenBtn.prop('disabled', true).html(
                    `<span class="spinner-border spinner-border-sm" role="status"></span> Generating...`
                );

                try {
                    // Generate Tags
                    $('input[name="tags"]').val('Generating tags...');
                    const tagsResponse = await $.ajax({
                        url: '/generate-tags',
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        data: {
                            title: title,
                            initial_tags: aiInitialTags.val().trim()
                        }
                    });

                    const tags = await pollBlogResponse(tagsResponse.cache_key);
                    $('input[name="tags"]').val(tags);

                    // Generate Content
                    $('textarea[name="content"]').val('Generating content...');
                    const contentResponse = await $.ajax({
                        url: '/generate-content',
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        data: { title: title, tags: tags }
                    });

                    const content = await pollBlogResponse(contentResponse.cache_key);
                    $('textarea[name="content"]').val(content);
                    $('input[name="title"]').val(title);

                    blogModal.hide();
                } catch (error) {
                    console.error('Generation error:', error);
                    alert('Error generating content. Please try again.');
                    $('input[name="tags"]').val('');
                    $('textarea[name="content"]').val('');
                } finally {
                    startGenBtn.prop('disabled', false).html('Generate Content');
                }
            });

            async function pollBlogResponse(cacheKey) {
                return new Promise((resolve, reject) => {
                    const poll = async () => {
                        try {
                            const response = await $.ajax({
                                url: '/chat/response',
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                data: { cache_key: cacheKey }
                            });

                            if (response.error) {
                                $('#chat-icon').removeClass('scroll-hide');
                                reject(response.error);
                                return;
                            }

                            if (response.status === 'complete') {
                                $('#chat-icon').removeClass('scroll-hide');
                                $('#generate-blog-btn').removeClass('scroll-hide');
                                if (response.tags) resolve(response.tags);
                                if (response.content) {
                                    let formattedResponse = response.content
                                        // Bold (**text** → <b>text</b>)
                                        .replace(/\*\*(.*?)\*\*/g, '<b>$1</b>')
                                        // Italic (*text* → <i>text</i>)
                                        .replace(/\*(.*?)\*/g, '<i>$1</i>')
                                        // Convert -> to →
                                        .replace(/->/g, '→')
                                        // Convert three dots ... to ellipsis …
                                        .replace(/\.{3}/g, '…')
                                        // Smart Quotes
                                        .replace(/"([^"]*)"/g, '“$1”')
                                        .replace(/'([^']*)'/g, '‘$1’')
                                        // Convert ## Heading to <h2>Heading</h2>
                                        .replace(/##\s*(.*?)(\n|$)/g, '<h2>$1</h2>')
                                        // Convert # Heading to <h1>Heading</h1>
                                        .replace(/#\s*(.*?)(\n|$)/g, '<h1>$1</h1>')
                                        // Convert ### Heading to <h3>Heading</h3>
                                        .replace(/###\s*(.*?)(\n|$)/g, '<h3>$1</h3>')
                                        // Links [text](url) → <a href="url">text</a>
                                        .replace(/\[([^\]]+)\]\(([^)]+)\)/g,
                                            '<a href="$2">$1</a>')
                                        // Unordered lists - item → <ul><li>item</li></ul>
                                        .replace(/^\s*-\s+(.*)$/gm, '<ul><li>$1</li></ul>')
                                        // Ordered lists 1. item → <ol><li>item</li></ol>
                                        .replace(/^\s*\d+\.\s+(.*)$/gm, '<ol><li>$1</li></ol>')
                                        // Blockquotes > text → <blockquote>text</blockquote>
                                        .replace(/^>\s*(.*)$/gm, '<blockquote>$1</blockquote>')
                                        // Images ![alt](url) → <img src="url" alt="alt">
                                        .replace(/!\[([^\]]+)\]\(([^)]+)\)/g,
                                            '<img src="$2" alt="$1">')
                                        // Inline Code `code` → <code>code</code>
                                        .replace(/`([^`]+)`/g, '<code>$1</code>')
                                    // Code block ```code``` → <pre><code>code</code></pre>
                                    .replace(/```([\s\S]+?)```/g,
                                            '<pre><code>$1</code></pre>')
                                        // Strikethrough ~~text~~ → <del>text</del>
                                        .replace(/~~(.*?)~~/g, '<del>$1</del>');

                                    resolve(formattedResponse);
                                }
                            } else if (response.status === 'pending') {
                                $('#chat-icon').addClass('scroll-hide');
                                $('#generate-blog-btn').addClass('scroll-hide');

                                setTimeout(poll, 2000);
                            }
                        } catch (error) {
                            $('#generate-blog-btn').removeClass('scroll-hide');
                            $('#chat-icon').removeClass('scroll-hide');
                            reject(error);
                        }
                    };

                    poll();
                });
            }
        });
    </script>
</body>

</html>
