<template>
  <section id="skills" class="py-20 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header (Screenshot 2) -->
      <div class="text-center mb-12">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          Tech Stack Grid
        </h2>
        <p class="text-slate-400 text-sm sm:text-base mt-2 max-w-xl mx-auto">
          High-fidelity, responsive tech stack components and production competencies.
        </p>

        <!-- Category Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
          <button
            v-for="cat in categories"
            :key="cat.id"
            @click="activeCategory = cat.id"
            class="px-4 py-1.5 rounded-full text-xs sm:text-sm font-medium transition-all duration-200 capitalize"
            :class="activeCategory === cat.id ? 'bg-cyan-500/20 text-cyan-300 border border-cyan-500/50 shadow-glow-cyan/30' : 'bg-white/[0.03] text-slate-400 border border-white/5 hover:text-white hover:bg-white/[0.06]'"
          >
            {{ cat.name }}
          </button>
        </div>
      </div>

      <!-- Skills Cards Grid (Screenshot 2: High-fidelity Cards) -->
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-4 sm:gap-6">
        <div
          v-for="skill in filteredSkills"
          :key="skill.id"
          class="glass-card rounded-2xl p-6 flex flex-col items-center justify-center text-center group cursor-pointer relative overflow-hidden"
        >
          <!-- Corner Ambient Glow -->
          <div class="absolute -top-10 -right-10 w-24 h-24 bg-cyan-500/10 rounded-full blur-xl group-hover:bg-cyan-500/25 transition-all"></div>

          <!-- Tech Icon -->
          <div class="w-14 h-14 rounded-xl bg-white/[0.04] border border-white/10 flex items-center justify-center mb-4 transition-transform duration-300 group-hover:scale-110 group-hover:border-cyan-400/50 shadow-sm text-cyan-400">
            <TechIcons :name="skill.name" custom-class="w-7 h-7" />
          </div>

          <!-- Skill Name -->
          <h3 class="text-base font-bold text-white tracking-wide group-hover:text-cyan-300 transition-colors">
            {{ skill.name }}
          </h3>

          <!-- Category Badge -->
          <span class="text-[11px] font-mono text-slate-400 uppercase tracking-wider mt-1">
            {{ skill.category }}
          </span>

          <!-- Proficiency Progress Bar -->
          <div class="w-full bg-slate-800/80 rounded-full h-1.5 mt-4 overflow-hidden">
            <div
              class="h-full rounded-full transition-all duration-500 bg-gradient-to-r from-cyan-500 to-emerald-400 group-hover:shadow-[0_0_8px_rgba(6,182,212,0.8)]"
              :style="{ width: `${skill.proficiency_percentage || 85}%` }"
            ></div>
          </div>
          <span class="text-[10px] font-mono text-slate-500 mt-1.5 self-end">
            {{ skill.proficiency_percentage || 85 }}%
          </span>

        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import TechIcons from './TechIcons.vue'

const props = defineProps({
  skills: {
    type: Array,
    default: () => [],
  }
})

const activeCategory = ref('all')

const categories = [
  { id: 'all', name: 'All Technologies' },
  { id: 'backend', name: 'Backend' },
  { id: 'frontend', name: 'Frontend' },
  { id: 'database', name: 'Database' },
  { id: 'tools', name: 'DevOps & Tools' },
]

const filteredSkills = computed(() => {
  if (activeCategory.value === 'all') {
    return props.skills
  }
  return props.skills.filter(s => s.category?.toLowerCase() === activeCategory.value)
})
</script>
