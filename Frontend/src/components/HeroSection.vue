<template>
  <section id="hero" class="relative pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
    <!-- Ambient Mesh Glows (Screenshots 2 & 3) -->
    <div class="mesh-glow-cyan top-10 right-[-100px] w-[500px] h-[500px] opacity-40"></div>
    <div class="mesh-glow-purple top-32 left-[-150px] w-[600px] h-[600px] opacity-30"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
        
        <!-- Left Content Column -->
        <div class="lg:col-span-7 flex flex-col items-start text-left">
          
          <!-- Availability / Specialist Pill Tag (Screenshot 3) -->
          <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-cyan-950/40 border border-cyan-500/30 text-cyan-400 font-mono text-xs uppercase tracking-wider mb-6 backdrop-blur-md">
            <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
            <span>{{ profile.tagline || 'FULL-STACK DEVELOPER // SPECIALIST' }}</span>
          </div>

          <!-- Main Hero Headline -->
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.15] mb-6">
            {{ heroTitleBefore }}
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-teal-300 to-emerald-400">
              {{ heroTitleHighlight }}
            </span>
          </h1>

          <!-- Hero Subtitle (from Backend - Zero Hardcode) -->
          <p class="text-slate-300 text-base sm:text-lg max-w-2xl font-normal leading-relaxed mb-8">
            {{ profile.hero_subtitle || "Hi, I'm a developer who crafts robust backend architectures and dynamic user interfaces using Laravel, Vue.js, and MySQL. Let's turn your vision into high-performance applications." }}
          </p>

          <!-- Core Tech Badges Row (Screenshot 3) -->
          <div class="flex flex-wrap gap-3 mb-10">
            <div class="flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-[#131b2e]/70 border border-red-500/30 shadow-[0_0_15px_-3px_rgba(239,68,68,0.2)] text-white text-sm font-medium hover:border-red-500/60 transition-colors">
              <TechIcons name="laravel" custom-class="w-5 h-5 text-red-500" />
              <span>Laravel</span>
            </div>
            <div class="flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-[#131b2e]/70 border border-emerald-500/30 shadow-[0_0_15px_-3px_rgba(16,185,129,0.2)] text-white text-sm font-medium hover:border-emerald-500/60 transition-colors">
              <TechIcons name="vue" custom-class="w-5 h-5 text-emerald-400" />
              <span>Vue.js</span>
            </div>
            <div class="flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-[#131b2e]/70 border border-amber-500/30 shadow-[0_0_15px_-3px_rgba(245,158,11,0.2)] text-white text-sm font-medium hover:border-amber-500/60 transition-colors">
              <TechIcons name="mysql" custom-class="w-5 h-5 text-amber-400" />
              <span>MySQL</span>
            </div>
          </div>

          <!-- CTA Buttons (Screenshot 3 & FR-06) -->
          <div class="flex flex-wrap items-center gap-4">
            <a
              href="#projects"
              class="inline-flex items-center justify-center px-7 py-3.5 rounded-xl bg-gradient-to-r from-cyan-400 via-teal-400 to-emerald-400 text-black font-semibold text-base shadow-[0_0_25px_rgba(6,182,212,0.4)] hover:shadow-[0_0_35px_rgba(6,182,212,0.6)] hover:scale-[1.02] transition-all duration-200 space-x-2"
            >
              <span>Explore Projects</span>
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
            </a>

            <!-- Download CV (FR-06 - One click PDF download) -->
            <a
              :href="cvDownloadUrl"
              target="_blank"
              download="Full-Stack-Developer-CV.pdf"
              class="inline-flex items-center justify-center px-6 py-3.5 rounded-xl bg-white/[0.04] border border-cyan-400/40 text-cyan-300 hover:text-white hover:bg-cyan-500/10 hover:border-cyan-300 font-medium text-base transition-all duration-200 space-x-2.5 backdrop-blur-md"
            >
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/>
              </svg>
              <span>Download CV</span>
            </a>
          </div>

        </div>

        <!-- Right Visual Column: Interactive Code Window & Cyber Avatar (Screenshot 3 & 2) -->
        <div class="lg:col-span-5 relative flex justify-center items-center">
          
          <!-- Outer Glass Frame with Cyan/Green Glow -->
          <div class="relative w-full max-w-lg rounded-2xl p-[1px] bg-gradient-to-b from-cyan-500/40 via-emerald-500/20 to-transparent shadow-[0_0_40px_-10px_rgba(6,182,212,0.3)]">
            <div class="w-full bg-[#0d1424]/90 rounded-2xl p-5 backdrop-blur-xl border border-white/5 relative overflow-hidden">
              
              <!-- Code IDE Header with Mac Dots -->
              <div class="flex items-center justify-between pb-4 border-b border-white/10 mb-4">
                <div class="flex items-center space-x-2">
                  <span class="w-3 h-3 rounded-full bg-rose-500/80"></span>
                  <span class="w-3 h-3 rounded-full bg-amber-500/80"></span>
                  <span class="w-3 h-3 rounded-full bg-emerald-500/80"></span>
                </div>
                <div class="text-xs font-mono text-slate-400 flex items-center space-x-1.5">
                  <span class="text-cyan-400">Routes/api.php</span>
                  <span class="text-slate-600">::</span>
                  <span class="text-emerald-400">Vue.js</span>
                </div>
              </div>

              <!-- Code Snippet Display (Screenshots 2 & 3) -->
              <div class="font-mono text-xs text-slate-300 leading-relaxed space-y-1.5 overflow-x-auto pb-4">
                <div class="text-slate-500">1 &lt;?php</div>
                <div>2 <span class="text-purple-400">use</span> App\Models\Project;</div>
                <div>3 <span class="text-purple-400">use</span> Illuminate\Support\Facades\Route;</div>
                <div class="text-slate-500">4 </div>
                <div>5 <span class="text-cyan-400">Route</span>::<span class="text-emerald-400">get</span>(<span class="text-amber-300">'/projects'</span>, <span class="text-purple-400">function</span> () {</div>
                <div>6 &nbsp;&nbsp;<span class="text-purple-400">return</span> Project::<span class="text-cyan-300">with</span>([<span class="text-amber-300">'skills'</span>])-&gt;<span class="text-emerald-400">get</span>();</div>
                <div>7 });</div>
              </div>

              <!-- Cyberpunk Hologram / Avatar Layer (Screenshot 3) -->
              <div class="relative mt-2 pt-4 border-t border-white/10 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                  <div class="relative w-16 h-16 rounded-xl overflow-hidden border-2 border-cyan-400/60 shadow-glow-cyan p-0.5 bg-[#0B0F17]">
                    <img
                      :src="profile.avatar_url || 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80'"
                      alt="Developer Avatar"
                      class="w-full h-full object-cover rounded-[10px]"
                    />
                    <span class="absolute bottom-1 right-1 w-3 h-3 rounded-full bg-emerald-400 border-2 border-[#0B0F17]"></span>
                  </div>
                  <div>
                    <h3 class="text-white font-bold text-sm tracking-wide">{{ profile.developer_name || 'Alex Rivera' }}</h3>
                    <p class="text-cyan-400 font-mono text-xs">Full-Stack Architect</p>
                    <div class="flex items-center space-x-1.5 mt-1 text-[11px] text-emerald-400">
                      <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                      <span>Active on Port 8000 & 5173</span>
                    </div>
                  </div>
                </div>

                <!-- Live Status Chip -->
                <div class="px-3 py-1.5 rounded-lg bg-cyan-500/10 border border-cyan-500/30 text-cyan-300 text-xs font-mono">
                  &lt;Reactive /&gt;
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

const cvDownloadUrl = api.getDownloadCvUrl()

// Split hero title to create the gradient accent
const heroTitleBefore = computed(() => {
  const title = props.profile.hero_title || 'Building Scalable Full-Stack Solutions'
  const words = title.split(' ')
  if (words.length > 2) {
    return words.slice(0, words.length - 2).join(' ') + ' '
  }
  return title
})

const heroTitleHighlight = computed(() => {
  const title = props.profile.hero_title || 'Building Scalable Full-Stack Solutions'
  const words = title.split(' ')
  if (words.length > 2) {
    return words.slice(words.length - 2).join(' ')
  }
  return ''
})
</script>
