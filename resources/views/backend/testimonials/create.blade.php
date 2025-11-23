@extends('backend.layout.app')
@section('mainSection')
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-8">
                        <div class="rounded h-100 p-4">

                            <h5 class="mb-4">
                                @if (isset($item))
                                    Edit testimonial <span class="text-primary">{{ $item->name }}</span>
                                @else
                                    Create testimonial
                                @endif
                            </h5>
                            <form
                                action="{{ isset($item) ? route('testimonials.update', $item->testimonials_id) : route('testimonials.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    {!! CreateText('name', old('name', isset($item) ? $item->name : ''), 'Name', [
                                        'aria-describedby' => 'titleHelp',
                                        'required' => 'required',
                                        'autofocus' => 'autofocus',
                                    ]) !!}
                                    {!! CreateText('position', old('position', isset($item) ? $item->position : ''), 'Position', [
                                        'aria-describedby' => 'subtitleHelp',
                                    ]) !!}

                                </div>
                                <br>
                                <label for="thumb" class="form-label">Thumb Image</label>
                                {!! CreateImage('thumb', 'Thumb', 'thumb', 'holder', old('thumb', isset($item) ? $item->thumb : '')) !!}

                                <br>
                                {!! CreateTextArea(
                                    'description',
                                    old('description', isset($item) ? $item->description : ''),
                                    'Description',
                                    ['placeholder' => 'Leave a comment here'],
                                    'Description',
                                ) !!}

                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-4">
                        <x-templates :location="$location" />
                        <br>
                        <div class="rounded h-80 p-4">

                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Publish</legend>
                            </fieldset>
                            <div class="row mb-3">
                                <div>
                                    <div class="col-sm-10">
                                        {!! createCheckbox('publish', 'Publish', !isset($item) || $item->status == 1 ? true : false) !!}
                                    </div>
                                </div>
                            </div>
                            {!! CreateButton('submit', 'Submit', null, ['class' => 'btn btn-primary']) !!}
                            {!! CreateButton('link', 'Cancel', route('testimonials.index'), ['class' => 'btn btn-danger']) !!}
                        </div>
                    </div>
                    </form>
                </div>
            </div>
@endsection
