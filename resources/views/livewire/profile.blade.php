<div>
    @section('style')
    <style>
        .img-container {
            column-count: auto;
            column-width: 14rem;
            column-gap: 0.5rem;
            padding: 1rem;
        }

        .img-result {
            margin-bottom: 0.5rem;
            display: block;
        }

        .img-result img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-radius: 0.2rem;
        }
    </style>
    @endsection
    <div class="flex flex-col items-center">
        <div>
            <img class="w-[130px] h-[130px] object-cover rounded-full" src="/storage/{{ $user->Foto }}" alt="">
        </div>
        <div class="mt-4">
            <span class="text-3xl font-bold">{{ $user->NamaLengkap }}</span>
        </div>
        <div class="mt-1">
            <span class="text-lg text-gray-600">{{ $user->username }}</span>
        </div>
    </div>
    <div class="flex justify-center mt-9">
        <div class="flex">
            <a href="/{{ $user->username }}" wire:navigate>
                <div class="font-semibold @if ($page == null) border-b-4 border-black @endif">Dibuat</div>
            </a>
            <a href="/{{ $user->username }}/album" wire:navigate>
                <div class="font-semibold @if ($page == 'album') border-b-4 border-black @endif ml-9">Album</div>
            </a>
            @if ($user->UserID == auth()->user()->UserID)
            <a href="/{{ $user->username }}/liked" wire:navigate>
                <div class="font-semibold @if ($page == 'liked') border-b-4 border-black @endif ml-9">Disukai</div>
            </a>
            @endif
        </div>
    </div>
    <div>
        @if ($page == null)
        <div class="img-container relative">
            @forelse ($posts as $post)
            <a href="/p/{{ $post->slug }}" wire:navigate class="img-result overflow-hidden">
                <img loading="lazy" src="/storage/{{ $post->LokasiFile }}" alt="{{ $post->judul }}"
                    class="duration-300 hover:scale-105">
            </a>
            @empty
            <p class="mt-5 font-sans text-center text-gray-900 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                Tidak ada postingan!
            </p>
            @endforelse
            @if (!$posts->isEmpty())
            <div x-intersect.full="$wire.loadMore()" class="p-4">
                <div wire:loading wire:target="loadMore" class="loading-indicator">
                    <i class='bx bx-loader-alt bx-spin' style='color:#000000'></i> Memuat Lebih banyak postingan...
                </div>
            </div>

            @endif
        </div>
        @elseif ($page == 'album')
        <div class="relative flex flex-wrap justify-between w-full max-w-[1200px] m-auto mt-1">
            @forelse ($posts as $post)
            <div class="flex-1 m-3 min-w-[200px] height-[100px] box bg-white" style="box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                <a href="album/{{ $post->slug }}">
                    <div class="p-3">
                        <span class="text-2xl font-bold">{{ $post->NamaAlbum }}</span>
                        <div class="mt-2 text-sm text-gray-700">{{ $post->Deskripsi }}</div>
                        <div class="flex mt-3">
                            <span>{{ $allFoto[$post->AlbumID]->total ?? '0' }} Foto</span>
                            <span class="mx-2">•</span>
                            <span>Diperbarui {{ $lastUpdated[$post->AlbumID] ?? $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <p class="mt-5 font-sans text-center text-gray-900 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                Tidak ada Album!
            </p>
            @endforelse
        </div>
        @if (!$posts->isEmpty())
        <div x-intersect.full="$wire.loadMore()" class="p-4">
            <div wire:loading wire:target="loadMore" class="loading-indicator">
                <i class='bx bx-loader-alt bx-spin' style='color:#000000'></i> Memuat Lebih banyak album...
            </div>
        </div>
        @endif
        @elseif ($page == 'liked')
        <div class="img-container relative">
            @forelse ($posts as $post)
            <a href="/p/{{ $post->slug }}" wire:navigate class="img-result overflow-hidden">
                <img loading="lazy" src="/storage/{{ $post->LokasiFile }}" alt="{{ $post->judul }}"
                    class="duration-300 hover:scale-105">
            </a>
            @empty
            <p class="mt-5 font-sans text-center text-gray-900 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                Tidak ada postingan!
            </p>
            @endforelse
            @if (!$posts->isEmpty())
            <div x-intersect.full="$wire.loadMore()" class="p-4">
                <div wire:loading wire:target="loadMore" class="loading-indicator">
                    <i class='bx bx-loader-alt bx-spin' style='color:#000000'></i> Memuat Lebih banyak postingan...
                </div>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>