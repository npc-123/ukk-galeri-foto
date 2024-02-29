<div>
  <x-slot name="title">Beranda</x-slot>
    @section('style')
    <style>
        .img-container{
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
          border-radius:  0.2rem;
        }
    </style>
    @endsection
    <div class="img-container">
        @foreach ($posts as $post)
        <a class="img-result" href="{{ $post->slug }}">
            <img loading="lazy" src="/storage/{{ $post->LokasiFile }}">
        </a>
        @endforeach
        <div x-intersect.full="$wire.loadMore()" class="p-4">
            <div wire:loading wire:target="loadMore" 
                  class="loading-indicator">
                  <i class='bx bx-loader-alt bx-spin' style='color:#000000' ></i> Memuat Lebih banyak postingan...  
            </div>
          </div>
    </div>
</div>
