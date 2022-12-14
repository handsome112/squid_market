@foreach($subcategories as $subcategory)
	<div class="subcategory-link">
		@if($subcategory->isParent())
		<details @browsing($subcategory) open @endif>
			<summary>
				<a href="{{ route('category', ['slug' => $subcategory->slug]) }}">{{ $subcategory->name }}</a><span class="footnote"> {{ $subcategory->totalProducts() }}</span>
			</summary>
			@include('includes.components.subcategories', ['subcategories' => $subcategory->subcategories])
		</details>
		@else
                <a href="{{ route('category', ['slug' => $subcategory->slug]) }}" class="list-group-item category align-items-center rounded-0 list-group-item-action d-flex justify-content-between" >{{ $subcategory->name }}</a>
		@endif
	</div>
@endforeach
