<style>
    .popup-modal img {
        width: 60px;
        height: 60px;
        margin: 0 auto 10px;
    }

    .popup-modal h3 {
        margin: 10px 0 5px;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .popup-modal p {
        font-size: 1rem;
    }

    .bg-green {
        background-color: green;
    }

    .bg-red {
        background-color: red;
    }

    .notification {
        position: fixed;
        top: 20px;
        right: -400px;
        /* Initially hidden */
        padding: 15px 30px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        font-size: 16px;
        z-index: 9999;
        transition: right 0.5s ease-in-out;
    }

    .notification.success {
        background-color: #28a745;
        color: white;
    }

    .notification.error {
        background-color: #dc3545;
        color: white;
    }

    .notification.show {
        right: 20px;
        /* Slide in */
    }

    .notification.hidden {
        right: -400px;
        /* Slide out */
    }
</style>

{{--
    🔔 Critical Popup Notification
    ─────────────────────────────────────────

    This popup is meant for important user alerts like success or error messages
    that need high visibility — typically used for form submissions or actions.

    ✅ HOW TO USE (in your Controller):

        // For success
        session()->flash('popup', [
            'type'    => 'success',
            'message' => 'Your operation was successful.'
        ]);

        // For error
        session()->flash('popup', [
            'type'    => 'error',
            'message' => 'Oops! Something went wrong.'
        ]);

        // Or, using redirect
        return redirect()->back()->with('popup', [
            'type'    => 'success', // or 'error'
            'message' => 'Settings saved successfully!'
        ]);

    ⚠️ Make sure this Blade block exists in your layout or the target view
    and is not overwritten or placed inside sections that get cleared.
--}}


@php
    $popup = session('popup'); // ['type' => 'success'|'error', 'message' => '...']
@endphp

<!-- Success or Error Popup -->
@if (session()->has('popup'))
    @php
        $popup = session('popup');
    @endphp
    <div class="popup-modal">
        <!-- Circular Icon -->
        <div class="icon-circle">
            @if ($popup['type'] === 'success')
                <i class="bi bi-check-circle-fill" style="color: #90EE90; font-size: 70px;"></i>
            @else
                <i class="bi bi-x-circle-fill" style="color: red; font-size: 70px;"></i>
            @endif
        </div>
        <!-- Heading -->
        <h3>{{ $popup['type'] === 'success' ? 'Success' : 'Error' }}</h3>
        <!-- Message -->
        <p style="color:gray;">{{ $popup['message'] }}</p>
    </div>
@endif



<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Icon for the modal -->
                <h5 class="modal-title" id="confirmationModalLabel">
                    <i class="fa fa-exclamation-triangle text-warning" style="margin-right: 10px;"></i> Are you
                    sure?
                </h5>
            </div>
            <div class="modal-body">
                <p id="confirmationMessage">Do you really want to delete this item?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirmActionButton">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div id="successNotification" class="notification success hidden">
    <span id="successMessage"></span>
</div>
<div id="errorNotification" class="notification error hidden">
    <span id="errorMessage"></span>
</div>

<!-- function that show error notification or success notification on
    toaster rather then standerd popup, for that set session to notificationSuccess or
    notificationError in controller instead of success or error -->


<script>
    function showNotification(type, message) {
        const notificationId = type === 'success' ? 'successNotification' : 'errorNotification';
        const messageElementId = type === 'success' ? 'successMessage' : 'errorMessage';

        const notification = document.getElementById(notificationId);
        const messageElement = document.getElementById(messageElementId);

        // Set the message
        messageElement.textContent = message;

        // Show the notification
        notification.classList.remove('hidden');
        notification.classList.add('show');

        // Hide the notification after 3 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            notification.classList.add('hidden');
        }, 3000);
    }

    function showSuccessNotification(message) {
        showNotification('success', message);
    }

    function showErrorNotification(message) {
        showNotification('error', message);
    }

    // Example usage
    // showSuccessNotification("Role assigned successfully!");
    // showErrorNotification("Failed to assign role.");

    document.addEventListener('DOMContentLoaded', function() {
        // Automatically remove the popup after 2 seconds
        @if (session('success') || session('error'))
            setTimeout(() => {
                document.querySelector('.popup-modal').remove();
            }, 2000);
        @endif
    });


    /*
    ==============================
    ACTION BUTTONS BINDING FUNCTION
    ==============================
    This function binds the click event on all elements with the classes
    .delete-btn and .publish-btn. It sets up a confirmation modal and redirects
    the user if confirmed.
    */
    function bindActionButtons() {
        // Select all action buttons (Delete/Publish/Unpublish)
        const actionButtons = document.querySelectorAll('.delete-btn, .publish-btn');

        // When a button is clicked
        actionButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default link behavior

                const action = this.getAttribute(
                    'data-action'); // Get action type (delete/publish/unpublish)
                const url = this.getAttribute('data-url'); // Get URL for the action
                const customMessage = this.getAttribute('data-message');
                const defaultMessages = {
                    delete: 'Do you really want to delete this item?',
                    unpublish: 'Do you really want to unpublish this item?',
                    publish: 'Do you really want to publish this item?'
                };
                const message = customMessage || defaultMessages[action] || 'Are you sure?';

                // Set the modal message
                document.getElementById('confirmationMessage').textContent = message;

                // Set the confirm button action
                const confirmButton = document.getElementById('confirmActionButton');
                confirmButton.onclick = function() {
                    window.location.href = url; // Redirect to the URL (delete/publish/unpublish)
                };

                // Show the modal
                var confirmationModal = new bootstrap.Modal(document.getElementById(
                    'confirmationModal'));
                confirmationModal.show();
            });
        });
    }

    /*
    =====================
    ACTION BUTTON MESSAGE
    =====================
    you can set data-message attribute in the action button to set custom message
    for the confirmation modal. If not set, it will use the default messages defined
    in the defaultMessages object.
    for example: data-message="Are you sure you want to delete this blog post?"
    */

    /*
    ==============================
    INITIAL BINDING ON DOCUMENT LOAD
    ==============================
    This ensures that on initial page load the action buttons are bound.
    */
    document.addEventListener('DOMContentLoaded', () => {
        bindActionButtons();
    });
</script>

{{--
    🔔 Standard Notification (Toastr)
    ─────────────────────────────────────────

    These lightweight alerts are triggered using simple session keys:
    'success' and 'error'. Ideal for general feedback like form updates,
    user actions, or confirmations that don’t require full popup modals.

    ✅ HOW TO USE (in your Controller):

        // For a success message
        return redirect()->back()->with('success', 'Profile updated successfully!');

        // For an error message
        return redirect()->back()->with('error', 'Failed to update profile.');

    ⚠️ The JavaScript functions `showSuccessNotification()` and
    `showErrorNotification()` must be globally available (already loaded).
--}}


@if (session('success'))
    <script>
        showSuccessNotification("{{ session('success') }}");
    </script>
@elseif (session('error'))
    <script>
        showErrorNotification("{{ session('error') }}");
    </script>
@endif
