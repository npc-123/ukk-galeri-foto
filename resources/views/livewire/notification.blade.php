<div>
    {{-- @forelse ($notifications as $notification)
    <a href="/p/asd" class="flex items-center py-3 px-4 hover:bg-gray-200">
        <img alt="pp" src="/storage/"
            class="w-[40px] h-[40px] object-cover rounded-full mr-5">
        <div>
            <div class="font-bold">cyvas</div>
            <div class="text-gray-500">4 hari yag lalu</div>
        </div>
    </a>
    @empty
    <span class="font-bold">Tidak ada notifikasi</span>
    @endforelse
    {{ $notifications->links() }} --}}
    <div wire:poll.10s class="flex flex-col justify-center items-center w-[70%] relative max-w-full mx-auto mt-3">
    @forelse ($notifications as $notification)
        <a href="/p/{{ $notification->foto->slug }}" wire:navigate class="flex justify-center items-center w-[50%] mx-auto mt-3 p-3 hover:bg-gray-100 hover:rounded-lg">
            <div class="mr-3">
                <img src="/storage/{{ $notification->user->Foto }}" class="w-[50px] h-[50px] object-cover rounded-full" alt="pp">
            </div>
            <div>
                <span class="font-bold">{{ $notification->user->username }}</span> <span>{{ $notification->isi }}</span>
                <div class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
            </div>
            <div class="ml-auto">
                <img src="/storage/{{ $notification->foto->LokasiFile }}" class="w-[50px] h-[50px] object-cover rounded-none" alt="">
            </div>
        </a>
    @empty
    <span class="font-bold">Tidak ada notifikasi</span>
    @endforelse
        <div x-intersect.full="$wire.loadMore()" class="p-4">
            <div wire:loading wire:target="loadMore" class="loading-indicator">
                  <i class='bx bx-loader-alt bx-spin' style='color:#000000' ></i> Memuat Lebih banyak notifikasi...  
            </div>
        </div>
    </div>
</div>
