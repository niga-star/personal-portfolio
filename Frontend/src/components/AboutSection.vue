<template>
  <section id="about" class="py-20 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Ambient Glow -->
      <div class="mesh-glow-purple top-10 left-[-100px] w-[500px] h-[500px] opacity-25"></div>

      <!-- Main About Spotlight Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        
        <!-- Left: Profile Image with Neon Gradient Frame & Socials -->
        <div class="lg:col-span-5 flex flex-col items-center">
          
          <!-- Neon Gradient Frame -->
          <div class="relative w-64 sm:w-72 aspect-square rounded-3xl p-1 bg-gradient-to-tr from-cyan-400 via-purple-500 to-pink-500 shadow-[0_0_35px_rgba(168,85,247,0.35)] mb-6 group cursor-pointer" @click="$emit('open-about-page')">
            <div class="w-full h-full rounded-[22px] overflow-hidden bg-[#0d1424] relative">
              <img
                :src="avatarUrl"
                :alt="profile.developer_name || 'Alex Rivera'"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                loading="lazy"
                decoding="async"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-[#080B11]/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-4">
                <span class="text-xs font-mono text-cyan-300 bg-[#080B11]/90 px-3 py-1 rounded-full border border-cyan-400/40">
                  Open About Page &rarr;
                </span>
              </div>
            </div>
          </div>

          <!-- Social Links Row -->
          <div class="flex items-center space-x-3">
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

        </div>

        <!-- Right: Bio & Key Highlights -->
        <div class="lg:col-span-7 flex flex-col">
          
          <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-purple-950/40 border border-purple-500/30 text-purple-300 font-mono text-xs uppercase tracking-wider mb-4 self-start">
            <span>SPOTLIGHT</span>
          </div>

          <!-- Section Title -->
          <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-400 to-cyan-400">
              {{ profile.about_heading || 'About Me' }}
            </span>
          </h2>

          <!-- Bio Lead -->
          <h3 class="text-lg sm:text-xl font-bold text-white mb-4 leading-snug">
            {{ profile.about_lead || 'My passion for bridging robust back-end systems with pixel-perfect interfaces.' }}
          </h3>

          <!-- Bio Paragraph -->
          <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-6 font-normal">
            {{ profile.about_bio || 'Senior Full-Stack Developer specializing in bridging robust back-end systems with pixel-perfect interfaces. Passionate about scalable database design, clean architecture, and modern reactive front-ends.' }}
          </p>

          <!-- Highlight Metric Cards Row -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-white/10 mb-6">
            
            <!-- 5+ Years Experience -->
            <div class="glass-card rounded-2xl p-4 border border-cyan-500/20 shadow-[0_0_15px_-5px_rgba(6,182,212,0.3)] flex flex-col justify-between">
              <div class="flex items-center justify-between mb-2">
                <span class="text-2xl font-extrabold text-white">5+</span>
                <div class="w-8 h-8 rounded-lg bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                  </svg>
                </div>
              </div>
              <span class="text-xs text-slate-300 font-medium">Years Experience</span>
            </div>

            <!-- 50+ Projects Deployed -->
            <div class="glass-card rounded-2xl p-4 border border-blue-500/20 shadow-[0_0_15px_-5px_rgba(59,130,246,0.3)] flex flex-col justify-between">
              <div class="flex items-center justify-between mb-2">
                <span class="text-2xl font-extrabold text-white">50+</span>
                <div class="w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/30 flex items-center justify-center text-blue-400">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/>
                    <path d="M12 15l-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/>
                  </svg>
                </div>
              </div>
              <span class="text-xs text-slate-300 font-medium">Projects Deployed</span>
            </div>

            <!-- 100% Client Satisfaction -->
            <div class="glass-card rounded-2xl p-4 border border-purple-500/20 shadow-[0_0_15px_-5px_rgba(168,85,247,0.3)] flex flex-col justify-between">
              <div class="flex items-center justify-between mb-2">
                <span class="text-2xl font-extrabold text-white">100%</span>
                <div class="w-8 h-8 rounded-lg bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400">
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                  </svg>
                </div>
              </div>
              <span class="text-xs text-slate-300 font-medium">Client Satisfaction</span>
            </div>

          </div>

          <!-- Action Buttons: Explore Full About Page -->
          <div class="flex flex-wrap items-center gap-4">
            <button
              type="button"
              @click="$emit('open-about-page')"
              class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-gradient-to-r from-purple-500 via-pink-500 to-cyan-400 text-white font-semibold text-xs sm:text-sm shadow-[0_0_20px_rgba(168,85,247,0.4)] hover:shadow-[0_0_30px_rgba(168,85,247,0.6)] hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 space-x-2"
            >
              <span>Explore Full Story & Career Journey</span>
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
            </button>

            <a
              :href="cvDownloadUrl"
              target="_blank"
              download="Full-Stack-Developer-CV.pdf"
              class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-white/[0.04] border border-white/10 text-slate-300 hover:text-white hover:border-cyan-400/50 text-xs sm:text-sm font-medium transition-colors space-x-2"
            >
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/>
              </svg>
              <span>Download CV</span>
            </a>
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
  },
  experiences: {
    type: Array,
    default: () => [],
  }
})

defineEmits(['open-about-page'])

const cvDownloadUrl = api.getDownloadCvUrl()

const avatarUrl = computed(() => {
  return props.profile.avatar_url || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=85'
})
</script>
