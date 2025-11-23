 @foreach ($items as $item)
                                        <tr data-id="{{ $item->testimonials_id }}" data-order="{{ $item->display_order }}">
                                            <th scope="row"
                                                class="{{ auth()->user()->can('testimonials.updateOrder') ? 'move-up-icon' : '' }}">
                                                {{ $loop->index + 1 }}</th>
                                            <td>{{ Str::limit($item->name, 50) }}</td>
                                            <td>
                                                 @if ($item->thumb)
                                                    @foreach (explode(',', $item->thumb) as $coverImage)
                                                        <img src="{{ asset(trim($coverImage)) }}"
                                                            alt="{{ Str::limit($item->title, 10) }}"
                                                            class="hoverable-image"
                                                            style="width: 45px; height: 45px; object-fit: cover;">
                                                    @endforeach
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                           @can('testimonials.publish')
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input page-toggle" type="checkbox"
                                                            data-page-id="{{ $item->testimonials_id }}"
                                                            data-url-template="{{ route('testimonials.publish', ['id' => $item->testimonials_id, 'publish' => ':publish']) }}"
                                                            {{ $item->status == 1 ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                            @else
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                            @endcan
                                            @canany(['testimonials.view', 'testimonials.edit', 'testimonials.publish',
                                                'testimonials.delete'])
                                                <td class="icon-wrapper">
                                                    <div class="toggle-icons" title="Options">
                                                        <i style="font-size: 20px;" class="fa fa-ellipsis-h"></i>
                                                    </div>
                                                    <div class="popup-container">
                                                        @can('testimonials.view')
                                                            <a href="{{ route('testimonials.view', ['id' => $item->testimonials_id]) }}"
                                                                class="text-icon" title="View">
                                                                <i style="font-size: 20px; padding-right: 10px;"
                                                                    class="fa fa-eye"></i> View
                                                            </a>
                                                        @endcan
                                                        @can('testimonials.edit')
                                                            <a href="{{ route('testimonials.edit', ['id' => $item->testimonials_id]) }}"
                                                                class="text-icon" title="Edit">
                                                                <i style="font-size: 20px; padding-right: 10px;"
                                                                    class="fa fa-edit"></i> Edit
                                                            </a>
                                                        @endcan
                                                        @can('testimonials.delete')
                                                            <a href="#" class="text-icon delete-btn"
                                                                data-action="delete"
                                                                data-url="{{ route('testimonials.delete', ['id' => $item->testimonials_id]) }}"
                                                                title="Delete">
                                                                <i style="font-size: 20px; padding-right: 10px;"
                                                                    class="fa fa-trash"></i> Delete
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
