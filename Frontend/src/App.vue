<template>
  <div class="relative min-h-screen bg-[#080B11] text-slate-100 overflow-x-hidden selection:bg-cyan-500 selection:text-black">
    
    <!-- Cyber Blueprint Background Grid -->
    <div class="fixed inset-0 bg-grid-pattern opacity-60 pointer-events-none"></div>

    <!-- Loading Splash Screen -->
    <div v-if="loading" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-[#080B11]">
      <div class="relative w-16 h-16">
        <div class="absolute inset-0 rounded-full border-4 border-cyan-500/20"></div>
        <div class="absolute inset-0 rounded-full border-4 border-cyan-400 border-t-transparent animate-spin"></div>
      </div>
      <p class="mt-4 font-mono text-xs text-cyan-400 tracking-widest uppercase">
        Loading Laravel & Vue Engine...
      </p>
    </div>

    <!-- Main Content -->
    <div v-else class="relative z-10 flex flex-col min-h-screen">
      
      <!-- Sticky Navigation Bar -->
      <Navbar
        :brand-name="currentProfile.brand_name"
        :current-page="currentPage"
        :active-section="activeSection"
        @open-admin="isAdminModalOpen = true"
        @navigate="handleNavigation"
      />

      <!-- Dynamic Page Views with Smooth Page Transition -->
      <main class="flex-grow">
        <transition name="page-fade" mode="out-in">
          
          <!-- HOME PAGE VIEW -->
          <div v-if="currentPage === 'home'" key="home-page">
            
            <!-- Hero Section (Profile photo as main visual element) -->
            <HeroSection
              :profile="currentProfile"
              @navigate-page="switchToPage"
              @navigate-section="scrollToSection"
            />

            <!-- Interactive Stats Counters -->
            <StatsSection :stats="currentProfile.stats" />

            <!-- Featured Projects with Reactive Filtering -->
            <ProjectsSection
              :projects="projects"
              @open-case-study="openCaseStudy"
            />

            <!-- Tech Stack Grid -->
            <TechStackSection :skills="skills" />

            <!-- About Spotlight & Teaser on Homepage -->
            <AboutSection
              :profile="currentProfile"
              :experiences="experiences"
              @open-about-page="switchToPage('about')"
            />

            <!-- Hire Me & Contact Section -->
            <ContactSection
              :profile="currentProfile"
              @navigate-page="switchToPage"
            />

          </div>

          <!-- DEDICATED ABOUT PAGE VIEW -->
          <div v-else-if="currentPage === 'about'" key="about-page">
            <AboutPage
              :profile="currentProfile"
              :experiences="experiences"
              @navigate-page="switchToPage"
              @navigate-section="handleAboutSectionNavigation"
            />
          </div>

        </transition>
      </main>

      <!-- Footer with Tech Badges and Navigation Links -->
      <Footer
        :brand-name="currentProfile.brand_name"
        :developer-name="currentProfile.developer_name"
        @navigate="handleNavigation"
      />

      <!-- Case Study Modal (FR-02) -->
      <CaseStudyModal
        v-if="selectedProject"
        :project="selectedProject"
        @close="selectedProject = null"
      />

      <!-- Admin Management Portal Modal (FR-05) -->
      <AdminModal
        :is-open="isAdminModalOpen"
        :current-profile="currentProfile"
        :projects="projects"
        :skills="skills"
        :experiences="experiences"
        @close="isAdminModalOpen = false"
        @refresh-data="loadAllData"
      />

    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue'
import { api } from './services/api'

import Navbar from './components/Navbar.vue'
import HeroSection from './components/HeroSection.vue'
import StatsSection from './components/StatsSection.vue'
import ProjectsSection from './components/ProjectsSection.vue'
import TechStackSection from './components/TechStackSection.vue'
import AboutSection from './components/AboutSection.vue'
import AboutPage from './components/AboutPage.vue'
import ContactSection from './components/ContactSection.vue'
import CaseStudyModal from './components/CaseStudyModal.vue'
import AdminModal from './components/AdminModal.vue'
import Footer from './components/Footer.vue'

const loading = ref(true)
const profile = ref({})
const experiences = ref([])
const projects = ref([])
const skills = ref([])

const currentPage = ref('home')
const activeSection = ref('hero')
const selectedProject = ref(null)
const isAdminModalOpen = ref(false)

// Fallback profile settings ensuring full visual presentation
const defaultProfile = {
  brand_name: 'DEV.CRAFT',
  developer_name: 'Alex Rivera',
  status_badge: 'Available for freelance & full-time',
  tagline: 'FULL-STACK DEVELOPER // SPECIALIST',
  hero_title: 'Building Scalable Full-Stack Solutions',
  hero_subtitle: "Hi, I'm a developer who crafts robust backend architectures and dynamic user interfaces using Laravel, Vue.js, and MySQL. Let's turn your vision into high-performance applications.",
  about_heading: 'About Me',
  about_lead: 'My passion for bridging robust back-end systems with pixel-perfect interfaces.',
  about_bio: 'As a Senior Full-Stack Developer, I specialize in crafting high-concurrency Laravel APIs, resilient MySQL database schemas, and reactive, glassmorphic Vue 3 user interfaces. I believe software engineering is an art that blends airtight backend security, clean design patterns, and memorable user experiences.',
  avatar_url: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=85',
  cv_url: '/api/v1/download-cv',
  email: 'hello@developer.com',
  github_url: 'https://github.com/developer',
  linkedin_url: 'https://linkedin.com/in/developer',
  telegram_url: 'https://t.me/developer',
  twitter_url: 'https://x.com/developer',
  stats: [
    { value: '50+', label: 'Projects Completed', accent: 'cyan' },
    { value: '99.9%', label: 'Uptime Architected', accent: 'emerald' },
    { value: '5+', label: 'Years Experience', accent: 'purple' },
    { value: '100%', label: 'Client Satisfaction', accent: 'pink' },
  ],
}

const currentProfile = computed(() => {
  return { ...defaultProfile, ...profile.value }
})

const openCaseStudy = (proj) => {
  selectedProject.value = proj
}

// Page Navigation handling
const switchToPage = (pageName) => {
  currentPage.value = pageName
  if (pageName === 'about') {
    window.location.hash = '#about'
    window.scrollTo({ top: 0, behavior: 'smooth' })
  } else {
    window.location.hash = '#hero'
    window.scrollTo({ top: 0, behavior: 'smooth' })
  }
}

// Scroll to section on home page
const scrollToSection = (sectionId) => {
  if (currentPage.value !== 'home') {
    currentPage.value = 'home'
    nextTick(() => {
      scrollToElement(sectionId)
    })
  } else {
    scrollToElement(sectionId)
  }
}

const scrollToElement = (id) => {
  const el = document.getElementById(id)
  if (el) {
    el.scrollIntoView({ behavior: 'smooth' })
    window.location.hash = `#${id}`
  } else {
    window.scrollTo({ top: 0, behavior: 'smooth' })
  }
}

// Handle navigation events from Navbar & Footer
const handleNavigation = (item) => {
  if (item.type === 'page') {
    switchToPage(item.page)
  } else if (item.type === 'section') {
    if (item.target === 'experience') {
      // Experience timeline is on the About Page
      if (currentPage.value !== 'about') {
        currentPage.value = 'about'
        window.location.hash = '#experience'
        nextTick(() => {
          scrollToElement('experience')
        })
      } else {
        scrollToElement('experience')
      }
    } else {
      // Home sections: hero, projects, skills, contact
      scrollToSection(item.target)
    }
  }
}

// Handle section navigation inside About page
const handleAboutSectionNavigation = (target) => {
  if (target === 'contact' || target === 'projects') {
    scrollToSection(target)
  } else if (target === 'experience') {
    scrollToElement('experience')
  }
}

// Sync current page with browser URL hash
const syncHashWithState = () => {
  const hash = window.location.hash.toLowerCase()
  if (hash === '#about' || hash === '#/about') {
    currentPage.value = 'about'
  } else if (hash === '#experience') {
    currentPage.value = 'about'
    nextTick(() => {
      scrollToElement('experience')
    })
  } else if (hash === '#projects' || hash === '#skills' || hash === '#contact') {
    currentPage.value = 'home'
    nextTick(() => {
      const section = hash.replace('#', '')
      scrollToElement(section)
    })
  } else {
    currentPage.value = 'home'
  }
}

// Active section observer on scroll
const updateActiveSectionOnScroll = () => {
  if (currentPage.value === 'about') {
    const expEl = document.getElementById('experience')
    if (expEl) {
      const rect = expEl.getBoundingClientRect()
      if (rect.top <= 200 && rect.bottom >= 200) {
        activeSection.value = 'experience'
        return
      }
    }
    activeSection.value = 'about'
    return
  }

  // On Home page, check sections
  const sections = ['contact', 'about', 'skills', 'projects', 'hero']
  for (const sId of sections) {
    const el = document.getElementById(sId)
    if (el) {
      const rect = el.getBoundingClientRect()
      if (rect.top <= 250) {
        activeSection.value = sId
        return
      }
    }
  }
  activeSection.value = 'hero'
}

// Load all dynamic data from Laravel Backend API (Zero Hardcoding)
const loadAllData = async () => {
  try {
    const [profileRes, projectsRes, skillsRes] = await Promise.allSettled([
      api.getProfile(),
      api.getProjects(),
      api.getSkills(),
    ])

    if (profileRes.status === 'fulfilled' && profileRes.value.data?.data) {
      profile.value = profileRes.value.data.data.profile || {}
      experiences.value = profileRes.value.data.data.experiences || []

      if (profile.value.developer_name && profile.value.brand_name) {
        document.title = `${profile.value.brand_name} | ${profile.value.developer_name}`
      }
    }

    if (projectsRes.status === 'fulfilled' && projectsRes.value.data?.data) {
      projects.value = projectsRes.value.data.data || []
    }

    if (skillsRes.status === 'fulfilled' && skillsRes.value.data?.data) {
      skills.value = skillsRes.value.data.data || []
    }
  } catch (err) {
    console.warn('Backend API connection warning (running with fallback state):', err)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  syncHashWithState()
  window.addEventListener('hashchange', syncHashWithState)
  window.addEventListener('scroll', updateActiveSectionOnScroll, { passive: true })
  loadAllData()
})

onUnmounted(() => {
  window.removeEventListener('hashchange', syncHashWithState)
  window.removeEventListener('scroll', updateActiveSectionOnScroll)
})
</script>
