@extends('backend.layout.app')
@section('mainSection')<form
                action="{{ isset($item) ? route('sliders.update', $item->sliders_id) : route('sliders.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-4">
                            <div class=" rounded h-100 p-4">
                                <h6 class="mb-4">{{ isset($item) ? 'Edit Slider ' . $item->title : 'Create Sliders' }}
                                </h6>

                                <div class="row">
                                    {!! CreateText(
                                        'title',
                                        old('title', isset($item) ? $item->title : ''),
                                        'Title',
                                        [
                                            'aria-describedby' => 'titleHelp',
                                            'required' => 'required',
                                            'autofocus' => 'autofocus',
                                        ],
                                        '12',
                                    ) !!}
                                    {!! CreateText(
                                        'subtitle',
                                        old('subtitle', isset($item) ? $item->subtitle : ''),
                                        'Subtitle',
                                        [
                                            'aria-describedby' => 'subtitleHelp',
                                        ],
                                        12,
                                    ) !!}

                                </div>
                                <br>
                                {!! CreateTextArea(
                                    'remarks',
                                    old('remarks', isset($item) ? $item->remarks : ''),
                                    'Remarks',
                                    ['placeholder' => 'Leave a comment here'],
                                    'Remarks',
                                ) !!}

                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-4">

                        <x-templates :location="$location" :templateOptions="$templateOptions"/>
                        </div>
                        <div class="col-sm-12 col-xl-4">

                            <div style="color: :white;" class=" rounded h-40 p-4">
                                <h6 class="mb-4">Images</h6>
                                <label for="subticovertle" class="form-label">Image</label>
                                {!! CreateImage('cover', 'Image', 'cover', 'holder', old('cover', isset($item) ? $item->cover : '')) !!}
                            </div>
                            <div class=" rounded h-80 p-4">
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
                                {!! CreateButton('link', 'Cancel', route('sliders.index'), ['class' => 'btn btn-danger']) !!}
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-12">
                            <div class=" rounded h-100 p-4">
                                <h6 class="mb-4">SEO</h6>
                                <div class="row">

                                    {!! CreateText('seo_title', old('seo_title', isset($item) ? $item->seo_title : ''), 'Seo Title', [
                                        'aria-describedby' => 'seotitleHelp',
                                    ]) !!}

                                    {!! CreateText('seo_keyword', old('seo_keyword', isset($item) ? $item->seo_keyword : ''), 'Seo Keyword', [
                                        'aria-describedby' => 'seotitleHelp',
                                    ]) !!}

                                </div>
                                <br>
                                {!! CreateTextArea(
                                    'seo_descripton',
                                    isset($item) ? $item->remarks : '',
                                    'Seo Description',
                                    ['placeholder' => 'Write a Description'],
                                    'Seo Description',
                                ) !!}

                            </div>
                        </div>
                    </div>
                </div>
            </form>
@endsection
