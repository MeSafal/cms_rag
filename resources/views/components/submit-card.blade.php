 <div class="col-sm-12 col-xl-12">
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
         {!! CreateButton('link', 'Cancel', route('countries.index'), ['class' => 'btn btn-danger']) !!}
     </div>
 </div>
