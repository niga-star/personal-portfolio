<template>
  <section id="contact" class="py-24 relative z-10">
    <!-- Curved Ambient Wireframe Glow (Screenshot 1 top right) -->
    <div class="mesh-glow-cyan top-1/4 right-0 w-[600px] h-[600px] opacity-35 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Outer Framed Glass Container (Screenshot 1) -->
      <div class="relative rounded-3xl p-6 sm:p-10 lg:p-12 bg-[#0a0f1d]/90 border border-white/10 backdrop-blur-2xl shadow-[0_0_60px_rgba(0,0,0,0.6)]">
        
        <!-- Breadcrumb (Screenshot 1) -->
        <div class="flex items-center space-x-2 text-xs font-mono text-slate-400 mb-6">
          <a href="#hero" class="hover:text-cyan-400 transition-colors">Home</a>
          <span>&gt;</span>
          <span class="text-slate-200">Contact</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
          
          <!-- Left Column: Title & 4 Contact Cards (Screenshot 1) -->
          <div class="lg:col-span-5 flex flex-col justify-between h-full">
            <div>
              <!-- Section Pre-tag -->
              <span class="text-xs font-extrabold font-mono tracking-widest text-cyan-400 uppercase mb-3 block">
                LET'S WORK TOGETHER
              </span>

              <!-- Headline -->
              <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight mb-4">
                Hire Me & Contact
              </h2>

              <!-- Description -->
              <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-10 max-w-md">
                Have a project in mind or want to discuss full-time opportunities? Feel free to reach out!
              </p>
            </div>

            <!-- 2x2 Contact Cards Grid (Screenshot 1) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              
              <!-- 1. Email Card -->
              <a
                :href="`mailto:${profile.email || 'hello@developer.com'}`"
                class="glass-card rounded-2xl p-4 border border-cyan-500/30 hover:border-cyan-400 shadow-[0_0_15px_-5px_rgba(6,182,212,0.3)] flex items-center justify-between group transition-all"
              >
                <div>
                  <span class="text-sm font-bold text-white block group-hover:text-cyan-300 transition-colors">Email</span>
                  <span class="text-xs text-slate-400 truncate block max-w-[150px] font-mono">{{ profile.email || 'hello@developer.com' }}</span>
                </div>
                <div class="w-9 h-9 rounded-xl bg-cyan-500/10 flex items-center justify-center text-cyan-400 group-hover:scale-110 transition-transform">
                  <TechIcons name="email" custom-class="w-5 h-5" />
                </div>
              </a>

              <!-- 2. GitHub Card -->
              <a
                :href="profile.github_url || 'https://github.com/developer'"
                target="_blank"
                rel="noopener"
                class="glass-card rounded-2xl p-4 border border-emerald-500/30 hover:border-emerald-400 shadow-[0_0_15px_-5px_rgba(16,185,129,0.3)] flex items-center justify-between group transition-all"
              >
                <div>
                  <span class="text-sm font-bold text-white block group-hover:text-emerald-300 transition-colors">GitHub</span>
                  <span class="text-xs text-slate-400 truncate block max-w-[150px] font-mono">github.com/developer</span>
                </div>
                <div class="w-9 h-9 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 group-hover:scale-110 transition-transform">
                  <TechIcons name="github" custom-class="w-5 h-5" />
                </div>
              </a>

              <!-- 3. LinkedIn Card -->
              <a
                :href="profile.linkedin_url || 'https://linkedin.com/in/developer'"
                target="_blank"
                rel="noopener"
                class="glass-card rounded-2xl p-4 border border-blue-500/30 hover:border-blue-400 shadow-[0_0_15px_-5px_rgba(59,130,246,0.3)] flex items-center justify-between group transition-all"
              >
                <div>
                  <span class="text-sm font-bold text-white block group-hover:text-blue-300 transition-colors">LinkedIn</span>
                  <span class="text-xs text-slate-400 truncate block max-w-[150px] font-mono">linkedin.com/in/dev</span>
                </div>
                <div class="w-9 h-9 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-400 group-hover:scale-110 transition-transform">
                  <TechIcons name="linkedin" custom-class="w-5 h-5" />
                </div>
              </a>

              <!-- 4. Telegram Card -->
              <a
                :href="profile.telegram_url || 'https://t.me/developer'"
                target="_blank"
                rel="noopener"
                class="glass-card rounded-2xl p-4 border border-teal-500/30 hover:border-teal-400 shadow-[0_0_15px_-5px_rgba(20,184,166,0.3)] flex items-center justify-between group transition-all"
              >
                <div>
                  <span class="text-sm font-bold text-white block group-hover:text-teal-300 transition-colors">Telegram</span>
                  <span class="text-xs text-slate-400 truncate block max-w-[150px] font-mono">t.me/developer</span>
                </div>
                <div class="w-9 h-9 rounded-xl bg-teal-500/10 flex items-center justify-center text-teal-400 group-hover:scale-110 transition-transform">
                  <TechIcons name="telegram" custom-class="w-5 h-5" />
                </div>
              </a>

            </div>
          </div>

          <!-- Right Column: Interactive Form Box (Screenshot 1) -->
          <div class="lg:col-span-7">
            <div class="relative rounded-2xl p-6 sm:p-8 bg-[#0d1527]/90 border border-emerald-500/30 shadow-[0_0_40px_-5px_rgba(16,185,129,0.25)] backdrop-blur-xl">
              
              <!-- Top Pill Badge (Screenshot 1) -->
              <div class="flex justify-center mb-6">
                <div class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full bg-emerald-950/40 border border-emerald-500/40 text-emerald-300 text-xs font-medium backdrop-blur-md">
                  <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                  <span>{{ profile.status_badge || 'Available for freelance & full-time' }}</span>
                </div>
              </div>

              <!-- Success Alert Message (in Amharic & English) -->
              <div v-if="successMessage" class="mb-6 p-4 rounded-xl bg-emerald-500/15 border border-emerald-500/40 text-emerald-300 text-sm flex items-start space-x-3">
                <svg class="w-5 h-5 text-emerald-400 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                  <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                <div>
                  <p class="font-bold">መልዕክትዎ በስኬት ተልኳል!</p>
                  <p class="text-xs text-emerald-200/90 mt-0.5">{{ successMessage }}</p>
                </div>
              </div>

              <!-- General Error Alert -->
              <div v-if="errorMessage" class="mb-6 p-4 rounded-xl bg-rose-500/15 border border-rose-500/40 text-rose-300 text-sm flex items-start space-x-3">
                <svg class="w-5 h-5 text-rose-400 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"/>
                  <line x1="12" y1="8" x2="12" y2="12"/>
                  <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <div>
                  <p class="font-bold">ስህተት ተከስቷል!</p>
                  <p class="text-xs text-rose-200/90 mt-0.5">{{ errorMessage }}</p>
                </div>
              </div>

              <!-- Contact Form (Screenshot 1) -->
              <form @submit.prevent="submitForm" class="space-y-5">
                
                <!-- 2-Column Row: Name & Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <!-- Name -->
                  <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Name</label>
                    <input
                      v-model="form.name"
                      type="text"
                      placeholder="Enter your name"
                      class="w-full px-4 py-3 rounded-xl bg-[#080d19]/80 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all"
                      :class="{ 'border-rose-500': errors.name }"
                    />
                    <span v-if="errors.name" class="text-xs text-rose-400 mt-1 block">{{ errors.name[0] }}</span>
                  </div>

                  <!-- Email -->
                  <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Email</label>
                    <input
                      v-model="form.email"
                      type="email"
                      placeholder="Enter your email"
                      class="w-full px-4 py-3 rounded-xl bg-[#080d19]/80 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all"
                      :class="{ 'border-rose-500': errors.email }"
                    />
                    <span v-if="errors.email" class="text-xs text-rose-400 mt-1 block">{{ errors.email[0] }}</span>
                  </div>
                </div>

                <!-- Project Type Dropdown (Screenshot 1) -->
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1.5">Project Type</label>
                  <div class="relative">
                    <select
                      v-model="form.project_type"
                      class="w-full px-4 py-3 rounded-xl bg-[#080d19]/80 border border-white/10 text-slate-200 text-sm appearance-none focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all pr-10 cursor-pointer"
                    >
                      <option value="" disabled selected>Select Project Type</option>
                      <option value="Full-Stack Web Application">Full-Stack Web Application (Laravel & Vue)</option>
                      <option value="High-Throughput Backend API">High-Throughput Backend API (Laravel / Sanctum)</option>
                      <option value="Modern Vue 3 SPA / Frontend">Modern Vue 3 SPA / Frontend Interface</option>
                      <option value="Database Design & Performance Tuning">Database Design & Performance Tuning</option>
                      <option value="Full-Time Engineering Role">Full-Time Engineering Role</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"/>
                      </svg>
                    </div>
                  </div>
                </div>

                <!-- Message (Screenshot 1) -->
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1.5">Message</label>
                  <textarea
                    v-model="form.message"
                    rows="4"
                    placeholder="Tell me about your project..."
                    class="w-full px-4 py-3 rounded-xl bg-[#080d19]/80 border border-white/10 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all resize-none"
                    :class="{ 'border-rose-500': errors.message }"
                  ></textarea>
                  <span v-if="errors.message" class="text-xs text-rose-400 mt-1 block">{{ errors.message[0] }}</span>
                </div>

                <!-- Submit Button: Vibrant Cyan-to-Emerald Gradient (Screenshot 1) -->
                <button
                  type="submit"
                  :disabled="loading"
                  class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-bold text-sm sm:text-base tracking-wide shadow-[0_0_25px_rgba(0,230,118,0.4)] hover:shadow-[0_0_35px_rgba(0,230,118,0.6)] hover:opacity-95 transition-all duration-200 disabled:opacity-50 flex items-center justify-center space-x-2 cursor-pointer"
                >
                  <svg v-if="loading" class="animate-spin w-5 h-5 text-black" viewBox="0 0 24 24" fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                  </svg>
                  <span>{{ loading ? 'መልዕክት በመላክ ላይ... (Sending)' : 'Send Message' }}</span>
                </button>

              </form>

            </div>
          </div>

        </div>

      </div>

    </div>
  </section>
</template>

<script setup>
import { ref, reactive } from 'vue'
import TechIcons from './TechIcons.vue'
import { api } from '../services/api'

defineProps({
  profile: {
    type: Object,
    default: () => ({}),
  }
})

const form = reactive({
  name: '',
  email: '',
  project_type: '',
  message: '',
})

const errors = ref({})
const loading = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

// Client-side instant validation (FR-03)
const validateClientSide = () => {
  errors.value = {}
  if (!form.name.trim()) {
    errors.value.name = ['እባክዎ ስምዎን ያስገቡ (Please enter your name).']
  }
  if (!form.email.trim() || !form.email.includes('@')) {
    errors.value.email = ['እባክዎ ትክክለኛ ኢሜይል ያስገቡ (Please enter a valid email).']
  }
  if (!form.message.trim() || form.message.trim().length < 10) {
    errors.value.message = ['እባክዎ ቢያንስ 10 ፊደላት ያለው መልዕክት ያስገቡ (Message must be at least 10 characters).']
  }
  return Object.keys(errors.value).length === 0
}

const submitForm = async () => {
  successMessage.value = ''
  errorMessage.value = ''
  
  if (!validateClientSide()) {
    return
  }

  loading.value = true

  try {
    const res = await api.sendContact({
      name: form.name,
      email: form.email,
      project_type: form.project_type || 'General Inquiry',
      message: form.message,
    })

    successMessage.value = res.data.message || 'መልዕክትዎ በስኬት ደርሷል! (Message sent successfully)'
    form.name = ''
    form.email = ''
    form.project_type = ''
    form.message = ''
    errors.value = {}
  } catch (err) {
    if (err.response?.status === 422) {
      errors.value = err.response.data.errors || {}
      errorMessage.value = 'እባክዎ የገቡትን መረጃዎች ያረጋግጡ (Please check input fields).'
    } else if (err.response?.status === 429) {
      errorMessage.value = 'ጥያቄዎች በዝተዋል፤ እባክዎ ከጥቂት ደቂቃ በኋላ እንደገና ይሞክሩ (Too many requests, please slow down - Rate Limit: 5 req/min).'
    } else {
      errorMessage.value = 'መልዕክቱን መላክ አልተቻለም፤ እባክዎ እንደገና ይሞክሩ (Could not send message, please try again).'
    }
  } finally {
    loading.value = false
  }
}
</script>
