<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="min-h-screen bg-black text-white" 
    x-data="reservationHandler(
        {{ $table->table_id }},
        {{ $hargaSiang }},
        {{ $hargaSore }}, 
        {{ $hargaMalam }},
        {{ $bookedSlotsJS }}
    )">

        {{-- HEADER GAMBAR --}}
        <div class="relative w-full h-[250px]">
            <img src="{{ asset('img/' . $table->nama_gambar) }}" class="w-full h-full opacity-50 object-cover">
            <a href="{{ route('reservation') }}" 
                class="absolute top-16 left-3 bg-white/20 backdrop-blur-sm rounded-full p-2 hover:bg-white/30 transition">←
            </a>
            <h1 class="absolute bottom-14 left-1/2 -translate-x-1/2 text-4xl font-bold uppercase tracking-wider">
                {{ $table->nama }}
            </h1>
        </div>

        {{-- DESKRIPSI --}}
        <div class="px-8 mt-6">
            <h2 class="text-3xl mb-2">Deskripsi</h2>
            <p class="text-gray-300 leading-relaxed">{{ $table->deskripsi }}</p>
        </div>

        {{-- FASILITAS --}}
        <div class="px-8 mt-6">
            <h2 class="text-3xl mb-3">Fasilitas</h2>
            <div class="flex flex-col gap-6 text-gray-300 text-lg">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/wifi.png') }}" class="w-6 h-6"> WiFi
                </div>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/cafe.png') }}" class="w-6 h-6"> Cafe
                </div>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/toilet.png') }}" class="w-6 h-6"> Toilet
                </div>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/parking.png') }}" class="w-6 h-6"> Parkiran
                </div>
            </div>
        </div>

        {{-- SLIDER TANGGAL --}}
        <div x-data="{ scroll: 0 }" class="relative w-full mt-10">
            <button @click="scroll -= 300; $refs.daySlider.scrollLeft = scroll"
                class="absolute left-3 top-1/2 -translate-y-1/2 z-20">
                <img src="{{ asset('img/tombol-kiri.png') }}"
                    class="w-10 h-10 opacity-80 hover:opacity-100 transition">
            </button>

            <div x-ref="daySlider" class="flex gap-6 overflow-x-auto no-scrollbar px-14 scroll-smooth">
                @php
                    $startDate = \Carbon\Carbon::today();
                @endphp
                @for ($i = 0; $i < 7; $i++)
                    @php
                        $day = $startDate->copy()->addDays($i);
                        $dateString = $day->format('Y-m-d');
                    @endphp
                    <button @click="selectDate('{{ $dateString }}')"
                        :class="{
                            'bg-white text-black': selectedDate === '{{ $dateString }}',
                            'bg-[#2d2d2d] text-white hover:bg-white/20': selectedDate !== '{{ $dateString }}'
                        }"
                        class="min-w-[220px] rounded-xl p-6 transition duration-300 shadow-lg">
                        <p class="text-gray-300">{{ $day->format('d F Y') }}</p>
                        <p class="text-2xl font-bold uppercase">{{ $day->translatedFormat('l') }}</p>
                    </button>
                @endfor
            </div>

            <button @click="scroll += 300; $refs.daySlider.scrollLeft = scroll"
                class="absolute right-3 top-1/2 -translate-y-1/2 z-20">
                <img src="{{ asset('img/tombol-kanan.png') }}"
                    class="w-10 h-10 opacity-80 hover:opacity-100 transition">
            </button>
        </div>
        <style>.no-scrollbar::-webkit-scrollbar { display: none; }</style>

        {{-- SLIDER JADWAL --}}
        <div class="px-8 mt-8 pb-32">
            <template x-if="!selectedDate">
                <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-16 text-center border border-white/10 border-dashed">
                    <svg class="w-20 h-20 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-gray-400 text-xl">Silakan pilih tanggal terlebih dahulu</p>
                </div>
            </template>

            <div x-show="selectedDate" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100">
                
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-bold">Pilih Jam</h2>
                    
                    <div class="bg-green-500/20 border border-green-500/30 rounded-xl px-5 py-2.5 backdrop-blur-sm">
                        <span class="text-green-400 font-bold text-lg" x-text="availableSlots.length"></span>
                        <span class="text-green-300 ml-1">Slot Tersedia</span>
                    </div>
                </div>

                <div x-data="{ scroll: 0 }" class="relative w-full px-6">
                    <button @click="scroll -= 300; $refs.timeSlider.scrollLeft = scroll"
                        class="absolute left-2 top-1/2 -translate-y-1/2 z-20 bg-white/10 backdrop-blur-md rounded-full p-3 hover:bg-white/20 transition-all duration-300 shadow-lg border border-white/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <div x-ref="timeSlider" class="flex gap-4 overflow-x-auto no-scrollbar scroll-smooth px-14 mb-10">
                        <template x-for="slot in availableSlots" :key="slot.time">
                            <button @click="toggleSlot(slot)" :disabled="slot.isBooked" 
                                :class="{
                                    'bg-gray-800/50 opacity-40 cursor-not-allowed border-gray-700': slot.isBooked,
                                    'bg-gradient-to-br from-red-600 to-red-700 text-white shadow-xl shadow-red-900/50 scale-105 border-red-500': slot.isSelected,
                                    'bg-white/5 text-white hover:bg-white/10 hover:scale-105 border-white/20': !slot.isBooked && !slot.isSelected
                                }"
                                class="min-w-[170px] rounded-2xl border backdrop-blur-sm flex flex-col items-center justify-center p-5 transition-all duration-300">

                                <p class="text-lg font-bold mb-2" x-text="slot.time"></p>
                                <p class="text-sm opacity-90 mb-1" x-text="'Rp' + slot.price.toLocaleString('id-ID')"></p>
                                <template x-if="slot.isBooked">
                                    <span class="text-xs text-red-400 mt-2 bg-red-500/20 px-3 py-1 rounded-full">Terisi</span>
                                </template>
                            </button>
                        </template>
                    </div>

                    <button @click="scroll += 300; $refs.timeSlider.scrollLeft = scroll"
                        class="absolute right-2 top-1/2 -translate-y-1/2 z-20 bg-white/10 backdrop-blur-md rounded-full p-3 hover:bg-white/20 transition-all duration-300 shadow-lg border border-white/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- BOTTOM BAR --}}
        <div x-show="selectedSlots.length > 0" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-full"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             class="fixed bottom-0 left-0 right-0 bg-[#181C14] border-t-4 border-[#3C3D37] backdrop-blur-xl px-8 py-6 flex items-center justify-between z-30 shadow-2xl">
            <div>
                <p class="text-[#FFF4E4] font-semibold text-xl">Total Reservasi</p>
                <p class="font-bold  bg-black text-[#FFF4E4] text-lg bg-clip-text" x-text="totalPriceFormatted"></p>
            </div>
            <form method="POST" action="{{ route('customer.reservation.cart') }}">
                @csrf
                <input type="hidden" name="table_id" :value="tableId">
                <input type="hidden" name="tanggal_pemesanan" :value="selectedDate">
                <input type="hidden" name="selected_slots" :value="JSON.stringify(selectedSlots)">
                <button type="submit" 
                    class="bg-[#C1121F] text-[#FFF4E4] hover:bg-[#A00F1B] text-xs font-bold py-4 px-10 rounded-xl transition shadow-lg hover:scale-105 duration-300 shadow-red-900/50 flex items-center gap-3 cursor-pointer">
                    <span class="text-lg">Lanjut</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>
        </div>
    </section>
    
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    
    {{-- ALPINE.JS LOGIC --}}
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('reservationHandler', (tableId, priceSiang, priceSore, priceMalam, bookedSlotsJS) => ({
            tableId: tableId,
            tablePriceSiang: priceSiang,
            tablePriceSore: priceSore,
            tablePriceMalam: priceMalam,
            bookedSlots: bookedSlotsJS,
            selectedDate: null,
            availableSlots: [],
            selectedSlots: [],
            
            get totalPrice() {
                return this.selectedSlots.reduce((total, slot) => total + slot.price, 0);
            },
            
            get totalPriceFormatted() {
                return 'Rp' + this.totalPrice.toLocaleString('id-ID');
            },
            
            selectDate(date) {
                this.selectedDate = date;
                this.selectedSlots = []; 
                this.generateAvailableSlots(); 
            },
            
            toggleSlot(slot) {
                if (slot.isBooked) return; 
                const index = this.selectedSlots.findIndex(s => s.time === slot.time);
                if (index === -1) {
                    this.selectedSlots.push(slot);
                } else {
                    this.selectedSlots.splice(index, 1);
                }
                this.generateAvailableSlots();
            },
            
            generateAvailableSlots() {
                if (!this.selectedDate) return;
                const bookedToday = this.bookedSlots[this.selectedDate] || [];
                const allSlots = [];
                
                for (let i = 10; i <= 25; i++) {
                    let startHour = i % 24;
                    let endHour = (i + 1) % 24;
                    let startHourStr = String(startHour).padStart(2, '0');
                    let endHourStr = String(endHour).padStart(2, '0');
                    const timeString = `${startHourStr}:00 – ${endHourStr}:00`;
                    const startTimeDB = `${startHourStr}:00:00`;
                    
                    let currentPrice;
                    if (startHour >= 10 && startHour < 18) {
                        currentPrice = this.tablePriceSiang;
                    } else if (startHour >= 18 && startHour <= 23) {
                        currentPrice = this.tablePriceSore;
                    } else {
                        currentPrice = this.tablePriceMalam;
                    }
                    
                    const isBooked = bookedToday.includes(startTimeDB);
                    const isSelected = this.selectedSlots.some(s => s.startTimeDB === startTimeDB);
                    
                    allSlots.push({
                        time: timeString,
                        startTimeDB: startTimeDB,
                        price: currentPrice,
                        isBooked: isBooked,
                        isSelected: isSelected
                    });
                }
                
                this.availableSlots = allSlots;
            }
        }));
    });
    </script>
</x-Layout>