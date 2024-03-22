<div>
    <nav class="bg-white font-serif font-bold w-full mt-3 items-center">
        <div class="flex flex-wrap items-center justify-between">
            <div class="flex items-center font-sans text-xs sm:text-base">
                <div class=" m-1 sm:m-3 h-[40px] w-[40px] object-contain">
                    <a href="/" wire:navigate><img
                        src="https://upload.wikimedia.org/wikipedia/commons/0/08/Pinterest-logo.png" alt="logo"></a>
                </div>
                <div class="m-1 sm:m-3"><a href="/" wire:navigate>Beranda</a></div>
                <div class="m-1 sm:m-3"><a href="/new">Buat</a></div>
            </div>
            <div wire:ignore class="relative w-[45%] h-12 sm:w-[50%] md:w-[60%]">
                <form wire:submit.prevent="search">
                <input wire:model.defer="searchInput" type="text" autocomplete="off" name="search" value="{{ request('search') }}"
                    class="pl-10 pr-4 py-2 border-2 rounded-3xl w-full font-normal font-sans focus:outline-none focus:border-blue-500"
                    placeholder="Cari Pengguna Lain" />
                </form>
                <div class="absolute inset-y-0 left-0 pl-3  
                        flex items-center  
                        pointer-events-none">
                    <svg class="h-8 w-5 font-extrabold text-gray-400" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>
            <div class="relative sm:mr-3">
                <!-- Tombol dropdown -->
                <div class="flex items-center dropdown-btn cursor-pointer">
                    <img alt="pp" src="/storage/{{ auth()->user()->Foto }}"
                        class="w-[40px] h-[40px] object-cover rounded-full mr-5">
                    <svg class="-ml-5 mr-2 h-9 w-9 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
    
                <!-- Isi dropdown -->
                <div class="dropdown-content font-sans absolute right-0 mt-1 w-40 bg-white rounded-md shadow-lg z-10 hidden">
                    <a href="/gallery" wire:navigate class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:rounded-lg">Galeri Saya</a>
                    <a href="/settings" wire:navigate class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:rounded-lg">Pengaturan</a>
                    <a href="/logout" wire:navigate class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:rounded-lg">Keluar</a>
                </div>
            </div>
        </div>
    </nav>
    @section('script')
    <script data-navigate-once>
        document.addEventListener('livewire:navigated', function () {
            const dropdownAkun = document.querySelector('.dropdown-btn');
            const dropdownContent = document.querySelector('.dropdown-content');
    
            dropdownAkun.addEventListener('click', function () {
                dropdownContent.classList.toggle('hidden');
            });
    
            // Menyembunyikan dropdown ketika pengguna mengklik di luar dropdown
            document.addEventListener('click', function (event) {
                if (!dropdownAkun.contains(event.target)) {
                    dropdownContent.classList.add('hidden');
                }
            });
        });
    </script>    
    @endsection
</div>
