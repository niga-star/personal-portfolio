<template>
  <div v-if="project" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto">
    <!-- Backdrop Blur with dark overlay -->
    <div
      class="fixed inset-0 bg-black/80 backdrop-blur-md transition-opacity"
      @click="$emit('close')"
    ></div>

    <!-- Modal Dialog Window (Screenshot 2 Case Study) -->
    <div class="relative w-full max-w-3xl rounded-2xl bg-[#0d1424] border border-cyan-500/30 shadow-[0_0_50px_rgba(6,182,212,0.25)] overflow-hidden z-10 my-8">
      
      <!-- Modal Header -->
      <div class="relative h-48 sm:h-64 w-full overflow-hidden bg-slate-900">
        <img
          :src="project.thumbnail_url"
          :alt="project.title"
          class="w-full h-full object-cover opacity-60"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-[#0d1424] via-[#0d1424]/60 to-transparent"></div>

        <!-- Close Button -->
        <button
          @click="$emit('close')"
          class="absolute top-4 right-4 w-9 h-9 rounded-full bg-black/60 border border-white/20 text-white hover:text-cyan-400 hover:border-cyan-400 flex items-center justify-center transition-colors"
          aria-label="Close modal"
        >
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6L6 18M6 6l12 12"/>
          </svg>
        </button>

        <!-- Title & Category Overlay -->
        <div class="absolute bottom-4 left-6 right-6">
          <span class="inline-block px-3 py-1 rounded-full bg-cyan-500/20 border border-cyan-500/40 text-cyan-300 font-mono text-xs uppercase tracking-wider mb-2">
            {{ project.category }}
          </span>
          <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
            {{ project.title }}
          </h2>
        </div>
      </div>

      <!-- Modal Body (FR-02 Requirements) -->
      <div class="p-6 sm:p-8 space-y-6 max-h-[60vh] overflow-y-auto">
        
        <!-- 1. Executive Summary & Description -->
        <div>
          <h4 class="text-xs font-mono text-cyan-400 uppercase tracking-wider mb-2 flex items-center space-x-1.5">
            <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
            <span>Project Overview</span>
          </h4>
          <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
            {{ project.description }}
          </p>
        </div>

        <!-- 2. Problem Solved (የተፈታው ችግር - SRS FR-02) -->
        <div class="p-4 rounded-xl bg-cyan-950/20 border border-cyan-500/20">
          <h4 class="text-xs font-mono text-cyan-300 uppercase tracking-wider mb-2 flex items-center space-x-1.5">
            <svg class="w-4 h-4 text-cyan-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>The Challenge & Engineering Solution (የተፈታው ችግር)</span>
          </h4>
          <p class="text-slate-300 text-sm leading-relaxed">
            {{ project.problem_solved || 'Engineered high-performance data processing pipelines and decoupled reactive frontend components to eliminate bottlenecks and optimize throughput.' }}
          </p>
        </div>

        <!-- 3. Database Architecture & Relations (የዳታቤዝ ግንኙነት - SRS FR-02) -->
        <div class="p-4 rounded-xl bg-purple-950/20 border border-purple-500/20">
          <h4 class="text-xs font-mono text-purple-300 uppercase tracking-wider mb-2 flex items-center space-x-1.5">
            <svg class="w-4 h-4 text-purple-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <ellipse cx="12" cy="5" rx="9" ry="3"/>
              <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
              <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
            </svg>
            <span>Database Schema & Architecture (የዳታቤዝ ግንኙነት)</span>
          </h4>
          <p class="text-slate-300 text-sm leading-relaxed font-mono">
            {{ project.database_architecture || 'Strict 3NF MySQL relational design with foreign key constraints, composite indexation, and ACID compliance across critical transactions.' }}
          </p>
        </div>

        <!-- 4. Technologies Used (ጥቅም ላይ የዋሉ ቴክኖሎጂዎች) -->
        <div>
          <h4 class="text-xs font-mono text-slate-400 uppercase tracking-wider mb-3">
            Technologies & Tools
          </h4>
          <div class="flex flex-wrap gap-2">
            <span
              v-for="s in project.skills"
              :key="s.id"
              class="px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs font-medium text-slate-200 flex items-center space-x-1.5"
            >
              <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
              <span>{{ s.name }}</span>
            </span>
          </div>
        </div>

      </div>

      <!-- Modal Footer Action Links (Live Demo / GitHub) -->
      <div class="p-6 bg-[#090E1A] border-t border-white/10 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center space-x-3">
          <a
            v-if="project.live_demo_url"
            :href="project.live_demo_url"
            target="_blank"
            rel="noopener noreferrer"
            class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-semibold text-sm hover:opacity-95 shadow-glow-cyan flex items-center space-x-2"
          >
            <span>Live Demo</span>
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/>
            </svg>
          </a>

          <a
            v-if="project.github_url"
            :href="project.github_url"
            target="_blank"
            rel="noopener noreferrer"
            class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/15 text-white hover:text-cyan-400 hover:border-cyan-400 font-medium text-sm flex items-center space-x-2 transition-colors"
          >
            <TechIcons name="github" custom-class="w-4 h-4" />
            <span>GitHub Repository</span>
          </a>
        </div>

        <button
          @click="$emit('close')"
          class="text-xs font-mono text-slate-400 hover:text-white transition-colors"
        >
          Close [Esc]
        </button>
      </div>

    </div>
  </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue'
import TechIcons from './TechIcons.vue'

defineProps({
  project: {
    type: Object,
    default: null,
  }
})

const emit = defineEmits(['close'])

const handleKeydown = (e) => {
  if (e.key === 'Escape') {
    emit('close')
  }
}

onMounted(() => {
  window.addEventListener('keydown', handleKeydown)
})

onUnmounted(() => {
  window.removeEventListener('keydown', handleKeydown)
})
</script>
