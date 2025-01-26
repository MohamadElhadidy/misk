 <div id="top-nav" class="top-nav md:h-[44px] h-[30px] border-b border-line">
     <div class="container mx-auto h-full">
         <div class="top-nav-main flex justify-between max-md:justify-center h-full">
             <div class="left-content flex items-center">
                 <ul class="flex items-center gap-5">
                     <li>
                         <a href="about" class="caption2 hover:underline"> About </a>
                     </li>
                     <li>
                         <a href="contact" class="caption2 hover:underline"> Contact </a>
                     </li>
                     <li>
                         <a href="locations" class="caption2 hover:underline"> Store Location </a>
                     </li>
                 </ul>
             </div>
             <div class="right-content flex items-center gap-5 max-md:hidden">
                 <div class="choose-type choose-language flex items-center gap-1.5">
                     <div class="select relative">
                         <p class="selected caption2">English</p>
                         <ul class="list-option bg-white">
                             <li data-item="English" class="caption2 active">English</li>
                         </ul>
                     </div>
                     <i class="ph ph-caret-down text-xs"></i>
                 </div>
                 <div class="choose-type choose-currency flex items-center gap-1.5">
                     <div class="select relative">
                         <p class="selected caption2">USD</p>
                         <ul class="list-option bg-white">
                             <li data-item="USD" class="caption2 active">USD</li>
                         </ul>
                     </div>
                     <i class="ph ph-caret-down text-xs"></i>
                 </div>
                 <a href="https://www.facebook.com/" target="_blank">
                     <i class="icon-facebook"></i>
                 </a>
                 <a href="https://www.instagram.com/" target="_blank">
                     <i class="icon-instagram"></i>
                 </a>


                 @admin
                     <a href="{{ route('admin') }}" target="_blank"
                         class="rounded-md bg-black px-3 py-2 text-sm font-semibold text-gray-200 shadow-xs hover:bg-gray-800 focus-visible:outline-2 ">Admin</a>
                 @endadmin
             </div>
         </div>
     </div>
 </div>
