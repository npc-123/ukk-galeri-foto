<div>
    @section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="sm:max-w-lg w-full p-10 bg-white rounded-xl shadow-sm">
            <div class="text-center">
                <h2 class="mt-5 text-3xl font-bold text-gray-900">
                    Buat Postingan Baru
                </h2>
                <p class="mt-2 text-sm text-gray-400">Unggah Kenangan Anda</p>
            </div>
            <form wire:submit.prevent="uploadPost" class="mt-8 space-y-3" action="" method="POST">
                <div class="grid grid-cols-1 space-y-2">
                    <label class="text-sm font-bold text-gray-500 tracking-wide">Judul</label>
                    <input @error('judulPost') wire:model.live="judulPost" @enderror
                        class="@error('judulPost') border-red-500 focus:border-red-600 @enderror text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        type="text" maxlength="99" wire:model="judulPost">
                    @error('judulPost') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    
                    <label class="text-sm font-bold text-gray-500 tracking-wide">Deskripsi</label>
                    <textarea maxlength="100" wire:model="deskripsiPost" @error('deskripsiPost') wire:model.live="deskripsiPost" @enderror
                        class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 @error('deskripsiPost') border-red-500 focus:border-red-600 @enderror" type="text"></textarea>
                    @error('deskripsiPost') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    
                    <label class="text-sm font-bold text-gray-500 tracking-wide">Album</label>
                    <div wire:ignore>
                        <select wire:model="albumPost" id="mySel" class="select2">
                            <option></option>
                            <option value="NEW">Buat Album Baru</option>
                            @foreach ($albums as $album)
                            <option value="{{ $album->AlbumID }}">{{ $album->NamaAlbum }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('albumPost') 
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        <style>
                            .select2-container {
                                /* border: rgb(239 68 68); */
                                border: 1px solid rgb(239 68 68);
                            }
                        </style>
                     @enderror

                </div>
                <div class="grid grid-cols-1 space-y-2">
                    <label class="text-sm font-bold text-gray-500 tracking-wide">Foto</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="relative flex flex-col rounded-lg @error('imagePost') border-red-500 @enderror border-4 border-dashed w-full h-max @if ($imagePost) p-1 @else p-5 @endif group text-center hover:cursor-pointer">
                            @if ($imagePost)
                                <img src="{{ $imagePost->temporaryUrl() }}" alt="">
                            @else
                            <div class="h-full w-full text-center flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-10 h-10 text-blue-400 group-hover:text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <label for="photo" class="text-blue-600 hover:cursor-pointer">Pilih File</label>
                            </div>
                            @endif
                            <input wire:model="imagePost" type="file" class="hidden" name="photo" id="photo" accept="image/webp, image/jpeg, image/png, image/jpg">
                        </label>
                    </div>
                    @error('imagePost') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>
                <p class="text-sm text-gray-500">
                    <span>Tipe File: jpg, jpeg, png, webp</span>
                </p>
                <div>
                    <button type="submit" wire:loading.attr="disabled" wire:loading.class="hover:cursor-wait"
                        class="my-5 w-full flex justify-center bg-blue-500 text-gray-100 p-4  rounded-full tracking-wide
                                        font-semibold  focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
    @script
        <script>
            Livewire.on('getAlbumId', (data) => {
                var option = new Option(data.albumName, data.albumId);
                option.selected = true;
                $("#mySel").append(option);
                $("#mySel").trigger("change");
            });
            Livewire.on('error', (data) => {
                Swal.fire({
                    icon: data.type,
                    title: data.title,
                    text: data.message,
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false
                })
            });
        </script>
    @endscript
    @section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function () {
            $(".select2").select2({
                    placeholder: 'Pilih Album',
                    width: '100%',
                })
                .on('select2:close', async function () {
                    var el = $(this);
                    if (el.val() === "NEW") {
                        const { value: text } = await Swal.fire({
                            title: "Buat Album Baru",
                            html: `
                              <input id="swal-input1" class="swal2-input" placeholder="Masukkan Nama Album">
                              <input id="swal-input2" class="swal2-input" placeholder="Masukkan Deskripsi Album">
                            `,
                            focusConfirm: false,
                            preConfirm: () => {
                                return [
                                    document.getElementById("swal-input1").value,
                                    document.getElementById("swal-input2").value
                                ];
                            }
                        });
                        if (text[0] !== '' || text[1] !== '') {
                            // el.append('<option>' + text[0] + '</option>').val(text[0]);
                            Livewire.dispatch('newAlbum', text);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Input Tidak Boleh Kosong',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            })
                        }
                    }
                })
                .on('change', function () {
                    // console.log($(this).val());
                    @this.set('albumPost', $(this).val());
                });
        });
    </script>
    @endsection
</div>
