<template>
  <section id="contact" class="py-24 relative z-10">
    <!-- Curved Ambient Wireframe Glow -->
    <div class="mesh-glow-cyan top-1/4 right-0 w-[600px] h-[600px] opacity-35 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Outer Framed Glass Container -->
      <div class="relative rounded-3xl p-6 sm:p-10 lg:p-12 bg-[#0a0f1d]/90 border border-white/10 backdrop-blur-2xl shadow-[0_0_60px_rgba(0,0,0,0.6)]">
        
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 text-xs font-mono text-slate-400 mb-6">
          <button
            type="button"
            @click="$emit('navigate-page', 'home')"
            class="hover:text-cyan-400 transition-colors flex items-center space-x-1 cursor-pointer"
          >
            <span>Home</span>
          </button>
          <span>&gt;</span>
          <span class="text-slate-200">Contact</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
          
          <!-- Left Column: Title & 4 Contact Cards -->
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

            <!-- 2x2 Contact Cards Grid -->
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
                rel="noopener noreferrer"
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
                rel="noopener noreferrer"
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
                rel="noopener noreferrer"
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

          <!-- Right Column: Interactive Form Box -->
          <div class="lg:col-span-7">
            <div class="relative rounded-2xl p-6 sm:p-8 bg-[#0d1527]/90 border border-emerald-500/30 shadow-[0_0_40px_-5px_rgba(16,185,129,0.25)] backdrop-blur-xl">
              
              <!-- Top Pill Badge -->
              <div class="flex justify-center mb-6">
                <div class="inline-flex items-center space-x-2 px-4 py-1.5 rounded-full bg-emerald-950/40 border border-emerald-500/40 text-emerald-300 text-xs font-medium backdrop-blur-md">
                  <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                  <span>{{ profile.status_badge || 'Available for freelance & full-time' }}</span>
                </div>
              </div>

              <!-- Success Alert Message -->
              <transition
                enter-active-class="transition duration-300 ease-out"
                enter-from-class="opacity-0 -translate-y-2"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition duration-200 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-2"
              >
                <div v-if="successMessage" class="mb-6 p-4 rounded-xl bg-emerald-500/15 border border-emerald-500/40 text-emerald-300 text-sm flex items-start space-x-3">
                  <svg class="w-5 h-5 text-emerald-400 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                  </svg>
                  <div>
                    <p class="font-bold">መልዕክትዎ በስኬት ተልኳል! (Message Sent)</p>
                    <p class="text-xs text-emerald-200/90 mt-0.5">{{ successMessage }}</p>
                  </div>
                </div>
              </transition>

              <!-- General Error Alert -->
              <transition
                enter-active-class="transition duration-300 ease-out"
                enter-from-class="opacity-0 -translate-y-2"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition duration-200 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-2"
              >
                <div v-if="errorMessage" class="mb-6 p-4 rounded-xl bg-rose-500/15 border border-rose-500/40 text-rose-300 text-sm flex items-start space-x-3">
                  <svg class="w-5 h-5 text-rose-400 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                  </svg>
                  <div>
                    <p class="font-bold">ስህተት ተከስቷል! (Validation Error)</p>
                    <p class="text-xs text-rose-200/90 mt-0.5">{{ errorMessage }}</p>
                  </div>
                </div>
              </transition>

              <!-- Contact Form -->
              <form @submit.prevent="submitForm" novalidate class="space-y-5">
                
                <!-- 2-Column Row: Name & Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  
                  <!-- 1. Name Field (Letters and spaces only, 3-30 chars) -->
                  <div>
                    <div class="flex items-center justify-between mb-1.5">
                      <label for="contact-name" class="block text-xs font-semibold text-slate-300">
                        Name <span class="text-cyan-400">*</span>
                      </label>
                      <span class="text-[10px] font-mono text-slate-400">
                        {{ form.name.length }}/30 chars
                      </span>
                    </div>

                    <div class="relative">
                      <input
                        id="contact-name"
                        ref="nameInputRef"
                        v-model="form.name"
                        type="text"
                        maxlength="35"
                        placeholder="e.g. Alex Rivera"
                        @input="handleFieldInput('name')"
                        @blur="handleFieldBlur('name')"
                        class="w-full px-4 py-3 rounded-xl bg-[#080d19]/80 border text-white placeholder-slate-500 text-sm focus:outline-none transition-all pr-10"
                        :class="getInputClasses('name')"
                        aria-required="true"
                        :aria-invalid="!!errors.name"
                      />

                      <!-- Status Icon Indicator -->
                      <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg
                          v-if="touched.name && !errors.name && form.name.trim().length >= 3"
                          class="w-4 h-4 text-emerald-400"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2.5"
                        >
                          <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        <svg
                          v-else-if="touched.name && errors.name"
                          class="w-4 h-4 text-rose-400"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                        >
                          <circle cx="12" cy="12" r="10"/>
                          <line x1="12" y1="8" x2="12" y2="12"/>
                          <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                      </div>
                    </div>

                    <!-- Clear, Helpful Error Message -->
                    <transition
                      enter-active-class="transition duration-200 ease-out"
                      enter-from-class="opacity-0 -translate-y-1"
                      enter-to-class="opacity-100 translate-y-0"
                    >
                      <p v-if="touched.name && errors.name" class="text-xs text-rose-400 mt-1.5 flex items-start space-x-1">
                        <span class="shrink-0 mt-0.5">•</span>
                        <span>{{ errors.name }}</span>
                      </p>
                    </transition>
                  </div>

                  <!-- 2. Email Field (Format & Verification) -->
                  <div>
                    <div class="flex items-center justify-between mb-1.5">
                      <label for="contact-email" class="block text-xs font-semibold text-slate-300">
                        Email Address <span class="text-cyan-400">*</span>
                      </label>
                      <span class="text-[10px] font-mono text-slate-400">Verified format</span>
                    </div>

                    <div class="relative">
                      <input
                        id="contact-email"
                        ref="emailInputRef"
                        v-model="form.email"
                        type="email"
                        placeholder="e.g. name@company.com"
                        @input="handleFieldInput('email')"
                        @blur="handleFieldBlur('email')"
                        class="w-full px-4 py-3 rounded-xl bg-[#080d19]/80 border text-white placeholder-slate-500 text-sm focus:outline-none transition-all pr-10"
                        :class="getInputClasses('email')"
                        aria-required="true"
                        :aria-invalid="!!errors.email"
                      />

                      <!-- Status Icon Indicator -->
                      <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg
                          v-if="touched.email && !errors.email && form.email.trim().length > 5"
                          class="w-4 h-4 text-emerald-400"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2.5"
                        >
                          <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        <svg
                          v-else-if="touched.email && errors.email"
                          class="w-4 h-4 text-rose-400"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                        >
                          <circle cx="12" cy="12" r="10"/>
                          <line x1="12" y1="8" x2="12" y2="12"/>
                          <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                      </div>
                    </div>

                    <!-- Clear, Helpful Error Message -->
                    <transition
                      enter-active-class="transition duration-200 ease-out"
                      enter-from-class="opacity-0 -translate-y-1"
                      enter-to-class="opacity-100 translate-y-0"
                    >
                      <p v-if="touched.email && errors.email" class="text-xs text-rose-400 mt-1.5 flex items-start space-x-1">
                        <span class="shrink-0 mt-0.5">•</span>
                        <span>{{ errors.email }}</span>
                      </p>
                    </transition>
                  </div>

                </div>

                <!-- 3. Project Type Dropdown -->
                <div>
                  <label for="contact-project-type" class="block text-xs font-semibold text-slate-300 mb-1.5">
                    Project Type <span class="text-slate-500">(Optional)</span>
                  </label>
                  <div class="relative">
                    <select
                      id="contact-project-type"
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

                <!-- 4. Message Field (Min 15 chars) -->
                <div>
                  <div class="flex items-center justify-between mb-1.5">
                    <label for="contact-message" class="block text-xs font-semibold text-slate-300">
                      Message <span class="text-cyan-400">*</span>
                    </label>
                    
                    <!-- Real-Time Character Counter -->
                    <span
                      class="text-[10px] font-mono px-2 py-0.5 rounded-full transition-colors"
                      :class="messageCharacterClass"
                    >
                      {{ form.message.trim().length }} / 15 min chars
                    </span>
                  </div>

                  <div class="relative">
                    <textarea
                      id="contact-message"
                      ref="messageInputRef"
                      v-model="form.message"
                      rows="4"
                      maxlength="5000"
                      placeholder="Tell me about your project, timeline, or engineering inquiry (at least 15 characters)..."
                      @input="handleFieldInput('message')"
                      @blur="handleFieldBlur('message')"
                      class="w-full px-4 py-3 rounded-xl bg-[#080d19]/80 border text-white placeholder-slate-500 text-sm focus:outline-none transition-all resize-none"
                      :class="getInputClasses('message')"
                      aria-required="true"
                      :aria-invalid="!!errors.message"
                    ></textarea>
                  </div>

                  <!-- Clear, Helpful Error Message -->
                  <transition
                    enter-active-class="transition duration-200 ease-out"
                    enter-from-class="opacity-0 -translate-y-1"
                    enter-to-class="opacity-100 translate-y-0"
                  >
                    <p v-if="touched.message && errors.message" class="text-xs text-rose-400 mt-1.5 flex items-start space-x-1">
                      <span class="shrink-0 mt-0.5">•</span>
                      <span>{{ errors.message }}</span>
                    </p>
                  </transition>
                </div>

                <!-- Submit Button -->
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
import { ref, reactive, computed } from 'vue'
import TechIcons from './TechIcons.vue'
import { api } from '../services/api'

defineProps({
  profile: {
    type: Object,
    default: () => ({}),
  }
})

defineEmits(['navigate-page'])

const form = reactive({
  name: '',
  email: '',
  project_type: '',
  message: '',
})

// Track touched state for real-time validation
const touched = reactive({
  name: false,
  email: false,
  message: false,
})

const errors = reactive({
  name: '',
  email: '',
  message: '',
})

const loading = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

// DOM element references for focusing invalid fields
const nameInputRef = ref(null)
const emailInputRef = ref(null)
const messageInputRef = ref(null)

// Disposable and fake email services blacklist
const disposableDomains = [
  'mailinator.com', 'tempmail.com', '10minutemail.com', 'guerrillamail.com',
  'trashmail.com', 'yopmail.com', 'throwawaymail.com', 'dispostable.com',
  'fakeinbox.com', 'sharklasers.com', 'temp-mail.org', 'getairmail.com',
  'burnermail.io', 'mytemp.email', 'crazymailing.com', 'generator.email',
  'maildrop.cc', 'inboxkitten.com', 'dropmail.me', 'mohmal.com',
]

// Common typo corrections
const domainTypoMap = {
  'gmial.com': 'gmail.com',
  'gamil.com': 'gmail.com',
  'gmai.com': 'gmail.com',
  'hotmial.com': 'hotmail.com',
  'yaho.com': 'yahoo.com',
  'outlok.com': 'outlook.com',
}

// 1. Name Validation (Letters & spaces only, 3 - 30 characters)
const validateName = () => {
  const value = form.name.trim()

  if (!value) {
    errors.name = 'ስምዎን ማስገባት ግዴታ ነው (Please enter your name).'
    return false
  }

  // Regex strictly checking only letters and spaces (Unicode \p{L} / ASCII letters)
  const lettersAndSpacesOnly = /^[\p{L}\s]+$/u
  if (!lettersAndSpacesOnly.test(value)) {
    errors.name = 'ስም ፊደላትን እና ክፍተትን ብቻ መያዝ አለበት፤ ቁጥሮች እና ምልክቶች አይፈቀዱም (Name must contain only letters and spaces, no numbers or special characters).'
    return false
  }

  if (value.length < 3) {
    errors.name = `ስም ቢያንስ 3 ፊደላት መሆን አለበት (Name must be at least 3 characters long, currently ${value.length}/30).`
    return false
  }

  if (value.length > 30) {
    errors.name = `ስም ከ30 ፊደላት መብለጥ የለበትም (Name cannot exceed 30 characters, currently ${value.length}/30).`
    return false
  }

  errors.name = ''
  return true
}

// 2. Email Validation (Format, Verification against fake/disposable services)
const validateEmail = () => {
  const value = form.email.trim()

  if (!value) {
    errors.email = 'ትክክለኛ የኢሜይል አድራሻ ያስገቡ (Please enter your email address).'
    return false
  }

  // Standard RFC format check
  const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/
  if (!emailRegex.test(value)) {
    errors.email = 'ትክክለኛ የኢሜይል ቅርጸት ያስገቡ (Please enter a valid email format, e.g. name@domain.com).'
    return false
  }

  const parts = value.split('@')
  if (parts.length !== 2) {
    errors.email = 'ትክክለኛ የኢሜይል አድራሻ ያስገቡ (Invalid email address).'
    return false
  }

  const domain = parts[1].toLowerCase().trim()

  // Ensure domain has at least one dot and a TLD with at least 2 chars
  const domainParts = domain.split('.')
  if (domainParts.length < 2 || domainParts[domainParts.length - 1].length < 2) {
    errors.email = 'የኢሜይል ዶሜይኑ ያልተሟላ ነው (Please enter a complete domain name, e.g. .com, .io).'
    return false
  }

  // Reject disposable / burner email domains
  if (disposableDomains.includes(domain)) {
    errors.email = 'ጊዜያዊ ወይም የማይሰራ ኢሜይል መጠቀም አይቻልም፤ እባክዎ እውነተኛ ኢሜይል ያስገቡ (Temporary or disposable email services are rejected. Please use an active email).'
    return false
  }

  // Detect common domain typos
  if (domainTypoMap[domain]) {
    errors.email = `የኢሜይል ዶሜይኑ የተሳሳተ ይመስላል፤ ወደ @${domainTypoMap[domain]} ማስተካከል ፈልገው ነበር? (Did you mean @${domainTypoMap[domain]}?)`
    return false
  }

  errors.email = ''
  return true
}

// 3. Message Validation (Min 15 characters, no short spam)
const validateMessage = () => {
  const value = form.message.trim()

  if (!value) {
    errors.message = 'እባክዎ መልዕክትዎን ያስገቡ (Please enter your message).'
    return false
  }

  if (value.length < 15) {
    errors.message = `መልዕክትዎ ቢያንስ 15 ፊደላት መሆን አለበት (Message must contain at least 15 characters, currently ${value.length}/15).`
    return false
  }

  if (value.length > 5000) {
    errors.message = 'መልዕክትዎ ከ5000 ፊደላት መብለጥ የለበትም (Message cannot exceed 5000 characters).'
    return false
  }

  errors.message = ''
  return true
}

// Real-Time Event Handlers
const handleFieldInput = (field) => {
  // If field is touched or has an error, validate on every keystroke in real-time
  if (touched[field] || errors[field]) {
    if (field === 'name') validateName()
    if (field === 'email') validateEmail()
    if (field === 'message') validateMessage()
  }
}

const handleFieldBlur = (field) => {
  touched[field] = true
  if (field === 'name') validateName()
  if (field === 'email') validateEmail()
  if (field === 'message') validateMessage()
}

// Full Form Validation before submission
const validateAll = () => {
  touched.name = true
  touched.email = true
  touched.message = true

  const isNameValid = validateName()
  const isEmailValid = validateEmail()
  const isMessageValid = validateMessage()

  if (!isNameValid && nameInputRef.value) {
    nameInputRef.value.focus()
  } else if (!isEmailValid && emailInputRef.value) {
    emailInputRef.value.focus()
  } else if (!isMessageValid && messageInputRef.value) {
    messageInputRef.value.focus()
  }

  return isNameValid && isEmailValid && isMessageValid
}

// Dynamic input border and glow classes
const getInputClasses = (field) => {
  if (touched[field] && errors[field]) {
    return 'border-rose-500/80 focus:border-rose-400 focus:ring-1 focus:ring-rose-400 shadow-[0_0_12px_rgba(244,63,94,0.25)]'
  }
  if (touched[field] && !errors[field]) {
    return 'border-emerald-500/60 focus:border-emerald-400 focus:ring-1 focus:ring-emerald-400 shadow-[0_0_10px_rgba(16,185,129,0.2)]'
  }
  return 'border-white/10 focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400'
}

// Dynamic counter class
const messageCharacterClass = computed(() => {
  const len = form.message.trim().length
  if (len === 0) return 'text-slate-500 bg-white/5'
  if (len < 15) return 'text-amber-400 bg-amber-500/10 border border-amber-500/30'
  return 'text-emerald-400 bg-emerald-500/10 border border-emerald-500/30 font-semibold'
})

// Submission Handler with Two-Tier Validation (Frontend + Backend)
const submitForm = async () => {
  successMessage.value = ''
  errorMessage.value = ''

  // 1. Run client-side validation
  if (!validateAll()) {
    errorMessage.value = 'እባክዎ የተገለጹትን ስህተቶች አስተካክለው እንደገና ይሞክሩ (Please resolve the highlighted validation errors).'
    return
  }

  loading.value = true

  try {
    // 2. Submit to backend API
    const res = await api.sendContact({
      name: form.name.trim(),
      email: form.email.trim(),
      project_type: form.project_type || 'General Inquiry',
      message: form.message.trim(),
    })

    successMessage.value = res.data.message || 'መልዕክትዎ በስኬት ደርሷል! (Message sent successfully)'
    form.name = ''
    form.email = ''
    form.project_type = ''
    form.message = ''
    
    // Reset touched and errors
    touched.name = false
    touched.email = false
    touched.message = false
    errors.name = ''
    errors.email = ''
    errors.message = ''
  } catch (err) {
    if (err.response?.status === 422) {
      const serverErrors = err.response.data.errors || {}
      if (serverErrors.name) errors.name = serverErrors.name[0]
      if (serverErrors.email) errors.email = serverErrors.email[0]
      if (serverErrors.message) errors.message = serverErrors.message[0]
      errorMessage.value = err.response.data.message || 'እባክዎ የገቡትን መረጃዎች ያረጋግጡ (Please check input fields).'
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
