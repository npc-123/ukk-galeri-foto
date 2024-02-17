<div>
    <div class="w-full">
        <div class="flex justify-center">
            <form action="" method="post" class="mt-11 w-full sm:w-[75%] md:w-[40%] lg:w-[30%] p-[10px]">
                <!-- @csrf -->
                <div id="photo-profile" class="flex justify-start">
                    <img src="https://miro.medium.com/v2/resize:fit:698/1*0jjdu52m0MO4SjLWiCVOlg.jpeg"
                        alt="phoro profile" class="w-32 object-contain rounded-full">
                    <div class="flex items-center px-6">
                        <label for="upload"
                            class="cursor-pointer inline-block py-2 px-4 bg-blue-500 text-white rounded-lg shadow-lg transition duration-300 ease-in-out hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                            tabindex="0">
                            <span class="d-none d-sm-block">Ganti</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input wire:model="imageUpload" name="image" type="file" id="upload" class="hidden"
                                accept="image/png">
                        </label>
                    </div>
                </div>
                <div class="block mt-7">
                    <div class="w-full">
                        <label for="username"
                            class="mt-3 block text-sm font-medium leading-6 text-gray-900">Username</label>
                        <div class="mt-2">
                            <input wire:model="username" id="username" name="username" type="text" autocomplete="off"
                                required
                                class="block w-full rounded-xl border-0 py-1.5 text-gray-900 shadow-sm ring-2 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-3 focus:outline-none">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="name" class="mt-3 block text-sm font-medium leading-6 text-gray-900">Nama
                            Lengkap</label>
                        <div class="mt-2">
                            <input wire:model="name" id="name" name="name" type="text" autocomplete="off" required
                                class="block w-full rounded-xl border-0 py-1.5 text-gray-900 shadow-sm ring-2 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-3 focus:outline-none">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="email" class="mt-3 block text-sm font-medium leading-6 text-gray-900">Email</label>
                        <div class="mt-2">
                            <input wire:model="email" id="email" name="email" type="text" autocomplete="off" required
                                class="block w-full rounded-xl border-0 py-1.5 text-gray-900 shadow-sm ring-2 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-3 focus:outline-none">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="address"
                            class="mt-3 block text-sm font-medium leading-6 text-gray-900">Alamat</label>
                        <div class="mt-2">
                            <textarea wire:model="address" id="address" name="address" rows="4" autocomplete="off"
                                required
                                class="block w-full rounded-xl border-0 py-1.5 text-gray-900 shadow-sm ring-2 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-3 focus:outline-none resize-none"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <!-- <input type="button" value="reset"> -->
                    <span id="reset"
                        class="cursor-pointer mr-3 py-2 px-4 bg-red-500 text-white rounded-lg shadow-lg transition duration-300 ease-in-out hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                        Atur Ulang
                    </span>
                    <input type="submit" value="Simpan"
                        class="cursor-pointer inline-block py-2 px-4 bg-blue-500 text-white rounded-lg shadow-lg transition duration-300 ease-in-out hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                </div>
            </form>
        </div>
    </div>
</div>