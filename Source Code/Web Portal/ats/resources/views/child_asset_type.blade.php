
@foreach($childs as $child)

 <option value='{{$child->at_asset_type_id}}'>{{$parent_name."->".$child->at_asset_type_name}}</option>
	@if(count($child->childs))
            @include('child_asset_type',['childs' => $child->childs,'parent_name'=>$parent_name."->".$child->at_asset_type_name])
        @endif

@endforeach
