@foreach ($items as $item)
    <tr data-id="{{ $item->articles_id }}" data-order="{{ $item->display_order }}">
        <th scope="row"
            class="{{ auth()->user()->can('articles.updateOrder') ? 'move-up-icon' : '' }}">
            {{ $loop->index + 1 }}</th>
        <td>{{ Str::limit($item->title, 20) }}</td>
        <td>
            <span
                class="{{ auth()->user()->can('articles.alias') ? 'alias-text' : '' }}"
                data-id="{{ $item->articles_id }}"
                style="cursor: {{ auth()->user()->can('articles.alias') ? 'pointer' : 'default' }};">
                {{ Str::limit($item->alias, 10) }}
            </span>
            <input type="text" class="alias-input d-none form-control"
                data-id="{{ $item->articles_id }}" value="{{ $item->alias }}"
                style="width: 150px;">
        </td>
        <td>
            <img src="{{ asset($item->cover) }}"
                alt="{{ Str::limit($item->title, 10) }}" class="hoverable-image"
                style="width: 45px; height: 45px; object-fit: cover;">
        </td>

        @can('articles.publish')
        <td>
            <div class="form-check form-switch">
                <input class="form-check-input page-toggle" type="checkbox"
                    data-page-id="{{ $item->articles_id }}"
                    data-url="{{ route('articles.publish', ['id' => $item->articles_id, 'publish' => $item->status == 1 ? -1 : 1]) }}"
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
        @canany(['articles.view', 'articles.edit', 'articles.publish', 'articles.delete'])
            <td class="icon-wrapper">
                <div class="toggle-icons" title="Options">
                    <i style="font-size: 20px;" class="fa fa-ellipsis-h"></i>
                </div>
                <div class="popup-container">
                    @can('articles.view')
                        <a href="{{ route('articles.view', ['id' => $item->articles_id]) }}"
                            class="text-icon" title="View">
                            <i style="font-size: 20px; padding-right: 10px;"
                                class="fa fa-eye"></i> View
                        </a>
                    @endcan
                    @can('articles.edit')
                        <a href="{{ route('articles.edit', ['id' => $item->articles_id]) }}"
                            class="text-icon" title="Edit">
                            <i style="font-size: 20px; padding-right: 10px;"
                                class="fa fa-edit"></i> Edit
                        </a>
                    @endcan
                    @can('articles.delete')
                        <a href="#" class="text-icon delete-btn"
                            data-action="delete"
                            data-url="{{ route('articles.delete', ['id' => $item->articles_id]) }}"
                            title="Delete">
                            <i style="font-size: 20px; padding-right: 10px;"
                                class="fa fa-trash"></i> Delete
                        </a>
                    @endcan
                    @can('articles.publish')
                        @if ($item->status == 1)
                            <a href="#" class="text-icon publish-btn"
                                data-action="unpublish"
                                data-url="{{ route('articles.publish', ['id' => $item->articles_id, 'publish' => -1]) }}"
                                title="Unpublish">
                                <i class="fa fa-ban"
                                    style="font-size: 20px; padding-right: 10px;"></i>
                                Unpublish
                            </a>
                        @else
                            <a href="#" class="text-icon publish-btn"
                                data-action="publish"
                                data-url="{{ route('articles.publish', ['id' => $item->articles_id, 'publish' => 1]) }}"
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
