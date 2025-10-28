@php
    $features = is_array($getState()) ? collect($getState())->pluck('feature') : collect();
@endphp

@if ($features->isNotEmpty())
    <ul class="list-disc list-inside text-sm text-gray-700">
        @foreach ($features as $feature)
            <li>{{ $feature }}</li>
        @endforeach
    </ul>
@else
    <span class="text-gray-400">–</span>
@endif
