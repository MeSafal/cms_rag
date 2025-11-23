{{--
@props(['itemEdit' => null, 'templates'])

@php
    $tables = [['id' => 'templates', 'title' => 'Template']];
    $tableOptions = ['custom' => 'Custom URL'];
    foreach ($tables as $t) {
        $tableOptions[$t['id']] = Str::limit($t['title'], 50, '...');
    }
@endphp

<input type="hidden" name="buttonData" id="buttonDataInput" value="{{ old('buttonData', $itemEdit->button_json ?? '') }}">


<input type="hidden" id="entriesData" value="{{ old('entriesData', '') }}">
<input type="hidden" id="entriesInput" name="entries" value="{{ old('entries', '') }}">
<br>
<div class="rounded h-80 p-4">
    <div class="m-n2">
        <button id="addButtonBtn" class="btn btn-primary w-100 m-2" type="button" data-bs-toggle="modal"
            data-bs-target="#buttonModal" style="color:white; border-color:transparent;">
            Add Button
        </button>

        <div class="container mt-4">
            <table class="table table-borderless" id="buttonTable">
                <thead id="entryTableHeader" class="table-light" style="display:none">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Path / URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="entryTableBody"></tbody>
            </table>
        </div>
    </div>
</div>
<br>

@include('backend.layout.extraButtonModel') --}}

{{-- MODULE A: Button popup (table + modal) --}}
@props(['itemEdit' => null, 'templates'])

@php
    // server-provided JSON data for initial state (optional)
    $buttonDataJson = old('buttonData', $itemEdit->button_json ?? '');
@endphp

<input type="hidden" id="buttonEntriesData" value="{{ $buttonDataJson }}">
<input type="hidden" id="buttonEntriesInput" name="button_entries" value="{{ old('button_entries', '') }}">

<div class="rounded h-80 p-4">
    <div class="m-n2">
        <button id="openButtonModalBtn" class="btn btn-primary w-100 m-2" type="button" data-bs-toggle="modal"
            data-bs-target="#buttonModal" aria-controls="buttonModal">
            Add Extra Content
        </button>

        <div class="container mt-4">
            <table class="table table-light table-striped" id="buttonEntriesTable">
                <thead id="buttonEntryTableHeader" style="display:none">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Path / URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="buttonEntryTableBody"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- BUTTON Modal (no nested form) -->
<div class="modal fade" id="buttonModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configure Button</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- NOT a real <form> to avoid nesting issues -->
                <div id="buttonModalForm" role="form" aria-label="Button Configure Form">
                    <div class="mb-3">
                        <label for="btn_title" class="form-label">Title</label>
                        <input id="btn_title" name="btn_title" class="form-control" type="text" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Destination</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="btn_destination"
                                    id="btn_dest_templates" value="templates" checked>
                                <label class="form-check-label" for="btn_dest_templates">Template</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="btn_destination"
                                    id="btn_dest_custom" value="custom">
                                <label class="form-check-label" for="btn_dest_custom">Custom URL</label>
                            </div>
                        </div>
                    </div>

                    <div id="btnContentList" class="mb-3" aria-live="polite">
                        <!-- dynamic radio list for content (fetched) -->
                    </div>

                    <div id="btnCustomUrlWrap" class="mb-3" style="display:none;">
                        <label for="btn_custom_url" class="form-label">Custom URL</label>
                        <input id="btn_custom_url" name="btn_custom_url" class="form-control" type="url" />
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="btnSave" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ======= Namespaced state for Button module =======
        const state = {
            entries: [], // list of saved button entries (max 1 in old UI)
            editing: false,
            editIndex: null
        };

        // Elements
        const dataIn = document.getElementById('buttonEntriesData');
        const entriesInput = document.getElementById('buttonEntriesInput');
        const tableHeader = document.getElementById('buttonEntryTableHeader');
        const tableBody = document.getElementById('buttonEntryTableBody');

        const openBtn = document.getElementById('openButtonModalBtn');
        const modalEl = document.getElementById('buttonModal');
        const btnSave = document.getElementById('btnSave');

        const titleEl = document.getElementById('btn_title');
        const customUrlWrap = document.getElementById('btnCustomUrlWrap');
        const customUrlEl = document.getElementById('btn_custom_url');
        const contentList = document.getElementById('btnContentList');

        // init from server JSON if present
        try {
            const raw = dataIn ? dataIn.value : '';
            if (raw) state.entries = JSON.parse(raw);
        } catch (e) {
            state.entries = [];
        }

        // helpers
        function syncHidden() {
            if (!entriesInput) return;
            entriesInput.value = JSON.stringify(state.entries);
        }

        function toggleHeader() {
            if (!tableHeader) return;
            tableHeader.style.display = state.entries.length ? '' : 'none';
        }

        function renderTable() {
            if (!tableBody) return;
            tableBody.innerHTML = '';
            state.entries.forEach((entry, idx) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>${idx+1}</td>
                <td>${escapeHtml(entry.title)}</td>
                <td>${escapeHtml(entry.path||entry.url||'')}</td>
                <td>
                    <button class="btn btn-sm btn-light btn-edit" data-index="${idx}">Edit</button>
                    <button class="btn btn-sm btn-danger btn-del ms-1" data-index="${idx}">Delete</button>
                </td>
            `;
                tableBody.appendChild(tr);
            });
        }

        function escapeHtml(s) {
            if (s == null) return '';
            return String(s).replace(/[&<>"'`=\/]/g, c => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
                '/': '&#x2F;',
                '`': '&#x60',
                '=': '&#x3D'
            } [c]));
        }

        function openModal() {
            state.editing = false;
            state.editIndex = null;
            clearModalForm();
            const inst = bootstrap.Modal.getOrCreateInstance(modalEl);
            inst.show();
            // load content radios (example fetch) - replace route if needed
            loadContentOptions('templates');
        }

        function clearModalForm() {
            if (titleEl) titleEl.value = '';
            if (customUrlEl) customUrlEl.value = '';
            if (customUrlWrap) customUrlWrap.style.display = 'none';
            if (contentList) contentList.innerHTML = '';
            // reset radio selection
            const r = document.querySelector('input[name="btn_destination"][value="templates"]');
            if (r) r.checked = true;
        }

        // load content options (ajax). Replace URL with your route if necessary.
        async function loadContentOptions(table) {
            if (!contentList) return;
            contentList.innerHTML = '<div class="text-muted small">Loading...</div>';

            try {
                // Example endpoint: replace with your real route
                const url = "{{ route('navigations.fetchContent') }}?table=" + encodeURIComponent(table);
                const res = await fetch(url, {
                    credentials: 'same-origin'
                });
                if (!res.ok) throw new Error('Failed to load');
                const items = await res.json();
                contentList.innerHTML = '';
                items.forEach(it => {
                    const id = 'btn_content_' + it.id;
                    const wrap = document.createElement('div');
                    wrap.className = 'form-check';
                    wrap.innerHTML = `
                    <input class="form-check-input" type="radio" name="btn_content_id" id="${id}" value="${it.alias}" data-id="${it.id}">
                    <label class="form-check-label" for="${id}">${escapeHtml(it.title)}</label>
                `;
                    contentList.appendChild(wrap);
                });
            } catch (e) {
                contentList.innerHTML = '<div class="text-danger small">Failed to load items</div>';
            }
        }

        // dest toggles
        document.addEventListener('change', (ev) => {
            const r = ev.target.closest('input[name="btn_destination"]');
            if (!r) return;
            if (r.value === 'custom') {
                customUrlWrap.style.display = '';
                contentList.style.display = 'none';
            } else {
                customUrlWrap.style.display = 'none';
                contentList.style.display = '';
                loadContentOptions(r.value);
            }
        });

        // table actions (delegate)
        tableBody?.addEventListener('click', (ev) => {
            const edit = ev.target.closest('.btn-edit');
            const del = ev.target.closest('.btn-del');
            if (edit) {
                const idx = Number(edit.dataset.index);
                const entry = state.entries[idx];
                if (!entry) return;
                state.editing = true;
                state.editIndex = idx;
                titleEl.value = entry.title || '';
                if (entry.nav === 'custom') {
                    document.querySelector('input[name="btn_destination"][value="custom"]').checked =
                        true;
                    customUrlWrap.style.display = '';
                    customUrlEl.value = entry.url || '';
                    contentList.style.display = 'none';
                } else {
                    document.querySelector('input[name="btn_destination"][value="templates"]').checked =
                        true;
                    customUrlWrap.style.display = 'none';
                    contentList.style.display = '';
                    // load items then check matching contentId (delay)
                    loadContentOptions(entry.nav);
                    setTimeout(() => {
                        const match = document.querySelector(
                            `input[name="btn_content_id"][data-id="${entry.contentId}"]`);
                        if (match) match.checked = true;
                    }, 350);
                }
                bootstrap.Modal.getOrCreateInstance(modalEl).show();
                return;
            }
            if (del) {
                const idx = Number(del.dataset.index);
                if (!confirm('Delete this entry?')) return;
                state.entries.splice(idx, 1);
                syncHidden();
                renderTable();
                toggleHeader();
            }
        });

        // save button
        btnSave?.addEventListener('click', () => {
            const title = titleEl?.value?.trim() ?? '';
            const nav = document.querySelector('input[name="btn_destination"]:checked')?.value ??
                'templates';
            let url = '';
            let contentId = null;
            let contentTitle = '';

            if (nav === 'custom') {
                url = customUrlEl?.value?.trim() ?? '';
                if (!url) {
                    showError('Enter a URL');
                    return;
                }
                contentTitle = url;
            } else {
                const sel = document.querySelector('input[name="btn_content_id"]:checked');
                if (!sel) {
                    showError('Select content');
                    return;
                }
                url = sel.value;
                contentId = sel.dataset.id;
                contentTitle = sel.nextElementSibling?.textContent ?? '';
            }

            const payload = {
                title,
                nav,
                url,
                contentId,
                contentTitle,
                path: `${nav}/${nav==='custom'?url:contentId}`
            };

            if (state.editing && state.editIndex !== null) {
                state.entries[state.editIndex] = payload;
            } else {
                state.entries.push(payload);
            }

            syncHidden();
            renderTable();
            toggleHeader();
            clearModalForm();
            hideModalSafely(modalEl);
        });

        // utility to hide modal safely and cleanup
        function removeBackdropsAndBodyState() {
            document.querySelectorAll('.modal-backdrop').forEach(e => e.remove());
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        }

        function hideModalSafely(el) {
            try {
                const inst = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
                inst.hide();
                setTimeout(removeBackdropsAndBodyState, 250);
            } catch (e) {
                el.classList.remove('show');
                el.style.display = 'none';
                removeBackdropsAndBodyState();
            }
        }

        function showError(msg) {
            // tiny fallback; replace with your app notification if present
            if (typeof showErrorNotification === 'function') return showErrorNotification(msg);
            alert(msg);
        }

        // initial render
        renderTable();
        toggleHeader();
    });
</script>
