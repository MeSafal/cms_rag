<?php

use App\Models\Button;
use App\Models\Label;
use App\Models\Mapper;
use App\Models\Template;

if (!function_exists('label')) {
    /**
     * Process and store a label string in the database.
     *
     * @param string $value The label string to process
     * @return string The processed label string
     */
    function label($value)
    {
        $existingLabel = Label::where('en', $value)->first();

        if (!$existingLabel) {
            Label::create([
                'en' => $value,
                'status' => 1,
                'createdby' => auth()->user()->name ?? 'System',
            ]);
        }

        return $value;
    }
}
if (!function_exists('templateOptions')) {
    /**
     * Get active templates with parent status set to 1.
     *
     * @return array
     */
    function templateOptions()
    {
        return Template::activeStatus()
            ->parentOne()
            ->pluck('title', 'templates_id')
            ->toArray();
    }
}

if (!function_exists('frontendPath')) {
    /**
     * Get the frontend path from the environment variables.
     *
     * @return string
     */
    function frontendPath()
    {
        return 'frontend.' . env('FRONTEND_PATH', 'resturant');
    }
}
if (!function_exists('favicon')) {
    /**
     * Get the favicon URL.
     *
     * @return string
     */
    function favicon()
    {
        // If an environment variable FAVICON is set, use that, otherwise default to 'img/favicon.ico'
        return asset(env('FAVICON', 'img/favicon.ico'));
    }
}

if (!function_exists('appName')) {
    /**
     * Get the frontend path from the environment variables.
     *
     * @return string
     */
    function appName()
    {
        return env('App_name');// Default to favidon if the env is not set
    }
}

if (!function_exists('splitTitle')) {
    /**
     * Split a string into N parts (as evenly as possible) by words.
     *
     * @param string $title
     * @param int $parts
     * @return array
     */
    function splitTitle(string $title, int $parts): array
    {
        $words = explode(' ', $title);
        $count = count($words);

        // Protect against zero or negative parts
        $parts = max(1, $parts);

        // Calculate base part size
        $basePartSize = floor($count / $parts);
        $remainder = $count % $parts;

        $result = [];
        $start = 0;

        for ($i = 0; $i < $parts; $i++) {
            // Distribute the remainder one by one
            $currentPartSize = $basePartSize + ($i < $remainder ? 1 : 0);

            $partWords = array_slice($words, $start, $currentPartSize);
            $result[] = implode(' ', $partWords);

            $start += $currentPartSize;
        }

        return $result;
    }
}

// in helpers.php

if (!function_exists('dynamicRoute')) {
    /**
     * @param  mixed  $item
     * @param  string $defaultTarget
     * @param  string $defaultTitle
     * @return array{url:string, target:string, title:string}
     */
    function dynamicRoute($item, string $defaultTarget = '_self', string $defaultTitle = 'View Detail'): array
    {
        $alias = $item->alias;
        $button = $item->buttons->first();

        // URL
        if ($button?->destination_to === 'custom') {
            $url = $button->url;
        } else {
            $title = class_basename($item);
            $tableAlias = Mapper::where('status', 1)
                ->where('title', $title)
                ->value('alias');
            $templatePath = $button
                ? getUrl($button->buttons_id)
                : null;
            $path = ($templatePath ? $templatePath . '/' : '') . $tableAlias . '/' . $alias;
            $url = route('content.dynamic', ['path' => $path]);
        }

        // Target & Title
        $target = $button->target ?? $defaultTarget;
        $titleText = $button->title ?? $defaultTitle;

        return [
            'url' => $url,
            'target' => $target,
            'title' => $titleText,
        ];
    }
}


if (!function_exists('CreateText')) {
    /**
     * Generate a text input field using the label function.
     *
     * @param string $name
     * @param string $value
     * @param string|null $labelText
     * @param array $attributes
     * @return string
     */
    function CreateText($name, $value = '', $labelText = null, $attributes = [], $length = '6')
    {
        $labelHtml = $labelText ? '<label for="' . htmlspecialchars($name, ENT_QUOTES) . '" class="form-label">' . label($labelText) . '</label>' : '';

        // Check if static display is requested
        if (isset($attributes['static']) && $attributes['static']) {
            unset($attributes['static']);
            return '<div class="col-md-' . $length . '">' .
                $labelHtml .
                '<div class="form-control-static">' . htmlspecialchars($value, ENT_QUOTES) . '</div>' .
                '</div>';
        }

        // Default input handling
        $defaultAttributes = [
            'type' => 'text',
            'class' => 'form-control',
            'id' => $name,
            'name' => $name,
            'value' => $value,
        ];

        $mergedAttributes = array_merge($defaultAttributes, $attributes);
        $attributesString = '';

        foreach ($mergedAttributes as $key => $val) {
            $attributesString .= ' ' . $key . '="' . htmlspecialchars($val, ENT_QUOTES) . '"';
        }

        return '<div class="col-md-' . $length . '">' .
            $labelHtml .
            '<input ' . $attributesString . '>' .
            '</div>';
    }
}

if (!function_exists('CreateDropdown')) {
    /**
     * Generate a text input field using the label function.
     *
     * @param string $name
     * @param string $value
     * @param string|null $labelText
     * @param array $attributes
     * @return string
     */
    function CreateDropdown($name, $options = [], $labelText = null, $attributes = [], $length = '6', $enableSearch = false)
    {
        $labelHtml = $labelText ? '<label for="' . htmlspecialchars($name, ENT_QUOTES) . '" class="form-label">' . $labelText . '</label>' : '';

        $defaultAttributes = [
            'class' => 'form-select col-md-12',
            'id' => $name,
            'name' => $name,
        ];

        $mergedAttributes = array_merge($defaultAttributes, $attributes);
        $selectedValue = $mergedAttributes['value'] ?? null;
        if (isset($mergedAttributes['value']))
            unset($mergedAttributes['value']);

        $attributesString = '';
        foreach ($mergedAttributes as $key => $val) {
            $attributesString .= ' ' . $key . '="' . htmlspecialchars($val, ENT_QUOTES) . '"';
        }

        $optionsHtml = '';
        foreach ($options as $optionValue => $optionText) {
            $isSelected = ($optionValue == $selectedValue) ? ' selected' : '';
            $optionsHtml .= '<option class="hover-dropdown" value="' . htmlspecialchars($optionValue, ENT_QUOTES) . '"' . $isSelected . '>' . htmlspecialchars($optionText, ENT_QUOTES) . '</option>';
        }

        $searchHtml = '';
        if ($enableSearch) {
            $searchHtml = <<<HTML
        <div class="custom-dropdown-wrapper">
            <div class="dropdown-search-container form-select p-0 border-0 dropdown-hover"
                style="display: none; position: absolute; width: 100%; z-index: 1000; box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);">
                <input type="text" class="form-control rounded-top border-bottom" placeholder="Search...">
                <div class="dropdown-options-list" style="max-height: 200px; overflow-y: auto;"></div>
            </div>
        </div>
        <script>
            (function() {
                const originalSelect = document.getElementById('{$name}');
                const wrapper = originalSelect.parentElement;
                const customDropdown = wrapper.querySelector('.dropdown-search-container');
                const optionsList = wrapper.querySelector('.dropdown-options-list');
                const searchInput = wrapper.querySelector('input');

                // Create visible trigger
                const visibleTrigger = document.createElement('div');
                visibleTrigger.className = 'form-select';
                visibleTrigger.style.cursor = 'pointer';
                visibleTrigger.innerHTML = originalSelect.options[originalSelect.selectedIndex]?.text || 'Select...';

                // Replace original select
                wrapper.insertBefore(visibleTrigger, originalSelect);
                originalSelect.style.display = 'none';

                // Clone options with original styling
                const originalOptions = Array.from(originalSelect.options).map(option => ({
                    value: option.value,
                    text: option.text,
                    selected: option.selected
                }));

                // Toggle dropdown with animation
                visibleTrigger.addEventListener('click', function(e) {
                    customDropdown.style.display = 'block';
                    setTimeout(() => {
                        customDropdown.classList.add('show');
                        searchInput.focus();
                    }, 10);
                    e.preventDefault();
                });

                // Filter options with hover states
                function populateOptions(filter = '') {
                    optionsList.innerHTML = originalOptions
                        .filter(opt => opt.text.toLowerCase().includes(filter.toLowerCase()))
                        .map(opt => `
                            <div class="dropdown-option form-select py-2 border-0 rounded-0 hover-dropdown"
                                 data-value="\${opt.value}"
                                 style="cursor: pointer; transition: background-color 0.15s ease-in-out;
                                        \${opt.value == originalSelect.value ? 'background-color: var(--bs-primary-bg-subtle)' : ''}">
                                \${opt.text}
                            </div>
                        `).join('');
                }

                // Initial setup
                populateOptions();

                // Handle search input
                searchInput.addEventListener('input', function(e) {
                    populateOptions(e.target.value);
                });

                // Handle option selection
                optionsList.addEventListener('click', function(e) {
                    const option = e.target.closest('.dropdown-option');
                    if (option) {
                        originalSelect.value = option.dataset.value;
                        visibleTrigger.innerHTML = option.textContent;
                        customDropdown.classList.remove('show');
                        setTimeout(() => {
                            customDropdown.style.display = 'none';
                            populateOptions(); // Update highlighted selection
                        }, 150);
                        originalSelect.dispatchEvent(new Event('change'));
                    }
                });

                // Close dropdown smoothly
                document.addEventListener('click', function(e) {
                    if (!wrapper.contains(e.target)) {
                        customDropdown.classList.remove('show');
                        setTimeout(() => customDropdown.style.display = 'none', 150);
                    }
                });
            })();
        </script>
        HTML;
        }

        return
            '<div class="col-md-' . htmlspecialchars($length, ENT_QUOTES) . ' position-relative">' .
            $labelHtml .
            '<select' . $attributesString . '>' .
            $optionsHtml .
            '</select>' .
            $searchHtml .
            '</div>';
    }
}

if (!function_exists('CreateTextArea')) {
    /**
     * Generate a textarea input field.
     *
     * @param string $name The name and ID of the textarea field.
     * @param string $value The default value for the textarea.
     * @param string|null $labelText The label text for the textarea.
     * @param array $attributes Additional attributes for the textarea.
     * @param string|null $floatingLabel Optional floating label text.
     * @return string
     */
    function CreateTextArea($name, $value = '', $labelText = null, $attributes = [], $floatingLabel = null)
    {
        // Use label function for main label
        $labelHtml = $labelText ? '<label class="form-label">' . label($labelText) . '</label>' : '';

        // Default attributes
        $defaultAttributes = [
            'class' => 'form-control',
            'name' => $name,
            'id' => $name,
            'style' => 'height: 150px;',
            'placeholder' => 'Enter text here',
        ];

        // Merge default attributes with provided attributes
        $mergedAttributes = array_merge($defaultAttributes, $attributes);

        // Build attributes string
        $attributesString = '';
        foreach ($mergedAttributes as $key => $val) {
            $attributesString .= ' ' . $key . '="' . htmlspecialchars($val, ENT_QUOTES) . '"';
        }

        // Floating label if provided
        $floatingLabelHtml = $floatingLabel ? '<label for="' . htmlspecialchars($name, ENT_QUOTES) . '">' . label($floatingLabel) . '</label>' : '';

        // Return the rendered HTML
        return
            '<div class="col-md-12">' .
            $labelHtml .
            '<div class="form-floating">' .
            '<textarea' . $attributesString . '>' . htmlspecialchars($value, ENT_QUOTES) . '</textarea>' .
            $floatingLabelHtml .
            '</div>' .
            '</div>';
    }
}

if (!function_exists('CreateEditorInput')) {
    /**
     * Generate a CKEditor textarea field.
     *
     * @param string $name The name of the textarea field.
     * @param string $value The default value for the textarea.
     * @param string|null $labelText The label text for the textarea.
     * @param string $id The unique ID for the CKEditor instance.
     * @param array $attributes Additional attributes for the textarea.
     * @return string
     */
    function CreateEditorInput($name, $value = '', $labelText = null, $id = 'ce1', $attributes = [])
    {
        // Use label function for the label
        $labelHtml = $labelText ? '<label for="' . htmlspecialchars($id, ENT_QUOTES) . '" class="form-label">' . label($labelText) . '</label>' : '';

        // Default attributes for CKEditor
        $defaultAttributes = [
            'class' => 'form-control ckeditor-classic',
            'name' => $name,
            'id' => $id,
        ];

        // Merge default attributes with provided attributes
        $mergedAttributes = array_merge($defaultAttributes, $attributes);

        $attributesString = '';
        foreach ($mergedAttributes as $key => $val) {
            $attributesString .= ' ' . $key . '="' . htmlspecialchars($val, ENT_QUOTES) . '"';
        }
        return
            '<div class="col-md-12">' .
            $labelHtml .
            '<textarea' . $attributesString . '>' . htmlspecialchars($value, ENT_QUOTES) . '</textarea>' .
            '<br>' .
            '</div>';
    }
}

if (!function_exists('CreateButton')) {
    /**
     * Generate a button or anchor element dynamically.
     *
     * @param string $type The type of the element: 'submit' or 'link'.
     * @param string|null $label The label text for the button/anchor.
     * @param string|null $url The URL for the anchor tag (only for type 'link').
     * @param array $attributes Additional attributes for the element.
     * @return string
     */
    function CreateButton($type, $label = null, $url = null, $attributes = [])
    {
        // Default classes for buttons
        $defaultAttributes = [
            'class' => 'btn btn-primary',
        ];

        // Merge default attributes with provided attributes
        $mergedAttributes = array_merge($defaultAttributes, $attributes);

        // Build attributes string
        $attributesString = '';
        foreach ($mergedAttributes as $key => $val) {
            $attributesString .= ' ' . $key . '="' . htmlspecialchars($val, ENT_QUOTES) . '"';
        }

        // Generate the element
        if ($type === 'submit') {
            return '<button type="submit"' . $attributesString . '>' . label($label) . '</button>';
        } elseif ($type === 'link') {
            return '<a href="' . htmlspecialchars($url, ENT_QUOTES) . '"' . $attributesString . '>' . label($label) . '</a>';
        }

        // Return an empty string if type is invalid
        return '';
    }
}

if (!function_exists('CreateImage')) {
    /**
     * Generate an image button for file manager integration.
     *
     * @param string $name The name for the input field.
     * @param string $labelText The label text for the input field.
     * @param string $inputId The ID for the input field (used in JavaScript).
     * @param string $previewId The ID for the preview element.
     * @param string|null $value The initial value for the input field (optional).
     * @return string
     */
    function CreateImage($name, $labelText, $inputId, $previewId, $value = null, $useCustom = false)
    {
        // Generate a unique preview id if needed
        $uniquePreviewId = ($previewId === 'holder') ? $previewId . '-' . $name : $previewId;

        $labelStyle = 'style="color: white;"';
        $labelHtml = $labelText
            ? '<label for="' . htmlspecialchars($inputId, ENT_QUOTES) . '" class="form-label">' . label($labelText) . '</label>'
            : '';
        if ($useCustom) {
            return '<button type="button" class="btn btn-primary" id="openFileManager">
                                        <i class="fas fa-file-image me-1"></i> Browse
                                    </button>';
        }
        return
            '<div class="input-group">' .
            '<span class="input-group-btn">' .
            '<a data-input="' . htmlspecialchars($inputId, ENT_QUOTES) . '" data-preview="' . htmlspecialchars($uniquePreviewId, ENT_QUOTES) . '" class="btn btn-primary lfm-btn">' .
            '<i class="fa fa-picture-o"></i> <span ' . $labelStyle . '>' . label($labelText) . '</span>' .
            '</a>' .
            '</span>' .
            '<input id="' . htmlspecialchars($inputId, ENT_QUOTES) . '" data-preview="' . htmlspecialchars($uniquePreviewId, ENT_QUOTES) . '" class="form-control lfm-input" type="text" name="' . htmlspecialchars($name, ENT_QUOTES) . '" value="' . ($value ? htmlspecialchars($value, ENT_QUOTES) : '') . '">' .
            '</div>' .
            '<div id="' . htmlspecialchars($uniquePreviewId, ENT_QUOTES) . '" class="image-preview-container">' .
            '<div class="image-preview"></div>' .
            '</div>' .
            '<br>';
    }

}

if (!function_exists('createCheckbox')) {
    /**
     * Generate a checkbox with custom checked and unchecked values.
     *
     * @param string $name The name attribute for the checkbox and hidden input
     * @param string $label The label text for the checkbox
     * @param bool $isChecked Whether the checkbox should be checked by default
     * @param string|null $id Optional ID for the checkbox input (default is autogenerated)
     * @param string $checkedValue Value to submit when the checkbox is checked
     * @param string $uncheckedValue Value to submit when the checkbox is unchecked
     * @return string
     */
    function createCheckbox(
        $name,
        $label,
        $isChecked = false,
        $id = null,
        $checkedValue = 'true',
        $uncheckedValue = 'false'
    ) {
        // Generate a unique ID if not provided
        $id = $id ?? uniqid('checkbox_');
        $label = label($label);

        return '
        <input type="hidden" name="' . htmlspecialchars($name, ENT_QUOTES) . '" value="' . htmlspecialchars($uncheckedValue, ENT_QUOTES) . '">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="' . htmlspecialchars($checkedValue, ENT_QUOTES) . '"
                   id="' . htmlspecialchars($id, ENT_QUOTES) . '" name="' . htmlspecialchars($name, ENT_QUOTES) . '"
                   ' . ($isChecked ? 'checked' : '') . '>
            <label class="form-check-label" for="' . htmlspecialchars($id, ENT_QUOTES) . '">
                ' . htmlspecialchars($label, ENT_QUOTES) . '
            </label>
        </div>';
    }
}

if (!function_exists('extractViewName')) {
    /**
     * Extracts the view name from a given file path.
     *
     * @param string $viewPath The file path (relative or absolute) to a blade view.
     * @return string The view name in dot notation, with the frontend path removed.
     */
    function extractViewName($viewPath)
    {
        // Normalize slashes to the system directory separator.
        $normalizedPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $viewPath);

        $viewsFolder = "views" . DIRECTORY_SEPARATOR;
        $pos = strpos($normalizedPath, $viewsFolder);
        if ($pos !== false) {
            $normalizedPath = substr($normalizedPath, $pos + strlen($viewsFolder));
        }
        $normalizedPath = preg_replace('/\.blade\.php$/', '', $normalizedPath);

        $viewDotNotation = str_replace(DIRECTORY_SEPARATOR, '.', $normalizedPath);

        $frontendPrefix = frontendPath();
        if (!empty($frontendPrefix) && strpos($viewDotNotation, $frontendPrefix . '.') === 0) {
            $viewDotNotation = substr($viewDotNotation, strlen($frontendPrefix . '.'));
        }

        return $viewDotNotation;
    }
}

if (!function_exists('CreateTemplateDropdown')) {
    /**
     * Generate a dropdown for template selection with a Preview button and modal.
     *
     * @param string $name Name and id of the dropdown.
     * @param array $options Array of templates, keyed by id. Each value is an array with 'title' and 'image_url'.
     * @param string|null $labelText Label for the dropdown.
     * @param array $attributes Additional attributes for the select element.
     * @param string $length Bootstrap column length (default: 6).
     * @param bool $enableSearch Whether to enable search (not used here but kept for consistency).
     * @return string HTML string.
     */
    function CreateTemplateDropdown($name, $options = [], $labelText = null, $attributes = [], $length = '6', $enableSearch = false)
    {
        // Generate label HTML if provided.
        $labelHtml = $labelText ? '<label for="' . htmlspecialchars($name, ENT_QUOTES) . '" class="form-label">' . $labelText . '</label>' : '';

        // Default attributes for the select element.
        $defaultAttributes = [
            'class' => 'form-select col-md-12',
            'id' => $name,
            'name' => $name,
        ];
        $mergedAttributes = array_merge($defaultAttributes, $attributes);
        $selectedValue = $mergedAttributes['value'] ?? null;
        if (isset($mergedAttributes['value'])) {
            unset($mergedAttributes['value']);
        }

        $attributesString = '';
        foreach ($mergedAttributes as $key => $val) {
            $attributesString .= ' ' . $key . '="' . htmlspecialchars($val, ENT_QUOTES) . '"';
        }

        // Build options HTML.
        $optionsHtml = '';
        foreach ($options as $optionValue => $templateData) {
            $title = $templateData['title'] ?? '';
            // Limit the title to 50 characters (or adjust as needed).
            $displayText = mb_strimwidth($title, 0, 50, '...');
            $isSelected = ($optionValue == $selectedValue) ? ' selected' : '';
            $optionsHtml .= '<option value="' . htmlspecialchars($optionValue, ENT_QUOTES) . '"' . $isSelected . '>' . htmlspecialchars($displayText, ENT_QUOTES) . '</option>';
        }

        // Create the main dropdown container with a Preview Template button.
        $html = '<div class="col-md-' . htmlspecialchars($length, ENT_QUOTES) . ' position-relative">';
        $html .= $labelHtml;
        $html .= '<div class="d-flex align-items-center">';
        $html .= '<select' . $attributesString . '>' . $optionsHtml . '</select>';
        // Add a Preview Template button
        $html .= '<button type="button" class="btn btn-secondary ms-2" id="' . $name . '_previewBtn">Preview Template</button>';
        $html .= '</div>';
        $html .= '</div>';

        // Create the modal HTML for previewing templates.
        $html .= '
        <div class="modal fade" id="' . $name . '_previewModal" tabindex="-1" aria-labelledby="' . $name . '_previewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="' . $name . '_previewModalLabel">Template Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
        ';

        // Loop through each template option to display a card.
        foreach ($options as $optionValue => $templateData) {
            $title = $templateData['title'] ?? '';
            $imageUrl = $templateData['image_url'] ?? '';
            $html .= '<div class="col-md-4 mb-3">
                <div class="card h-100">
                    <img src="' . htmlspecialchars($imageUrl, ENT_QUOTES) . '" class="card-img-top" alt="' . htmlspecialchars($title, ENT_QUOTES) . '">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($title, ENT_QUOTES) . '</h5>
                        <p class="card-text">ID: ' . htmlspecialchars($optionValue, ENT_QUOTES) . '</p>
                    </div>
                </div>
            </div>';
        }

        $html .= '
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        ';

        // Append JavaScript to bind the preview button to open the modal.
        $html .= '
        <script>
            (function() {
                const previewBtn = document.getElementById("' . $name . '_previewBtn");
                const modalElement = document.getElementById("' . $name . '_previewModal");
                if (previewBtn && modalElement) {
                    const previewModal = new bootstrap.Modal(modalElement);
                    previewBtn.addEventListener("click", function() {
                        previewModal.show();
                    });
                }
            })();
        </script>
        ';

        return $html;
    }
}

if (!function_exists('getOrderedSections')) {
    function getOrderedSections(array $staticSections)
    {
        // Retrieve only the title field for active templates matching the static sections,
        // ordered by display_order
        return Template::whereIn('title', $staticSections)
            ->where('status', 1)
            ->orderBy('display_order')
            ->select('title')
            ->get();
    }
}

if (!function_exists('getTables')) {
    function getTables()
    {
        return [
            ['id' => 'articles', 'title' => 'Article'],
            ['id' => 'pages', 'title' => 'Page'],
            ['id' => 'blogs', 'title' => 'Blog'],
            ['id' => 'countries', 'title' => 'Country'],
            ['id' => 'coachings', 'title' => 'Coaching'],
            ['id' => 'testimonials', 'title' => 'Testimonial'],
        ];
    }
}

if (!function_exists('getUrl')) {
    function getUrl($id)
    {
        $button = Button::where('status', '<>', 0)
            ->where('buttons_id', $id)
            ->first();
        if ($button->destination_to === 'custom') {
            return $button->url;
        } else {
            $modelName = ucfirst(Str::singular($button->destination_to)); // e.g., "templates" → "Template"
            $modelClass = "App\\Models\\$modelName";
            if (class_exists($modelClass)) {
                $record = $modelClass::find($button->destination_id);
                if ($modelName != 'Template') {
                    $table = Mapper::where('status', 1)
                        ->where('title', $modelName)
                        ->value('alias');
                    return $table . '/' . $record?->alias;
                }
                return $record?->alias;
            }
        }


        return "javascript:void(0)";

        // return "{$tableName}/{$alias}";
    }
}
