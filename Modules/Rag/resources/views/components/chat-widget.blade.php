@once
    <!-- RAG Chat Widget Styles -->
    <style>
        .chat-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            font-family: 'Segoe UI', system-ui, sans-serif;
            z-index: 9999;
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
            z-index: 10000;
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

    <!-- RAG Chat Widget Markup -->
    <div class="chat-container">
        <!-- Chat Icon -->
        <div class="chat-icon" id="chat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="currentColor">
                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" />
            </svg>
        </div>

        <!-- Chat Window -->
        <div class="chat-window" id="chat-window">
            <div class="chat-header">
                <h3>Chat Assistant</h3>
                <button class="close-btn" id="close-chat">&times;</button>
            </div>
            <div class="chat-messages" id="chat-messages"></div>
            <div class="chat-input">
                <input type="text" id="user-input" placeholder="Type your message...">
                <button id="send-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Dependencies (if not already included in layout) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <!-- RAG Chat Widget Logic -->
    <script>
        (function () {
            const RAG_CONFIG = {
                selectors: {
                    messageContainer: '#chat-messages',
                    inputField: '#user-input',
                    sendButton: '#send-btn',

                    // Optional UI elements (can be null if not used)
                    chatWindow: '#chat-window',
                    toggleButton: '#chat-icon',
                    closeButton: '#close-chat'
                },
                endpoints: {
                    send: '/chat/send',
                    response: '/chat/response',
                    csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                },
                pusher: {
                    key: 'qskwvj5qfsqqjsibjws6',
                    host: 'localhost',
                    port: 8080
                }
            };

            class RagChat {
                constructor(config) {
                    this.config = config;
                    this.pusherConnection = null;
                    this.wsChannel = null;
                    this.currentSessionId = null;
                    this.pendingMessages = new Map();
                    this.currentLoadingId = null;

                    this.init();
                }

                init() {
                    this.bindEvents();
                }

                bindEvents() {
                    const s = this.config.selectors;

                    // Send Message Events
                    $(s.sendButton).on('click', () => this.sendMessage());
                    $(s.inputField).on('keypress', (e) => {
                        if (e.which == 13) this.sendMessage();
                    });

                    // Toggle Events (if elements exist)
                    if ($(s.toggleButton).length) {
                        $(s.toggleButton).on('click', () => this.toggleChat(true));
                    }
                    if ($(s.closeButton).length) {
                        $(s.closeButton).on('click', () => this.toggleChat(false));
                    }
                }

                toggleChat(show) {
                    const s = this.config.selectors;
                    $(s.toggleButton).toggleClass('scroll-hide', show);

                    $(s.chatWindow).css('display', show ? 'flex' : 'none');
                    if (show) {
                        const container = $(s.messageContainer);
                        container.scrollTop(container[0].scrollHeight);
                        $(s.inputField).focus();
                    }
                }

                appendMessage(content, type, id = '') {
                    const messageClass = {
                        user: 'user-message',
                        bot: 'bot-message',
                        loading: 'loading-message',
                        error: 'error-message'
                    }[type];

                    const renderedContent = (type === 'bot') ? this.renderMarkdown(content) : content;

                    const message = $(`
                        <div class="message ${messageClass}" ${id ? `id="${id}"` : ''}>
                            ${renderedContent}
                        </div>
                    `);

                    const container = $(this.config.selectors.messageContainer);
                    container.append(message);
                    container.scrollTop(container[0].scrollHeight);
                }

                renderMarkdown(text) {
                    return text
                        .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank" style="color: #007bff; text-decoration: underline;">$1</a>')
                        .replace(/\*\*(.*?)\*\*/g, '<b>$1</b>')
                        .replace(/\*(.*?)\*/g, '<i>$1</i>')
                        .replace(/\n/g, '<br>');
                }

                replaceLoading(content, loadingId) {
                    const renderedContent = this.renderMarkdown(content);
                    const loadingElement = $(`#${loadingId}`);

                    const hasThinkingSteps = loadingElement.find('.thinking-steps li').length > 0;

                    if (hasThinkingSteps) {
                        loadingElement.removeClass('loading-message').addClass('thinking-card collapsed');
                        loadingElement.find('.thinking-header').html('Thinking Process.');

                        loadingElement.off('click').on('click', function () {
                            loadingElement.toggleClass('collapsed').toggleClass('expanded');
                        });

                        loadingElement.after(`<div class="message bot-message">${renderedContent}</div>`);
                    } else {
                        loadingElement.replaceWith(`<div class="message bot-message">${renderedContent}</div>`);
                    }

                    const container = $(this.config.selectors.messageContainer);
                    container.scrollTop(container[0].scrollHeight);
                }

                showError(message, loadingId) {
                    $(`#${loadingId}`).replaceWith(
                        `<div class="message error-message">${message}</div>`
                    );
                }

                async sendMessage() {
                    const input = $(this.config.selectors.inputField);
                    const message = input.val().trim();
                    if (!message) return;

                    this.appendMessage(message, 'user');
                    input.val('');

                    const loadingId = `loading-${Date.now()}`;
                    this.currentLoadingId = loadingId;
                    this.appendMessage('Thinking...', 'loading', loadingId);

                    try {
                        const response = await $.ajax({
                            url: this.config.endpoints.send,
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': this.config.endpoints.csrfToken },
                            data: { message }
                        });

                        if (response.status === 'pending' && response.session_id) {
                            this.initializeWebSocket(response.session_id);

                            this.pendingMessages.set(loadingId, (responseText) => {
                                this.replaceLoading(responseText, loadingId);
                            });

                            setTimeout(() => {
                                if (this.pendingMessages.has(loadingId)) {
                                    this.pendingMessages.delete(loadingId);
                                    this.pollResponse(response.cache_key, loadingId);
                                }
                            }, 60000);
                        }
                    } catch (error) {
                        this.showError('Unable to connect to server', loadingId);
                    }
                }

                initializeWebSocket(sessionId) {
                    if (this.currentSessionId && this.currentSessionId !== sessionId) {
                        if (this.wsChannel) {
                            this.pusherConnection.unsubscribe(`chat.${this.currentSessionId}`);
                            this.wsChannel = null;
                        }
                    }

                    if (this.wsChannel && this.currentSessionId === sessionId) return;
                    if (typeof Pusher === 'undefined') return;

                    try {
                        if (!this.pusherConnection) {
                            this.pusherConnection = new Pusher(this.config.pusher.key, {
                                wsHost: this.config.pusher.host,
                                wsPort: this.config.pusher.port,
                                forceTLS: false,
                                disableStats: true,
                                enabledTransports: ['ws', 'wss'],
                                cluster: ''
                            });
                        }

                        const channelName = `chat.${sessionId}`;
                        this.wsChannel = this.pusherConnection.subscribe(channelName);
                        this.currentSessionId = sessionId;

                        this.wsChannel.bind('thinking.update', (data) => {
                            const loadingId = this.currentLoadingId;
                            if (loadingId) {
                                this.updateThinking(data.message, loadingId);
                            }
                        });

                        this.wsChannel.bind('message.received', (data) => {
                            for (let [loadingId, callback] of this.pendingMessages.entries()) {
                                callback(data.response);
                                this.pendingMessages.delete(loadingId);
                                this.currentLoadingId = null;
                                break;
                            }
                        });
                    } catch (error) {
                        // Silent fail
                    }
                }

                updateThinking(message, loadingId) {
                    const loadingElement = $(`#${loadingId}`);
                    if (loadingElement.length) {
                        let list = loadingElement.find('ul.thinking-steps');
                        if (!list.length) {
                            loadingElement.html('<div class="thinking-header">Thinking...</div><ul class="thinking-steps" style="list-style: none; padding-left: 0; margin-bottom: 0; font-size: 0.85em; color: #666;"></ul>');
                            list = loadingElement.find('ul.thinking-steps');
                        }

                        const stepId = `step-${Date.now()}`;
                        list.append(`<li id="${stepId}" style="margin-top: 4px;">• ${message}</li>`);

                        const container = $(this.config.selectors.messageContainer);
                        container.scrollTop(container[0].scrollHeight);
                    }
                }

                async pollResponse(cacheKey, loadingId) {
                    try {
                        const response = await $.ajax({
                            url: this.config.endpoints.response,
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': this.config.endpoints.csrfToken },
                            data: { cache_key: cacheKey }
                        });

                        if (response.status === 'complete' || response.response) {
                            this.replaceLoading(response.response, loadingId);
                        } else {
                            setTimeout(() => this.pollResponse(cacheKey, loadingId), 2000);
                        }
                    } catch (error) {
                        this.showError('Failed to get response', loadingId);
                    }
                }
            }

            $(document).ready(() => {
                window.ragChat = new RagChat(RAG_CONFIG);
            });
        })();
    </script>
@endonce


