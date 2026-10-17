<template>
  <div class="relative min-h-screen bg-[#080B11] text-slate-100 overflow-x-hidden">
    
    <!-- Cyber Blueprint Background Grid (Screenshots 2 & 4) -->
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
        :brand-name="profile.brand_name"
        @open-admin="isAdminModalOpen = true"
      />

      <main class="flex-grow">
        <!-- Hero Section (Screenshot 3 & 2) -->
        <HeroSection :profile="profile" />

        <!-- Interactive Stats Counters (Screenshot 2 & 4) -->
        <StatsSection :stats="profile.stats" />

        <!-- Featured Projects with Reactive Filtering (Screenshot 2 & FR-01) -->
        <ProjectsSection
          :projects="projects"
          @open-case-study="openCaseStudy"
        />

        <!-- Tech Stack Grid (Screenshot 2) -->
        <TechStackSection :skills="skills" />

        <!-- About Me & Journey Timeline (Screenshot 4) -->
        <AboutSection
          :profile="profile"
          :experiences="experiences"
        />

        <!-- Hire Me & Contact Section (Screenshot 1: 2x2 cards + glass form) -->
        <ContactSection :profile="profile" />
      </main>

      <!-- Footer with Tech Badges -->
      <Footer
        :brand-name="profile.brand_name"
        :developer-name="profile.developer_name"
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
        :current-profile="profile"
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
import { ref, onMounted } from 'vue'
import { api } from './services/api'

import Navbar from './components/Navbar.vue'
import HeroSection from './components/HeroSection.vue'
import StatsSection from './components/StatsSection.vue'
import ProjectsSection from './components/ProjectsSection.vue'
import TechStackSection from './components/TechStackSection.vue'
import AboutSection from './components/AboutSection.vue'
import ContactSection from './components/ContactSection.vue'
import CaseStudyModal from './components/CaseStudyModal.vue'
import AdminModal from './components/AdminModal.vue'
import Footer from './components/Footer.vue'

const loading = ref(true)
const profile = ref({})
const experiences = ref([])
const projects = ref([])
const skills = ref([])

const selectedProject = ref(null)
const isAdminModalOpen = ref(false)

const openCaseStudy = (proj) => {
  selectedProject.value = proj
}

// Load all dynamic data from Laravel Backend API (Zero Hardcoding)
const loadAllData = async () => {
  try {
    const [profileRes, projectsRes, skillsRes] = await Promise.all([
      api.getProfile(),
      api.getProjects(),
      api.getSkills(),
    ])

    if (profileRes.data?.data) {
      profile.value = profileRes.data.data.profile || {}
      experiences.value = profileRes.data.data.experiences || []

      if (profile.value.developer_name && profile.value.brand_name) {
        document.title = `${profile.value.brand_name} | ${profile.value.developer_name}`
      }
    }

    if (projectsRes.data?.data) {
      projects.value = projectsRes.data.data || []
    }

    if (skillsRes.data?.data) {
      skills.value = skillsRes.data.data || []
    }
  } catch (err) {
    console.error('Error fetching backend portfolio data:', err)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  loadAllData()
})
</script>
