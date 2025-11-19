   <x-Layout>
       <x-slot:title>{{ $title }}</x-slot:title>


       <!-- Background -->
       <div class="relative w-full min-h-screen bg-[#181C14] overflow-hidden">

           <!-- Riwayat pemesanan -->
           <div class="text-[#FFF4E4] font-bold-1/2">
               <h1 class="text-6xl mt-25 mb-13 ml-20">riwayat pemesanan</h1>
           </div>

           <div class="w-[95%] mx-auto mt-6 space-y-4">
               <!-- Kotak 1 -->
               <div class="h-37 flex border border-[#FFF4E4] rounded-2xl">
                   <div class="w-16 h-16 mt-10 ml-15">
                       <img src="{{ asset('img/aktivitas.png') }}">
                   </div>
                   <div class="ml-18">
                       <p class="text-[#FFF4E4] text-3xl font-bold mt-4 mb-5">No invoice</p>
                       <p class="text-[#FFF4E4] text-xl">09/09/2009</p>
                       <p class="text-[#FFF4E4] text-xl">Rp20.000</p>
                   </div>
                   <div class="ml-auto mr-10 mt-4">
                       <p class="italic text-[#FFF4E4] text-2xl ml-25">paid</p>
                       <button type="lihat detail"
                           class="border border-[#FFF4E4] hover:text-[#181C14] hover:bg-[#FFF4E4] rounded text-[#FFF4E4] font-bold text-center w-40 h-10 mt-8">
                           Lihat Detail
                       </button>
                   </div>
               </div>

               <!-- Kotak 2-->
               <div class="h-37 flex border border-[#FFF4E4] rounded-2xl">
                   <div class="w-16 h-16 mt-10 ml-15">
                       <img src="{{ asset('img/aktivitas.png') }}">
                   </div>
                   <div class="ml-18">
                       <p class="text-[#FFF4E4] text-3xl font-bold mt-4 mb-5">No invoice</p>
                       <p class="text-[#FFF4E4] text-xl">09/09/2009</p>
                       <p class="text-[#FFF4E4] text-xl">Rp20.000</p>
                   </div>
                   <div class="ml-auto mr-10 mt-4">
                       <p class="italic text-[#FFF4E4] text-2xl ml-25">paid</p>
                       <button type="lihat detail"
                           class="border border-[#FFF4E4] hover:text-[#181C14] hover:bg-[#FFF4E4] rounded text-[#FFF4E4] font-bold text-center w-40 h-10 mt-8">
                           Lihat Detail
                       </button>
                   </div>
               </div>
           </div>

           <!-- Modalnya ntar dari struk, UI nya nunggu afra -->
   </x-Layout>
