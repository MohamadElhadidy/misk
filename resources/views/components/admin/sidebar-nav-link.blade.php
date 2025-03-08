@props(['active' => false])
<li>
<a class="{{$active ? 'text-blue-600 font-semibold bg-gray-200' : 'text-gray-700 hover:bg-gray-200'}}  rounded-md block px-3 py-2"
   aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>{{$slot}}</a>
</li>
