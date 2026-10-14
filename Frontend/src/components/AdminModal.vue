<template>
  <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto">
    <!-- Backdrop Blur -->
    <div class="fixed inset-0 bg-black/85 backdrop-blur-md" @click="$emit('close')"></div>

    <!-- Admin Window -->
    <div class="relative w-full max-w-4xl rounded-2xl bg-[#0B101E] border border-cyan-500/30 shadow-[0_0_50px_rgba(6,182,212,0.25)] overflow-hidden z-10 my-6 flex flex-col max-h-[90vh]">
      
      <!-- Header -->
      <div class="p-5 bg-[#080C17] border-b border-white/10 flex items-center justify-between">
        <div class="flex items-center space-x-3">
          <div class="w-8 h-8 rounded-lg bg-cyan-500/20 border border-cyan-500/40 flex items-center justify-center text-cyan-400">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
          </div>
          <div>
            <h3 class="text-base font-bold text-white font-mono">
              Admin Management Portal (FR-05)
            </h3>
            <p class="text-xs text-slate-400">
              Manage database records, projects, and contact messages in real time.
            </p>
          </div>
        </div>

        <button
          @click="$emit('close')"
          class="w-8 h-8 rounded-full bg-white/5 border border-white/10 text-slate-400 hover:text-white flex items-center justify-center transition-colors"
        >
          ✕
        </button>
      </div>

      <!-- Main Body: If Not Authenticated Show Login -->
      <div v-if="!isAuthenticated" class="p-8 sm:p-12 flex flex-col items-center justify-center text-center">
        <div class="w-16 h-16 rounded-2xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 mb-4 shadow-glow-cyan">
          <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <h4 class="text-xl font-bold text-white mb-2">የአስተዳዳሪ መግቢያ (Admin Authentication)</h4>
        <p class="text-xs text-slate-400 mb-6 max-w-sm">
          Please enter admin credentials to manage portfolio contents securely using Laravel Sanctum.
        </p>

        <form @submit.prevent="handleLogin" class="w-full max-w-sm space-y-4 text-left">
          <div v-if="loginError" class="p-3 rounded-lg bg-rose-500/20 border border-rose-500/40 text-rose-300 text-xs">
            {{ loginError }}
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-300 mb-1">Email</label>
            <input
              v-model="loginEmail"
              type="email"
              required
              class="w-full px-4 py-2.5 rounded-xl bg-[#080d19] border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-400"
              placeholder="admin@portfolio.com"
            />
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-300 mb-1">Password</label>
            <input
              v-model="loginPassword"
              type="password"
              required
              class="w-full px-4 py-2.5 rounded-xl bg-[#080d19] border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-400"
              placeholder="••••••••"
            />
          </div>

          <div class="text-[11px] text-slate-400 bg-white/5 p-2.5 rounded-lg border border-white/5">
            Default Demo: <span class="text-cyan-300 font-mono">admin@portfolio.com</span> / <span class="text-cyan-300 font-mono">Password123!</span>
          </div>

          <button
            type="submit"
            :disabled="loginLoading"
            class="w-full py-2.5 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-bold text-sm shadow-glow-cyan hover:opacity-95 transition-all disabled:opacity-50"
          >
            {{ loginLoading ? 'በማረጋገጥ ላይ... (Authenticating)' : 'Sign In with Sanctum' }}
          </button>
        </form>
      </div>

      <!-- Authenticated Admin Dashboard -->
      <div v-else class="flex flex-col flex-1 overflow-hidden">
        
        <!-- Tab Navigation Bar -->
        <div class="px-6 pt-3 bg-[#080C17] border-b border-white/10 flex items-center justify-between">
          <div class="flex space-x-2">
            <button
              v-for="tab in adminTabs"
              :key="tab.id"
              @click="activeTab = tab.id"
              class="px-4 py-2 text-xs font-mono font-medium rounded-t-lg transition-colors border-b-2"
              :class="activeTab === tab.id ? 'border-cyan-400 text-cyan-300 bg-white/5' : 'border-transparent text-slate-400 hover:text-white'"
            >
              {{ tab.name }}
              <span v-if="tab.id === 'messages' && unreadMessagesCount > 0" class="ml-1.5 px-1.5 py-0.2 rounded-full bg-rose-500 text-white text-[10px]">
                {{ unreadMessagesCount }}
              </span>
            </button>
          </div>

          <!-- Logout Button -->
          <button
            @click="handleLogout"
            class="text-xs text-rose-400 hover:text-rose-300 font-mono py-1 px-3 rounded-lg hover:bg-rose-500/10 transition-colors"
          >
            Sign Out
          </button>
        </div>

        <!-- Tab Contents Area -->
        <div class="p-6 overflow-y-auto flex-1 space-y-6">

          <!-- 1. MESSAGES TAB -->
          <div v-if="activeTab === 'messages'" class="space-y-4">
            <div class="flex items-center justify-between">
              <h4 class="text-sm font-bold text-white font-mono">
                Received Messages ({{ messages.length }})
              </h4>
              <button @click="fetchMessages" class="text-xs text-cyan-400 hover:underline">
                Refresh
              </button>
            </div>

            <div v-if="messages.length === 0" class="text-center py-10 text-slate-500 text-xs font-mono">
              ምንም መልዕክት የለም (No contact messages received yet).
            </div>

            <div v-for="msg in messages" :key="msg.id" class="p-4 rounded-xl bg-white/[0.03] border transition-colors" :class="msg.is_read ? 'border-white/5' : 'border-cyan-500/40 bg-cyan-950/10'">
              <div class="flex items-start justify-between gap-4">
                <div>
                  <div class="flex items-center space-x-2">
                    <span class="text-sm font-bold text-white">{{ msg.sender_name }}</span>
                    <span class="text-xs font-mono text-cyan-400">({{ msg.sender_email }})</span>
                    <span v-if="!msg.is_read" class="px-2 py-0.5 rounded text-[10px] bg-cyan-500/20 text-cyan-300 border border-cyan-500/40">
                      New
                    </span>
                  </div>
                  <div class="text-xs text-slate-400 mt-0.5 font-mono">
                    Project: <span class="text-slate-200">{{ msg.project_type || 'General Inquiry' }}</span>
                  </div>
                </div>

                <div class="flex items-center space-x-2">
                  <button
                    v-if="!msg.is_read"
                    @click="markRead(msg.id)"
                    class="px-2.5 py-1 rounded bg-white/5 text-[11px] text-cyan-300 hover:bg-cyan-500/20"
                  >
                    Mark Read
                  </button>
                  <button
                    @click="deleteMsg(msg.id)"
                    class="px-2 py-1 rounded bg-rose-500/10 text-[11px] text-rose-400 hover:bg-rose-500/20"
                  >
                    Delete
                  </button>
                </div>
              </div>

              <p class="text-xs sm:text-sm text-slate-300 mt-3 p-3 rounded-lg bg-black/40 border border-white/5 leading-relaxed">
                {{ msg.message }}
              </p>
              <span class="text-[10px] text-slate-500 mt-2 block font-mono">
                Received: {{ new Date(msg.created_at).toLocaleString() }}
              </span>
            </div>
          </div>

          <!-- 2. PROJECTS TAB (CRUD) -->
          <div v-if="activeTab === 'projects'" class="space-y-6">
            <div class="flex items-center justify-between">
              <h4 class="text-sm font-bold text-white font-mono">
                Manage Projects ({{ projects.length }})
              </h4>
              <button
                @click="showCreateProject = !showCreateProject"
                class="px-3 py-1.5 rounded-lg bg-cyan-500 text-black text-xs font-bold shadow-glow-cyan"
              >
                {{ showCreateProject ? 'Cancel' : '+ Add New Project' }}
              </button>
            </div>

            <!-- Create Project Form -->
            <form v-if="showCreateProject" @submit.prevent="handleCreateProject" class="p-5 rounded-2xl bg-[#080d19] border border-cyan-500/30 space-y-4">
              <h5 class="text-xs font-mono font-bold text-cyan-300 uppercase">New Project Details</h5>
              
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs text-slate-400 mb-1">Title</label>
                  <input v-model="newProj.title" required class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs" />
                </div>
                <div>
                  <label class="block text-xs text-slate-400 mb-1">Category</label>
                  <select v-model="newProj.category" class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs">
                    <option value="Full-Stack">Full-Stack</option>
                    <option value="Backend">Backend</option>
                    <option value="Frontend">Frontend</option>
                    <option value="Tools">Tools</option>
                  </select>
                </div>
              </div>

              <div>
                <label class="block text-xs text-slate-400 mb-1">Summary</label>
                <input v-model="newProj.summary" required class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs" />
              </div>

              <div>
                <label class="block text-xs text-slate-400 mb-1">Description</label>
                <textarea v-model="newProj.description" rows="2" required class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs"></textarea>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs text-slate-400 mb-1">Problem Solved (Case Study)</label>
                  <textarea v-model="newProj.problem_solved" rows="2" class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs"></textarea>
                </div>
                <div>
                  <label class="block text-xs text-slate-400 mb-1">Database Architecture</label>
                  <textarea v-model="newProj.database_architecture" rows="2" class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs"></textarea>
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                  <label class="block text-xs text-slate-400 mb-1">Thumbnail URL</label>
                  <input v-model="newProj.thumbnail_url" class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs" />
                </div>
                <div>
                  <label class="block text-xs text-slate-400 mb-1">Live Demo URL</label>
                  <input v-model="newProj.live_demo_url" class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs" />
                </div>
                <div>
                  <label class="block text-xs text-slate-400 mb-1">GitHub URL</label>
                  <input v-model="newProj.github_url" class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs" />
                </div>
              </div>

              <button type="submit" class="px-5 py-2 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-bold text-xs">
                Save Project to Database
              </button>
            </form>

            <!-- Projects Table -->
            <div class="space-y-3">
              <div v-for="proj in projects" :key="proj.id" class="p-3.5 rounded-xl bg-white/[0.02] border border-white/10 flex items-center justify-between">
                <div>
                  <span class="text-xs px-2 py-0.5 rounded bg-cyan-500/20 text-cyan-300 font-mono mr-2">{{ proj.category }}</span>
                  <span class="text-sm font-bold text-white">{{ proj.title }}</span>
                </div>
                <div class="flex items-center space-x-2">
                  <button @click="deleteProj(proj.id)" class="px-2.5 py-1 rounded bg-rose-500/10 text-xs text-rose-400 hover:bg-rose-500/20">
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- 3. PROFILE SETTINGS TAB -->
          <div v-if="activeTab === 'profile'" class="space-y-4">
            <h4 class="text-sm font-bold text-white font-mono">
              Live Profile & Content Customizer (Zero Hardcode)
            </h4>

            <div v-if="profileSaveNotice" class="p-3 rounded-lg bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs">
              {{ profileSaveNotice }}
            </div>

            <form @submit.prevent="handleSaveProfile" class="space-y-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs text-slate-400 mb-1">Brand Name</label>
                  <input v-model="profileForm.brand_name" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs" />
                </div>
                <div>
                  <label class="block text-xs text-slate-400 mb-1">Developer Name</label>
                  <input v-model="profileForm.developer_name" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs" />
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs text-slate-400 mb-1">Tagline</label>
                  <input v-model="profileForm.tagline" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs" />
                </div>
                <div>
                  <label class="block text-xs text-slate-400 mb-1">Status Badge Text</label>
                  <input v-model="profileForm.status_badge" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs" />
                </div>
              </div>

              <div>
                <label class="block text-xs text-slate-400 mb-1">Hero Title</label>
                <input v-model="profileForm.hero_title" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs" />
              </div>

              <div>
                <label class="block text-xs text-slate-400 mb-1">Hero Subtitle</label>
                <textarea v-model="profileForm.hero_subtitle" rows="2" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs"></textarea>
              </div>

              <div>
                <label class="block text-xs text-slate-400 mb-1">About Bio</label>
                <textarea v-model="profileForm.about_bio" rows="3" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs"></textarea>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                  <label class="block text-xs text-slate-400 mb-1">Email</label>
                  <input v-model="profileForm.email" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs" />
                </div>
                <div>
                  <label class="block text-xs text-slate-400 mb-1">GitHub URL</label>
                  <input v-model="profileForm.github_url" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs" />
                </div>
                <div>
                  <label class="block text-xs text-slate-400 mb-1">LinkedIn URL</label>
                  <input v-model="profileForm.linkedin_url" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs" />
                </div>
              </div>

              <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-bold text-xs shadow-glow-cyan">
                Update Profile in MySQL
              </button>
            </form>
          </div>

        </div>

      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, watch } from 'vue'
import { api } from '../services/api'

const props = defineProps({
  isOpen: Boolean,
  currentProfile: Object,
  projects: {
    type: Array,
    default: () => [],
  }
})

const emit = defineEmits(['close', 'refresh-data'])

const isAuthenticated = ref(!!localStorage.getItem('portfolio_token'))
const loginEmail = ref('admin@portfolio.com')
const loginPassword = ref('Password123!')
const loginLoading = ref(false)
const loginError = ref('')

const activeTab = ref('messages')
const adminTabs = [
  { id: 'messages', name: 'Messages' },
  { id: 'projects', name: 'Projects' },
  { id: 'profile', name: 'Profile Settings' },
]

const messages = ref([])
const unreadMessagesCount = ref(0)
const showCreateProject = ref(false)
const profileSaveNotice = ref('')

const newProj = reactive({
  title: '',
  category: 'Full-Stack',
  summary: '',
  description: '',
  problem_solved: '',
  database_architecture: '',
  thumbnail_url: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1000&q=80',
  live_demo_url: '',
  github_url: '',
})

const profileForm = reactive({ ...props.currentProfile })

watch(() => props.currentProfile, (newVal) => {
  if (newVal) {
    Object.assign(profileForm, newVal)
  }
}, { deep: true, immediate: true })

const handleLogin = async () => {
  loginLoading.value = true
  loginError.value = ''
  try {
    const res = await api.login({
      email: loginEmail.value,
      password: loginPassword.value,
    })
    localStorage.setItem('portfolio_token', res.data.token)
    isAuthenticated.value = true
    await fetchMessages()
  } catch (err) {
    loginError.value = err.response?.data?.message || 'መግባት አልተቻለም፤ መረጃውን ያረጋግጡ (Authentication failed).'
  } finally {
    loginLoading.value = false
  }
}

const handleLogout = async () => {
  try {
    await api.logout()
  } catch (_) {}
  localStorage.removeItem('portfolio_token')
  isAuthenticated.value = false
}

const fetchMessages = async () => {
  if (!isAuthenticated.value) return
  try {
    const res = await api.getMessages()
    messages.value = res.data.data
    unreadMessagesCount.value = res.data.unread_count || 0
  } catch (_) {}
}

const markRead = async (id) => {
  try {
    await api.markMessageRead(id)
    await fetchMessages()
  } catch (_) {}
}

const deleteMsg = async (id) => {
  if (!confirm('ይህ መልዕክት ይሰረዝ? (Delete this message?)')) return
  try {
    await api.deleteMessage(id)
    await fetchMessages()
  } catch (_) {}
}

const handleCreateProject = async () => {
  try {
    await api.createProject(newProj)
    showCreateProject.value = false
    emit('refresh-data')
    alert('ፕሮጀክቱ በተሳካ ሁኔታ ተፈጥሯል! (Project created!)')
  } catch (err) {
    alert('ስህተት ተከስቷል: ' + (err.response?.data?.message || err.message))
  }
}

const deleteProj = async (id) => {
  if (!confirm('ፕሮጀክቱ ይሰረዝ? (Delete this project?)')) return
  try {
    await api.deleteProject(id)
    emit('refresh-data')
  } catch (_) {}
}

const handleSaveProfile = async () => {
  try {
    profileSaveNotice.value = ''
    await api.updateProfile(profileForm)
    profileSaveNotice.value = 'መረጃዎች በMySQL ዳታቤዝ ላይ ተሻሽለዋል! (Profile saved to MySQL!)'
    emit('refresh-data')
  } catch (err) {
    alert('ስህተት: ' + (err.response?.data?.message || err.message))
  }
}

onMounted(() => {
  if (isAuthenticated.value) {
    fetchMessages()
  }
})
</script>
