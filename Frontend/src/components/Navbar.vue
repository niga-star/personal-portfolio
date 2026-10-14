<template>
  <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" :class="isScrolled ? 'bg-[#080B11]/85 backdrop-blur-md border-b border-white/10 shadow-lg shadow-black/30 py-3' : 'bg-transparent py-5'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between">
        
        <!-- Brand Logo with Cyan Glow (Screenshots 2 & 3) -->
        <a href="#hero" class="flex items-center space-x-2.5 group">
          <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-cyan-500 to-emerald-400 p-[1px] shadow-glow-cyan transition-transform group-hover:scale-105">
            <div class="w-full h-full bg-[#080B11] rounded-[7px] flex items-center justify-center">
              <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 group-hover:animate-ping"></span>
            </div>
          </div>
          <span class="text-xl font-extrabold tracking-wider text-white font-mono flex items-center">
            {{ brandName || 'DEV.CRAFT' }}
          </span>
        </a>

        <!-- Desktop Navigation Links (Pill Frame like Screenshot 3) -->
        <nav class="hidden md:flex items-center space-x-1 px-4 py-1.5 rounded-full bg-white/[0.03] border border-white/10 backdrop-blur-md">
          <a
            v-for="item in navLinks"
            :key="item.href"
            :href="item.href"
            class="px-4 py-1.5 text-sm font-medium rounded-full transition-colors duration-200"
            :class="activeSection === item.id ? 'text-white bg-white/10 shadow-sm' : 'text-slate-400 hover:text-white hover:bg-white/5'"
          >
            {{ item.name }}
          </a>
        </nav>

        <!-- Right Action Buttons -->
        <div class="hidden md:flex items-center space-x-3">
          <!-- Admin Portal Trigger Button (FR-05) -->
          <button
            @click="$emit('open-admin')"
            class="px-3 py-1.5 text-xs font-mono rounded-lg border border-white/10 text-slate-400 hover:text-cyan-400 hover:border-cyan-500/40 transition-colors flex items-center space-x-1.5 bg-white/[0.02]"
            title="Admin Management Portal"
          >
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <span>Admin</span>
          </button>

          <!-- Get In Touch Button (Screenshot 3 & 4) -->
          <a
            href="#contact"
            class="relative inline-flex items-center justify-center px-5 py-2 text-sm font-medium text-white transition-all duration-300 rounded-full group overflow-hidden border border-cyan-400/30 hover:border-cyan-400 shadow-glow-cyan/50 hover:shadow-glow-cyan"
          >
            <span class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-emerald-500/20 group-hover:opacity-100 transition-opacity"></span>
            <span class="relative flex items-center space-x-1.5">
              <span>Get in Touch</span>
            </span>
          </a>
        </div>

        <!-- Mobile Menu Toggle Button -->
        <button
          @click="mobileMenuOpen = !mobileMenuOpen"
          class="md:hidden p-2 rounded-lg text-slate-400 hover:text-white hover:bg-white/5"
          aria-label="Toggle menu"
        >
          <svg v-if="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

      </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div v-show="mobileMenuOpen" class="md:hidden px-4 pt-3 pb-6 bg-[#080B11]/95 border-b border-white/10 backdrop-blur-xl">
      <div class="flex flex-col space-y-2">
        <a
          v-for="item in navLinks"
          :key="item.href"
          :href="item.href"
          @click="mobileMenuOpen = false"
          class="px-4 py-2.5 text-base font-medium rounded-lg text-slate-300 hover:text-cyan-400 hover:bg-white/5"
        >
          {{ item.name }}
        </a>
        <div class="pt-3 border-t border-white/10 flex flex-col space-y-2">
          <button
            @click="mobileMenuOpen = false; $emit('open-admin')"
            class="w-full text-left px-4 py-2 text-sm text-slate-400 hover:text-cyan-400 flex items-center space-x-2"
          >
            <span>Admin Management</span>
          </button>
          <a
            href="#contact"
            @click="mobileMenuOpen = false"
            class="text-center py-2.5 rounded-lg bg-gradient-to-r from-cyan-500 to-emerald-500 text-black font-semibold text-sm shadow-glow-cyan"
          >
            Get in Touch
          </a>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

defineProps({
  brandName: {
    type: String,
    default: 'DEV.CRAFT',
  }
})

defineEmits(['open-admin'])

const isScrolled = ref(false)
const mobileMenuOpen = ref(false)
const activeSection = ref('hero')

const navLinks = [
  { name: 'Home', href: '#hero', id: 'hero' },
  { name: 'About', href: '#about', id: 'about' },
  { name: 'Projects', href: '#projects', id: 'projects' },
  { name: 'Skills', href: '#skills', id: 'skills' },
  { name: 'Experience', href: '#experience', id: 'experience' },
  { name: 'Contact', href: '#contact', id: 'contact' },
]

const handleScroll = () => {
  isScrolled.value = window.scrollY > 30
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>
