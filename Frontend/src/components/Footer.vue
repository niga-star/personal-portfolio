<template>
  <footer class="py-12 bg-[#06080E] border-t border-white/10 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row items-center justify-between gap-6">
        
        <!-- Brand & Description -->
        <div class="flex flex-col items-center md:items-start text-center md:text-left">
          <div class="flex items-center space-x-2">
            <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 animate-pulse"></span>
            <span class="text-lg font-bold font-mono text-white tracking-wider">
              {{ brandName || 'DEV.CRAFT' }}
            </span>
          </div>
          <p class="text-xs text-slate-400 mt-1 max-w-sm">
            Full-Stack Software Engineering Portfolio built strictly with Laravel 11, Vue 3, Vite, and MySQL 8.
          </p>
        </div>

        <!-- Live Tech Stack Badges -->
        <div class="flex flex-wrap items-center justify-center gap-2 text-[11px] font-mono text-slate-400">
          <span class="px-2.5 py-1 rounded-md bg-white/5 border border-white/10 text-cyan-400">Laravel 11</span>
          <span class="px-2.5 py-1 rounded-md bg-white/5 border border-white/10 text-emerald-400">Vue 3 (Vite)</span>
          <span class="px-2.5 py-1 rounded-md bg-white/5 border border-white/10 text-amber-400">MySQL 8</span>
          <span class="px-2.5 py-1 rounded-md bg-white/5 border border-white/10 text-teal-400">Tailwind CSS</span>
        </div>

        <!-- Latency / Uptime Indicator & Copyright -->
        <div class="flex flex-col items-center md:items-end text-xs text-slate-400">
          <div class="flex items-center space-x-1.5 text-emerald-400 text-[11px] font-mono">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
            <span>API Latency &lt; 45ms (NFR-01)</span>
          </div>
          <span class="text-[11px] text-slate-500 mt-1">
            &copy; {{ new Date().getFullYear() }} {{ developerName || 'Full-Stack Developer' }}. All rights reserved.
          </span>
        </div>

      </div>
    </div>
  </footer>
</template>

<script setup>
defineProps({
  brandName: String,
  developerName: String,
})
</script>
