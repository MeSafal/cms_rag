@foreach ($items as $item)
    <tr data-id="{{ $item->sliders_id }}" data-order="{{ $item->display_order }}">
        <th scope="row" class="{{ auth()->user()->can('sliders.updateOrder') ? 'move-up-icon' : '' }}">
            {{ $loop->index + 1 }}</th>
        <td>{{ Str::limit($item->title, 20) }}</td>
        <td>
            <span class="{{ auth()->user()->can('sliders.alias') ? 'alias-text' : '' }}" data-id="{{ $item->sliders_id }}"
                style="cursor: {{ auth()->user()->can('sliders.alias') ? 'pointer' : 'default' }};">
                {{ Str::limit($item->alias, 10) }}
            </span>
            <input type="text" class="alias-input d-none form-control" data-id="{{ $item->sliders_id }}"
                value="{{ $item->alias }}" style="width: 150px;">
        </td>
        <td>{{ Str::limit($item->template->title == 'partials.slider' ? 'Default' : $item->template->title, 20) }}</td>
        <td>
            @foreach (explode(',', $item->cover) as $coverImage)
                <img src="{{ asset(trim($coverImage)) }}" alt="{{ Str::limit($item->title, 10) }}"
                    class="hoverable-image" style="width: 45px; height: 45px; object-fit: cover;">
            @endforeach
        </td>
        @can('sliders.publish')
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input page-toggle" type="checkbox" data-page-id="{{ $item->sliders_id }}"
                        data-url="{{ route('sliders.publish', ['id' => $item->sliders_id, 'publish' => $item->status == 1 ? -1 : 1]) }}"
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
        @canany(['sliders.view', 'sliders.edit', 'sliders.publish', 'sliders.delete'])
            <td class="icon-wrapper">
                <div class="toggle-icons" title="Options">
                    <i style="font-size: 20px;" class="fa fa-ellipsis-h"></i>
                </div>
                <div class="popup-container">
                    @can('sliders.view')
                        <a href="{{ route('sliders.view', ['id' => $item->sliders_id]) }}" class="text-icon" title="View">
                            <i style="font-size: 20px; padding-right: 10px;" class="fa fa-eye"></i> View
                        </a>
                    @endcan
                    @can('sliders.edit')
                        <a href="{{ route('sliders.edit', ['id' => $item->sliders_id]) }}" class="text-icon" title="Edit">
                            <i style="font-size: 20px; padding-right: 10px;" class="fa fa-edit"></i> Edit
                        </a>
                    @endcan
                    @can('sliders.delete')
                        <a href="#" class="text-icon delete-btn" data-action="delete"
                            data-url="{{ route('sliders.delete', ['id' => $item->sliders_id]) }}" title="Delete">
                            <i style="font-size: 20px; padding-right: 10px;" class="fa fa-trash"></i> Delete
                        </a>
                    @endcan
                    @can('sliders.publish')
                        @if ($item->status == 1)
                            <a href="#" class="text-icon publish-btn" data-action="unpublish"
                                data-url="{{ route('sliders.publish', ['id' => $item->sliders_id, 'publish' => -1]) }}"
                                title="Unpublish">
                                <i class="fa fa-ban" style="font-size: 20px; padding-right: 10px;"></i>
                                Unpublish
                            </a>
                        @else
                            <a href="#" class="text-icon publish-btn" data-action="publish"
                                data-url="{{ route('sliders.publish', ['id' => $item->sliders_id, 'publish' => 1]) }}"
                                title="Publish">
                                <i class="fa fa-check" style="font-size: 20px; padding-right: 10px;"></i>
                                Publish
                            </a>
                        @endif
                    @endcan
                </div>
            </td>
        @endcanany
    </tr>
@endforeach
