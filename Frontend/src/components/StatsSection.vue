<template>
  <section class="py-14 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header (Screenshot 2) -->
      <div class="text-center mb-10">
        <h2 class="text-xl sm:text-2xl font-bold text-white tracking-tight">
          Interactive Stats Counters
        </h2>
        <p class="text-slate-400 text-xs sm:text-sm mt-1">
          High-fidelity conditions and exquisite stats counters.
        </p>
      </div>

      <!-- Stats Grid (Screenshots 2 & 4) -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
        <div
          v-for="(item, idx) in displayStats"
          :key="idx"
          class="relative group rounded-2xl p-[1px] transition-all duration-300"
          :class="getCardBorderClass(item.accent)"
        >
          <div class="h-full bg-[#0E1424]/80 backdrop-blur-md rounded-2xl p-6 flex flex-col items-center text-center transition-all group-hover:bg-[#121a30]">
            
            <!-- Value with neon glow -->
            <span
              class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-2 transition-transform duration-300 group-hover:scale-105"
              :class="getValueColorClass(item.accent)"
            >
              {{ item.value }}
            </span>

            <!-- Label -->
            <span class="text-xs sm:text-sm font-medium text-slate-300">
              {{ item.label }}
            </span>

          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  stats: {
    type: Array,
    default: () => [],
  }
})

const defaultStats = [
  { value: '50+', label: 'Projects Completed', accent: 'cyan' },
  { value: '99.9%', label: 'Uptime Architected', accent: 'emerald' },
  { value: '5+', label: 'Years Experience', accent: 'purple' },
  { value: '100%', label: 'Client Satisfaction', accent: 'pink' },
]

const displayStats = computed(() => {
  return (props.stats && props.stats.length > 0) ? props.stats : defaultStats
})

const getCardBorderClass = (accent) => {
  switch (accent) {
    case 'cyan':
      return 'bg-gradient-to-b from-cyan-500/40 via-cyan-500/10 to-transparent shadow-[0_0_20px_-5px_rgba(6,182,212,0.25)]'
    case 'emerald':
    case 'green':
      return 'bg-gradient-to-b from-emerald-500/40 via-emerald-500/10 to-transparent shadow-[0_0_20px_-5px_rgba(16,185,129,0.25)]'
    case 'purple':
      return 'bg-gradient-to-b from-purple-500/40 via-purple-500/10 to-transparent shadow-[0_0_20px_-5px_rgba(168,85,247,0.25)]'
    case 'pink':
    default:
      return 'bg-gradient-to-b from-pink-500/40 via-pink-500/10 to-transparent shadow-[0_0_20px_-5px_rgba(236,72,153,0.25)]'
  }
}

const getValueColorClass = (accent) => {
  switch (accent) {
    case 'cyan':
      return 'text-cyan-400 drop-shadow-[0_0_12px_rgba(6,182,212,0.6)]'
    case 'emerald':
    case 'green':
      return 'text-emerald-400 drop-shadow-[0_0_12px_rgba(16,185,129,0.6)]'
    case 'purple':
      return 'text-purple-400 drop-shadow-[0_0_12px_rgba(168,85,247,0.6)]'
    case 'pink':
    default:
      return 'text-pink-400 drop-shadow-[0_0_12px_rgba(236,72,153,0.6)]'
  }
}
</script>
