@props(['itemEdit' => null, 'templates'])

{{-- Added hidden inputs expected by the JS (prevent null reads) --}}
@php
    // entries might be stored as JSON-string or as array; normalize to JSON string
    $initialEntriesJson = '';
    if (old('entriesData')) {
        $initialEntriesJson = old('entriesData');
    } elseif (!empty($itemEdit?->entries)) {
        $initialEntriesJson = is_array($itemEdit->entries) ? json_encode($itemEdit->entries) : $itemEdit->entries;
    }
@endphp

<input type="hidden" id="entriesData" value="{{ $initialEntriesJson }}">
<input type="hidden" id="entriesInput" name="entries" value="{{ old('entries', $initialEntriesJson) }}">

<br>
<div class="rounded h-80 p-4">
    <div class="m-n2">
        <button id="addButtonBtn_repeater" class="btn btn-primary w-100 m-2" type="button" data-bs-toggle="modal"
            data-bs-target="#repeaterModal" style="color:white; border-color:transparent;">
            Add Extra Content
        </button>

        <div class="container mt-4">
            <table class="table table-borderless" id="buttonTable_repeater">
                <thead id="entryTableHeader_repeater" class="table-light" style="display:none;">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="entryTableBody_repeater"></tbody>
            </table>
        </div>
    </div>
</div>
<br>

@include('backend.layout.extraContentModel')
