<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="min-h-screen bg-[#0e0f0b] text-[#F4EFE7] font-poppins pb-32" 
    x-data="reservationHandler(
        {{ $table->table_id }},
        {{ $hargaSiang }},
        {{ $hargaSore }}, 
        {{ $hargaMalam }},
        {{ $bookedSlotsJS }},
        '{{ now()->setTimezone('Asia/Jakarta')->format('Y-m-d') }}',
        {{ now()->setTimezone('Asia/Jakarta')->format('H') }},
        {{ $hasUnpaid ? 'true' : 'false' }}, 
        {{ $unpaidTransactionId ?? 'null' }}
    )">
        
        {{-- HEADER GAMBAR (Parallax Effect) --}}
        <div class="relative w-full h-[300px] md:h-[400px] overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 hover:scale-105" 
                 style="background-image: url('{{ asset('img/' . $table->nama_gambar) }}');">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#0e0f0b] via-[#0e0f0b]/40 to-transparent"></div>
            
            {{-- Tombol Kembali --}}
            <a href="{{ route('reservation') }}" 
                class="absolute top-24 left-6 md:left-10 bg-black/30 backdrop-blur-md border border-white/10 rounded-full p-3 hover:bg-[#e9d9c9] hover:text-black transition z-20 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:-translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            {{-- Judul Meja --}}
            <div class="absolute bottom-0 left-0 w-full p-6 md:p-10 z-10">
                <div class="container mx-auto max-w-5xl">
                    <h1 class="text-5xl md:text-7xl font-bebas tracking-wide text-[#e9d9c9] drop-shadow-lg mb-2">
                        {{ $table->nama }}
                    </h1>
                    <div class="flex items-center gap-2 text-sm md:text-base text-gray-300">
                        <span class="bg-[#e9d9c9] text-black px-2 py-0.5 rounded text-xs font-bold uppercase">Meja Biliar</span>
                        <span>•</span>
                        <span>Professional Grade</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- KONTEN UTAMA (Grid Layout) --}}
        <div class="container mx-auto max-w-5xl px-6 md:px-10 mt-8 space-y-12">

            {{-- 1. DESKRIPSI & FASILITAS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                {{-- Kiri: Deskripsi --}}
                <div class="md:col-span-2 space-y-4">
                    <h2 class="text-2xl font-bebas text-white border-l-4 border-[#e9d9c9] pl-3">TENTANG MEJA INI</h2>
                    <p class="text-gray-400 leading-relaxed text-sm md:text-base text-justify">
                        {{ $table->deskripsi }}
                    </p>
                </div>

                {{-- Kanan: Fasilitas --}}
                <div class="space-y-4">
                    <h2 class="text-2xl font-bebas text-white border-l-4 border-[#e9d9c9] pl-3">FASILITAS</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center gap-3 bg-white/5 p-3 rounded-lg border border-white/5">
                            <img src="{{ asset('img/wifi.png') }}" class="w-5 h-5 opacity-70"> <span class="text-sm text-gray-300">WiFi</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/5 p-3 rounded-lg border border-white/5">
                            <img src="{{ asset('img/cafe.png') }}" class="w-5 h-5 opacity-70"> <span class="text-sm text-gray-300">Cafe</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/5 p-3 rounded-lg border border-white/5">
                            <img src="{{ asset('img/toilet.png') }}" class="w-5 h-5 opacity-70"> <span class="text-sm text-gray-300">Toilet</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/5 p-3 rounded-lg border border-white/5">
                            <img src="{{ asset('img/parking.png') }}" class="w-5 h-5 opacity-70"> <span class="text-sm text-gray-300">Parkir</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. PILIH TANGGAL (Slider Horizontal) --}}
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-3xl font-bebas text-white">1. PILIH TANGGAL</h2>
                    <div class="flex gap-2">
                         <button @click="$refs.daySlider.scrollBy({left: -200, behavior: 'smooth'})" class="p-2 rounded-full bg-white/5 hover:bg-white/10 border border-white/10 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button @click="$refs.daySlider.scrollBy({left: 200, behavior: 'smooth'})" class="p-2 rounded-full bg-white/5 hover:bg-white/10 border border-white/10 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
                
                <div x-ref="daySlider" class="flex gap-4 overflow-x-auto no-scrollbar pb-4 snap-x">
                    @php 
                        $startDate = \Carbon\Carbon::now('Asia/Jakarta');
                        if ($startDate->hour < 2) { $startDate->subDay(); }
                    @endphp
                    @for ($i = 0; $i < 7; $i++)
                        @php
                            $day = $startDate->copy()->addDays($i);
                            $dateString = $day->format('Y-m-d');
                        @endphp
                        <button @click="selectDate('{{ $dateString }}')"
                            :class="selectedDate === '{{ $dateString }}' 
                                ? 'bg-[#e9d9c9] text-black border-[#e9d9c9] scale-100 shadow-[0_0_15px_rgba(233,217,201,0.4)]' 
                                : 'bg-white/5 text-gray-400 border-white/10 hover:bg-white/10 hover:border-white/30 scale-95'"
                            class="min-w-[140px] md:min-w-[160px] snap-start rounded-xl p-4 border transition-all duration-300 flex flex-col items-center justify-center gap-1 group">
                            
                            <span class="text-xs font-medium uppercase tracking-wider opacity-80">{{ $day->translatedFormat('l') }}</span>
                            <span class="text-3xl font-bebas tracking-wide">{{ $day->format('d') }}</span>
                            <span class="text-xs font-medium opacity-60">{{ $day->format('M Y') }}</span>
                        </button>
                    @endfor
                </div>
            </div>

            {{-- 3. PILIH JAM (Grid System) --}}
            <div x-show="selectedDate" x-transition.opacity class="space-y-6">
                <div class="flex items-center justify-between border-b border-white/10 pb-4">
                    <h2 class="text-3xl font-bebas text-white">2. PILIH SLOT WAKTU</h2>
                    <div class="flex items-center gap-2 text-sm text-green-400 bg-green-900/20 px-3 py-1 rounded-full border border-green-900/30">
                        <span class="font-bold" x-text="countAvailable"></span>
                        <span>Slot Tersedia</span>
                    </div>
                </div>

                {{-- Grid Slot Waktu --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                    <template x-for="slot in availableSlots" :key="slot.time">
                        <button @click="toggleSlot(slot)" 
                            :disabled="slot.isBooked || slot.isPast"
                            :class="{
                                'bg-red-900/20 border-red-900/30 opacity-60 cursor-not-allowed': slot.isBooked,
                                'bg-gray-800/40 border-gray-700/30 opacity-40 cursor-not-allowed': slot.isPast && !slot.isBooked,
                                'bg-[#e9d9c9] text-black border-[#e9d9c9] shadow-[0_0_10px_rgba(233,217,201,0.5)] transform scale-[1.02]': slot.isSelected,
                                'bg-white/5 border-white/10 text-gray-300 hover:bg-white/10 hover:border-white/30': !slot.isBooked && !slot.isPast && !slot.isSelected
                            }"
                            class="relative p-3 rounded-lg border transition-all duration-200 flex flex-col items-center justify-center gap-1 h-20 group">
                            
                            {{-- Jam --}}
                            <span class="text-sm font-bold" x-text="slot.time.replace('–', '-')"></span>
                            
                            {{-- Harga --}}
                            <span class="text-[10px] opacity-80" x-text="'Rp' + (slot.price / 1000) + 'k'"></span>

                            {{-- Status Badge --}}
                            <template x-if="slot.isBooked">
                                <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-red-500"></span>
                            </template>
                            <template x-if="slot.isSelected">
                                <div class="absolute inset-0 border-2 border-[#e9d9c9] rounded-lg animate-pulse"></div>
                            </template>
                        </button>
                    </template>
                </div>
            </div>

            {{-- Pesan Jika Belum Pilih Tanggal --}}
            <template x-if="!selectedDate">
                <div class="flex flex-col items-center justify-center py-16 border-2 border-dashed border-white/10 rounded-2xl bg-white/5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-400 text-lg">Silakan pilih tanggal main di atas dulu ya!</p>
                </div>
            </template>

        </div>

        {{-- BOTTOM BAR (Floating Total - Compact Version) --}}
        <div x-show="selectedSlots.length > 0" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-full opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-full opacity-0"
            class="fixed bottom-4 left-0 right-0 z-50 px-4 md:px-0 flex justify-center pointer-events-none">

            <div class="pointer-events-auto bg-[#1a1a19]/95 backdrop-blur-md border border-white/10 shadow-[0_4px_20px_rgb(0,0,0,0.5)] rounded-xl p-2.5 w-full max-w-lg flex items-center justify-between gap-3">
                
                {{-- Info Total --}}
                <div class="flex flex-col pl-2">
                    <span class="text-[10px] text-gray-400 font-medium uppercase tracking-wider leading-none mb-0.5">Total Estimasi</span>
                    <div class="flex items-baseline gap-1">
                        <span class="text-[#e9d9c9] font-bold text-sm">Rp</span>
                        <span class="text-white font-bebas text-xl md:text-2xl tracking-wide" x-text="totalPrice.toLocaleString('id-ID')"></span>
                    </div>
                </div>

                {{-- Form Submit --}}
                <form method="POST" action="{{ route('customer.reservation.cart') }}">
                    @csrf
                    <input type="hidden" name="table_id" :value="tableId">
                    <input type="hidden" name="tanggal_pemesanan" :value="selectedDate">
                    <input type="hidden" name="selected_slots" :value="JSON.stringify(selectedSlots)">
                    
                    {{-- tombol  --}}
                    <button type="submit" 
                        class="bg-[#e9d9c9] hover:bg-white text-black px-5 py-2 rounded-lg transition duration-300 flex items-center gap-2 shadow-md hover:shadow-[#e9d9c9]/20 transform active:scale-95 group">
                        
                        <span class="font-bold text-xs md:text-sm uppercase tracking-wider">Lanjut</span>
                        
                        <svg class="w-3.5 h-3.5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </section>
    
    <style>.no-scrollbar::-webkit-scrollbar { display: none; } .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }</style>
    
    {{-- ALPINE.JS LOGIC --}}
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('reservationHandler', (tableId, priceSiang, priceSore, priceMalam, bookedSlotsJS, serverDateStr, serverHour, hasUnpaid, unpaidTransactionId) => ({
            tableId: tableId,
            tablePriceSiang: priceSiang,
            tablePriceSore: priceSore,
            tablePriceMalam: priceMalam,
            bookedSlots: bookedSlotsJS,
            serverDate: new Date(serverDateStr), 
            serverHour: serverHour,              
            hasUnpaid: hasUnpaid,
            unpaidTransactionId: unpaidTransactionId,
            
            selectedDate: null,
            availableSlots: [],
            selectedSlots: [],

            get countAvailable() {
                return this.availableSlots.filter(slot => !slot.isBooked && !slot.isPast).length;
            },
            
            get totalPrice() {
                return this.selectedSlots.reduce((total, slot) => total + slot.price, 0);
            },
            
            selectDate(date) {
                this.selectedDate = date;
                this.selectedSlots = []; 
                this.generateAvailableSlots(); 
            },
            
            toggleSlot(slot) {
                if (slot.isBooked || slot.isPast) return; 
                
                const index = this.selectedSlots.findIndex(s => s.time === slot.time);
                if (index === -1) {
                    this.selectedSlots.push(slot);
                } else {
                    this.selectedSlots.splice(index, 1);
                }
                this.generateAvailableSlots();
                this.availableSlots = this.availableSlots.map(s => {
                    if (this.selectedSlots.some(sel => sel.time === s.time)) {
                        s.isSelected = true;
                    }
                    return s;
                });
            },
            
            generateAvailableSlots() {
                if (!this.selectedDate) return;
                
                const dateSelectedStr = this.selectedDate;
                const bookedToday = this.bookedSlots[dateSelectedStr] || [];
                const allSlots = [];
                
                for (let i = 0; i < 24; i++) {
                    // SKIP Jam Tutup (02:00 - 10:00)
                    if (i >= 2 && i < 10) {
                        continue;
                    }

                    let startHour = i;
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

                    let isBooked = bookedToday.includes(startTimeDB);

                    let isPast = false;
                    let slotRealDate = new Date(this.selectedDate); 
                    slotRealDate.setHours(startHour, 0, 0, 0);

                    let now = new Date(this.serverDate);
                    now.setHours(this.serverHour, 0, 0, 0); 
                    
                    if (slotRealDate < now) {
                        isPast = true;
                    }
                    
                    const isSelected = this.selectedSlots.some(s => s.startTimeDB === startTimeDB);
                    
                    allSlots.push({
                        time: timeString,
                        startTimeDB: startTimeDB,
                        price: currentPrice,
                        isBooked: isBooked,
                        isPast: isPast,
                        isSelected: isSelected
                    });
                }
                this.availableSlots = allSlots;
            }
        }));
    });
    </script>
</x-Layout>