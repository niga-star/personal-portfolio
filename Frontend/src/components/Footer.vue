<template>
  <footer class="py-12 bg-[#06080E] border-t border-white/10 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Top Grid: Brand & Navigation Links -->
      <div class="grid grid-cols-1 md:grid-cols-12 gap-8 pb-8 border-b border-white/10 items-center">
        
        <!-- Brand & Description -->
        <div class="md:col-span-5 flex flex-col items-center md:items-start text-center md:text-left">
          <button
            type="button"
            @click="$emit('navigate', { id: 'home', type: 'page', page: 'home' })"
            class="flex items-center space-x-2.5 group cursor-pointer"
          >
            <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 animate-pulse"></span>
            <span class="text-xl font-bold font-mono text-white tracking-wider group-hover:text-cyan-300 transition-colors">
              {{ brandName || 'DEV.CRAFT' }}
            </span>
          </button>
          <p class="text-xs text-slate-400 mt-2 max-w-sm leading-relaxed">
            Full-Stack Software Engineering Portfolio built with Laravel 11, Vue 3, Vite, and MySQL. Designed for maximum performance, responsiveness, and clean architecture.
          </p>
        </div>

        <!-- Quick Navigation Links -->
        <div class="md:col-span-4 flex flex-wrap items-center justify-center md:justify-start gap-x-6 gap-y-2 text-xs font-mono">
          <button
            type="button"
            @click="$emit('navigate', { id: 'home', type: 'page', page: 'home' })"
            class="text-slate-400 hover:text-cyan-400 transition-colors"
          >
            Home
          </button>
          <button
            type="button"
            @click="$emit('navigate', { id: 'about', type: 'page', page: 'about' })"
            class="text-slate-400 hover:text-cyan-400 transition-colors"
          >
            About
          </button>
          <button
            type="button"
            @click="$emit('navigate', { id: 'projects', type: 'section', target: 'projects' })"
            class="text-slate-400 hover:text-cyan-400 transition-colors"
          >
            Projects
          </button>
          <button
            type="button"
            @click="$emit('navigate', { id: 'skills', type: 'section', target: 'skills' })"
            class="text-slate-400 hover:text-cyan-400 transition-colors"
          >
            Skills
          </button>
          <button
            type="button"
            @click="$emit('navigate', { id: 'contact', type: 'section', target: 'contact' })"
            class="text-slate-400 hover:text-cyan-400 transition-colors"
          >
            Contact
          </button>
        </div>

        <!-- Back to Top Button -->
        <div class="md:col-span-3 flex justify-center md:justify-end">
          <button
            type="button"
            @click="scrollToTop"
            class="px-3.5 py-2 rounded-xl bg-white/[0.04] border border-white/10 hover:border-cyan-400/40 text-slate-300 hover:text-cyan-400 text-xs font-mono flex items-center space-x-1.5 transition-all"
          >
            <span>Back to top</span>
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 15l-6-6-6 6"/>
            </svg>
          </button>
        </div>

      </div>

      <!-- Bottom Row: Badges & Latency -->
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 text-xs text-slate-400">
        
        <!-- Live Tech Stack Badges -->
        <div class="flex flex-wrap items-center justify-center gap-2 text-[11px] font-mono">
          <span class="px-2.5 py-1 rounded-md bg-white/5 border border-white/10 text-cyan-400">Laravel 11</span>
          <span class="px-2.5 py-1 rounded-md bg-white/5 border border-white/10 text-emerald-400">Vue 3 (Vite)</span>
          <span class="px-2.5 py-1 rounded-md bg-white/5 border border-white/10 text-amber-400">MySQL 8</span>
          <span class="px-2.5 py-1 rounded-md bg-white/5 border border-white/10 text-teal-400">Tailwind CSS</span>
        </div>

        <!-- Copyright -->
        <span class="text-[11px] text-slate-500 text-center sm:text-right">
          &copy; {{ new Date().getFullYear() }} {{ developerName || 'Alex Rivera' }}. All rights reserved.
        </span>

      </div>
    </div>
  </footer>
</template>

<script setup>
defineProps({
  brandName: String,
  developerName: String,
})

defineEmits(['navigate'])

const scrollToTop = () => {
  window.scrollTo({ top: 0, behavior: 'smooth' })
}
</script>
