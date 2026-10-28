<template>
  <section id="skills" class="py-20 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center mb-12">
        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-cyan-950/40 border border-cyan-500/30 text-cyan-400 font-mono text-xs uppercase tracking-wider mb-3">
          <span>CAPABILITIES</span>
        </div>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          Tech Stack & Expertise
        </h2>
        <p class="text-slate-400 text-sm sm:text-base mt-2 max-w-xl mx-auto">
          Modern languages, frameworks, and database architectures utilized in production.
        </p>

        <!-- Category Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
          <button
            v-for="cat in categories"
            :key="cat.id"
            type="button"
            @click="activeCategory = cat.id"
            class="px-4 py-2 rounded-full text-xs sm:text-sm font-medium transition-all duration-200 capitalize cursor-pointer"
            :class="activeCategory === cat.id ? 'bg-cyan-500/20 text-cyan-300 border border-cyan-500/50 shadow-glow-cyan/40 scale-105' : 'bg-white/[0.03] text-slate-400 border border-white/5 hover:text-white hover:bg-white/[0.06]'"
          >
            {{ cat.name }}
          </button>
        </div>
      </div>

      <!-- Skills Cards Grid -->
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-4 sm:gap-6">
        <div
          v-for="skill in filteredSkills"
          :key="skill.id || skill.name"
          class="glass-card rounded-2xl p-5 sm:p-6 flex flex-col items-center justify-center text-center group cursor-pointer relative overflow-hidden border border-white/10 hover:border-cyan-500/40 transition-all duration-300"
        >
          <!-- Corner Ambient Glow -->
          <div class="absolute -top-10 -right-10 w-24 h-24 bg-cyan-500/10 rounded-full blur-xl group-hover:bg-cyan-500/25 transition-all"></div>

          <!-- Tech Icon -->
          <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-white/[0.04] border border-white/10 flex items-center justify-center mb-3.5 transition-transform duration-300 group-hover:scale-110 group-hover:border-cyan-400/50 shadow-sm text-cyan-400">
            <TechIcons :name="skill.name" custom-class="w-6 h-6 sm:w-7 sm:h-7" />
          </div>

          <!-- Skill Name -->
          <h3 class="text-sm sm:text-base font-bold text-white tracking-wide group-hover:text-cyan-300 transition-colors">
            {{ skill.name }}
          </h3>

          <!-- Category Badge -->
          <span class="text-[10px] sm:text-[11px] font-mono text-slate-400 uppercase tracking-wider mt-1">
            {{ skill.category }}
          </span>

          <!-- Proficiency Progress Bar -->
          <div class="w-full bg-slate-800/80 rounded-full h-1.5 mt-4 overflow-hidden">
            <div
              class="h-full rounded-full transition-all duration-700 bg-gradient-to-r from-cyan-500 to-emerald-400 group-hover:shadow-[0_0_8px_rgba(6,182,212,0.8)]"
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

// Fallback skills if backend is loading or empty
const defaultSkills = [
  { id: 1, name: 'Laravel', category: 'backend', proficiency_percentage: 95 },
  { id: 2, name: 'Node.js', category: 'backend', proficiency_percentage: 90 },
  { id: 3, name: 'PHP', category: 'backend', proficiency_percentage: 95 },
  { id: 4, name: 'Vue.js', category: 'frontend', proficiency_percentage: 92 },
  { id: 5, name: 'React', category: 'frontend', proficiency_percentage: 88 },
  { id: 6, name: 'Next.js', category: 'frontend', proficiency_percentage: 85 },
  { id: 7, name: 'TypeScript', category: 'frontend', proficiency_percentage: 89 },
  { id: 8, name: 'Tailwind CSS', category: 'frontend', proficiency_percentage: 96 },
  { id: 9, name: 'MySQL', category: 'database', proficiency_percentage: 94 },
  { id: 10, name: 'PostgreSQL', category: 'database', proficiency_percentage: 88 },
  { id: 11, name: 'Redis', category: 'database', proficiency_percentage: 90 },
  { id: 12, name: 'Docker', category: 'tools', proficiency_percentage: 88 },
]

const displaySkills = computed(() => {
  return (props.skills && props.skills.length > 0) ? props.skills : defaultSkills
})

const filteredSkills = computed(() => {
  if (activeCategory.value === 'all') {
    return displaySkills.value
  }
  return displaySkills.value.filter(s => s.category?.toLowerCase() === activeCategory.value.toLowerCase())
})
</script>
