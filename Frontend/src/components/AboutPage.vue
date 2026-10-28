<template>
  <div class="pt-28 pb-20 md:pt-36 md:pb-28 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Ambient Glows -->
      <div class="mesh-glow-purple -top-10 left-[-100px] w-[500px] h-[500px] opacity-30"></div>
      <div class="mesh-glow-cyan top-96 right-[-80px] w-[500px] h-[500px] opacity-25"></div>

      <!-- Breadcrumb Bar -->
      <nav class="flex items-center space-x-2 text-xs font-mono text-slate-400 mb-8" aria-label="Breadcrumb">
        <button
          @click="$emit('navigate-page', 'home')"
          class="hover:text-cyan-400 flex items-center space-x-1.5 transition-colors"
        >
          <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
          <span>Home</span>
        </button>
        <span class="text-slate-600">/</span>
        <span class="text-cyan-400 font-semibold">About Me</span>
      </nav>

      <!-- Page Header -->
      <div class="mb-14">
        <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-purple-950/40 border border-purple-500/30 text-purple-300 font-mono text-xs uppercase tracking-wider mb-4 backdrop-blur-md">
          <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse"></span>
          <span>ENGINEERING PROFILE & STORY</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight mb-4">
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-400 to-cyan-400">
            {{ profile.about_heading || 'About Me' }}
          </span>
        </h1>
        <p class="text-slate-300 text-base sm:text-xl font-medium max-w-3xl leading-relaxed">
          {{ profile.about_lead || 'My passion for bridging robust back-end systems with pixel-perfect interfaces.' }}
        </p>
      </div>

      <!-- Main About Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start mb-24">
        
        <!-- Left: Portrait Photo Stage & Quick Facts -->
        <div class="lg:col-span-5 flex flex-col items-center">
          
          <!-- Portrait Container Frame -->
          <div class="relative w-64 sm:w-72 lg:w-80 aspect-[4/5] rounded-3xl p-[2px] bg-gradient-to-tr from-cyan-400 via-purple-500 to-pink-500 shadow-[0_0_40px_rgba(168,85,247,0.35)] mb-6 group">
            <div class="w-full h-full rounded-[22px] overflow-hidden bg-[#0a0f1d] relative">
              <img
                :src="avatarUrl"
                :alt="profile.developer_name || 'Alex Rivera'"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                loading="lazy"
                decoding="async"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-[#080B11]/80 via-transparent to-transparent"></div>
              
              <!-- Bottom Name Overlay -->
              <div class="absolute bottom-4 left-4 right-4">
                <p class="text-white font-bold text-base">{{ profile.developer_name || 'Alex Rivera' }}</p>
                <p class="text-cyan-400 font-mono text-xs">{{ profile.tagline || 'Full-Stack Developer // Specialist' }}</p>
              </div>
            </div>

            <!-- Floating Status Badge -->
            <div class="absolute -top-3 -right-3 px-3 py-1 rounded-full bg-[#080B11]/90 border border-emerald-500/40 text-emerald-300 text-xs font-mono shadow-md flex items-center space-x-1.5 backdrop-blur-md">
              <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
              <span>Available</span>
            </div>
          </div>

          <!-- Social Links Row -->
          <div class="flex items-center space-x-3 mb-6">
            <a
              v-if="profile.github_url"
              :href="profile.github_url"
              target="_blank"
              rel="noopener noreferrer"
              class="w-10 h-10 rounded-xl bg-white/[0.04] border border-white/10 flex items-center justify-center text-slate-300 hover:text-cyan-400 hover:border-cyan-400/50 hover:bg-white/[0.08] transition-all"
              title="GitHub"
            >
              <TechIcons name="github" custom-class="w-5 h-5" />
            </a>
            <a
              v-if="profile.linkedin_url"
              :href="profile.linkedin_url"
              target="_blank"
              rel="noopener noreferrer"
              class="w-10 h-10 rounded-xl bg-white/[0.04] border border-white/10 flex items-center justify-center text-slate-300 hover:text-cyan-400 hover:border-cyan-400/50 hover:bg-white/[0.08] transition-all"
              title="LinkedIn"
            >
              <TechIcons name="linkedin" custom-class="w-5 h-5" />
            </a>
            <a
              v-if="profile.twitter_url"
              :href="profile.twitter_url"
              target="_blank"
              rel="noopener noreferrer"
              class="w-10 h-10 rounded-xl bg-white/[0.04] border border-white/10 flex items-center justify-center text-slate-300 hover:text-cyan-400 hover:border-cyan-400/50 hover:bg-white/[0.08] transition-all"
              title="Twitter / X"
            >
              <TechIcons name="twitter" custom-class="w-4 h-4" />
            </a>
            <a
              v-if="profile.telegram_url"
              :href="profile.telegram_url"
              target="_blank"
              rel="noopener noreferrer"
              class="w-10 h-10 rounded-xl bg-white/[0.04] border border-white/10 flex items-center justify-center text-slate-300 hover:text-cyan-400 hover:border-cyan-400/50 hover:bg-white/[0.08] transition-all"
              title="Telegram"
            >
              <TechIcons name="telegram" custom-class="w-5 h-5" />
            </a>
          </div>

          <!-- Quick Facts Card -->
          <div class="w-full max-w-sm glass-card rounded-2xl p-5 border border-white/10 space-y-3">
            <h4 class="text-xs font-mono uppercase tracking-wider text-slate-400 border-b border-white/10 pb-2">
              Quick Facts
            </h4>
            <div class="flex items-center justify-between text-xs">
              <span class="text-slate-400">Location:</span>
              <span class="text-white font-medium">Worldwide (Remote)</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <span class="text-slate-400">Core Stack:</span>
              <span class="text-cyan-300 font-medium">Laravel 11, Vue 3, MySQL</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <span class="text-slate-400">Experience:</span>
              <span class="text-emerald-400 font-medium">5+ Years Professional</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <span class="text-slate-400">Languages:</span>
              <span class="text-purple-300 font-medium">PHP, JS, TypeScript, SQL</span>
            </div>
          </div>

        </div>

        <!-- Right: In-depth Story & Philosophy -->
        <div class="lg:col-span-7 flex flex-col space-y-8">
          
          <!-- Narrative Section -->
          <div class="glass-card rounded-2xl p-6 sm:p-8 border border-white/10">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center space-x-2">
              <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
              <span>Engineering Journey & Vision</span>
            </h3>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-4">
              {{ profile.about_bio || 'As a Senior Full-Stack Developer, I specialize in crafting high-concurrency Laravel APIs, resilient MySQL database schemas, and reactive, glassmorphic Vue 3 user interfaces. I believe software engineering is an art that blends airtight backend security, clean design patterns, and memorable user experiences.' }}
            </p>
            <p class="text-slate-400 text-sm leading-relaxed">
              Throughout my engineering journey, I have had the privilege to architect enterprise SaaS dashboards, lead development squads, optimize relational database queries for high throughput, and craft pixel-perfect user interfaces that delight end-users.
            </p>
          </div>

          <!-- 4 Core Pillars Grid -->
          <div>
            <h3 class="text-lg font-bold text-white mb-4">Core Engineering Pillars</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              
              <!-- Pillar 1 -->
              <div class="glass-card rounded-xl p-4 border border-cyan-500/20">
                <div class="w-8 h-8 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 mb-2.5">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                  </svg>
                </div>
                <h4 class="text-sm font-bold text-white mb-1">High Performance & Scalability</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                  Optimized database indexing, transaction safety, and decoupled microservices that handle high traffic effortlessly.
                </p>
              </div>

              <!-- Pillar 2 -->
              <div class="glass-card rounded-xl p-4 border border-emerald-500/20">
                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-400 mb-2.5">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                  </svg>
                </div>
                <h4 class="text-sm font-bold text-white mb-1">Clean & Secure Code</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                  Strict adherence to SOLID principles, two-tier validation, Sanctum token security, and comprehensive test suites.
                </p>
              </div>

              <!-- Pillar 3 -->
              <div class="glass-card rounded-xl p-4 border border-purple-500/20">
                <div class="w-8 h-8 rounded-lg bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 mb-2.5">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                    <line x1="8" y1="21" x2="16" y2="21"/>
                    <line x1="12" y1="17" x2="12" y2="21"/>
                  </svg>
                </div>
                <h4 class="text-sm font-bold text-white mb-1">Reactive Front-End Craft</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                  Smooth animations, glassmorphic dark-mode aesthetics, responsive typography, and sub-50ms user interactions.
                </p>
              </div>

              <!-- Pillar 4 -->
              <div class="glass-card rounded-xl p-4 border border-pink-500/20">
                <div class="w-8 h-8 rounded-lg bg-pink-500/10 border border-pink-500/30 flex items-center justify-center text-pink-400 mb-2.5">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                    <line x1="9" y1="9" x2="9.01" y2="9"/>
                    <line x1="15" y1="9" x2="15.01" y2="9"/>
                  </svg>
                </div>
                <h4 class="text-sm font-bold text-white mb-1">User & Client Empathy</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                  Transparent communication, prompt delivery, and crafting solutions that solve real business bottlenecks.
                </p>
              </div>

            </div>
          </div>

          <!-- Highlight Metric Cards Row -->
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 pt-2">
            
            <div class="glass-card rounded-xl p-3.5 sm:p-4 border border-cyan-500/20 text-center">
              <span class="text-2xl sm:text-3xl font-extrabold text-cyan-400 block mb-0.5">5+</span>
              <span class="text-[11px] text-slate-300 font-medium">Years Experience</span>
            </div>

            <div class="glass-card rounded-xl p-3.5 sm:p-4 border border-emerald-500/20 text-center">
              <span class="text-2xl sm:text-3xl font-extrabold text-emerald-400 block mb-0.5">50+</span>
              <span class="text-[11px] text-slate-300 font-medium">Projects Shipped</span>
            </div>

            <div class="glass-card rounded-xl p-3.5 sm:p-4 border border-purple-500/20 text-center">
              <span class="text-2xl sm:text-3xl font-extrabold text-purple-400 block mb-0.5">99.9%</span>
              <span class="text-[11px] text-slate-300 font-medium">Uptime Delivered</span>
            </div>

            <div class="glass-card rounded-xl p-3.5 sm:p-4 border border-pink-500/20 text-center">
              <span class="text-2xl sm:text-3xl font-extrabold text-pink-400 block mb-0.5">100%</span>
              <span class="text-[11px] text-slate-300 font-medium">Client Satisfaction</span>
            </div>

          </div>

        </div>

      </div>

      <!-- Career & Education Journey Timeline -->
      <div id="experience" class="pt-16 border-t border-white/10 mb-20">
        <div class="text-center mb-14">
          <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-cyan-950/40 border border-cyan-500/30 text-cyan-300 font-mono text-xs uppercase tracking-wider mb-3">
            <span>MILESTONES & CREDENTIALS</span>
          </div>
          <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
            Career & Education Journey
          </h2>
          <p class="text-slate-400 text-xs sm:text-sm mt-2 max-w-xl mx-auto">
            A proven track record of software engineering leadership and academic excellence.
          </p>
        </div>

        <!-- Vertical Timeline with Glowing Nodes -->
        <div class="relative max-w-3xl mx-auto">
          <!-- Central Connecting Line -->
          <div class="absolute left-4 sm:left-1/2 top-4 bottom-4 w-0.5 bg-gradient-to-b from-cyan-400 via-purple-500 to-emerald-400 opacity-40 sm:-translate-x-1/2"></div>

          <div class="space-y-8">
            <div
              v-for="(item, idx) in displayExperiences"
              :key="item.id || idx"
              class="relative flex flex-col sm:flex-row items-start"
              :class="idx % 2 === 0 ? 'sm:flex-row-reverse text-left' : 'text-left'"
            >
              <!-- Timeline Glowing Node Dot -->
              <div class="absolute left-4 sm:left-1/2 w-4 h-4 rounded-full bg-cyan-400 border-4 border-[#080B11] shadow-[0_0_12px_rgba(6,182,212,0.8)] -translate-x-1.5 sm:-translate-x-2 mt-2 z-10"></div>

              <!-- Content Card -->
              <div class="ml-10 sm:ml-0 sm:w-1/2" :class="idx % 2 === 0 ? 'sm:pl-8' : 'sm:pr-8'">
                <div class="glass-card rounded-2xl p-5 border border-white/10 hover:border-cyan-500/40 transition-all duration-300 hover:-translate-y-1">
                  
                  <!-- Period Tag -->
                  <div class="flex items-center space-x-2 mb-2">
                    <span
                      class="px-2.5 py-0.5 rounded-full text-[11px] font-mono font-semibold"
                      :class="item.period === 'Present' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-cyan-300 border border-cyan-500/30'"
                    >
                      {{ item.period }}
                    </span>
                    <span class="text-xs font-mono text-slate-500 uppercase">
                      {{ item.type }}
                    </span>
                  </div>

                  <!-- Role Title -->
                  <h4 class="text-base font-bold text-white tracking-wide">
                    {{ item.role_title }}
                  </h4>

                  <!-- Institution -->
                  <p class="text-cyan-400 text-xs font-mono mt-0.5 mb-2">
                    {{ item.institution }}
                  </p>

                  <!-- Description -->
                  <p v-if="item.description" class="text-slate-400 text-xs sm:text-sm leading-relaxed">
                    {{ item.description }}
                  </p>

                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Bottom Call To Action Block -->
      <div class="rounded-3xl p-8 sm:p-12 bg-gradient-to-r from-cyan-950/40 via-[#0d1527] to-purple-950/40 border border-white/10 backdrop-blur-xl text-center relative overflow-hidden">
        <div class="mesh-glow-cyan top-0 left-1/4 w-[300px] h-[300px] opacity-20"></div>

        <h3 class="text-2xl sm:text-3xl font-extrabold text-white mb-3">
          Ready to Build Something Extraordinary?
        </h3>
        <p class="text-slate-300 text-sm sm:text-base max-w-xl mx-auto mb-8">
          Whether you need a scalable full-stack system, high-throughput backend APIs, or an accessible reactive user interface, let's connect.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4">
          <!-- Get In Touch -->
          <button
            type="button"
            @click="$emit('navigate-section', 'contact')"
            class="px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-semibold text-sm shadow-glow-cyan hover:scale-[1.02] active:scale-[0.98] transition-all"
          >
            Get in Touch
          </button>

          <!-- Explore Projects -->
          <button
            type="button"
            @click="$emit('navigate-section', 'projects')"
            class="px-6 py-3 rounded-xl bg-white/[0.05] border border-cyan-400/30 text-cyan-300 hover:text-white hover:bg-cyan-500/10 text-sm font-medium transition-all"
          >
            Explore Projects
          </button>

          <!-- Download CV -->
          <a
            :href="cvDownloadUrl"
            target="_blank"
            download="Full-Stack-Developer-CV.pdf"
            class="px-5 py-3 rounded-xl bg-white/[0.03] border border-white/10 text-slate-300 hover:text-white hover:bg-white/[0.08] text-sm font-medium transition-all"
          >
            Download CV
          </a>

          <!-- Return to Homepage -->
          <button
            type="button"
            @click="$emit('navigate-page', 'home')"
            class="px-5 py-3 rounded-xl bg-transparent border border-slate-700 text-slate-400 hover:text-white hover:border-slate-500 text-sm font-medium transition-all flex items-center space-x-1.5"
          >
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            <span>Return to Home</span>
          </button>
        </div>

      </div>

    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import TechIcons from './TechIcons.vue'
import { api } from '../services/api'

const props = defineProps({
  profile: {
    type: Object,
    default: () => ({}),
  },
  experiences: {
    type: Array,
    default: () => [],
  }
})

defineEmits(['navigate-page', 'navigate-section'])

const cvDownloadUrl = api.getDownloadCvUrl()

const avatarUrl = computed(() => {
  return props.profile.avatar_url || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=85'
})

// Realistic default experiences if backend is loading or empty
const defaultExperiences = [
  {
    id: 1,
    period: 'Present',
    role_title: 'Senior Full-Stack Engineer',
    institution: 'Tech Innovators Global',
    type: 'career',
    description: 'Architecting scalable cloud microservices, high-traffic Laravel APIs, and high-performance Vue.js SPA interfaces for over 1M+ active users.',
  },
  {
    id: 2,
    period: '2022 - 2024',
    role_title: 'Full-Stack Lead',
    institution: 'Fintech Cloud Solutions',
    type: 'career',
    description: 'Led a team of 6 engineers delivering enterprise banking systems, automated CI/CD pipelines, and relational database tuning.',
  },
  {
    id: 3,
    period: '2020 - 2022',
    role_title: 'Backend Software Engineer',
    institution: 'Modern Web Labs',
    type: 'career',
    description: 'Built high-throughput RESTful APIs with Laravel and MySQL, optimizing database indexing and transaction safety.',
  },
  {
    id: 4,
    period: '2016 - 2020',
    role_title: 'B.S. in Computer Science',
    institution: 'Faculty of Informatics & Software Engineering',
    type: 'education',
    description: 'Graduated with Magna Cum Laude honors. Focused on Distributed Systems, Relational Database Theory, and Software Architecture.',
  },
]

const displayExperiences = computed(() => {
  return (props.experiences && props.experiences.length > 0) ? props.experiences : defaultExperiences
})
</script>
