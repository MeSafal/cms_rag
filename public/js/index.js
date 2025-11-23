// public/js/index.js
/**
 * Main front-end logic for Articles table
 *
 * NOTE: Declare your CSRF token directly here if you want to avoid reading it from the meta tag.
 * Replace the placeholder below with your actual token string.
 */
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
}
/* Fallback notification helpers if your theme doesn't provide them */
if (typeof window.showSuccessNotification === 'undefined') {
    window.showSuccessNotification = function (msg) {
        console.log('SUCCESS:', msg);
    };
}
if (typeof window.showErrorNotification === 'undefined') {
    window.showErrorNotification = function (msg) {
        console.error('ERROR:', msg);
    };
}

/* ---------------------------
   Publish Toggle
   --------------------------- */
function bindPublishToggle() {
    const csrfToken = getCsrfToken();
    document.querySelectorAll('.page-toggle').forEach(function (toggle) {
        // prevent clicks from bubbling
        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        // handle change
        toggle.addEventListener('change', function (e) {
            e.stopPropagation();
            const isChecked = this.checked;
            const self = this;
            self.disabled = true;

            const urlTemplate = this.dataset.urlTemplate;
            if (!urlTemplate) {
                console.error('No URL template provided on .page-toggle');
                self.disabled = false;
                return;
            }
            const url = urlTemplate.replace(':publish', isChecked ? 1 : -1);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data && data.success) {
                        showSuccessNotification(data.message || 'Status updated');
                    } else {
                        showErrorNotification(data.message || 'Failed to update status');
                        self.checked = !isChecked;
                    }
                })
                .catch(error => {
                    console.error('Publish toggle error:', error);
                    showErrorNotification('Error updating status');
                    self.checked = !isChecked;
                })
                .finally(() => {
                    self.disabled = false;
                });
        });
    });
}

/* ---------------------------
   Alias Editing (jQuery)
   --------------------------- */
function bindAliasEditing() {
    const csrfToken = getCsrfToken();
    if (typeof $ === 'undefined') return; // jQuery required for this helper

    $('.alias-text').off('click').on('click', function () {
        var $text = $(this);
        $text.addClass('d-none').siblings('.alias-input').removeClass('d-none').focus();
    });

    $('.alias-input').off('blur keydown').on('blur keydown', function (e) {
        // if blur or Escape -> close input without saving
        if ((e.type === 'blur') || (e.type === 'keydown' && e.key === 'Escape')) {
            $(this).addClass('d-none').siblings('.alias-text').removeClass('d-none');
            return;
        }

        if (e.type === 'keydown' && e.key === 'Enter') {
            var $input = $(this);
            var $text = $input.siblings('.alias-text');
            var itemId = $input.data('id');
            var urlTemplate = $input.data('urlTemplate') || '';
            var url = urlTemplate.indexOf(':id') !== -1 ? urlTemplate.replace(':id', itemId) : urlTemplate;

            $input.addClass('d-none');
            $text.removeClass('d-none');

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    alias: $input.val()
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    showSuccessNotification(response.message || 'Alias updated');
                    if (response && response.success && response.alias) {
                        $text.text(response.alias);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error updating alias:', error);
                    showErrorNotification('Error updating alias');
                }
            });
        }
    });
}

/* ---------------------------
   Popup Toggle for action icons (jQuery)
   --------------------------- */
function bindPopupToggle() {
    if (typeof $ === 'undefined') return;

    $('.toggle-icons').off('click').on('click', function (e) {
        e.stopPropagation();
        $('.popup-container').not($(this).siblings('.popup-container')).slideUp();
        $(this).siblings('.popup-container').stop(true, true).slideToggle();
    });

    $(document).on('click', (e) => {
        if (!$(e.target).closest('.icon-wrapper').length) {
            $('.popup-container').slideUp();
        }
    });
}

/* ---------------------------
   Utility: Get table body reference safely
   --------------------------- */
function getTableBody(tableId = 'articles-table') {
    const table = document.getElementById(tableId);
    if (table) {
        return table.querySelector('tbody');
    }
    // fallback to first tbody on page
    return document.querySelector('tbody');
}

/* ---------------------------
   Initialize Order (safe against missing DOM)
   --------------------------- */
let initialOrder = [];
function initializeOrder(tableId = 'articles-table') {
    const tableBody = getTableBody(tableId);
    if (!tableBody) {
        initialOrder = [];
        return initialOrder;
    }

    initialOrder = Array.from(tableBody.querySelectorAll('tr')).map((row) => ({
        id: row.getAttribute('data-id'),
        order: row.getAttribute('data-order') !== null ? row.getAttribute('data-order') : ''
    }));
    return initialOrder;
}

/* ---------------------------
   Drag & Drop Ordering
   --------------------------- */
function bindDragAndDropForTable(tableId = 'articles-table') {
    const table = document.getElementById(tableId);
    if (!table) return;

    // permission check
    if (table.dataset.permission !== "true") return;

    const tableBody = table.querySelector('tbody');
    if (!tableBody) return;

    const updateUrl = table.dataset.url;

    let draggedRow = null;

    // make rows draggable
    tableBody.querySelectorAll('tr').forEach(row => {
        row.setAttribute('draggable', 'true');

        row.addEventListener('dragstart', function (e) {
            draggedRow = row;
            row.classList.add('dragging');
            try {
                e.dataTransfer.effectAllowed = "move";
            } catch (err) {
                // some browsers may throw on effectAllowed when not using DataTransfer
            }
        });

        row.addEventListener('dragend', function () {
            if (draggedRow) draggedRow.classList.remove('dragging');
            updateOrder();
            draggedRow = null;
        });

        row.addEventListener('dragover', function (e) {
            e.preventDefault();
            const after = getDragAfterElement(e.clientY);
            if (!after) {
                tableBody.appendChild(draggedRow);
            } else {
                tableBody.insertBefore(draggedRow, after);
            }
        });
    });

    function getDragAfterElement(y) {
        const rows = [...tableBody.querySelectorAll('tr:not(.dragging)')];
        return rows.reduce((closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;
            if (offset < 0 && offset > closest.offset) {
                return { offset, element: child };
            }
            return closest;
        }, { offset: Number.NEGATIVE_INFINITY }).element;
    }

    function updateOrder() {
        // compute new order based on DOM position (1-based)
        const currentOrder = Array.from(tableBody.querySelectorAll('tr')).map((row, idx) => {
            const newOrder = idx + 1;
            row.setAttribute('data-order', newOrder);
            return {
                id: row.getAttribute('data-id'),
                order: newOrder
            };
        });

        // if initialOrder was empty, populate it (defensive)
        if (!initialOrder || initialOrder.length === 0) {
            initializeOrder(tableId);
        }

        const changedRows = currentOrder.filter(cur => {
            const orig = initialOrder.find(o => o.id === cur.id);
            return orig && Number(orig.order) !== Number(cur.order);
        });

        if (changedRows.length === 0) return;

        fetch(updateUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                order: changedRows
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    initializeOrder(tableId);
                    showSuccessNotification('Order updated successfully');
                } else {
                    showErrorNotification((data && data.message) || 'Failed to update order');
                }
            })
            .catch(err => {
                console.error('Order-update error:', err);
                showErrorNotification('Unexpected error occurred while updating order');
            });
    }

    // capture starting state
    initializeOrder(tableId);
}

/* ---------------------------
   Optional: placeholder for other bindings referenced in blade
   --------------------------- */
function bindActionButtons() {
    // If you have delete/publish confirmation handlers etc., bind them here.
    // This placeholder avoids "bindActionButtons is not defined" errors from blade script.
}

/* Export or attach to window if needed */
window.bindPublishToggle = bindPublishToggle;
window.bindAliasEditing = bindAliasEditing;
window.bindPopupToggle = bindPopupToggle;
window.initializeOrder = initializeOrder;
window.bindDragAndDropForTable = bindDragAndDropForTable;
window.bindActionButtons = bindActionButtons;
