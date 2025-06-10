<div class="fixed z-50 right-3 lg:right-7 bottom-3 lg:bottom-7">
    <div x-init="initInterval()">
        <p id="popup" class="bg-white border rounded-t-full rounded-bl-full mb-2 px-3 py-1 transition-all duration-300">Memiliki pertanyaan/bantuan?</p>
    </div>
    <div class="flex justify-end">
        <a href="{{ route('contact') }}" class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-full border border-gray-200 w-fit">
            <span>Chat</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
            </svg>
        </a>
    </div>
</div>

@push('scripts')
<script>
    function toggleVisibility() {
        const popup = document.getElementById('popup');
        popup.classList.toggle('hidden');

        console.log(popup);
    }

    function initInterval() {
      setInterval(toggleVisibility.bind(this), 15000); // Toggle visibilitas setiap 30 detik
    }
</script>
@endpush

