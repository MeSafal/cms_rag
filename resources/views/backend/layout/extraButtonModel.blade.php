<div class="modal fade" id="buttonModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-scheme">
                <h5 class="modal-title">Configure Button</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="buttonForm">
                    {!! CreateText('buttonTitle', '', 'Title', ['required'], '12') !!}
                    <br>
                    <div class="row g-4">
                        <div class="col-xl-6 col-md-12">
                            <div class="bg-shadow p-3 rounded scrollable-card">
                                <h6>Navigate To</h6>
                                @foreach ($tableOptions as $id => $label)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="destination_to"
                                            id="modal_dest_to_{{ $id }}" value="{{ $id }}"
                                            {{ $loop->first ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="modal_dest_to_{{ $id }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="bg-shadow p-3 rounded scrollable-card">
                                <h6 id="modalContentHeader">Select Content</h6>
                                <div id="modalContentRadioList" class="radio-container"></div>
                                <div id="modalCustomInput" style="display:none;">
                                    {!! CreateText('buttonUrl', '', 'URL', ['required'], '12') !!}
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal" style="color:white;">Close</button>
                <button id="saveButton" class="btn btn-primary" style="color:white;">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Elements
    const dataInput  = document.getElementById('buttonDataInput');
    const addBtn     = document.getElementById('addButtonBtn');
    const tableHdr   = document.getElementById('entryTableHeader');
    const tableBody  = document.getElementById('entryTableBody');
    const modalEl    = document.getElementById('buttonModal');
    const saveBtn    = document.getElementById('saveButton');
    const form       = document.getElementById('buttonForm');
    if (!form) return console.warn('buttonForm not found');

    const titleInput = form.querySelector('input[name="buttonTitle"]');
    const destRadios = Array.from(form.querySelectorAll('input[name="destination_to"]'));
    const customInp  = document.getElementById('modalCustomInput');
    const listEl     = document.getElementById('modalContentRadioList');
    const headerEl   = document.getElementById('modalContentHeader');

    // State
    let btnData = null;
    let lastItems = [];
    let editing = false;

    // Helpers
    function showErrorNotification(msg) {
        if (window.Toastify) {
            Toastify({ text: msg, duration: 4000 }).showToast();
        } else {
            console.error(msg);
        }
    }

    function getSelectedNav() {
        const r = form.querySelector('input[name="destination_to"]:checked');
        return r ? r.value : null;
    }

    function toggleNavUI() {
        const sel = getSelectedNav();
        if (sel === 'custom') {
            customInp.style.display = 'block';
            listEl.style.display = 'none';
            headerEl.innerText = 'Enter URL';
            listEl.innerHTML = '';
        } else {
            customInp.style.display = 'none';
            listEl.style.display = 'block';
            headerEl.innerText = 'Select Content';
            loadContent(sel);
        }
    }

    async function loadContent(table) {
        if (!table) {
            listEl.innerHTML = '<div class="text-muted">No table selected</div>';
            return;
        }
        listEl.innerHTML = '<div class="text-muted">Loading...</div>';
        try {
            const url = new URL("{{ route('navigations.fetchContent') }}", window.location.origin);
            url.searchParams.set('table', table);
            const res = await fetch(url.toString(), { credentials: 'same-origin' });
            if (!res.ok) {
                const txt = await res.text();
                showErrorNotification('Failed loading content');
                listEl.innerHTML = '<div class="text-danger">Failed to load</div>';
                console.error('fetch error:', res.status, txt);
                return;
            }
            const items = await res.json();
            lastItems = Array.isArray(items) ? items : [];
            listEl.innerHTML = '';
            if (lastItems.length === 0) {
                listEl.innerHTML = '<div class="text-muted">No items found</div>';
                return;
            }

            lastItems.forEach((it) => {
                const checked = (editing && btnData && btnData.contentId == it.id) ? 'checked' : '';
                const radioId = `dest_id_${it.id}`;
                const wrapper = document.createElement('div');
                wrapper.className = 'form-check mb-2';
                wrapper.innerHTML = `
                    <input class="form-check-input" type="radio" name="destination_id" id="${radioId}"
                           value="${it.alias}" data-id="${it.id}" ${checked}>
                    <label class="form-check-label" for="${radioId}">${it.title}</label>
                `;
                listEl.appendChild(wrapper);
            });
        } catch (err) {
            showErrorNotification('Error loading content');
            listEl.innerHTML = '<div class="text-danger">Load error</div>';
            console.error(err);
        }
    }

    function renderRowFromState() {
        if (!btnData) return;
        if (tableHdr) tableHdr.style.display = '';
        // show just one row (original logic)
        const displayPath = btnData.nav === 'custom' ? btnData.url : btnData.contentTitle;
        tableBody.innerHTML = `
            <tr data-id="1">
                <td>1</td>
                <td>${escapeHtml(btnData.title)}</td>
                <td>${escapeHtml(displayPath)}</td>
                <td>
                    <a href="javascript:void(0)" class="edit-btn"><i class="fa fa-edit"></i></a>
                    <a href="javascript:void(0)" class="del-btn text-danger ms-2"><i class="fa fa-trash"></i></a>
                </td>
            </tr>`;
    }

    function escapeHtml(s) {
        if (s == null) return '';
        return String(s).replace(/[&<>"'`=\/]/g, function (c) {
            return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;','`':'&#x60;','=':'&#x3D;'}[c];
        });
    }

    // Delegated actions for edit/delete
    tableBody.addEventListener('click', (ev) => {
        const edit = ev.target.closest('.edit-btn');
        const del  = ev.target.closest('.del-btn');
        if (edit) {
            if (!btnData) return;
            editing = true;
            // populate form
            titleInput.value = btnData.title || '';
            // set nav radio
            const navRadio = form.querySelector(`input[name="destination_to"][value="${btnData.nav}"]`);
            if (navRadio) navRadio.checked = true;
            toggleNavUI();
            if (btnData.nav === 'custom') {
                const urlInput = form.querySelector('input[name="buttonUrl"]');
                if (urlInput) urlInput.value = btnData.url || '';
            } else {
                // ensure content radios loaded, then set checked
                setTimeout(() => {
                    const match = form.querySelector(`input[name="destination_id"][data-id="${btnData.contentId}"]`);
                    if (match) match.checked = true;
                }, 350);
            }
            const bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
            bsModal.show();
            return;
        }
        if (del) {
            if (!confirm('Are you sure?')) return;
            btnData = null;
            if (dataInput) dataInput.value = '';
            if (tableHdr) tableHdr.style.display = 'none';
            tableBody.innerHTML = '';
            if (addBtn) addBtn.style.display = '';
            return;
        }
    });

    // Setup destination radio changes
    destRadios.forEach(r => r.addEventListener('change', toggleNavUI));

    // When modal is shown, ensure UI toggle runs (Bootstrap 5 event)
    modalEl.addEventListener('shown.bs.modal', () => {
        // reset editing flag only when opening normally
        if (!editing) {
            // clear selection in modal content area if needed
        }
        toggleNavUI();
    });

    // Save button
    saveBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const title = (titleInput && titleInput.value || '').trim();
        if (!title) { if (titleInput) titleInput.focus(); return; }

        const nav = getSelectedNav();
        if (!nav) return showErrorNotification('Select destination');

        let url = '', contentId = null, contentTitle = '';

        if (nav === 'custom') {
            const urlInput = form.querySelector('input[name="buttonUrl"]');
            url = urlInput ? urlInput.value.trim() : '';
            if (!url) { if (urlInput) urlInput.focus(); return; }
            contentTitle = url;
        } else {
            const sel = form.querySelector('input[name="destination_id"]:checked');
            if (!sel) { showErrorNotification('Select a content item'); return; }
            url = sel.value;
            contentId = sel.dataset.id;
            contentTitle = sel.nextElementSibling ? sel.nextElementSibling.textContent : '';
        }

        btnData = {
            title,
            nav,
            url,
            contentId,
            contentTitle,
            path: `${nav}/${nav === 'custom' ? url : contentId}`
        };
        if (dataInput) dataInput.value = JSON.stringify(btnData);
        if (addBtn) addBtn.style.display = 'none';
        renderRowFromState();

        // hide modal via bootstrap API and cleanup body/backdrop if needed
        try {
            const inst = bootstrap.Modal.getInstance(modalEl) || bootstrap.Modal.getOrCreateInstance(modalEl);
            if (inst) inst.hide();
        } catch (err) {
            // fallback: remove classes
            modalEl.classList.remove('show');
            modalEl.style.display = 'none';
            document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
            document.body.classList.remove('modal-open');
        }
        editing = false;
    });

    // Preload existing data if present
    try {
        if (dataInput && dataInput.value) {
            const parsed = JSON.parse(dataInput.value);
            if (parsed) {
                btnData = parsed;
            }
        }
    } catch (err) {
        console.warn('buttonData parse failed', err);
    }

    if (btnData && !editing) {
        if (addBtn) addBtn.style.display = 'none';
        renderRowFromState();
    }

    // Ensure modal uses Bootstrap 5 show/hide (for Add button)
    if (addBtn) {
        addBtn.addEventListener('click', () => {
            editing = false;
            // clear form
            if (form) form.reset();
            // show modal
            const inst = bootstrap.Modal.getOrCreateInstance(modalEl);
            inst.show();
        });
    }
});
</script>
