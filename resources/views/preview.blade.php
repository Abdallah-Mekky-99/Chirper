<x-layout title="Design Preview">
    <div class="space-y-6">
        {{-- 1. MOCK COMPOSE AREA --}}
        <div class="bg-base-100 rounded-2xl border border-base-200 p-4 shadow-sm">
            <div class="flex gap-4">
                <div class="avatar">
                    <div class="w-12 h-12 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img src="https://i.pravatar.cc/150?u=me" alt="My Avatar" />
                    </div>
                </div>
                <div class="flex-1">
                    <textarea 
                        placeholder="What's happening?" 
                        class="textarea textarea-ghost w-full text-xl resize-none focus:bg-transparent min-h-[120px] p-0 focus:outline-none"
                    ></textarea>
                    
                    <div class="divider my-2 opacity-50"></div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex gap-1">
                            <button class="btn btn-ghost btn-sm btn-circle text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            </button>
                            <button class="btn btn-ghost btn-sm btn-circle text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h7"/><path d="M16 19h6"/><path d="M19 16v6"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            </button>
                        </div>
                        <button class="btn btn-primary rounded-full px-6 btn-sm">Chirp</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. MOCK FEED --}}
        <div class="space-y-4">
            
            {{-- Chirp 1 --}}
            <div class="bg-base-100 rounded-2xl border border-base-200 p-4 hover:bg-base-200/30 transition-colors cursor-pointer group shadow-sm">
                <div class="flex gap-4">
                    <div class="avatar">
                        <div class="w-12 h-12 rounded-full">
                            <img src="https://i.pravatar.cc/150?u=alex" alt="Alex" />
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-bold hover:underline">Alex Rivers</span>
                            <span class="text-sm opacity-50">@arivers · 2h</span>
                        </div>
                        <p class="mt-1 text-base leading-relaxed">
                            Just finished the new landing page for the project. The glassmorphism effects are looking really slick with the new theme! 🚀 #webdev #design
                        </p>
                        
                        {{-- Mock Image --}}
                        <div class="mt-3 rounded-2xl overflow-hidden border border-base-200 aspect-video bg-base-300 relative">
                             <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Project preview">
                        </div>

                        <div class="flex justify-between mt-4 max-w-md opacity-60">
                            <button class="flex items-center gap-2 hover:text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                <span class="text-xs font-medium">12</span>
                            </button>
                            <button class="flex items-center gap-2 hover:text-success transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m17 2 4 4-4 4"/><path d="M3 11v-1a4 4 0 0 1 4-4h14"/><path d="m7 22-4-4 4-4"/><path d="M21 13v1a4 4 0 0 1-4 4H3"/></svg>
                                <span class="text-xs font-medium">5</span>
                            </button>
                            <button class="flex items-center gap-2 hover:text-error transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                <span class="text-xs font-medium">42</span>
                            </button>
                            <button class="flex items-center gap-2 hover:text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" x2="12" y1="2" y2="15"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chirp 2 --}}
            <div class="bg-base-100 rounded-2xl border border-base-200 p-4 hover:bg-base-200/30 transition-colors cursor-pointer group shadow-sm">
                <div class="flex gap-4">
                    <div class="avatar">
                        <div class="w-12 h-12 rounded-full">
                            <img src="https://i.pravatar.cc/150?u=sarah" alt="Sarah" />
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-bold hover:underline">Sarah Jenkins</span>
                            <span class="text-sm opacity-50">@sarahcodes · 5h</span>
                        </div>
                        <p class="mt-1 text-base leading-relaxed">
                            PHP 8.4 is coming with some amazing features. Property hooks are going to change how we write our models! 🐘💻
                        </p>

                        <div class="flex justify-between mt-4 max-w-md opacity-60">
                            <button class="flex items-center gap-2 hover:text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                <span class="text-xs font-medium">3</span>
                            </button>
                            <button class="flex items-center gap-2 hover:text-success transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m17 2 4 4-4 4"/><path d="M3 11v-1a4 4 0 0 1 4-4h14"/><path d="m7 22-4-4 4-4"/><path d="M21 13v1a4 4 0 0 1-4 4H3"/></svg>
                                <span class="text-xs font-medium">1</span>
                            </button>
                            <button class="flex items-center gap-2 hover:text-error transition-colors text-error opacity-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                <span class="text-xs font-bold">128</span>
                            </button>
                            <button class="flex items-center gap-2 hover:text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" x2="12" y1="2" y2="15"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
