<footer class="footer border-top">
    <div class="container-fluid pt-4 px-4">
        <div class="rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    &copy; <a href="{{ route('dashboard') }}">Visobotics</a>, All Right Reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="javascript:void(0)">Gokul Subedi</a>
                    <br>Referenced with: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

<!-- JAVASCRIPT -->
<script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('backend/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('backend/js/plugins.js') }}"></script>


<script src="{{ asset('lib/ckeditor4/ckeditor.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Vector map -->
<script src="{{ asset('backend/libs/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('backend/libs/jsvectormap/maps/world-merc.js') }}"></script>

<!-- Swiper slider js -->
<script src="{{ asset('backend/libs/swiper/swiper-bundle.min.js') }}"></script>

<!-- Dashboard init -->
<script src="{{ asset('backend/js/pages/dashboard-ecommerce.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('backend/js/app.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>


<script>
    var route_prefix = "/filemanager";
</script>


<!-- CKEditor init -->
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
<script>
    //  $('textarea[name=ce5]').ckeditor({
    //      height: 100,
    //      filebrowserImageBrowseUrl: route_prefix + '?type=Images',
    //      filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{ csrf_token() }}',
    //      filebrowserBrowseUrl: route_prefix + '?type=Files',
    //      filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{ csrf_token() }}'
    //  });

    $(document).ready(function() {
        // Replace 'editor-class' with the class name you want to target
        $('.ckeditor-classic').each(function() {
            $(this).ckeditor({
                height: 200,
                filebrowserImageBrowseUrl: route_prefix + '?type=Images',
                filebrowserImageUploadUrl: route_prefix +
                    '/upload?type=Images&_token={{ csrf_token() }}',
                filebrowserBrowseUrl: route_prefix + '?type=Files',
                filebrowserUploadUrl: route_prefix +
                    '/upload?type=Files&_token={{ csrf_token() }}'
            });
        });
    });
</script>
<script>
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
</script>
<script>
    $('#lfm').filemanager('image', {
        prefix: route_prefix
    });
    // $('#lfm').filemanager('file', {prefix: route_prefix});
</script>



<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<style>
    .popover {
        top: auto;
        left: auto;
    }
</style>
<script>
    $(document).ready(function() {

        // Define function to open filemanager window
        var lfm = function(options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager',
                'width=900,height=600');
            window.SetUrl = cb;
        };

        // Define LFM summernote button
        var LFMButton = function(context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: 'Insert image with filemanager',
                click: function() {

                    lfm({
                        type: 'image',
                        prefix: '/filemanager'
                    }, function(lfmItems, path) {
                        lfmItems.forEach(function(lfmItem) {
                            context.invoke('insertImage', lfmItem.url);
                        });
                    });

                }
            });
            return button.render();
        };

        // Initialize summernote with LFM button in the popover button group
        // Please note that you can add this button to any other button group you'd like
        $('#summernote-editor').summernote({
            toolbar: [
                ['popovers', ['lfm']],
            ],
            buttons: {
                lfm: LFMButton
            }
        })

        /*===============================
        Toggle the dark and light theme of
        the system, via ajax
        ================================*/

           const btn = document.getElementById('themeToggleAjaxBtn');
        const icon = document.getElementById('themeToggleIcon');
        if (!btn || !icon) return;

        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        function isDarkTheme() {
            return document.documentElement.getAttribute('data-bs-theme') === 'dark' ||
                icon.classList.contains('bx-sun');
        }

        async function toggleServerTheme(newState) {
            const url = "{{ route('settings.toggle') }}";
            const res = await fetch(url, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    switch_state: newState
                })
            });

            if (!res.ok) {
                const txt = await res.text().catch(() => null);
                throw new Error('Server error: ' + (txt || res.status));
            }

            return res.json();
        }

        btn.addEventListener('click', async () => {
            btn.disabled = true;
            const currentlyDark = isDarkTheme();
            const desiredState = currentlyDark ? 'off' : 'on'; // 'on' = dark

            try {
                const json = await toggleServerTheme(desiredState);

                // show success — prefer server message if present
                const msg = (json && json.message) ? json.message : 'Theme updated';
                showSuccessNotification(msg);

            } catch (err) {
                // show error using the project's notification helper
                const errMsg = (err && err.message) ? err.message :
                    'Unable to toggle theme. Try again.';
                if (typeof showErrorNotification === 'function') {
                    showErrorNotification(errMsg);
                }
            } finally {
                btn.disabled = false;
            }
        });
    });
</script>

