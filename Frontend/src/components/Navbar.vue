<template>
  <header
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    :class="isScrolled ? 'bg-[#080B11]/90 backdrop-blur-md border-b border-white/10 shadow-lg shadow-black/40 py-3' : 'bg-transparent py-5'"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between">
        
        <!-- Brand Logo with Cyan Glow (Returns to Home) -->
        <a
          href="#hero"
          @click.prevent="handleNavClick({ id: 'home', type: 'page', page: 'home' })"
          class="flex items-center space-x-2.5 group cursor-pointer"
        >
          <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-cyan-500 via-teal-400 to-emerald-400 p-[1px] shadow-glow-cyan transition-transform group-hover:scale-105">
            <div class="w-full h-full bg-[#080B11] rounded-[7px] flex items-center justify-center">
              <span class="w-2.5 h-2.5 rounded-full bg-cyan-400 group-hover:animate-ping"></span>
            </div>
          </div>
          <span class="text-lg sm:text-xl font-extrabold tracking-wider text-white font-mono flex items-center">
            {{ brandName || 'DEV.CRAFT' }}
          </span>
        </a>

        <!-- Desktop Navigation Links (Pill Frame) -->
        <nav class="hidden md:flex items-center space-x-1 px-3 py-1.5 rounded-full bg-white/[0.04] border border-white/10 backdrop-blur-md">
          <button
            v-for="item in navLinks"
            :key="item.id"
            type="button"
            @click="handleNavClick(item)"
            class="px-3.5 py-1.5 text-xs lg:text-sm font-medium rounded-full transition-all duration-200 cursor-pointer"
            :class="isLinkActive(item) ? 'text-white bg-white/15 shadow-sm font-semibold' : 'text-slate-400 hover:text-white hover:bg-white/5'"
          >
            {{ item.name }}
          </button>
        </nav>

        <!-- Right Action Buttons -->
        <div class="hidden md:flex items-center space-x-3">
          <!-- Admin Portal Trigger Button -->
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

          <!-- Get In Touch Button -->
          <button
            type="button"
            @click="handleNavClick({ id: 'contact', type: 'section', target: 'contact' })"
            class="relative inline-flex items-center justify-center px-4 sm:px-5 py-2 text-xs sm:text-sm font-medium text-white transition-all duration-300 rounded-full group overflow-hidden border border-cyan-400/30 hover:border-cyan-400 shadow-glow-cyan/50 hover:shadow-glow-cyan active:scale-95 cursor-pointer"
          >
            <span class="absolute inset-0 bg-gradient-to-r from-cyan-500/20 to-emerald-500/20 group-hover:opacity-100 transition-opacity"></span>
            <span class="relative flex items-center space-x-1.5">
              <span>Get in Touch</span>
            </span>
          </button>
        </div>

        <!-- Mobile Menu Toggle Button -->
        <button
          @click="mobileMenuOpen = !mobileMenuOpen"
          class="md:hidden p-2 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 focus:outline-none focus:ring-1 focus:ring-cyan-400"
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
    <transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="opacity-0 -translate-y-2"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 -translate-y-2"
    >
      <div v-show="mobileMenuOpen" class="md:hidden px-4 pt-3 pb-6 bg-[#080B11]/98 border-b border-white/10 backdrop-blur-xl shadow-2xl">
        <div class="flex flex-col space-y-1.5">
          <button
            v-for="item in navLinks"
            :key="item.id"
            type="button"
            @click="handleNavClick(item)"
            class="text-left px-4 py-2.5 text-base font-medium rounded-xl transition-all"
            :class="isLinkActive(item) ? 'text-cyan-400 bg-white/10 font-bold' : 'text-slate-300 hover:text-cyan-400 hover:bg-white/5'"
          >
            {{ item.name }}
          </button>
          
          <div class="pt-3 border-t border-white/10 flex flex-col space-y-2">
            <button
              @click="mobileMenuOpen = false; $emit('open-admin')"
              class="w-full text-left px-4 py-2 text-sm text-slate-400 hover:text-cyan-400 flex items-center space-x-2"
            >
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
              </svg>
              <span>Admin Management</span>
            </button>
            <button
              type="button"
              @click="handleNavClick({ id: 'contact', type: 'section', target: 'contact' })"
              class="w-full text-center py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-emerald-500 text-black font-semibold text-sm shadow-glow-cyan"
            >
              Get in Touch
            </button>
          </div>
        </div>
      </div>
    </transition>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  brandName: {
    type: String,
    default: 'DEV.CRAFT',
  },
  currentPage: {
    type: String,
    default: 'home',
  },
  activeSection: {
    type: String,
    default: 'hero',
  }
})

const emit = defineEmits(['open-admin', 'navigate'])

const isScrolled = ref(false)
const mobileMenuOpen = ref(false)

// Ordered Navigation links: Home, then About directly after Home
const navLinks = [
  { name: 'Home', id: 'home', type: 'page', page: 'home' },
  { name: 'About', id: 'about', type: 'page', page: 'about' },
  { name: 'Projects', id: 'projects', type: 'section', target: 'projects' },
  { name: 'Skills', id: 'skills', type: 'section', target: 'skills' },
  { name: 'Experience', id: 'experience', type: 'section', target: 'experience' },
  { name: 'Contact', id: 'contact', type: 'section', target: 'contact' },
]

const isLinkActive = (item) => {
  if (item.type === 'page') {
    if (item.page === 'about') {
      return props.currentPage === 'about'
    }
    if (item.page === 'home') {
      return props.currentPage === 'home' && (!props.activeSection || props.activeSection === 'hero')
    }
  } else if (item.type === 'section') {
    if (props.currentPage === 'home') {
      return props.activeSection === item.target
    }
    if (props.currentPage === 'about' && item.target === 'experience') {
      return props.activeSection === 'experience'
    }
  }
  return false
}

const handleNavClick = (item) => {
  mobileMenuOpen.value = false
  emit('navigate', item)
}

const handleScroll = () => {
  isScrolled.value = window.scrollY > 25
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll, { passive: true })
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>
