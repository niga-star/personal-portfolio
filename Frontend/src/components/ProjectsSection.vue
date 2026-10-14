<template>
  <section id="projects" class="py-20 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header (Screenshot 2) -->
      <div class="text-center mb-12">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          Featured Projects
        </h2>
        <p class="text-slate-400 text-sm sm:text-base mt-2 max-w-xl mx-auto">
          High-fidelity production systems and interactive case studies.
        </p>

        <!-- Reactive Filter Tabs (FR-01: No page reload) -->
        <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
          <button
            v-for="cat in categories"
            :key="cat"
            @click="activeCategory = cat"
            class="px-5 py-2 rounded-full text-xs sm:text-sm font-medium transition-all duration-200 capitalize"
            :class="activeCategory === cat ? 'bg-cyan-500 text-black font-semibold shadow-glow-cyan' : 'bg-white/[0.03] text-slate-400 border border-white/5 hover:text-white hover:bg-white/[0.06]'"
          >
            {{ cat }}
          </button>
        </div>
      </div>

      <!-- Projects Grid (Screenshot 2: Cards with Case Study >) -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        <div
          v-for="proj in filteredProjects"
          :key="proj.id"
          class="glass-card rounded-2xl overflow-hidden group flex flex-col justify-between"
        >
          <div>
            <!-- Card Thumbnail with Case Study Overlay -->
            <div class="relative h-48 w-full overflow-hidden bg-slate-900 cursor-pointer" @click="$emit('open-case-study', proj)">
              <img
                :src="proj.thumbnail_url"
                :alt="proj.title"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                loading="lazy"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-[#0E1424] via-transparent to-transparent opacity-80"></div>
              
              <!-- Category Badge -->
              <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-black/60 border border-white/10 text-cyan-400 text-xs font-mono backdrop-blur-md">
                {{ proj.category }}
              </span>

              <!-- Featured Star -->
              <span v-if="proj.is_featured" class="absolute top-3 right-3 px-2 py-0.5 rounded-full bg-amber-500/20 border border-amber-500/40 text-amber-400 text-[10px] font-mono flex items-center space-x-1 backdrop-blur-md">
                <span>★ Featured</span>
              </span>
            </div>

            <!-- Card Content -->
            <div class="p-6">
              <h3
                @click="$emit('open-case-study', proj)"
                class="text-xl font-bold text-white tracking-wide group-hover:text-cyan-300 transition-colors cursor-pointer mb-2"
              >
                {{ proj.title }}
              </h3>

              <p class="text-slate-400 text-xs sm:text-sm line-clamp-2 mb-4 leading-relaxed">
                {{ proj.summary }}
              </p>

              <!-- Skills Tech Pills (Screenshot 2: Next.js, Tailwind, etc.) -->
              <div class="flex flex-wrap gap-1.5 mb-4">
                <span
                  v-for="skill in proj.skills"
                  :key="skill.id"
                  class="px-2.5 py-1 rounded-md bg-white/[0.04] border border-white/10 text-[11px] font-mono text-slate-300"
                >
                  {{ skill.name }}
                </span>
              </div>
            </div>
          </div>

          <!-- Card Footer (Screenshot 2: Case Study > link and action buttons) -->
          <div class="p-6 pt-0 border-t border-white/5 flex items-center justify-between mt-auto">
            <button
              @click="$emit('open-case-study', proj)"
              class="text-xs sm:text-sm font-semibold text-cyan-400 hover:text-cyan-300 flex items-center space-x-1.5 group-hover:translate-x-1 transition-transform"
            >
              <span>Case Study</span>
              <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
            </button>

            <!-- External links -->
            <div class="flex items-center space-x-2">
              <a
                v-if="proj.github_url"
                :href="proj.github_url"
                target="_blank"
                rel="noopener"
                class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors"
                title="View Code on GitHub"
              >
                <TechIcons name="github" custom-class="w-4 h-4" />
              </a>
              <a
                v-if="proj.live_demo_url"
                :href="proj.live_demo_url"
                target="_blank"
                rel="noopener"
                class="p-1.5 rounded-lg text-slate-400 hover:text-cyan-400 hover:bg-white/5 transition-colors"
                title="Open Live Demo"
              >
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/>
                </svg>
              </a>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import TechIcons from './TechIcons.vue'

const props = defineProps({
  projects: {
    type: Array,
    default: () => [],
  }
})

defineEmits(['open-case-study'])

const activeCategory = ref('All')

const categories = ['All', 'Full-Stack', 'Backend', 'Frontend', 'Tools']

// Reactive Filtering (FR-01: No page reload)
const filteredProjects = computed(() => {
  if (activeCategory.value === 'All') {
    return props.projects
  }
  return props.projects.filter(p => {
    return p.category?.toLowerCase().includes(activeCategory.value.toLowerCase())
  })
})
</script>
