@props(['img'])

<div class="max-w-sm rounded overflow-hidden shadow-lg">
    <img class="w-full" src={{ $img }} alt="Sunset in the mountains">
    <div class="px-6 py-4">
      <div class="font-bold text-xl mb-2">{{ $titulo }}</div>
      <p class="text-gray-700 text-base">
        {{ $slot }}
      </p>
    </div>
  </div>