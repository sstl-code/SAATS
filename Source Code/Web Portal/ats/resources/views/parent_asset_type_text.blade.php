<?php $arrParent=""; $i=0;?>
@foreach($parents as $parent)
      
     <?php   $arrParent=trim($parent->at_asset_type_name);?>
	    @if(count($parent->parents))
              <?php   $arrParent='->'.trim($parent->at_asset_type_name);?>
            @include('parent_asset_type_text',['parents' => $parent->parents,'parent_name'=>"->".$parent->at_asset_type_name])
        @endif
@endforeach
{{ trim($arrParent) }}