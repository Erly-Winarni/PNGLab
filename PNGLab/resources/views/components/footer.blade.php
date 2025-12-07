<footer class="bg-white border-t border-gray-200 shadow-inner">
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="col-span-2 md:col-span-1 space-y-4">
                <a href="/" class="flex items-center text-2xl font-extrabold text-[#193053]">
                    <img src="{{ asset('images/Logo-PNGLab.png') }}" alt="Logo PNGLab" class="h-8 w-auto mr-2">
                    PNGLab
                </a>
                <p class="text-sm text-gray-600">
                    Kembangkan Kreativitas. Kuasai Desain.
                </p>
            </div>

            <div>
                <h4 class="text-md font-bold text-[#193053] mb-3 border-b border-[#446AA6]/50 pb-1">Ikuti Kami</h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="https://www.instagram.com/rlyy.zz?igsh=MXZqdHZheWtsaGc4NA%3D%3D&utm_source=qr" target="_blank" class="text-gray-600 hover:text-[#446AA6] transition flex items-center space-x-2">
                            <img src="{{ asset('images/icon-ig.png') }}" alt="Instagram" class="w-5 h-5 object-contain">
                            <span>Instagram</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="https://youtube.com/@windahbasudara?si=TByjuTYhxiKxdkXm" target="_blank" class="text-gray-600 hover:text-[#446AA6] transition flex items-center space-x-2">
                            <img src="{{ asset('images/icon-yt.png') }}" alt="Twitter / X" class="w-5 h-5 object-contain">
                            <span>Youtube</span>
                        </a>
                    </li>
                   
                    <li>
                        <a href="https://linkedin.com/in/erly-winarni" target="_blank" class="text-gray-600 hover:text-[#446AA6] transition flex items-center space-x-2">
                            <img src="{{ asset('images/icon-link.png') }}" alt="LinkedIn" class="w-5 h-5 object-contain">
                            <span>LinkedIn</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-md font-bold text-[#193053] mb-3 border-b border-[#446AA6]/50 pb-1">Kontak</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><strong class="text-[#193053]">Email:</strong> info@pnglab.com</li>
                    <li><strong class="text-[#193053]">Alamat:</strong> Makasssar, Sulawesi Selatan</li>
                    <li><strong class="text-[#193053]">Jam Kerja:</strong> Sen-Jum, 09:00 - 17:00</li>
                </ul>
            </div>

            <div class="col-span-2 md:col-span-1">
                <h4 class="text-md font-bold text-[#193053] mb-3 border-b border-[#446AA6]/50 pb-1">Bergabung</h4>
                <p class="text-sm text-gray-600 mb-3">
                    Ingin berbagi pengetahuan?
                </p>
                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-[#52A397] text-white rounded-full font-semibold hover:bg-[#2f655d] transition shadow-md">
                    Daftar sebagai Guru →
                </a>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} PNGLab. Final Project LAB WEB Sistem Informasi 2024.
            </p>
        </div>
    </div>
</footer>