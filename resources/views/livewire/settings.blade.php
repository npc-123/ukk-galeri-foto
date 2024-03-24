<div>
    <div class="w-full">
        <div class="flex justify-center">
            <form action="" method="post" class="mt-11 w-full sm:w-[75%] md:w-[40%] lg:w-[30%] p-[10px]">
                <!-- @csrf -->
                <div id="photo-profile" class="flex justify-start">
                    @if ($imageUpload)
                    <img src="{{$imageUpload->temporaryUrl()}}" alt="photo profile" class="w-32 h-32 object-cover rounded-full">
                    @else
                    <img src="/storage/{{$image}}" alt="photo profile" class="w-32 h-32 object-cover rounded-full">
                    @endif
                    
                    <div class="flex items-center px-6">
                        <label for="upload"
                            class="cursor-pointer inline-block py-2 px-4 bg-blue-500 text-white rounded-lg shadow-lg transition duration-300 ease-in-out hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                            tabindex="0">
                            <span class="d-none d-sm-block"><i class="bx bx-upload"></i> Ganti</span>
                            <span wire:loading wire:target="imageUpload"><i class='bx bx-loader-alt bx-spin' style='color:#ffffff' ></i></span>
                            <input wire:model="imageUpload" name="imageUpload" type="file" id="upload" class="hidden">
                        </label>
                        @error('imageUpload') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="block mt-7">
                    <div class="w-full">
                        <label for="name" class="mt-3 block text-sm font-medium leading-6 text-gray-900">Nama
                            Lengkap</label>
                        <div class="mt-2">
                            <input wire:model="name" @error('name') wire:model.live="name" @enderror id="name" name="name" type="text" autocomplete="off" required
                                class="block w-full rounded-xl border-0 py-1.5 text-gray-900 shadow-sm ring-2 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600  sm:text-sm sm:leading-6 pl-3 focus:outline-none @error('name') ring-red-500 focus:ring-red-600 @enderror">
                                <div class="text-red-500 text-sm">@error('name') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="username"
                            class="mt-3 block text-sm font-medium leading-6 text-gray-900">Username</label>
                        <div class="mt-2">
                            <input wire:model="username" @error('username') wire:model.live="username" @enderror id="username" name="username" type="text" autocomplete="off"
                                required
                                class="block w-full rounded-xl border-0 py-1.5 text-gray-900 shadow-sm ring-2 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-3 focus:outline-none @error('username') ring-red-500 focus:ring-red-600 @enderror">
                                <div class="text-red-500 text-sm">@error('username') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="email" class="mt-3 block text-sm font-medium leading-6 text-gray-900">Email</label>
                        <div class="mt-2">
                            <input wire:model="email" @error('email') wire:model.live="email" @enderror id="email" name="email" type="text" autocomplete="off" required
                                class="block w-full rounded-xl border-0 py-1.5 text-gray-900 shadow-sm ring-2 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-3 focus:outline-none @error('email') ring-red-500 focus:ring-red-600 @enderror">
                                <div class="text-red-500 text-sm">@error('email') {{ $message }} @enderror</div>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="address"
                            class="mt-3 block text-sm font-medium leading-6 text-gray-900">Alamat</label>
                        <div class="mt-2">
                            <textarea wire:model="address" @error('address') wire:model.live="address" @enderror id="address" name="address" rows="4" autocomplete="off"
                                required
                                class="block w-full rounded-xl border-0 py-1.5 text-gray-900 shadow-sm ring-2 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-3 focus:outline-none resize-none @error('address') ring-red-500 focus:ring-red-600 @enderror"></textarea>
                                <div class="text-red-500 text-sm">@error('address') {{ $message }} @enderror</div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <!-- <input type="button" value="reset"> -->
                    <span id="reset"
                        class="cursor-pointer mr-3 py-2 px-4 bg-red-500 text-white rounded-lg shadow-lg transition duration-300 ease-in-out hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                        Atur Ulang
                    </span>
                    {{-- <input type="submit" value="Simpan"
                        class="cursor-pointer inline-block py-2 px-4 bg-blue-500 text-white rounded-lg shadow-lg transition duration-300 ease-in-out hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100"> --}}
                    <span id="simpan"
                        class="cursor-pointer inline-block py-2 px-4 bg-blue-500 text-white rounded-lg shadow-lg transition duration-300 ease-in-out hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                        Simpan
                    </span>
                </div>
            </form>
        </div>
    </div>
    <script>
        const btnReset = document.getElementById('reset');
        const btnSimpan = document.getElementById('simpan');

        btnReset.addEventListener('click', function () {
            Swal.fire({
                title: "Apa anda yakin?",
                text: "Anda akan mereset ke awal.",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: "#3b82f6",
                confirmButtonText: "Ya!",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('resetInput');                          
                }
            });
        });

        btnSimpan.addEventListener('click', function () {
            Swal.fire({
                title: 'Konfirmasi Perubahan',
                text: "Semua Perubahan Akan Disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('update');
                }
            });
        });
        </script>
    @script
        <script>
            Livewire.on('updateSuccess', function(data) {
                Swal.fire({
                    icon: data.type,
                    title: data.message,
                    confirmButtonColor: '#3b82f6',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                    // text: data.message
                });
            });
            Livewire.on('updateFailed', function(data) {
                Swal.fire({
                    icon: data.type,
                    title: data.title,
                    confirmButtonColor: '#3b82f6',
                    text: data.message
                });
            });
        </script>    
    @endscript
</div>
