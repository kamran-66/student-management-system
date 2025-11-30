<div class="p-4 bg-white rounded-lg shadow">
  <p class="text-sm text-gray-500">{{ $label }}</p>
  <p class="mt-2 text-2xl font-semibold text-gray-800">{{ $value }}</p>
  @if($slot) <div class="mt-2 text-sm text-green-600">{{ $slot }}</div> @endif
</div>
