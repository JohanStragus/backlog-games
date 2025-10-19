{{-- resources/views/components/application-logo.blade.php --}}
<a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2">
    {{-- SVG mando minimalista (puedes cambiarlo por tu propio logo) --}}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-7 w-7" fill="currentColor">
        <path d="M7 10h3v2H7v3H5v-3H2v-2h3V7h2v3zm12.5-1a3.5 3.5 0 0 1 0 7c-.9 0-1.72-.34-2.34-.9l-.24-.21H7.08l-.24.21A3.5 3.5 0 1 1 4.5 9c.9 0 1.72.34 2.34.9l.24.21h9.84l.24-.21c.62-.56 1.44-.9 2.34-.9Zm-3.75 3.25a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm2.5 0a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Z"/>
    </svg>

    <span class="font-semibold tracking-tight text-gray-100">
        {{ config('app.name', 'Backlog Games') }}
    </span>
</a>
