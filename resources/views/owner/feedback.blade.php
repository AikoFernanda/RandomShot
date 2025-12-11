<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Alpine Data untuk Mengatur Tab --}}
    <div class="min-h-screen text-[#F4EFE7]" x-data="{ activeTab: 'feedback' }">

        {{-- HEADER & FILTER --}}
        <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between mb-8 gap-4">
            <div>
                <h1 class="text-4xl font-bebas tracking-wide text-[#F4EFE7]">SUARA PELANGGAN</h1>
                <p class="text-gray-400 text-sm mt-1">Dengarkan masukan dan pantau kepuasan pelanggan.</p>
            </div>

            {{-- FORM FILTER PERIODE --}}
            <form method="GET" action="{{ route('owner.feedback') }}" class="flex flex-wrap items-end gap-3 bg-[#3C3D37] p-2 rounded-xl border border-white/5 shadow-lg">
                <div>
                    <label class="text-[10px] text-gray-400 uppercase font-bold px-1">Dari</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" 
                        class="bg-[#181C14] text-white text-xs p-2 rounded border border-white/10 focus:border-[#e9d9c9] outline-none [color-scheme:dark]">
                </div>
                <div>
                    <label class="text-[10px] text-gray-400 uppercase font-bold px-1">Sampai</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" 
                        class="bg-[#181C14] text-white text-xs p-2 rounded border border-white/10 focus:border-[#e9d9c9] outline-none [color-scheme:dark]">
                </div>
                <button type="submit" class="bg-[#e9d9c9] hover:bg-white text-black font-bold text-xs px-4 py-2.5 rounded transition shadow-lg">
                    Filter
                </button>
            </form>
        </div>

        {{-- NAVIGASI TAB --}}
        <div class="flex border-b border-white/10 mb-8">
            {{-- Tombol Tab 1 --}}
            <button @click="activeTab = 'feedback'"
                class="px-6 py-3 text-sm font-bold tracking-wide uppercase transition border-b-2"
                :class="activeTab === 'feedback' ? 'text-[#e9d9c9] border-[#e9d9c9]' : 'text-gray-500 border-transparent hover:text-white'">
                💬 Feedback & Saran
                <span class="ml-2 bg-[#3C3D37] px-2 py-0.5 rounded text-xs text-white">{{ count($feedbacks) }}</span>
            </button>

            {{-- Tombol Tab 2 --}}
            <button @click="activeTab = 'rating'"
                class="px-6 py-3 text-sm font-bold tracking-wide uppercase transition border-b-2"
                :class="activeTab === 'rating' ? 'text-[#e9d9c9] border-[#e9d9c9]' : 'text-gray-500 border-transparent hover:text-white'">
                ⭐ Rating & Ulasan
                <span class="ml-2 bg-[#3C3D37] px-2 py-0.5 rounded text-xs text-white">{{ count($reviews) }}</span>
            </button>
        </div>


        {{--  TAB KONTEN 1: FEEDBACK (TEXT ONLY)  --}}
        <div x-show="activeTab === 'feedback'" x-transition.opacity>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($feedbacks as $item)
                    <div class="bg-[#3C3D37] border border-white/5 p-6 rounded-xl shadow-lg hover:border-[#e9d9c9]/30 transition group flex flex-col h-full">
                        {{-- Header Card --}}
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#e9d9c9] to-[#8d7b68] p-[1px]">
                                <div class="w-full h-full rounded-full bg-[#3C3D37] flex items-center justify-center font-bold text-[#e9d9c9] text-sm">
                                    {{ substr($item->customer->nama ?? 'G', 0, 1) }}
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-sm">{{ $item->customer->nama ?? 'Guest' }}</h4>
                                <p class="text-[10px] text-gray-400">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                            </div>
                        </div>

                        {{-- Isi Pesan --}}
                        <div class="flex-1 relative">
                            <svg class="absolute -top-2 -left-2 w-6 h-6 text-[#e9d9c9]/20 transform -scale-x-100" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16H9C9 14.9385 9.77385 13.9317 10.7554 13.6268L11.6657 13.3441L11.0669 11.4158L10.1566 11.6985C7.9945 12.37 6.6383 14.5098 7.07897 16.7884L7.54133 19.1802C7.86536 20.8562 9.32832 21 11.034 21H14.017ZM21.017 21L21.017 18C21.017 16.8954 20.1216 16 19.017 16H16C16 14.9385 16.7739 13.9317 17.7554 13.6268L18.6657 13.3441L18.0669 11.4158L17.1566 11.6985C14.9945 12.37 13.6383 14.5098 14.079 16.7884L14.5413 19.1802C14.8654 20.8562 16.3283 21 18.034 21H21.017Z" /></svg>
                            <p class="text-sm text-gray-300 italic leading-relaxed pl-4">
                                "{{ $item->feedback }}"
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center border border-dashed border-white/10 rounded-xl bg-white/5">
                        <p class="text-gray-500">Belum ada feedback teks pada periode ini.</p>
                    </div>
                @endforelse
            </div>
        </div>


        {{--  TAB KONTEN 2: RATING & REVIEWS  --}}
        <div x-show="activeTab === 'rating'" x-cloak x-transition.opacity>
            
            {{-- SUMMARY STATISTIK (Hanya muncul di tab Rating) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                {{-- SKOR UTAMA --}}
                <div class="bg-[#3C3D37] p-6 rounded-xl border border-white/5 flex flex-col justify-center items-center text-center shadow-lg">
                    <h2 class="text-5xl font-bebas text-[#e9d9c9]">{{ number_format($avgRating, 1) }}</h2>
                    <div class="flex gap-1 text-yellow-500 my-2">
                        @for($i=1; $i<=5; $i++)
                            @if($i <= round($avgRating))
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                            @else
                                <svg class="w-5 h-5 text-gray-600 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                            @endif
                        @endfor
                    </div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Total {{ $totalRatingCount }} Ulasan</p>
                </div>

                {{-- DISTRIBUSI BINTANG --}}
                <div class="col-span-2 bg-[#3C3D37] p-6 rounded-xl border border-white/5 shadow-lg flex flex-col justify-center">
                    <div class="space-y-2">
                        @foreach(range(5, 1) as $star)
                            @php 
                                $count = $starDistribution[$star] ?? 0;
                                $percent = $totalRatingCount > 0 ? ($count / $totalRatingCount) * 100 : 0;
                            @endphp
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold text-gray-400 w-3">{{ $star }}</span>
                                <svg class="w-3 h-3 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                <div class="flex-1 h-1.5 bg-black/30 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#e9d9c9] rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                                </div>
                                <span class="text-xs text-gray-500 w-8 text-right">{{ $count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- DAFTAR REVIEW --}}
            <div class="space-y-4">
                @forelse($reviews as $rev)
                    <div class="bg-[#3C3D37] border-l-4 border-[#e9d9c9] rounded-r-xl p-5 shadow-lg hover:bg-white/5 transition">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                {{-- Avatar Kecil --}}
                                <div class="w-8 h-8 rounded-full bg-[#181C14] flex items-center justify-center font-bold text-[#e9d9c9] text-xs">
                                    {{ substr($rev->customer->nama ?? 'G', 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-sm">{{ $rev->customer->nama ?? 'Guest' }}</h4>
                                    <div class="flex text-yellow-500 text-[10px] mt-0.5">
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $rev->rating)
                                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <span class="text-[10px] text-gray-500">{{ \Carbon\Carbon::parse($rev->created_at)->format('d M Y') }}</span>
                        </div>
                        
                        @if($rev->review)
                            <p class="text-sm text-gray-300 italic">"{{ $rev->review }}"</p>
                        @endif
                    </div>
                @empty
                    <div class="py-12 text-center border border-dashed border-white/10 rounded-xl bg-white/5">
                        <p class="text-gray-500">Belum ada rating pada periode ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-layout-owner>