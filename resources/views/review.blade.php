<x-Layout>
    <x-slot:title>Ulasan Pelanggan</x-slot:title>

    {{-- Ambil data review user dari controller --}}
    @php
        $myReview = $userReview ?? null;
        $hasReviewed = $myReview ? true : false;
    @endphp
    {{-- {{ dd($myReview, $hasReviewed) }} --}}

    <div class="min-h-screen bg-[#0e0f0b] text-[#F4EFE7] font-poppins pt-24 pb-20 px-6 md:px-12">

        {{-- HEADER (Tombol Trigger Modal) --}}
        <div class="max-w-7xl mx-auto mb-10 border-b border-white/10 pb-6 flex flex-col md:flex-row justify-between items-end gap-4"
            x-data="{ showModal: false }">

            <div>
                <h1 class="text-4xl md:text-6xl font-bebas tracking-wide text-white">
                    APA KATA <span class="text-[#e9d9c9]">MEREKA?</span>
                </h1>
                <p class="text-gray-400 mt-2 text-lg">Pengalaman nyata dari pengunjung Random Shot Pool & Cafe.</p>
            </div>

            {{-- TOMBOL LOGIC: Edit jika sudah ada, Tulis jika belum --}}
            @if (session('user_id'))
                <button @click="showModal = true"
                    class="bg-[#e9d9c9] hover:bg-white text-black px-6 py-3 rounded-full font-bold shadow-[0_0_15px_rgba(233,217,201,0.4)] transition transform hover:-translate-y-1 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    {{ $hasReviewed ? 'Edit Ulasan Saya' : 'Tulis Ulasan' }}
                </button>
            @endif

            {{--  MODAL FORM (CREATE / EDIT)  --}}
            <template x-teleport="body">
                <div x-show="showModal" style="display: none;"
                    class="fixed inset-0 z-[9999] flex items-center justify-center px-4">
                    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" x-transition.opacity
                        @click="showModal = false"></div>

                    {{-- 
                        x-data inisialisasi nilai:
                        Jika sudah review: ambil dari database.
                        Jika belum: set default 0 dan string kosong.
                    --}}
                    <div class="relative bg-[#1a1a19] border border-white/10 w-full max-w-lg rounded-2xl p-8 shadow-2xl"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-data="{
                            rating: {{ $hasReviewed ? $myReview->rating : 0 }},
                            hoverRating: 0
                        }">

                        <div class="flex justify-between items-start mb-6">
                            <h3 class="text-2xl font-bebas text-white">
                                {{ $hasReviewed ? 'EDIT ULASAN ANDA' : 'BAGIKAN PENGALAMANMU' }}
                            </h3>
                            <button @click="showModal = false"
                                class="text-gray-400 hover:text-white text-2xl">&times;</button>
                        </div>

                        <form action="{{ route('customer.review.store') }}" method="POST">
                            @csrf

                            {{-- Input Bintang --}}
                            <div class="mb-6 text-center">
                                <label class="block text-gray-400 text-sm mb-2">Beri Rating (Wajib)</label>
                                <div class="flex justify-center gap-2">
                                    <input type="hidden" name="rating" :value="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="button" @mouseenter="hoverRating = {{ $i }}"
                                            @mouseleave="hoverRating = 0" @click="rating = {{ $i }}"
                                            class="focus:outline-none transition-transform duration-200 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-10 w-10 transition-colors duration-200"
                                                :class="(hoverRating >= {{ $i }} || (hoverRating === 0 && rating >=
                                                    {{ $i }})) ? 'text-yellow-400 fill-current' :
                                                'text-gray-600'"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </button>
                                    @endfor
                                </div>
                            </div>

                            {{-- Input Text (Isi value jika ada review sebelumnya) --}}
                            <div class="mb-6">
                                <label for="review" class="block text-gray-400 text-sm mb-2">Ulasan
                                    (Opsional)</label>
                                <textarea name="review" id="review" rows="4"
                                    class="w-full bg-black/30 border border-white/10 rounded-xl p-4 text-white focus:outline-none focus:border-[#e9d9c9] placeholder-gray-600 resize-none transition"
                                    placeholder="Ceritakan pengalaman seru kamu di sini...">{{ $hasReviewed ? $myReview->review : '' }}</textarea>
                            </div>

                            <button type="submit" :disabled="rating === 0"
                                :class="rating > 0 ? 'bg-[#e9d9c9] hover:bg-white text-black cursor-pointer' :
                                    'bg-gray-700 text-gray-500 cursor-not-allowed'"
                                class="w-full py-3 rounded-xl font-bold uppercase tracking-widest transition shadow-lg">
                                {{ $hasReviewed ? 'Update Ulasan' : 'Kirim Ulasan' }}
                            </button>
                        </form>
                    </div>
                </div>
            </template>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">

        {{-- KOLOM KIRI: STATISTIK --}}
        <div class="lg:col-span-1 bg-[#1a1a19] border border-white/10 rounded-2xl p-8 sticky top-28 shadow-xl">
            <h3 class="text-xl font-bold font-bebas text-white mb-6">RINGKASAN ULASAN</h3>
            <div class="flex items-baseline gap-2 mb-2">
                <span class="text-7xl font-bebas text-[#e9d9c9]">{{ number_format($averageRating, 1) }}</span>
                <span class="text-xl text-gray-500">/ 5.0</span>
            </div>
            <div class="flex text-yellow-400 mb-6 text-xl">
                @for ($i = 1; $i <= 5; $i++)
                    <span>{{ $i <= round($averageRating) ? '★' : '☆' }}</span>
                @endfor
            </div>
            <p class="text-sm text-gray-400 mb-8 border-b border-white/10 pb-6">Berdasarkan {{ $totalReviews }}
                ulasan pelanggan</p>
            <div class="space-y-3">
                @for ($i = 5; $i >= 1; $i--)
                    @php $percent = $totalReviews > 0 ? (($starCounts[$i] ?? 0) / $totalReviews) * 100 : 0; @endphp
                    <div class="flex items-center gap-3 text-sm">
                        <span class="w-3 font-bold">{{ $i }}</span>
                        <div class="flex-1 h-2 bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-[#e9d9c9]" style="width: {{ $percent }}%"></div>
                        </div>
                        <span class="w-8 text-right text-gray-500 text-xs">{{ $starCounts[$i] ?? 0 }}</span>
                    </div>
                @endfor
            </div>
        </div>

        {{-- KOLOM KANAN: DAFTAR ULASAN --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- FILTER BUTTONS --}}
            <div class="flex flex-wrap gap-3 mb-8">
                @foreach (['' => 'Semua', 'hari' => 'Hari Ini', 'minggu' => 'Minggu Ini', 'bulan' => 'Bulan Ini'] as $key => $label)
                    <a href="{{ route('review', ['filter' => $key]) }}"
                        class="px-5 py-2 rounded-full text-sm font-bold border transition {{ request('filter') == $key ? 'bg-[#e9d9c9] text-black border-[#e9d9c9]' : 'bg-white/5 text-gray-400 border-white/10' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            {{-- KHUSUS: KOTAK ULASAN SAYA --}}
            @if ($hasReviewed)
                <div
                    class="relative bg-gradient-to-r from-[#e9d9c9]/10 to-transparent border border-[#e9d9c9]/30 rounded-2xl p-6 mb-8 shadow-[0_0_20px_rgba(233,217,201,0.1)]">

                    <div class="flex items-start gap-5">
                        {{-- Avatar --}}
                        <div
                            class="w-12 h-12 shrink-0 rounded-full bg-[#e9d9c9] flex items-center justify-center text-black font-bold text-lg shadow-md uppercase">
                            {{ substr(session('nama'), 0, 2) }}
                        </div>

                        <div class="w-full">
                            {{-- HEADER--}}
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2">

                                {{-- Nama & Badge --}}
                                <div class="flex flex-wrap items-center gap-3">
                                    <h4 class="font-bold text-lg text-[#e9d9c9] leading-none">{{ session('nama') }}
                                    </h4>

                                    {{-- Badge Ulasan Anda --}}
                                    <span
                                        class="bg-[#e9d9c9] text-black text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider shadow-sm">
                                        Ulasan Anda
                                    </span>
                                </div>

                                {{-- Waktu --}}
                                <span class="text-xs text-gray-400 mt-1 sm:mt-0">
                                    {{ $myReview->created_at->diffForHumans() }}
                                </span>
                            </div>

                            {{-- Bintang --}}
                            <div class="flex text-yellow-400 text-sm mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span>{{ $i <= $myReview->rating ? '★' : '☆' }}</span>
                                @endfor
                            </div>

                            {{-- Isi Review --}}
                            <p class="text-gray-200 italic">
                                "{{ $myReview->review ?? ($myReview->feedback ?? 'Rating tanpa ulasan.') }}"
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- LIST ULASAN ORANG LAIN --}}
            @forelse($reviews as $review)
                {{-- Skip jika ini ulasan user sendiri (Cek pakai session user_id) --}}
                @if (session('user_id') && $review->customer_id == session('user_id'))
                    @continue
                @endif

                <div
                    class="bg-[#1a1a19] border border-white/10 rounded-2xl p-6 hover:border-[#e9d9c9]/30 transition shadow-lg">
                    <div class="flex items-start gap-5">
                        <div
                            class="w-12 h-12 shrink-0 rounded-full bg-white/10 flex items-center justify-center text-gray-300 font-bold text-lg uppercase">
                            {{ substr($review->user->name ?? 'User', 0, 2) }}
                        </div>
                        <div class="w-full">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2">
                                <h4 class="font-bold text-lg text-white">{{ $review->customer->nama ?? 'Pengguna' }}
                                </h4>
                                <span
                                    class="text-xs text-gray-500">{{ $review->created_at->translatedFormat('d F Y') }}</span>
                            </div>
                            <div class="flex text-yellow-400 text-sm mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                @endfor
                            </div>
                            <p class="text-gray-400 leading-relaxed text-sm">
                                "{{ $review->review ?? ($review->feedback ?? '-') }}"</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 text-gray-500">Belum ada ulasan lain.</div>
            @endforelse

            <div class="mt-10">{{ $reviews->links('pagination::tailwind') }}</div>
        </div>
    </div>
</div>
</x-Layout>
