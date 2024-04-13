<div>
  <x-slot name="title">Beranda</x-slot>
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
  @if (session()->has('deletePost'))
  <script>
      const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    });
    Toast.fire({
      icon: "success",
      title: "Postingan berhasil dihapus"
    });
  </script>
  @endif
  <div class="img-container">
    @forelse ($posts as $post)
    <a href="/p/{{ $post->slug }}" wire:navigate class="img-result overflow-hidden">
      <img loading="lazy" src="/storage/{{ $post->LokasiFile }}" alt="{{ $post->judul }}"
        class="duration-300 hover:scale-105">
    </a>
    @empty
    <p class="font-sans text-center text-gray-600">Tidak ada postingan!</p>
    @endforelse
    <div x-intersect.full="$wire.loadMore()" class="p-4">
      <div wire:loading wire:target="loadMore" class="loading-indicator">
        <i class='bx bx-loader-alt bx-spin' style='color:#000000'></i> Memuat Lebih banyak postingan...
      </div>
    </div>
  </div>
</div>