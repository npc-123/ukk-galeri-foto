<div>
    <div class="flex flex-col items-center">
        @forelse ($users as $user)
        <a wire:navigate href="/{{$user->username}}" class="max-w-full w-[30rem] mt-4 hover:bg-gray-200 hover:rounded-full p-4">
            <div class="flex justify-between relative items-center">
                <div class="flex-shrink-0">
                    <img class="w-[50px] h-[50px] object-cover rounded-full" src="/storage/{{$user->Foto}}" alt="">
                </div>
                <div class="flex flex-col ml-3 w-[50%]">
                    <span class="font-bold">{{$user->NamaLengkap}}</span>
                    <span>{{$user->username}}</span>
                </div>
                <div class="flex items-center ml-auto">
                    <div class="rounded-full bg-blue-500 px-3 py-1 text-white hover:bg-blue-600">
                        <span>Lihat Profil</span>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <span class="font-bold">Tidak ada hasil</span>
        @endforelse
        <div x-intersect.full="$wire.loadMore()" class="p-4">
            <div wire:loading wire:target="loadMore" class="loading-indicator">
                <i class='bx bx-loader-alt bx-spin' style='color:#000000' ></i> Memuat Lebih banyak akun...
            </div>
        </div>
    </div>
</div>
