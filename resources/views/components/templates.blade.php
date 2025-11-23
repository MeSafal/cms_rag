@php
    $options =
        ['' => label('Choose Template')] +
        collect(templateOptions())
            ->mapWithKeys(
                fn($path, $id) => [
                    $id => \Illuminate\Support\Str::limit($path, 50, '...'),
                ],
            )
            ->toArray();

    // Grab from PHP for JS
    $locT = $location['template_id'] ?? '';
    $locC = $location['child_id'] ?? '';

    // Determine initial toggle state
    $isTemplateDisabled = empty($locT) && empty($locC);
@endphp

<div class="col-sm-12 col-xl-12">
    {{-- Toggle Button --}}
    <div class="d-flex align-items-center mb-3 p-3rounded">
        <label for="templateToggle" class="d-flex align-items-center w-100" style="cursor: pointer;">
            <span class="me-3 fw-bold">{{label('Disable Template')}}:</span>
            <div class="form-check form-switch ms-auto">
                <input class="form-check-input" type="checkbox" id="templateToggle"
                    @if($isTemplateDisabled) checked @endif
                    style="width: 3.0rem; height: 1.2rem;">
            </div>
        </label>
    </div>

    <div id="templateContainer" class="rounded h-100 p-4" @if($isTemplateDisabled) style="display: none;" @endif>
        {!! CreateDropdown(
            'template_id',
            $options,
            label('Parent Template'),
            [
                'aria-describedby' => 'templateHelp',
                'value' => old('template_id', $locT ?: (array_search('home', templateOptions()) ?: null)),
            ],
            '12',
            true,
        ) !!}
        <br>
        <div class="row">
            <div class="col-12 col-md-12" id="templateSelectionCard" style="display: none;">
                <div class="bg-shadow p-3 rounded d-flex flex-column scrollable-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 id="templateSelectionHeader" class="mb-3">{{label('Select Options')}}</h5>
                    </div>
                    <div id="checkboxList" class="radio-container"></div>
                    <input type="hidden" name="child_id" id="selectedChildInput" value="{{ $locC }}">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Elements
        const templateToggle = document.getElementById('templateToggle');
        const templateContainer = document.getElementById('templateContainer');
        const templateDropdown = document.querySelector('select[name="template_id"]');
        const hiddenChildInput = document.getElementById('selectedChildInput');

        // Store original values
        let originalTemplateId = templateDropdown.value;
        let originalChildId = hiddenChildInput.value;

        // Initialize based on PHP state
        @if($isTemplateDisabled)
            templateToggle.checked = true;
            templateDropdown.value = '';
            hiddenChildInput.value = '';
        @endif

        // Toggle functionality
        templateToggle.addEventListener('change', function() {
            if (this.checked) {
                // Toggling ON: Hide container and clear values
                templateContainer.style.display = 'none';
                originalTemplateId = templateDropdown.value;
                originalChildId = hiddenChildInput.value;
                templateDropdown.value = '';
                hiddenChildInput.value = '';
            } else {
                // Toggling OFF: Show container and restore values
                templateContainer.style.display = 'block';
                templateDropdown.value = originalTemplateId;
                hiddenChildInput.value = originalChildId;

                // Re-fetch children if needed
                if (originalTemplateId) {
                    fetchTemplateChildren(originalTemplateId);
                }
            }
        });

        // Existing template functionality
        const templateSelectionCard = document.getElementById('templateSelectionCard');
        const checkboxList = document.getElementById('checkboxList');

        const defaultTemplate = "{{ $locT }}";
        let defaultChild = "{{ $locC }}";

        function fetchTemplateChildren(templateId) {
            if (!templateId) {
                templateSelectionCard.style.display = 'none';
                checkboxList.innerHTML = '';
                hiddenChildInput.value = '';
                return;
            }

            fetch(`{{ route('templates.fetchChildren', '') }}/${templateId}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(items => {
                templateSelectionCard.style.display = 'block';
                checkboxList.innerHTML = '';
                items.forEach(item => {
                    const checked = item.templates_id == defaultChild ? 'checked' : '';
                    checkboxList.insertAdjacentHTML('beforeend', `
                        <div class="form-check mb-2">
                            <input type="radio" class="form-check-input item-radio"
                                id="item_${item.templates_id}"
                                name="child_id"
                                value="${item.templates_id}"
                                ${checked}>
                            <label class="form-check-label text-light fw-bold"
                                for="item_${item.templates_id}">
                                ${item.title}
                            </label>
                        </div>`);
                });
                document.querySelectorAll('.item-radio').forEach(r => {
                    r.addEventListener('change', () => hiddenChildInput.value = r.value);
                    if (r.checked) hiddenChildInput.value = r.value;
                });
            })
            .catch(console.error);
        }

        // Initialize if not toggled off
        if (!templateToggle.checked) {
            fetchTemplateChildren(defaultTemplate);
        }

        templateDropdown.addEventListener('change', e => {
            defaultChild = '';
            fetchTemplateChildren(e.target.value);
        });
    });
</script>
