@foreach ($items as $item)
    <tr data-id="{{ $item->countries_id }}" data-order="{{ $item->display_order }}">
        <th scope="row"
            class="{{ auth()->user()->can('countries.updateOrder') ? 'move-up-icon' : '' }}">
            {{ $loop->index + 1 }}</th>
        <td>{{ Str::limit($item->title, 20) }}</td>
        <td>
            <span
                class="{{ auth()->user()->can('countries.alias') ? 'alias-text' : '' }}"
                data-id="{{ $item->countries_id }}"
                style="cursor: {{ auth()->user()->can('countries.alias') ? 'pointer' : 'default' }};">
                {{ Str::limit($item->alias, 10) }}
            </span>
            <input type="text" class="alias-input d-none form-control"
                data-id="{{ $item->countries_id }}" value="{{ $item->alias }}"
                style="width: 150px;">
        </td>
        <td>
            <img src="{{ asset($item->cover) }}"
                alt="{{ Str::limit($item->title, 10) }}" class="hoverable-image"
                style="width: 45px; height: 45px; object-fit: cover;">
        </td>

        @can('countries.publish')
        <td>
            <div class="form-check form-switch">
                <input class="form-check-input page-toggle" type="checkbox"
                    data-page-id="{{ $item->countries_id }}"
                    data-url="{{ route('countries.publish', ['id' => $item->countries_id, 'publish' => $item->status == 1 ? -1 : 1]) }}"
                    {{ $item->status == 1 ? 'checked' : '' }}>
            </div>
        </td>
    @else
        <td>
            @if ($page->status == 1)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Inactive</span>
            @endif
        </td>
    @endcan
        @canany(['countries.view', 'countries.edit', 'countries.publish', 'countries.delete'])
            <td class="icon-wrapper">
                <div class="toggle-icons" title="Options">
                    <i style="font-size: 20px;" class="fa fa-ellipsis-h"></i>
                </div>
                <div class="popup-container">
                    @can('countries.view')
                        <a href="{{ route('countries.view', ['id' => $item->countries_id]) }}"
                            class="text-icon" title="View">
                            <i style="font-size: 20px; padding-right: 10px;"
                                class="fa fa-eye"></i> View
                        </a>
                    @endcan
                    @can('countries.edit')
                        <a href="{{ route('countries.edit', ['id' => $item->countries_id]) }}"
                            class="text-icon" title="Edit">
                            <i style="font-size: 20px; padding-right: 10px;"
                                class="fa fa-edit"></i> Edit
                        </a>
                    @endcan
                    @can('countries.delete')
                        <a href="#" class="text-icon delete-btn"
                            data-action="delete"
                            data-url="{{ route('countries.delete', ['id' => $item->countries_id]) }}"
                            title="Delete">
                            <i style="font-size: 20px; padding-right: 10px;"
                                class="fa fa-trash"></i> Delete
                        </a>
                    @endcan
                    @can('countries.publish')
                        @if ($item->status == 1)
                            <a href="#" class="text-icon publish-btn"
                                data-action="unpublish"
                                data-url="{{ route('countries.publish', ['id' => $item->countries_id, 'publish' => -1]) }}"
                                title="Unpublish">
                                <i class="fa fa-ban"
                                    style="font-size: 20px; padding-right: 10px;"></i>
                                Unpublish
                            </a>
                        @else
                            <a href="#" class="text-icon publish-btn"
                                data-action="publish"
                                data-url="{{ route('countries.publish', ['id' => $item->countries_id, 'publish' => 1]) }}"
                                title="Publish">
                                <i class="fa fa-check"
                                    style="font-size: 20px; padding-right: 10px;"></i>
                                Publish
                            </a>
                        @endif
                    @endcan
                </div>
            </td>
        @endcanany
    </tr>
@endforeach
