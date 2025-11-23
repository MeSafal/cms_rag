@extends('backend.layout.app')
@section('mainSection')

@php
    $settingArray = $settingArray ?? ['switch_state' => 'on'];
    $selectedColor = $settingArray['custom_color'] ?? $settingArray['selected_color'] ?? '#530d82';
@endphp

<div class="container py-4">
    <div class="row gx-4 gy-4 align-items-start">

        <!-- Left: Color selector -->
        <div class="col-12 col-lg-6">
            <form id="colorSelectorForm" action="{{ route('settings.store') }}" method="POST" class="card p-3 h-100">
                @csrf
                <h5 class="mb-3">Select a Color</h5>

                <div class="d-flex flex-wrap gap-2 mb-3" aria-label="Predefined colors">
                    <button type="button" class="btn btn-sm p-0 rounded-circle border" style="width:40px;height:40px;"
                        data-color="#530d82" aria-pressed="false" aria-label="#530d82" title="#530d82">
                        <span class="d-block rounded-circle w-100 h-100" style="background:#530d82;border-radius:50%;"></span>
                    </button>

                    <button type="button" class="btn btn-sm p-0 rounded-circle border" style="width:40px;height:40px;"
                        data-color="#EB1616" aria-pressed="false" aria-label="#EB1616" title="#EB1616">
                        <span class="d-block rounded-circle w-100 h-100" style="background:#EB1616;border-radius:50%;"></span>
                    </button>

                    <button type="button" class="btn btn-sm p-0 rounded-circle border" style="width:40px;height:40px;"
                        data-color="#33FF57" aria-pressed="false" aria-label="#33FF57" title="#33FF57">
                        <span class="d-block rounded-circle w-100 h-100" style="background:#33FF57;border-radius:50%;"></span>
                    </button>

                    <button type="button" class="btn btn-sm p-0 rounded-circle border" style="width:40px;height:40px;"
                        data-color="#3357FF" aria-pressed="false" aria-label="#3357FF" title="#3357FF">
                        <span class="d-block rounded-circle w-100 h-100" style="background:#3357FF;border-radius:50%;"></span>
                    </button>

                    <button type="button" class="btn btn-sm p-0 rounded-circle border" style="width:40px;height:40px;"
                        data-color="#FFD700" aria-pressed="false" aria-label="#FFD700" title="#FFD700">
                        <span class="d-block rounded-circle w-100 h-100" style="background:#FFD700;border-radius:50%;"></span>
                    </button>
                </div>

                <div class="mb-3 d-flex align-items-center gap-3">
                    <div>
                        <label for="color-picker" class="form-label mb-1">Or pick a custom color</label>
                        <input type="color" id="color-picker" name="custom_color" class="form-control form-control-color p-0"
                            value="{{ old('custom_color', $selectedColor) }}" style="width:56px;height:40px;">
                    </div>

                    <div class="ms-auto text-end">
                        <small class="d-block text-muted">Selected</small>
                        <div id="selected-color-display" class="border rounded" style="width:48px;height:48px;background:{{ old('selected_color', $selectedColor) }};"></div>
                        <small id="selected-color-code" class="d-block text-muted mt-1">{{ old('selected_color', $selectedColor) }}</small>
                    </div>
                </div>

                <input type="hidden" id="selected-color" name="selected_color" value="{{ old('selected_color', $selectedColor) }}">

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">Save Color</button>
                    <button type="button" id="clearColor" class="btn btn-outline-secondary">Clear</button>
                </div>
            </form>
        </div>

        <!-- Right: Modern preview (Bootstrap only) -->
        <div class="col-12 col-lg-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="card-title mb-1">Theme Preview</h5>
                            <p class="card-subtitle text-muted small mb-0">See how your selected primary color looks.</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-light text-muted">Live</span>
                        </div>
                    </div>

                    <!-- Navbar preview -->
                    <nav class="navbar rounded mb-3" style="background: var(--preview-nav-bg, #f8f9fa);">
                        <div class="container-fluid px-2">
                            <a class="navbar-brand fw-bold" href="#" style="color: var(--preview-accent, {{ $selectedColor }});">Brand</a>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm" style="background: transparent; border:1px solid rgba(0,0,0,0.08);">Link</button>
                                <button id="previewPrimaryBtn" class="btn btn-sm" style="background: {{ $selectedColor }}; color: #fff; border-color: {{ $selectedColor }};">Primary</button>
                            </div>
                        </div>
                    </nav>

                    <div class="row gx-3">
                        <div class="col-12 col-md-6">
                            <div class="p-3 border rounded mb-3" role="region" aria-label="Card preview">
                                <h6 class="mb-2">Card title</h6>
                                <p class="small text-muted">This is an example paragraph — primary color applied to buttons and accents.</p>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm" id="previewBtn1" style="background: {{ $selectedColor }}; color: #fff; border-color: {{ $selectedColor }};">Action</button>
                                    <button class="btn btn-sm btn-outline-secondary">Cancel</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="p-3 border rounded mb-3">
                                <h6 class="mb-2">Sidebar preview</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Dashboard
                                        <span class="badge bg-secondary rounded-pill" style="background: {{ $selectedColor }};">4</span>
                                    </li>
                                    <li class="list-group-item">Templates</li>
                                    <li class="list-group-item">Settings</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto d-flex justify-content-end gap-2">
                        <button type="button" id="applyPreview" class="btn btn-outline-primary">Apply Preview</button>
                        <button type="button" id="resetPreview" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square position-fixed" style="right:20px;bottom:20px;"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- Minimal JS: keep only color selection logic; remove theme toggle code -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const colorButtons = document.querySelectorAll('[data-color]');
    const colorPicker = document.getElementById('color-picker');
    const selectedColorCode = document.getElementById('selected-color-code');
    const selectedColorDisplay = document.getElementById('selected-color-display');
    const selectedColorInput = document.getElementById('selected-color');
    const colorForm = document.getElementById('colorSelectorForm');
    const clearBtn = document.getElementById('clearColor');

    function applyColor(color, submit = false) {
        if (!color) {
            // reset display
            selectedColorCode.textContent = 'None';
            selectedColorDisplay.style.background = '';
            colorButtons.forEach(btn => btn.setAttribute('aria-pressed', 'false'));
            if (selectedColorInput) selectedColorInput.value = '';
            if (colorPicker) colorPicker.value = '#000000';
            // reset preview variables
            document.documentElement.style.removeProperty('--bs-primary');
            document.documentElement.style.removeProperty('--preview-accent');
            document.documentElement.style.removeProperty('--preview-nav-bg');
            return;
        }
        selectedColorCode.textContent = color;
        selectedColorDisplay.style.background = color;
        if (selectedColorInput) selectedColorInput.value = color;
        if (colorPicker) colorPicker.value = color;
        colorButtons.forEach(btn => btn.setAttribute('aria-pressed', btn.dataset.color === color ? 'true' : 'false'));

        // update live preview CSS vars
        document.documentElement.style.setProperty('--bs-primary', color);
        document.documentElement.style.setProperty('--preview-accent', color);
        document.documentElement.style.setProperty('--preview-nav-bg', '#fff');
        if (submit && colorForm) colorForm.submit();
    }

    colorButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            applyColor(this.dataset.color, true);
        });
    });

    function debounce(fn, wait) {
        let t;
        return function (...args) { clearTimeout(t); t = setTimeout(() => fn.apply(this, args), wait); };
    }

    if (colorPicker) {
        colorPicker.addEventListener('input', debounce(function (e) {
            applyColor(e.target.value, true);
        }, 500));
    }

    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            applyColor('', false);
        });
    }

    // initialize from existing hidden value
    if (selectedColorInput && selectedColorInput.value) {
        applyColor(selectedColorInput.value, false);
    }

    // preview controls
    document.getElementById('applyPreview')?.addEventListener('click', () => {
        const color = selectedColorInput?.value || null;
        if (color) {
            document.documentElement.style.setProperty('--bs-primary', color);
            document.documentElement.setProperty
        }
    });

    document.getElementById('resetPreview')?.addEventListener('click', () => {
        document.documentElement.style.removeProperty('--bs-primary');
        document.documentElement.style.removeProperty('--preview-accent');
        document.documentElement.style.removeProperty('--preview-nav-bg');
    });
});
</script>

@endsection
