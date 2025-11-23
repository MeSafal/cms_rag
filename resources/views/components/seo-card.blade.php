 <div class="col-sm-12 col-xl-12">
     <div class="rounded h-100 p-4">
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
