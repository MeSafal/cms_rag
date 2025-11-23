<!-- backend/layout/extraContentModel.blade.php (REPEATER - no nested <form>) -->
<!-- Modal (keeps same visual design; all IDs namespaced with _repeater) -->
<div class="modal fade" id="repeaterModal" tabindex="-1" aria-labelledby="repeaterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-scheme" id="repeaterModalLabel">Add Extra Content</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- NOTE: NOT a real <form> to avoid nested form issues -->
                <div id="repeaterForm_container_repeater">
                    <div class="row">
                        {!! CreateText('modalTitle_repeater', old('modalTitle', ''), 'Title', ['aria-describedby' => 'titleHelp']) !!}
                        {!! CreateText('modalSubtitle_repeater', old('modalSubtitle', ''), 'Sub Title', [
                            'aria-describedby' => 'titleHelp',
                        ]) !!}
                    </div>
                    <br>
                    {!! CreateEditorInput(
                        'modalDescription_repeater',
                        old('modalDescription', ''),
                        'Description',
                        'modalDescription_repeater',
                        [
                            'placeholder' => 'Write a Description',
                        ],
                    ) !!}
                    <br>
                    <label for="repeater_extraImg" class="form-label">Extra Image</label>
                    {!! CreateImage(
                        'extraImg_repeater',
                        'Extra Image',
                        'extraImg_repeater',
                        'holder_repeater',
                        old('extraImg', isset($item) ? $item->thumb : ''),
                    ) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                    style="color:white;">Close</button>
                <button type="button" class="btn btn-primary" id="addEntry_repeater" style="color:white;">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- View modal (namespaced) -->
<div class="modal fade" id="viewModal_repeater" tabindex="-1" aria-labelledby="viewModalLabel_repeater"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-scheme" id="viewModalTitle_repeater"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="text-scheme" id="viewModalSubtitle_repeater"></h6>
                <p class="text-scheme" id="viewModalDescription_repeater"></p>
                <div id="viewModalImagesContainer_repeater" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Namespaced variables so it doesn't conflict with other modals
        const entriesDataEl = document.getElementById('entriesData'); // keep this name (parent expects it)
        const entriesInputEl = document.getElementById('entriesInput'); // keep this name (parent expects it)

        const tableBody = document.getElementById('entryTableBody_repeater') || document.getElementById(
            'entryTableBody');
        const tableHeader = document.getElementById('entryTableHeader_repeater') || document.getElementById(
            'entryTableHeader');

        const modalEl = document.getElementById('repeaterModal');
        const viewModalEl = document.getElementById('viewModal_repeater');

        const titleEl = document.getElementById('modalTitle_repeater');
        const subtitleEl = document.getElementById('modalSubtitle_repeater');
        const descId = 'modalDescription_repeater';
        const extraImgEl = document.getElementById('extraImg_repeater');

        const addBtn = document.getElementById('addEntry_repeater');

        // state
        let entries_repeater = [];
        let currentEditIndex_repeater = null;
        let entryCount_repeater = 0;

        // util escape
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

        // Determine base URL to prefix relative/storage paths
        const APP_URL = (window.APP_URL && String(window.APP_URL).trim()) ||
            (document.querySelector('meta[name="app-url"]')?.content?.trim()) ||
            window.location.origin;

        function normalizeUrl(raw) {
            if (!raw) return null;
            let s = String(raw).trim();

            // remove invisible/control characters often present from DB dumps (eg: "▶")
            s = s.replace(/[^\x20-\x7E]/g, '').trim();
            if (!s) return null;

            // If it's a data URL, leave as-is
            if (/^data:/i.test(s)) return s;

            // Already absolute
            if (/^https?:\/\//i.test(s)) return s;

            // Protocol-relative
            if (/^\/\//.test(s)) return window.location.protocol + s;

            // Path starting with slash -> prefix origin
            if (s.startsWith('/')) return APP_URL.replace(/\/$/, '') + s;

            // Typical storage path like "storage/..." or "storage/photos/..."
            // or relative path without leading slash -> prefix with origin + '/'
            return APP_URL.replace(/\/$/, '') + '/' + s.replace(/^\/+/, '');
        }

        // init from hidden input (entriesData) if present
        try {
            const raw = entriesDataEl ? entriesDataEl.value : '';
            if (raw) entries_repeater = JSON.parse(raw) || [];
        } catch (e) {
            entries_repeater = [];
            console.warn('repeater: invalid entriesData JSON', e);
        }

        function syncHidden_repeater() {
            if (!entriesInputEl) return;
            entriesInputEl.value = JSON.stringify(entries_repeater);
        }

        function renderTable_repeater() {
            if (!tableBody || !tableHeader) return;
            tableBody.innerHTML = '';
            if (entries_repeater.length === 0) {
                if (tableHeader) tableHeader.style.display = 'none';
                return;
            }
            if (tableHeader) tableHeader.style.display = 'table-header-group';
            entries_repeater.forEach((entry, idx) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${escapeHtml(entry.title || '')}</td>
                <td class="icon-wrapper">
                    <div class="toggle-icons" title="Options" role="button" tabindex="0" data-index="${idx}">
                        <i style="font-size: 20px;" class="fa fa-ellipsis-h"></i>
                    </div>
                    <div class="popup-container" style="display:none">
                        <a href="javascript:void(0)" class="text-icon view-entry_repeater" data-entry-index="${idx}">
                            <i class="fa fa-eye" style="font-size: 20px; padding-right: 10px;"></i> View
                        </a>
                        <a href="javascript:void(0)" class="text-icon edit-entry_repeater" data-entry-index="${idx}">
                            <i class="fa fa-edit" style="font-size: 20px; padding-right: 10px;"></i> Edit
                        </a>
                        <a href="javascript:void(0)" class="text-icon delete-entry_repeater text-danger" data-entry-index="${idx}">
                            <i class="fa fa-trash" style="font-size: 20px; padding-right: 10px;"></i> Delete
                        </a>
                    </div>
                </td>
            `;
                tableBody.appendChild(tr);
            });
        }

        // clear modal inputs (no <form>. safe)
        function clearModal_repeater() {
            if (titleEl) titleEl.value = '';
            if (subtitleEl) subtitleEl.value = '';
            if (extraImgEl) extraImgEl.value = '';
            // clear CKEditor instance if present
            try {
                if (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances[descId]) {
                    CKEDITOR.instances[descId].setData('');
                } else {
                    const d = document.getElementById(descId);
                    if (d) d.value = '';
                }
            } catch (e) {
                /* ignore */
            }
            currentEditIndex_repeater = null;
        }

        function getDesc_repeater() {
            try {
                if (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances[descId]) {
                    return CKEDITOR.instances[descId].getData().trim();
                }
            } catch (e) {
                /* fallback */
            }
            const d = document.getElementById(descId);
            return d ? d.value.trim() : '';
        }

        // safe hide modal
        function removeBackdropsAndBodyState() {
            document.querySelectorAll('.modal-backdrop').forEach(e => e.remove());
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        }

        function hideModalSafely(el) {
            try {
                if (!el) return;
                const inst = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
                inst.hide();
                setTimeout(removeBackdropsAndBodyState, 200);
            } catch (e) {
                el.classList.remove('show');
                el.style.display = 'none';
                removeBackdropsAndBodyState();
            }
        }

        // Add / Update handler
        addBtn && addBtn.addEventListener('click', function() {
            const title = titleEl ? titleEl.value.trim() : '';
            const subtitle = subtitleEl ? subtitleEl.value.trim() : '';
            const description = getDesc_repeater();
            const extraImg = extraImgEl ? extraImgEl.value.trim() : '';

            if (!title && !description) {
                if (typeof showErrorNotification === 'function') return showErrorNotification(
                    'Title or Description is required.');
                return alert('Title or Description is required.');
            }

            const payload = {
                title,
                subtitle,
                description,
                extraImg
            };

            if (currentEditIndex_repeater !== null && !isNaN(currentEditIndex_repeater)) {
                entries_repeater[currentEditIndex_repeater] = payload;
            } else {
                entries_repeater.push(payload);
                entryCount_repeater++;
            }

            syncHidden_repeater();
            renderTable_repeater();
            clearModal_repeater();
            hideModalSafely(modalEl);

            // cleanup fallback
            setTimeout(removeBackdropsAndBodyState, 400);

            if (typeof showSuccessNotification === 'function') showSuccessNotification('Entry saved.');
        });

        // Table delegation (view/edit/delete + popup toggle)
        tableBody && tableBody.addEventListener('click', function(ev) {
            const toggleBtn = ev.target.closest('.toggle-icons');
            if (toggleBtn) {
                ev.stopPropagation();
                // close others
                document.querySelectorAll('.popup-container').forEach(pc => {
                    if (pc !== toggleBtn.parentElement.querySelector('.popup-container')) pc
                        .style.display = 'none';
                });
                const pc = toggleBtn.parentElement.querySelector('.popup-container');
                if (pc) pc.style.display = (pc.style.display === 'block') ? 'none' : 'block';
                return;
            }

            const view = ev.target.closest('.view-entry_repeater');
            if (view) {
                const idx = Number(view.dataset.entryIndex);
                const entry = entries_repeater[idx];
                if (!entry) return;
                const vmTitle = document.getElementById('viewModalTitle_repeater');
                const vmSubtitle = document.getElementById('viewModalSubtitle_repeater');
                const vmDesc = document.getElementById('viewModalDescription_repeater');
                const vmImgs = document.getElementById('viewModalImagesContainer_repeater');

                if (vmTitle) vmTitle.innerText = entry.title || '';
                if (vmSubtitle) vmSubtitle.innerText = entry.subtitle || '';
                if (vmDesc) vmDesc.innerHTML = entry.description || '';
                if (vmImgs) {
                    vmImgs.innerHTML = '';
                    if (entry.extraImg) {
                        // split CSV, normalize and append
                        (entry.extraImg.split(',') || []).map(u => (u || '').trim()).filter(Boolean)
                            .forEach(url => {
                                const normalized = normalizeUrl(url);
                                if (!normalized) return;
                                const img = document.createElement('img');
                                img.src = normalized;
                                img.alt = 'Image';
                                img.style.width = '100px';
                                img.style.height = '100px';
                                img.style.objectFit = 'cover';
                                img.className = 'me-2 mb-2';
                                vmImgs.appendChild(img);
                            });
                    } else {
                        vmImgs.innerHTML = '<p class="text-muted">No images available</p>';
                    }
                }

                if (viewModalEl && window.bootstrap && bootstrap.Modal) {
                    bootstrap.Modal.getOrCreateInstance(viewModalEl).show();
                }
                return;
            }

            const edit = ev.target.closest('.edit-entry_repeater');
            if (edit) {
                const idx = Number(edit.dataset.entryIndex);
                const entry = entries_repeater[idx];
                if (!entry) return;
                currentEditIndex_repeater = idx;
                if (titleEl) titleEl.value = entry.title || '';
                if (subtitleEl) subtitleEl.value = entry.subtitle || '';
                if (extraImgEl) extraImgEl.value = entry.extraImg || '';
                try {
                    if (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances[descId]) {
                        CKEDITOR.instances[descId].setData(entry.description || '');
                    } else {
                        const d = document.getElementById(descId);
                        if (d) d.value = entry.description || '';
                    }
                } catch (e) {
                    /* ignore */
                }
                if (modalEl && window.bootstrap && bootstrap.Modal) bootstrap.Modal.getOrCreateInstance(
                    modalEl).show();
                return;
            }

            const del = ev.target.closest('.delete-entry_repeater');
            if (del) {
                const idx = Number(del.dataset.entryIndex);
                if (!confirm('Delete this entry?')) return;
                entries_repeater.splice(idx, 1);
                syncHidden_repeater();
                renderTable_repeater();
                if (typeof showSuccessNotification === 'function') showSuccessNotification(
                    'Entry deleted.');
                return;
            }
        });

        // global click to close popups
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.icon-wrapper')) {
                document.querySelectorAll('.popup-container').forEach(pc => pc.style.display = 'none');
            }
        });

        // keyboard/backdrop safety
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') removeBackdropsAndBodyState();
        }, {
            passive: true
        });
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList && e.target.classList.contains('modal-backdrop'))
                removeBackdropsAndBodyState();
        }, {
            passive: true
        });

        // initial render
        renderTable_repeater();
    });
</script>
