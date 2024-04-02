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
    <div class="flex flex-col items-center mt-5">
        <div class="flex mb-4">
            <span class="text-3xl font-bold">{{$album->NamaAlbum}}</span>
            @if($user->UserID == auth()->user()->UserID)
            <div class="relative">
                <div
                    class="dropdownAlbum-btn bg-gray-200 rounded-full flex justify-center items-center ml-3 hover:cursor-pointer">
                    <i class='bx bx-dots-horizontal-rounded text-2xl mx-2'></i>
                </div>
                <div
                    class="dropdownAlbum-content hover:cursor-pointer font-sans absolute right-0 mt-1 w-40 bg-white rounded-md shadow-lg z-10 hidden">
                    <div id="editBtn" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:rounded-lg"><i
                            class='bx bx-edit' style='color:#100b0b'></i> Ubah Nama</div>
                    <div id="deleteBtn" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:rounded-lg"><i
                            class='bx bx-trash' style='color:#100b0b'></i> Hapus Album</div>
                </div>
                @script
                <script>
                    Livewire.on('successUpdate', () => {
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
                              title: "Berhasil Memperbarui Nama Album"
                            });
                            @this.dispatch('refreshLivewire');
                        })
                </script>
                @endscript
                <script>
                    const editBtn = document.getElementById('editBtn');
                    const deleteBtn = document.getElementById('deleteBtn');
                    deleteBtn.addEventListener('click', function () {
                        Swal.fire({
                            title: "Apa anda yakin?",
                            text: "Album ini dan Semua Foto didalamnya akan di hapus!!",
                            icon: "warning",
                            showCancelButton: true,
                            cancelButtonColor: "#d33",
                            confirmButtonColor: "#3b82f6",
                            confirmButtonText: "Ya!",
                            cancelButtonText: "Batal",
                            reverseButtons: true
                        }).then((result) => {
                        if (result.isConfirmed) {
                            @this.call('deleteAlbum');
                        }
                        });
                    });
                    editBtn.addEventListener('click', async function () {
                        const { value: text } = await Swal.fire({
                                title: "Edit Nama Album",
                                html: `
                                  <input id="swal-input1" class="swal2-input" value="{{ $album->NamaAlbum }}" placeholder="Masukkan Nama Album">
                                `,
                                focusConfirm: false,
                                preConfirm: () => {
                                    return [
                                        document.getElementById("swal-input1").value,
                                    ];
                                }
                            });
                            const newName = text[0];
                            if (text !== '') {
                                @this.call('editAlbum', newName);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Input Tidak Boleh Kosong',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
                                })
                            }
                    });
                </script>
                <script>
                    const dropdownAlbum = document.querySelector('.dropdownAlbum-btn');
                    const dropdownAlbumContent = document.querySelector('.dropdownAlbum-content');
                    dropdownAlbum.addEventListener('click', function () {
                        dropdownAlbumContent.classList.toggle('hidden');
                    });
                    document.addEventListener('click', function (event) {
                        if (!dropdownAlbum.contains(event.target)) {
                            dropdownAlbumContent.classList.add('hidden');
                        }
                    });
                </script>
            </div>
            @endif
        </div>
        <div>
            <a href="/{{ $user->username }}">
                <img class="mx-auto w-[70px] h-[70px] object-cover rounded-full" src="/storage/{{ $user->Foto }}" alt="">
                <span class="mt-1 text-xl font-semibold">{{ $user->NamaLengkap }}</span>
            </a>
        </div>
    </div>
    <div class="img-container relative">
        @forelse ($posts as $post)
        <a href="/p/{{ $post->slug }}" wire:navigate class="img-result overflow-hidden">
            <img loading="lazy" src="/storage/{{ $post->LokasiFile }}" alt="{{ $post->judul }}"
                class="duration-300 hover:scale-105">
        </a>
        @empty
        <p
            class="mt-5 font-sans text-center text-gray-900 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
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
</div>