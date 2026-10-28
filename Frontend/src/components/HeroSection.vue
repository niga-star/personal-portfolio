<template>
  <section id="hero" class="relative pt-28 pb-16 md:pt-36 md:pb-24 lg:pt-40 lg:pb-28 overflow-hidden">
    <!-- Ambient Background Glows -->
    <div class="mesh-glow-cyan -top-20 right-[-80px] w-[550px] h-[550px] opacity-35"></div>
    <div class="mesh-glow-purple top-40 left-[-120px] w-[500px] h-[500px] opacity-25"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
        
        <!-- Left Content Column -->
        <div class="lg:col-span-7 flex flex-col items-start text-left order-2 lg:order-1">
          
          <!-- Availability / Specialist Pill Tag -->
          <div class="inline-flex items-center space-x-2.5 px-4 py-1.5 rounded-full bg-cyan-950/40 border border-cyan-500/30 text-cyan-400 font-mono text-xs uppercase tracking-wider mb-6 backdrop-blur-md shadow-[0_0_15px_-3px_rgba(6,182,212,0.3)]">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
            <span class="w-2 h-2 rounded-full bg-cyan-400 -ml-4"></span>
            <span>{{ profile.tagline || 'FULL-STACK DEVELOPER // SPECIALIST' }}</span>
          </div>

          <!-- Main Hero Headline -->
          <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.12] mb-6">
            Hi, I'm <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-teal-300 to-emerald-400">{{ developerName }}</span>
            <br />
            <span class="text-2xl sm:text-4xl lg:text-5xl font-bold text-slate-200">
              {{ heroTitle }}
            </span>
          </h1>

          <!-- Hero Subtitle -->
          <p class="text-slate-300 text-sm sm:text-base lg:text-lg max-w-2xl font-normal leading-relaxed mb-8">
            {{ profile.hero_subtitle || "Crafting robust backend architectures, high-concurrency APIs, and dynamic user interfaces using Laravel, Vue.js, and MySQL. Let's turn your vision into high-performance digital products." }}
          </p>

          <!-- Core Tech Badges Row -->
          <div class="flex flex-wrap items-center gap-2.5 sm:gap-3 mb-8">
            <div class="flex items-center space-x-2 px-3.5 py-2 rounded-xl bg-[#131b2e]/80 border border-red-500/30 shadow-[0_0_15px_-3px_rgba(239,68,68,0.2)] text-white text-xs sm:text-sm font-medium hover:border-red-500/60 transition-colors">
              <TechIcons name="laravel" custom-class="w-4 h-4 sm:w-5 sm:h-5 text-red-500" />
              <span>Laravel</span>
            </div>
            <div class="flex items-center space-x-2 px-3.5 py-2 rounded-xl bg-[#131b2e]/80 border border-emerald-500/30 shadow-[0_0_15px_-3px_rgba(16,185,129,0.2)] text-white text-xs sm:text-sm font-medium hover:border-emerald-500/60 transition-colors">
              <TechIcons name="vue" custom-class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-400" />
              <span>Vue.js 3</span>
            </div>
            <div class="flex items-center space-x-2 px-3.5 py-2 rounded-xl bg-[#131b2e]/80 border border-amber-500/30 shadow-[0_0_15px_-3px_rgba(245,158,11,0.2)] text-white text-xs sm:text-sm font-medium hover:border-amber-500/60 transition-colors">
              <TechIcons name="mysql" custom-class="w-4 h-4 sm:w-5 sm:h-5 text-amber-400" />
              <span>MySQL</span>
            </div>
            <div class="flex items-center space-x-2 px-3.5 py-2 rounded-xl bg-[#131b2e]/80 border border-cyan-500/30 shadow-[0_0_15px_-3px_rgba(6,182,212,0.2)] text-white text-xs sm:text-sm font-medium hover:border-cyan-500/60 transition-colors">
              <TechIcons name="tailwind" custom-class="w-4 h-4 sm:w-5 sm:h-5 text-cyan-400" />
              <span>Tailwind CSS</span>
            </div>
          </div>

          <!-- CTA Buttons Row -->
          <div class="flex flex-wrap items-center gap-3.5 sm:gap-4 mb-8 w-full sm:w-auto">
            <!-- 1. Explore Projects -->
            <a
              href="#projects"
              @click.prevent="$emit('navigate-section', 'projects')"
              class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-gradient-to-r from-cyan-400 via-teal-400 to-emerald-400 text-black font-semibold text-sm sm:text-base shadow-[0_0_25px_rgba(6,182,212,0.4)] hover:shadow-[0_0_35px_rgba(6,182,212,0.6)] hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 space-x-2"
            >
              <span>Explore Projects</span>
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
            </a>

            <!-- 2. About Me Page Button -->
            <button
              type="button"
              @click="$emit('navigate-page', 'about')"
              class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-white/[0.05] border border-cyan-400/40 text-cyan-300 hover:text-white hover:bg-cyan-500/15 hover:border-cyan-300 font-medium text-sm sm:text-base transition-all duration-200 space-x-2 backdrop-blur-md hover:scale-[1.02] active:scale-[0.98]"
            >
              <span>About Me</span>
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
            </button>

            <!-- 3. Download CV -->
            <a
              :href="cvDownloadUrl"
              target="_blank"
              download="Full-Stack-Developer-CV.pdf"
              class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3.5 rounded-xl bg-white/[0.03] border border-white/10 text-slate-300 hover:text-white hover:bg-white/[0.08] hover:border-white/20 font-medium text-sm sm:text-base transition-all duration-200 space-x-2 backdrop-blur-md"
            >
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/>
              </svg>
              <span>CV (PDF)</span>
            </a>
          </div>

          <!-- Social Quick Links -->
          <div class="flex items-center space-x-3 text-slate-400">
            <span class="text-xs font-mono uppercase tracking-wider text-slate-500">Connect:</span>
            <a
              v-if="profile.github_url"
              :href="profile.github_url"
              target="_blank"
              rel="noopener noreferrer"
              class="p-2 rounded-lg bg-white/[0.03] border border-white/10 hover:border-cyan-400/50 hover:text-cyan-400 hover:bg-cyan-500/10 transition-all"
              title="GitHub Profile"
            >
              <TechIcons name="github" custom-class="w-4 h-4" />
            </a>
            <a
              v-if="profile.linkedin_url"
              :href="profile.linkedin_url"
              target="_blank"
              rel="noopener noreferrer"
              class="p-2 rounded-lg bg-white/[0.03] border border-white/10 hover:border-cyan-400/50 hover:text-cyan-400 hover:bg-cyan-500/10 transition-all"
              title="LinkedIn Profile"
            >
              <TechIcons name="linkedin" custom-class="w-4 h-4" />
            </a>
            <a
              v-if="profile.twitter_url"
              :href="profile.twitter_url"
              target="_blank"
              rel="noopener noreferrer"
              class="p-2 rounded-lg bg-white/[0.03] border border-white/10 hover:border-cyan-400/50 hover:text-cyan-400 hover:bg-cyan-500/10 transition-all"
              title="Twitter / X"
            >
              <TechIcons name="twitter" custom-class="w-3.5 h-3.5" />
            </a>
            <a
              v-if="profile.telegram_url"
              :href="profile.telegram_url"
              target="_blank"
              rel="noopener noreferrer"
              class="p-2 rounded-lg bg-white/[0.03] border border-white/10 hover:border-cyan-400/50 hover:text-cyan-400 hover:bg-cyan-500/10 transition-all"
              title="Telegram"
            >
              <TechIcons name="telegram" custom-class="w-4 h-4" />
            </a>
          </div>

        </div>

        <!-- Right Visual Column: Profile Photo as Main Visual Element -->
        <div class="lg:col-span-5 relative flex justify-center items-center order-1 lg:order-2">
          
          <div class="relative w-full max-w-md sm:max-w-lg flex flex-col items-center">
            
            <!-- Ambient Pulsing Aura Behind Profile Photo -->
            <div class="absolute inset-0 bg-gradient-to-tr from-cyan-500/30 via-emerald-500/20 to-purple-500/30 rounded-3xl blur-3xl opacity-60 animate-pulse-glow pointer-events-none scale-105"></div>

            <!-- Profile Photo Container Frame -->
            <div class="relative group w-64 h-72 sm:w-80 sm:h-96 md:w-88 md:h-[430px] rounded-3xl p-[2px] bg-gradient-to-tr from-cyan-400 via-emerald-400 to-purple-500 shadow-[0_0_50px_rgba(6,182,212,0.35)] transition-all duration-500 hover:shadow-[0_0_70px_rgba(6,182,212,0.55)]">
              
              <div class="relative w-full h-full rounded-[22px] overflow-hidden bg-[#0a0f1d]">
                
                <!-- Profile Image -->
                <img
                  :src="avatarUrl"
                  :alt="developerName"
                  class="w-full h-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-105"
                  loading="eager"
                  decoding="async"
                />

                <!-- Modern Subtle Gradient Overlays -->
                <div class="absolute inset-0 bg-gradient-to-t from-[#080B11] via-transparent to-transparent opacity-60"></div>
                <div class="absolute inset-0 bg-gradient-to-tr from-cyan-900/20 via-transparent to-purple-900/20 mix-blend-overlay"></div>

                <!-- Bottom Floating In-Photo Info Strip -->
                <div class="absolute bottom-3 left-3 right-3 p-3 rounded-xl bg-[#080B11]/80 backdrop-blur-md border border-white/10 flex items-center justify-between">
                  <div class="flex items-center space-x-2.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs font-mono font-medium text-white truncate">{{ developerName }}</span>
                  </div>
                  <span class="text-[10px] font-mono text-cyan-400 px-2 py-0.5 rounded bg-cyan-500/10 border border-cyan-500/30">
                    Online
                  </span>
                </div>

              </div>

              <!-- Top-Right Floating Pill: Live Availability -->
              <div class="absolute -top-4 -right-2 sm:-right-4 px-3.5 py-1.5 rounded-full bg-[#0a0f1d]/90 border border-emerald-500/40 text-emerald-300 text-xs font-medium shadow-[0_0_20px_rgba(16,185,129,0.3)] backdrop-blur-md flex items-center space-x-2 animate-float-gentle">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span class="w-2 h-2 rounded-full bg-emerald-400 -ml-4"></span>
                <span>{{ profile.status_badge || 'Available for hire' }}</span>
              </div>

              <!-- Bottom-Left Floating Pill: Experience Milestone -->
              <div class="absolute -bottom-4 -left-2 sm:-left-4 px-3.5 py-2 rounded-2xl bg-[#0a0f1d]/90 border border-cyan-500/40 text-white text-xs font-medium shadow-[0_0_25px_rgba(6,182,212,0.3)] backdrop-blur-md flex items-center space-x-2.5 animate-float-delayed">
                <div class="w-7 h-7 rounded-lg bg-cyan-500/20 border border-cyan-500/40 flex items-center justify-center text-cyan-400">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                  </svg>
                </div>
                <div>
                  <span class="block text-xs font-bold text-white">5+ Years Exp.</span>
                  <span class="block text-[10px] text-cyan-400 font-mono">Senior Engineer</span>
                </div>
              </div>

            </div>

          </div>

        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'
import TechIcons from './TechIcons.vue'
import { api } from '../services/api'

const props = defineProps({
  profile: {
    type: Object,
    default: () => ({}),
  }
})

defineEmits(['navigate-page', 'navigate-section'])

const cvDownloadUrl = api.getDownloadCvUrl()

const developerName = computed(() => {
  return props.profile.developer_name || 'Alex Rivera'
})

const heroTitle = computed(() => {
  return props.profile.hero_title || 'Building Scalable Full-Stack Solutions'
})

const avatarUrl = computed(() => {
  return props.profile.avatar_url || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=85'
})
</script>
