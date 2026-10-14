<template>
  <section id="about" class="py-20 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Ambient Glow (Screenshot 4) -->
      <div class="mesh-glow-purple top-10 left-[-100px] w-[500px] h-[500px] opacity-25"></div>

      <!-- Main About Grid (Screenshot 4) -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start mb-20">
        
        <!-- Left: Profile Image with Neon Gradient Frame & Socials (Screenshot 4) -->
        <div class="lg:col-span-5 flex flex-col items-center">
          
          <!-- Dual Neon Gradient Frame (Cyan to Purple) -->
          <div class="relative w-64 sm:w-72 aspect-square rounded-3xl p-1 bg-gradient-to-tr from-cyan-400 via-purple-500 to-pink-500 shadow-[0_0_35px_rgba(168,85,247,0.35)] mb-6">
            <div class="w-full h-full rounded-[22px] overflow-hidden bg-[#0d1424]">
              <img
                :src="profile.avatar_url || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80'"
                :alt="profile.developer_name || 'Alex Rivera'"
                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
              />
            </div>
          </div>

          <!-- Social Links Row (Screenshot 4: GitHub, LinkedIn, X) -->
          <div class="flex items-center space-x-4">
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

        <!-- Right: Bio & Philosophy (Screenshot 4) -->
        <div class="lg:col-span-7 flex flex-col">
          
          <!-- Section Title (Screenshot 4: Purple/Cyan Gradient) -->
          <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-400 to-cyan-400">
              {{ profile.about_heading || 'About Me' }}
            </span>
          </h2>

          <!-- Bio Lead (Screenshot 4) -->
          <h3 class="text-lg sm:text-xl font-bold text-white mb-4 leading-snug">
            {{ profile.about_lead || 'My passion for bridging robust back-end systems with pixel-perfect interfaces.' }}
          </h3>

          <!-- Bio Paragraphs (Dynamic from backend) -->
          <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-6 font-normal">
            {{ profile.about_bio || 'Senior Full-Stack Developer specializing in bridging robust back-end systems with pixel-perfect interfaces. Passionate about scalable database design, clean architecture, and modern reactive front-ends.' }}
          </p>

          <!-- Highlight Metric Cards Row (Screenshot 4) -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-white/10">
            
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

            <!-- 30+ Projects Deployed -->
            <div class="glass-card rounded-2xl p-4 border border-blue-500/20 shadow-[0_0_15px_-5px_rgba(59,130,246,0.3)] flex flex-col justify-between">
              <div class="flex items-center justify-between mb-2">
                <span class="text-2xl font-extrabold text-white">30+</span>
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

        </div>

      </div>

      <!-- Career & Education Journey Timeline (Screenshot 4) -->
      <div id="experience" class="pt-10 border-t border-white/10">
        <div class="text-center mb-12">
          <h3 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
            Career & Education Journey
          </h3>
          <p class="text-slate-400 text-xs sm:text-sm mt-1">
            Proven track record of engineering leadership and continuous academic mastery.
          </p>
        </div>

        <!-- Vertical Timeline with Glowing Nodes (Screenshot 4) -->
        <div class="relative max-w-3xl mx-auto">
          <!-- Central Connecting Line -->
          <div class="absolute left-4 sm:left-1/2 top-4 bottom-4 w-0.5 bg-gradient-to-b from-cyan-400 via-purple-500 to-emerald-400 opacity-40 sm:-translate-x-1/2"></div>

          <div class="space-y-8">
            <div
              v-for="(item, idx) in experiences"
              :key="item.id"
              class="relative flex flex-col sm:flex-row items-start"
              :class="idx % 2 === 0 ? 'sm:flex-row-reverse text-left' : 'text-left'"
            >
              <!-- Timeline Glowing Node Dot -->
              <div class="absolute left-4 sm:left-1/2 w-4 h-4 rounded-full bg-cyan-400 border-4 border-[#080B11] shadow-[0_0_12px_rgba(6,182,212,0.8)] -translate-x-1.5 sm:-translate-x-2 mt-1.5 z-10"></div>

              <!-- Content Card -->
              <div class="ml-10 sm:ml-0 sm:w-1/2" :class="idx % 2 === 0 ? 'sm:pl-8' : 'sm:pr-8'">
                <div class="glass-card rounded-2xl p-5 border border-white/10 hover:border-cyan-500/40 transition-all">
                  
                  <!-- Period Tag (Screenshot 4: Present, 2022-2024, etc.) -->
                  <div class="flex items-center space-x-2 mb-1.5">
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-mono font-semibold" :class="item.period === 'Present' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-white/5 text-cyan-300 border border-cyan-500/30'">
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
                  <p v-if="item.description" class="text-slate-400 text-xs leading-relaxed">
                    {{ item.description }}
                  </p>

                </div>
              </div>
            </div>
          </div>

          <!-- Bottom Action Buttons (Screenshot 4: Download CV & Get in Touch) -->
          <div class="flex items-center justify-center space-x-4 mt-12">
            <a
              :href="cvDownloadUrl"
              target="_blank"
              download="Full-Stack-Developer-CV.pdf"
              class="px-5 py-2.5 rounded-xl bg-white/5 border border-white/15 text-slate-300 hover:text-white hover:border-cyan-400 text-xs sm:text-sm font-medium transition-colors"
            >
              Download CV
            </a>
            <a
              href="#contact"
              class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-cyan-400 to-purple-500 text-black font-semibold text-xs sm:text-sm shadow-glow-cyan hover:opacity-95 transition-all"
            >
              Get in Touch
            </a>
          </div>

        </div>

      </div>

    </div>
  </section>
</template>

<script setup>
import TechIcons from './TechIcons.vue'
import { api } from '../services/api'

defineProps({
  profile: {
    type: Object,
    default: () => ({}),
  },
  experiences: {
    type: Array,
    default: () => [],
  }
})

const cvDownloadUrl = api.getDownloadCvUrl()
</script>
