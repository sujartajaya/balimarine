<div id="{{ $id ?? '' }}" class="rounded-xl text-white p-4 shadow {{ $color }}">
    <div class="flex justify-between items-center">
        <div>
            <p class="text-sm opacity-80">{{ $title }}</p>
            <h2 class="text-xl font-bold value">
                {{ $value }}
            </h2>
        </div>
        <div class="text-2xl">
            {{ $icon }}
        </div>
    </div>
</div>