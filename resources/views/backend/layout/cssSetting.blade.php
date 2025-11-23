@php
    use App\Models\Setting;
    use Illuminate\Support\Facades\Auth;

    $theme_color = '#191C24';
    $dark_color = '#000000';
    $custom_color = '#EB1616';
    $head_color = '#FFFFFF';
    $faded_color = 'rgba(0,0,0,0.3)';
    $formatted_color = '3px 6px 6px rgba(0, 0, 0, 0.3)';

    if (Auth::check()) {
        $setting = Setting::where('createdby', Auth::id())->first();
        if (!$setting) {
            $setting = Setting::create([
                'switch_state' => 'on',
                'custom_color' => '#000000',
                'selected_color' => '#530d82',
                'status' => 1,
                'display_order' => 1,
                'createdby' => Auth::id(),
                'updatedby' => Auth::id(),
            ]);
            $setting = Setting::where('createdby', Auth::id())->first();
        }
        $settingArray = $setting->toArray();

        $custom_color =
            ($settingArray['custom_color'] ?? '#000000') !== '#000000'
                ? $settingArray['custom_color'] ?? '#000000'
                : $settingArray['selected_color'] ?? '#530d82';

        if (($settingArray['switch_state'] ?? 'on') == 'on') {
            $theme_color = '#191C24';
            $dark_color = '#000000';
            $head_color = '#FFFFFF';
        } else {
            $theme_color = '#E6E3DB';
            $dark_color = '#f7efef';
            $head_color = '#000000';
        }

        if (!function_exists('hexToRgb')) {
            function hexToRgb($hex, $alpha = 0.3)
            {
                $hex = ltrim($hex, '#');
                if (strlen($hex) === 3) {
                    $hex = str_repeat($hex[0], 2) . str_repeat($hex[1], 2) . str_repeat($hex[2], 2);
                }
                if (strlen($hex) !== 6) {
                    throw new InvalidArgumentException('Invalid hex color format.');
                }
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
                return "3px 6px 6px rgba($r, $g, $b, $alpha)";
            }
        }

        if (!function_exists('fadeOutColor')) {
            function fadeOutColor($hexColor, $alpha = 0.6)
            {
                $hexColor = ltrim($hexColor, '#');
                if (strlen($hexColor) == 6) {
                    $r = hexdec(substr($hexColor, 0, 2));
                    $g = hexdec(substr($hexColor, 2, 2));
                    $b = hexdec(substr($hexColor, 4, 2));
                } elseif (strlen($hexColor) == 3) {
                    $r = hexdec(str_repeat(substr($hexColor, 0, 1), 2));
                    $g = hexdec(str_repeat(substr($hexColor, 1, 1), 2));
                    $b = hexdec(str_repeat(substr($hexColor, 2, 1), 2));
                } else {
                    return "rgba(0,0,0,$alpha)";
                }
                return "rgba($r, $g, $b, $alpha)";
            }
        }

        $faded_color = fadeOutColor($custom_color, 0.6);

        try {
            $formatted_color = hexToRgb($custom_color);
        } catch (InvalidArgumentException $e) {
            $formatted_color = '3px 6px 6px rgba(0, 0, 0, 0.3)';
        }
    }
@endphp

<style>
    /* -------------------------
   Theme variables (blade -> css vars)
   Use these in the rest of the stylesheet only via var(--...)
   ------------------------- */
    :root {
        --cms-vertical-menu-bg: {{ $custom_color }};
        --custom-color: {{ $custom_color }};
        --theme-color: {{ $theme_color }};
        --dark-color: {{ $dark_color }};
        --head-color: {{ $head_color }};
        --faded-color: {{ $faded_color }};
        --shadow: {{ $formatted_color }};

        /* bootstrap mappings (override where needed) */
        --bs-primary: var(--custom-color);
        --bs-secondary: var(--theme-color);
        --bs-dark: var(--dark-color);
        --bs-white: var(--head-color);
    }

    /* -------------------------
   Minimal targeted overrides (keep only what's custom)
   - Put customizations where they belong (not re-defining full bootstrap)
   - Use CSS variables above
   ------------------------- */

    /* Shadows & utilities */
    .box-shadow {
        box-shadow: var(--shadow);
    }

    :root {
        --text-faded-color: #000;
    }

    [data-bs-theme="dark"] {
        --text-faded-color: #fff;
    }

    .text-scheme {
        color: var(--text-faded-color);
    }


    /* Selection outline for template radio */
    .selected-item input.main-template-radio:checked {
        outline: 2px solid var(--custom-color);
        outline-offset: 3px;
    }

    /* Hover dropdown highlight (custom) */
    .hover-dropdown:hover {
        background-color: #3e5cdf;
        color: #FFF;
    }

    /* Draggable state */
    .draggable-item.dragging,
    tr.dragging {
        opacity: 0.5;
        background: var(--custom-color);
    }

    /* Small reusable custom color utility */
    .custon-color,
    .custom-color,
    .text-icon-welcome,
    .camera-icon {
        color: var(--custom-color);
    }

    /* custom svg color filter kept as-is (size + filter) */
    .custom-svg {
        width: 30px;
        height: 30px;
        filter: brightness(0) saturate(100%) invert(17%) sepia(46%) saturate(5325%) hue-rotate(267deg) brightness(80%) contrast(115%);
    }

    /* Order number badge */
    .order-number {
        position: absolute;
        left: 0;
        top: 8px;
        width: 15px;
        height: 15px;
        border: 3px solid var(--custom-color);
        color: var(--head-color);
        background-color: black;
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .order-number:not(:empty) {
        background-color: var(--custom-color);
    }

    /* Hover effects */
    .hover-effect {
        transition: transform .3s ease, opacity .3s ease;
    }

    .hover-effect:hover {
        opacity: .5;
    }

    /* Template card (kept custom layout only) */
    .template-card {
        position: relative;
        height: 300px;
        overflow: hidden;
        border-radius: 8px;
        transition: box-shadow .3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, .15);
    }

    .template-card:hover {
        box-shadow: 0 16px 32px rgba(0, 0, 0, .3);
    }

    .image-wrapper {
        height: 100%;
        transition: transform .3s ease;
    }

    .template-card:hover .image-wrapper {
        transform: translateY(-40px);
    }

    .template-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .template-title {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, .6);
        text-align: center;
        padding: 10px;
        opacity: 0;
        transition: opacity .3s ease;
    }

    .template-card:hover .template-title {
        opacity: 1;
    }

    /* Transitions for show/hide */
    .template-item {
        transition: opacity .2s ease-in-out;
    }

    .hidden {
        opacity: 0;
        pointer-events: none;
        height: 0;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    /* Custom checkbox (drag handle) */
    .custom-checkbox {
        position: relative;
        padding-left: 30px;
        min-height: 25px;
        cursor: move;
    }

    .visually-hidden {
        position: absolute;
        opacity: 0;
        height: 0;
        width: 0;
    }

    .content-label {
        display: block;
        padding: 5px 0;
    }

    /* Scrollbars (thin, theme-aware) */
    * {
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.3) var(--bs-secondary);
    }

    *::-webkit-scrollbar {
        width: 4px;
    }

    *::-webkit-scrollbar-track {
        background: var(--bs-secondary);
    }

    *::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 5px;
    }

    *::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    /* Nav tabs small tweak */
    .nav-tabs .nav-link {
        cursor: grabbing;
    }

    .nav-tabs .nav-link.active {
        color: var(--custom-color) !important;
        cursor: not-allowed;
    }

    /* Popup modal (custom simple toaster/modal) */
    .popup-modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1055;
        width: 400px;
        background-color: var(--theme-color);
        color: var(--head-color);
        border-radius: 15px;
        text-align: center;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, .2);
    }

    /* Hoverable image zoom */
    .hoverable-image {
        position: relative;
        width: 45px;
        height: 45px;
        object-fit: cover;
        transition: transform .2s ease-in-out, z-index .2s ease-in-out;
        z-index: 1;
    }

    .hoverable-image:hover {
        transform: scale(5.44);
        z-index: 10;
        object-fit: cover;
    }

    /* Small image preview helper */
    .image-preview {
        gap: 10px;
        min-width: fit-content;
    }

    .image-preview img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        aspect-ratio: 1/1;
        flex-shrink: 0;
    }

    /* Modal extra large width override */
    .modal-xl {
        max-width: 90%;
    }

    /* Popup container (tiny dropdown) */
    /* Make popup-container a vertical list and each item a full-width row */
    .popup-container {
        display: none;
        /* kept as before */
        position: absolute;
        top: 100%;
        right: 0;
        width: 160px;
        background-color: var(--cms-popup-container-bg);
        /* border: 1px solid var(--theme-color); */
        padding: .25rem .5rem;
        /* compact padding */
        border-radius: 6px;
        z-index: 1000;
        box-shadow: var(--shadow);
        flex-direction: column;
        gap: 0.25rem;
        /* small gap between rows */
    }

    /* Ensure popup doesn't wrap items into multiple columns */
    .popup-container .text-icon>* {
        flex-shrink: 0;
    }

    /* -------------------------
   Bootstrap-targeted custom properties (minimal overrides)
   Keep only the custom properties that differ from bootstrap defaults
   ------------------------- */

    /* Form controls: only override border color, radius and focus shadow */
    .form-control {
        color: gray;
        border-radius: 5px;
        border: 1px solid var(--dark-color);
        background-clip: padding-box;
        outline: 0;
        border-color: var(--custom-color);
    }

    .form-control:focus {
        border-color: var(--custom-color);
        box-shadow: var(--shadow);
        outline: 0;
    }

    /* Form check (checkbox/radio) */
    .form-check-input:checked {
        background-color: var(--custom-color);
        border-color: var(--custom-color);
    }

    .form-check-input[type="checkbox"]:indeterminate {
        background-color: var(--custom-color);
        border-color: var(--custom-color);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10h8'/%3e%3c/svg%3e");
    }

    /* Range thumbs */
    .form-range::-webkit-slider-thumb {
        background-color: var(--custom-color);
    }

    .form-range::-moz-range-thumb {
        background-color: var(--custom-color);
    }

    /* Buttons: only override colors that must follow selected theme color */
    .btn {
        border-radius: 5px;
        padding: .375rem .75rem;
    }

    .btn-primary {
        color: #FFFFFF;
        background-color: var(--custom-color);
        border-color: var(--faded-color);
    }

    .btn-primary:hover {
        color: var(--theme-color) !important;
        background-color: var(--faded-color);
    }

    .btn-primary.disabled {
        color: var(--head-color);
        background-color: var(--custom-color);
        border-color: var(--custom-color);
    }

    .btn-outline-primary {
        color: var(--custom-color);
        border-color: var(--custom-color);
    }

    .btn-outline-primary:disabled,
    .btn-outline-primary.disabled {
        color: var(--custom-color);
        background-color: transparent;
    }

    /* Small visual tweaks for other Bootstrap helpers */
    .btn-light {
        color: var(--head-color);
        background-color: #6C7293;
        border-color: #6C7293;
    }

    .btn-outline-light:hover {
        color: var(--head-color);
        background-color: #6C7293;
        border-color: #6C7293;
    }

    .btn:hover {
        color: #6C7293;
    }

    /* Links */
    a {
        color: var(--custom-color);
        text-decoration: none;
    }

    a:hover {
        color: var(--faded-color);
    }

    /* Text & utility colors mapped to theme */
    .text-primary {
        color: var(--custom-color) !important;
    }

    .link-primary {
        color: var(--custom-color);
    }

    .border-primary {
        border-color: var(--custom-color) !important;
    }

    .bg-primary {
        background-color: var(--custom-color) !important;
    }

    /* Lightweight list-group & popover color mapping */
    .list-group-item {
        background-color: var(--head-color);
        color: #6C7293;
        border: 1px solid var(--dark-color);
    }

    .popover-body {
        color: #6C7293;
        padding: 1rem;
    }

    .dropdown-menu {
        background-color: var(--head-color);
        color: #6C7293;
        border-radius: 5px;
    }

    /* Accordion minimal override */
    .accordion-button {
        background-color: var(--dark-color);
        color: #6C7293;
        padding: 1rem 1.25rem;
    }

    /* Small misc */
    .link-light,
    .text-body,
    .text-light,
    .border-light {
        color: #6C7293 !important;
    }

    .border-dark {
        border-color: var(--dark-color) !important;
    }

    .border-custom {
        border: 1px solid var(--custom-color);
    }

    /* -------------------------
   Bottom: moved class definitions (defined elsewhere)
   Kept here so you can remove them selectively.
   These are full definitions moved from top — they likely duplicate other files.
   Delete any block below when you confirm it's defined elsewhere.
   ------------------------- */

    < !-- moved-start -->

    /* moved: full definitions for selective removal */
    .box-shadow\\ {
        box-shadow: var(--shadow);
    }

    .selected-item\\input.main-template-radio:checked {
        outline: 2px solid var(--custom-color);
        outline-offset: 3px;
    }

    .hover-dropdown--moved:hover {
        background-color: #3e5cdf;
        color: #FFF;
    }

    .draggable-item--moved.dragging {
        opacity: 0.5;
        background: var(--custom-color);
    }

    .custom-svg {
        width: 30px;
        height: 30px;
        filter: brightness(0) saturate(100%) invert(17%) sepia(46%) saturate(5325%) hue-rotate(267deg) brightness(80%) contrast(115%);
    }

    .custon-color {
        color: var(--custom-color);
    }

    tr.dragging {
        opacity: 0.5;
        background: var(--custom-color);
    }

    tr.drop-area {
        border-top: 2px solid #fff;
    }

    .order-number {
        position: absolute;
        left: 0;
        top: 8px;
        width: 15px;
        height: 15px;
        border: 3px solid var(--custom-color);
        color: white;
        background-color: black;
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .hover-effect {
        transition: transform .3s ease, opacity .3s ease;
    }

    .hover-effect--moved:hover {
        opacity: .5;
    }

    .modal-xl {
        max-width: 90%;
    }

    .border-custom {
        border: 1px solid var(--custom-color);
    }

    .template-card {
        position: relative;
        height: 300px;
        overflow: hidden;
        border-radius: 8px;
        transition: box-shadow .3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, .15);
    }

    .template-card--moved:hover {
        box-shadow: 0 16px 32px rgba(0, 0, 0, .3);
    }

    .image-wrapper {
        height: 100%;
        transition: transform .3s ease;
    }

    .template-card--moved:hover .image-wrapper {
        transform: translateY(-40px);
    }

    .template-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .template-title {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, .6);
        text-align: center;
        padding: 10px;
        opacity: 0;
        transition: opacity .3s ease;
    }

    .template-card--moved:hover .template-title {
        opacity: 1;
    }

    .custom-color {
        color: var(--custom-color);
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }

    .template-item {
        transition: opacity .2s ease-in-out;
    }

    .hidden {
        opacity: 0;
        pointer-events: none;
        height: 0;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    .custom-checkbox {
        cursor: move;
        position: relative;
        padding-left: 30px;
        min-height: 25px;
        cursor: pointer;
    }

    .visually-hidden {
        position: absolute;
        opacity: 0;
        height: 0;
        width: 0;
    }

    .content-label {
        display: block;
        padding: 5px 0;
    }

    .scrollable-card {
        max-height: 300px;
        overflow-y: auto;
    }

    /* Scrollbar moved */
    .scrollbar-moved * {
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.3) var(--bs-secondary);
    }

    /* Nav tabs moved */
    .nav-tabs.nav-link {
        cursor: grabbing;
    }

    .nav-tabs.nav-link.active {
        color: var(--custom-color) !important;
        cursor: not-allowed;
    }

    .camera-icon {
        font-size: 14px;
        color: var(--custom-color);
    }

    .popup-modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1055;
        width: 400px;
        background-color: var(--theme-color);
        color: var(--head-color);
        border-radius: 15px;
        text-align: center;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, .2);
    }

    .hoverable-image {
        position: relative;
        width: 45px;
        height: 45px;
        object-fit: cover;
        transition: transform .2s ease-in-out, z-index .2s ease-in-out;
        z-index: 1;
    }

    .hoverable-image--moved:hover {
        transform: scale(5.44);
        z-index: 10;
        object-fit: cover;
    }

    .text-icon {
        color: var(--custom-color);
    }

    .text-icon-welcome {
        color: var(--custom-color);
    }

    .form-control:focus {
        border-color: var(--custom-color);
        box-shadow: var(--shadow);
    }

    /* button moved */
    .btn {
        display: inline-block;
        font-weight: 400;
        line-height: 1.5;
        color: #6C7293;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        border-radius: 5px;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    /* dropdown moved */
    .dropdown-menu {
        position: absolute;
        z-index: 1000;
        display: none;
        min-width: 10rem;
        padding: .5rem 0;
        margin: 0;
        font-size: 1rem;
        color: #6C7293;
        text-align: left;
        list-style: none;
        background-color: var(--head-color);
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .15);
        border-radius: 5px;
    }

    /* accordion moved */
    .accordion-button {
        background-color: var(--dark-color);
        color: #6C7293;
    }

    /* list group moved */
    .list-group-item {
        position: relative;
        display: block;
        padding: .5rem 1rem;
        color: #6C7293;
        background-color: var(--head-color);
        border: 1px solid var(--dark-color);
    }

    /* popover moved */
    .popover-body {
        padding: 1rem 1rem;
        color: #6C7293;
    }

    /* link moved */
    .link-light {
        color: #6C7293;
    }

    /* border moved */
    .border-light {
        border-color: #6C7293 !important;
    }

    .border-dark {
        border-color: var(--dark-color) !important;
    }

    /* text moved */
    .text-body {
        color: #6C7293 !important;
    }

    .text-light {
        color: #6C7293 !important;
    }

    .bg-light {
        background-color: #6C7293 !important;
    }

    .list-group-item-action--moved:active {
        color: #6C7293;
        background-color: #e9ecef;
    }

    /* anchor moved */
    a {
        color: var(--custom-color);
        text-decoration: none;
    }

    a--moved:hover {
        color: var(--faded-color);
    }

    /* form-check moved */
    .form-check-input--moved:checked {
        background-color: var(--custom-color);
        border-color: var(--custom-color);
    }

    /* range moved */
    .form-range--moved::-webkit-slider-thumb {
        background-color: var(--custom-color);
    }

    .form-range--moved::-moz-range-thumb {
        background-color: var(--custom-color);
    }

    /* buttons moved */
    .btn-primary {
        color: #FFFFFF;
        background-color: var(--custom-color);
        border-color: var(--faded-color);
    }

    .btn-primary--moved.disabled {
        color: var(--head-color);
        background-color: var(--custom-color);
        border-color: var(--custom-color);
    }

    .btn-outline-primary {
        color: var(--custom-color);
        border-color: var(--custom-color);
    }

    .btn-outline-primary--moved:disabled,
    .btn-outline-primary--moved.disabled {
        color: var(--custom-color);
        background-color: transparent;
    }

    .nav-link.dropdown-toggle.show {
        color: var(--custom-color) !important;
    }

    /* link-primary moved */
    .link-primary {
        color: var(--custom-color);
    }

    /* border-primary moved */
    .border-primary {
        border-color: var(--custom-color) !important;
    }

    /* text-primary moved */
    .text-primary {
        color: var(--custom-color) !important;
    }

    /* bg-primary moved */
    .bg-primary {
        background-color: var(--custom-color) !important;
    }


    /* danger button moved */
    .btn-danger {
        color: white;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        color: rgb(146, 146, 146);
        background-color: #bb2d3b;
        border-color: #b02a37;
    }
</style>
