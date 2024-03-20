<div>
    <div class="flex flex-wrap justify-center">
        <div
            class="flex max-sm:items-center max-sm:flex-col shadow-2xl rounded-xl max-sm:h-fit h-[85vh] max-sm:w-full w-[80vw] relative">
            <div class="h-full w-1/2">
                <img class="h-full rounded-xl object-contain" src="/storage/{{ $post->LokasiFile }}" alt="">
            </div>
            <div class="sm:pl-7 pt-4 flex flex-col justify-between w-1/2">
                <div class="border-solid border-b-2 border-gray-300">
                    <div class="text-3xl font-bold font-sans">
                        {{ $post->JudulFoto }}
                    </div>
                    <div class="mt-2 font-sans text-gray-500">
                        {{ $post->DeskripsiFoto }}
                    </div>
                    <a href="/{{ $user->username }}" class="mt-5 flex items-center">
                        <img class="pr-1 h-[40px] object-contain mr-2 rounded-full" src="/storage/{{ $user->Foto }}"
                            alt="">
                        <span class="font-bold">{{ $user->username }}</span>
                    </a>
                </div>
                <div class="mt-3 overflow-auto max-h-[400px]">
                    <div class="mt-1 font-bold">Komentar</div>
                    @php
                    setlocale(LC_TIME, 'id_ID.utf8');
                    @endphp
                    @forelse($comments as $comment)
                    <div>
                        <div class="mt-7">
                            <div class="flex items-center">
                                <img class="pr-1 h-[30px] object-contain mr-1 rounded-full"
                                    src="/storage/{{ $comment->user->Foto }}" alt="">
                                <a href="/{{ $comment->user->username }}" class="font-bold">{{ $comment->user->username }}</a> <span class="mx-2">•</span>
                                <span class="text-gray-500">{{ strftime('%d %B %Y', strtotime($comment->TanggalKomentar)) }}</span> 
                                @if(auth()->user()->UserID == $comment->UserID)
                                <div class="relative sm:mr-3">
                                    <!-- Tombol dropdown -->
                                    <div class="flex items-center dropdown-comment{{ $comment->KomentarID }}-btn cursor-pointer">
                                        <svg class="ml-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM6 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path></svg>
                                    </div>
                        
                                    <!-- Isi dropdown -->
                                    <div class="dropdown-comment{{ $comment->KomentarID }}-content font-sans absolute right-0 mt-1 w-40 bg-white rounded-md shadow-lg z-10 hidden">
                                        <div class="relative">
                                            <button onclick="editComment({{ $comment->KomentarID }})"
                                                class="w-full text-start block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:rounded-lg"><i class='bx bxs-edit' undefined ></i> Edit</button>
                                            <button onclick="deleteComment({{ $comment->KomentarID }})"
                                                class="w-full text-start block px-4 py-2 text-gray-800 hover:bg-gray-200 hover:rounded-lg"><i class='bx bxs-trash' ></i> Hapus</button>
                                        </div>
                                    </div>
                                </div>
                                <script data-navigate-once>
                                    document.addEventListener('livewire:navigated', function () {

                                    const dropdownComment{{ $comment->KomentarID }} = document.querySelector('.dropdown-comment{{ $comment->KomentarID }}-btn');
                                    const dropdownCommentContent{{ $comment->KomentarID }} = document.querySelector('.dropdown-comment{{ $comment->KomentarID }}-content');
                                
                                    dropdownComment{{ $comment->KomentarID }}.addEventListener('click', function () {
                                        dropdownCommentContent{{ $comment->KomentarID }}.classList.toggle('hidden');
                                    });
                                
                                    // Menyembunyikan dropdown ketika pengguna mengklik di luar dropdown
                                    document.addEventListener('click', function (event) {
                                        if (!dropdownComment{{ $comment->KomentarID }}.contains(event.target)) {
                                            dropdownCommentContent{{ $comment->KomentarID }}.classList.add('hidden');
                                        }
                                    });
                                    });
                                </script>
                                @endif
                            </div>
                            <div class="mt-1">
                                <div id="comment-{{ $comment->KomentarID }}" class="text-gray-800">
                                    {{ $comment->IsiKomentar }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="mt-3">
                        <span class="text-gray-500">Tidak ada komentar!</span>
                    </div>
                    @endforelse
                </div>
                <div class="flex flex-col border-solid border-t-2 border-gray-300">
                    <div class="flex justify-between items-center mt-2">
                        <span class="font-bold text-xl">{{$commentTotal}} Komentar</span>
                        <div class="flex items-center">
                            <span class="text-xl font-bold">{{$likeTotal}} Suka</span>
                            <div wire:ignore>
                                <button wire:click="like">
                                    <i id="likeButton" class='bx bx-heart text-4xl ml-2 mr-2' style='color:#f30909'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <form wire:submit.prevent="newComment">
                        <div class="my-2 flex">
                            <img class="h-[40px] rounded-full object-contain mr-2"
                                src="/storage/{{ auth()->user()->Foto}}" alt="">
                            <input required wire:model="textComment"
                                class="p-2 font-medium w-full focus:outline-2 rounded-3xl border-solid border-2 border-gray-300"
                                type="text" placeholder="Tulis komentar..." />
                            <!-- buat bx-send agar menjadi kotak -->
                            <button type="submit">
                                <i class='bx bx-send text-4xl mx-1' style='color:#000000'></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('script')
    <script data-navigate-once>
        async function editComment(id) {
            var commentValue = document.getElementById('comment-' + id).innerText;
            const { value: editedComment } = await Swal.fire({
            input: "textarea",
            inputLabel: "Edit Komentar",
            inputPlaceholder: "Masukkan Komentar",
            showCancelButton: true,
            cancelButtonText: 'Batal',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3b82f6',
            inputValue: commentValue,
            inputAttributes: {
                maxlength: 225
            }
          });
          if (editedComment) {
            @this.call('editComment', id, editedComment);
          } else if (editedComment == '') {
            Swal.fire({
                icon: 'error',
                title: 'Input Tidak Boleh Kosong',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            })
          }
        }
        function deleteComment(id) {
            Swal.fire({
                title: 'Hapus Komentar?',
                text: "Komentar yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('deleteComment', id);
                }
            });
        }

    </script>
    @endsection
    @script
    <script>
        Livewire.on('like', (data) => {
            var likeButton = document.getElementById('likeButton');
            if (data.liked == true) {
                likeButton.classList.remove("bxs-heart");
                likeButton.classList.add("bx-heart");
            } else {
                likeButton.classList.remove("bx-heart");
                likeButton.classList.add("bxs-heart");
            }
        });
    </script>
    @endscript
</div>