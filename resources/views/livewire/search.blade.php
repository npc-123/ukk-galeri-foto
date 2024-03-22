<div>
    <div class="flex flex-col items-center">
        @forelse ($users as $user)
        <a href="/{{$user->username}}" class="w-96 mt-4 hover:bg-gray-200 hover:rounded-full p-4">
            <div class="flex justify-start">
                <div>
                    <img class="w-[50px] h-[50px] object-cover rounded-full" src="{{$user->Foto}}" alt="">
                </div>
                <div class="flex flex-col ml-3">
                    <span class="font-bold">{{$user->username}}</span>
                    <span>{{$user->NamaLengkap}}</span>
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
    </div>
</div>
