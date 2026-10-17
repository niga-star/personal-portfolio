<template>
  <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-6 overflow-y-auto">
    <!-- Backdrop Blur -->
    <div class="fixed inset-0 bg-black/85 backdrop-blur-md" @click="$emit('close')"></div>

    <!-- Admin Window -->
    <div class="relative w-full max-w-5xl rounded-2xl bg-[#0B101E] border border-cyan-500/30 shadow-[0_0_50px_rgba(6,182,212,0.25)] overflow-hidden z-10 my-4 flex flex-col max-h-[92vh]">
      
      <!-- Top Header -->
      <div class="p-4 sm:p-5 bg-[#080C17] border-b border-white/10 flex items-center justify-between">
        <div class="flex items-center space-x-3">
          <div class="w-9 h-9 rounded-xl bg-cyan-500/20 border border-cyan-500/40 flex items-center justify-center text-cyan-400">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
          </div>
          <div>
            <div class="flex items-center space-x-2">
              <h3 class="text-sm sm:text-base font-bold text-white font-mono">
                Admin Management Portal
              </h3>
              <span v-if="isAuthenticated" class="px-2 py-0.5 rounded-full text-[10px] font-mono bg-emerald-500/20 text-emerald-400 border border-emerald-500/40">
                Authorized
              </span>
            </div>
            <p class="text-xs text-slate-400 hidden sm:block">
              Full control over projects, skills, journey, messages, profile, and security.
            </p>
          </div>
        </div>

        <button
          @click="$emit('close')"
          class="w-8 h-8 rounded-full bg-white/5 border border-white/10 text-slate-400 hover:text-white flex items-center justify-center transition-colors cursor-pointer"
        >
          ✕
        </button>
      </div>

      <!-- Main Body: If Not Authenticated Show Login -->
      <div v-if="!isAuthenticated" class="p-6 sm:p-12 flex flex-col items-center justify-center text-center">
        <div class="w-16 h-16 rounded-2xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400 mb-4 shadow-glow-cyan">
          <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <h4 class="text-xl font-bold text-white mb-1">የአስተዳዳሪ መግቢያ (Admin Authentication)</h4>
        <p class="text-xs text-slate-400 mb-6 max-w-md">
          ይህ የአስተዳዳሪ ክፍል በLaravel Sanctum እና በብሩት-ፎርስ መከላከያ (Rate Limiting) የተጠበቀ ነው። እባክዎ የተፈቀደለትን መረጃ ያስገቡ።
        </p>

        <form @submit.prevent="handleLogin" class="w-full max-w-sm space-y-4 text-left">
          <div v-if="loginGeneralError" class="p-3 rounded-xl bg-rose-500/20 border border-rose-500/40 text-rose-300 text-xs">
            {{ loginGeneralError }}
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-300 mb-1">Email (ኢሜይል)</label>
            <input
              v-model="loginEmail"
              type="email"
              placeholder="admin@portfolio.com"
              class="w-full px-4 py-2.5 rounded-xl bg-[#080d19] border text-white text-sm focus:outline-none focus:border-cyan-400 transition-colors"
              :class="loginErrors.email ? 'border-rose-500' : 'border-white/10'"
            />
            <span v-if="loginErrors.email" class="text-xs text-rose-400 mt-1 block">{{ loginErrors.email[0] }}</span>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-300 mb-1">Password (የይለፍ ቃል)</label>
            <input
              v-model="loginPassword"
              type="password"
              placeholder="••••••••"
              class="w-full px-4 py-2.5 rounded-xl bg-[#080d19] border text-white text-sm focus:outline-none focus:border-cyan-400 transition-colors"
              :class="loginErrors.password ? 'border-rose-500' : 'border-white/10'"
            />
            <span v-if="loginErrors.password" class="text-xs text-rose-400 mt-1 block">{{ loginErrors.password[0] }}</span>
          </div>

          <div class="text-[11px] text-slate-400 bg-white/5 p-2.5 rounded-xl border border-white/5">
            Default Demo: <span class="text-cyan-300 font-mono">admin@portfolio.com</span> / <span class="text-cyan-300 font-mono">Password123!</span>
          </div>

          <button
            type="submit"
            :disabled="loginLoading"
            class="w-full py-2.5 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-bold text-sm shadow-glow-cyan hover:opacity-95 transition-all disabled:opacity-50 cursor-pointer flex items-center justify-center space-x-2"
          >
            <svg v-if="loginLoading" class="animate-spin w-4 h-4 text-black" viewBox="0 0 24 24" fill="none">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            <span>{{ loginLoading ? 'በማረጋገጥ ላይ... (Authenticating)' : 'Sign In with Sanctum' }}</span>
          </button>
        </form>
      </div>

      <!-- Authenticated Admin Dashboard -->
      <div v-else class="flex flex-col flex-1 overflow-hidden">
        
        <!-- Tab Navigation Bar -->
        <div class="px-4 sm:px-6 pt-3 bg-[#080C17] border-b border-white/10 flex items-center justify-between overflow-x-auto">
          <div class="flex space-x-1 sm:space-x-2">
            <button
              v-for="tab in adminTabs"
              :key="tab.id"
              @click="activeTab = tab.id"
              class="px-3 sm:px-4 py-2 text-xs font-mono font-medium rounded-t-lg transition-colors border-b-2 whitespace-nowrap cursor-pointer"
              :class="activeTab === tab.id ? 'border-cyan-400 text-cyan-300 bg-white/5' : 'border-transparent text-slate-400 hover:text-white'"
            >
              {{ tab.name }}
              <span v-if="tab.id === 'messages' && unreadMessagesCount > 0" class="ml-1.5 px-1.5 py-0.2 rounded-full bg-rose-500 text-white text-[10px]">
                {{ unreadMessagesCount }}
              </span>
            </button>
          </div>

          <!-- Sign Out Button -->
          <button
            @click="handleLogout"
            class="text-xs text-rose-400 hover:text-rose-300 font-mono py-1 px-3 rounded-lg hover:bg-rose-500/10 transition-colors ml-4 whitespace-nowrap cursor-pointer"
          >
            Sign Out
          </button>
        </div>

        <!-- Tab Contents Area -->
        <div class="p-4 sm:p-6 overflow-y-auto flex-1 space-y-6">

          <!-- 1. MESSAGES TAB -->
          <div v-if="activeTab === 'messages'" class="space-y-4">
            <div class="flex items-center justify-between">
              <div>
                <h4 class="text-sm font-bold text-white font-mono">
                  Received Contact Messages ({{ messages.length }})
                </h4>
                <p class="text-xs text-slate-400">የመጡ መልዕክቶችን ይመልከቱ፣ አንብበው እንደጨረሱ ምልክት ያድርጉ ወይም ያጥፉ።</p>
              </div>
              <button @click="fetchMessages" class="text-xs text-cyan-400 hover:underline cursor-pointer">
                Refresh
              </button>
            </div>

            <div v-if="messages.length === 0" class="text-center py-10 text-slate-500 text-xs font-mono">
              ምንም መልዕክት የለም (No contact messages received yet).
            </div>

            <div v-for="msg in messages" :key="msg.id" class="p-4 rounded-xl bg-white/[0.03] border transition-colors" :class="msg.is_read ? 'border-white/5' : 'border-cyan-500/40 bg-cyan-950/10'">
              <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3">
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
                    <span v-if="msg.budget_range" class="ml-2">| Budget: <span class="text-emerald-300">{{ msg.budget_range }}</span></span>
                  </div>
                </div>

                <div class="flex items-center space-x-2">
                  <button
                    v-if="!msg.is_read"
                    @click="markRead(msg.id)"
                    class="px-2.5 py-1 rounded bg-white/5 text-[11px] text-cyan-300 hover:bg-cyan-500/20 cursor-pointer"
                  >
                    Mark Read
                  </button>
                  <button
                    @click="deleteMsg(msg.id)"
                    class="px-2.5 py-1 rounded bg-rose-500/10 text-[11px] text-rose-400 hover:bg-rose-500/20 cursor-pointer"
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

          <!-- 2. PROJECTS TAB (Create, Edit, Delete with Inline Validation) -->
          <div v-if="activeTab === 'projects'" class="space-y-6">
            <div class="flex items-center justify-between">
              <div>
                <h4 class="text-sm font-bold text-white font-mono">
                  Manage Projects ({{ projects.length }})
                </h4>
                <p class="text-xs text-slate-400">ፕሮጀክቶችን አዲስ ይፍጠሩ፣ ነባሮችን ያሻሽሉ ወይም ይሰርዙ።</p>
              </div>
              <button
                @click="openProjectForm(null)"
                class="px-3 py-1.5 rounded-lg bg-cyan-500 text-black text-xs font-bold shadow-glow-cyan hover:opacity-90 transition-opacity cursor-pointer"
              >
                {{ isEditingProject ? 'Cancel Edit' : (showProjectForm ? 'Close Form' : '+ Add New Project') }}
              </button>
            </div>

            <!-- Project Form (Create / Edit) -->
            <form v-if="showProjectForm" @submit.prevent="handleSaveProject" class="p-5 rounded-2xl bg-[#080d19] border border-cyan-500/30 space-y-4">
              <div class="flex items-center justify-between">
                <h5 class="text-xs font-mono font-bold text-cyan-300 uppercase">
                  {{ isEditingProject ? `Edit Project: ${projectForm.title}` : 'New Project Details' }}
                </h5>
                <span class="text-[11px] text-slate-400 font-mono">Validated with ProjectRequest</span>
              </div>

              <div v-if="projectGeneralError" class="p-3 rounded-xl bg-rose-500/20 border border-rose-500/40 text-rose-300 text-xs">
                {{ projectGeneralError }}
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Title *</label>
                  <input
                    v-model="projectForm.title"
                    type="text"
                    placeholder="e.g. NextGen Microservices Platform"
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400 transition-colors"
                    :class="projectErrors.title ? 'border-rose-500' : 'border-white/10'"
                  />
                  <span v-if="projectErrors.title" class="text-xs text-rose-400 mt-1 block">{{ projectErrors.title[0] }}</span>
                </div>
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Category *</label>
                  <select
                    v-model="projectForm.category"
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                    :class="projectErrors.category ? 'border-rose-500' : 'border-white/10'"
                  >
                    <option value="Full-Stack">Full-Stack</option>
                    <option value="Backend">Backend</option>
                    <option value="Frontend">Frontend</option>
                    <option value="Tools">Tools</option>
                  </select>
                  <span v-if="projectErrors.category" class="text-xs text-rose-400 mt-1 block">{{ projectErrors.category[0] }}</span>
                </div>
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Summary * (አጭር ማጠቃለያ)</label>
                <input
                  v-model="projectForm.summary"
                  type="text"
                  placeholder="One sentence impactful summary..."
                  class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                  :class="projectErrors.summary ? 'border-rose-500' : 'border-white/10'"
                />
                <span v-if="projectErrors.summary" class="text-xs text-rose-400 mt-1 block">{{ projectErrors.summary[0] }}</span>
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Full Description * (ሙሉ መግለጫ)</label>
                <textarea
                  v-model="projectForm.description"
                  rows="2"
                  placeholder="Detailed breakdown of system capabilities..."
                  class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                  :class="projectErrors.description ? 'border-rose-500' : 'border-white/10'"
                ></textarea>
                <span v-if="projectErrors.description" class="text-xs text-rose-400 mt-1 block">{{ projectErrors.description[0] }}</span>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Problem Solved (Case Study)</label>
                  <textarea
                    v-model="projectForm.problem_solved"
                    rows="2"
                    placeholder="Challenges faced and solutions delivered..."
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400"
                  ></textarea>
                </div>
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Database Architecture</label>
                  <textarea
                    v-model="projectForm.database_architecture"
                    rows="2"
                    placeholder="Relational schema, indexes, tables used..."
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400"
                  ></textarea>
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                  <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-semibold text-slate-300">Thumbnail URL / Image</label>
                    <label class="text-[11px] text-cyan-400 hover:text-cyan-300 cursor-pointer flex items-center space-x-1">
                      <span v-if="uploadingThumbnail">Uploading...</span>
                      <span v-else>📁 Upload Image</span>
                      <input type="file" accept="image/*" class="hidden" @change="handleUploadProjectThumbnail" :disabled="uploadingThumbnail" />
                    </label>
                  </div>
                  <div class="flex items-center space-x-2">
                    <input
                      v-model="projectForm.thumbnail_url"
                      placeholder="https://... or upload from PC"
                      class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                      :class="projectErrors.thumbnail_url ? 'border-rose-500' : 'border-white/10'"
                    />
                    <img v-if="projectForm.thumbnail_url" :src="projectForm.thumbnail_url" class="w-8 h-8 rounded object-cover border border-cyan-500/30 shrink-0" />
                  </div>
                  <span v-if="projectErrors.thumbnail_url" class="text-xs text-rose-400 mt-1 block">{{ projectErrors.thumbnail_url[0] }}</span>
                </div>
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Live Demo URL</label>
                  <input
                    v-model="projectForm.live_demo_url"
                    placeholder="https://..."
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                    :class="projectErrors.live_demo_url ? 'border-rose-500' : 'border-white/10'"
                  />
                  <span v-if="projectErrors.live_demo_url" class="text-xs text-rose-400 mt-1 block">{{ projectErrors.live_demo_url[0] }}</span>
                </div>
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">GitHub URL</label>
                  <input
                    v-model="projectForm.github_url"
                    placeholder="https://github.com/..."
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                    :class="projectErrors.github_url ? 'border-rose-500' : 'border-white/10'"
                  />
                  <span v-if="projectErrors.github_url" class="text-xs text-rose-400 mt-1 block">{{ projectErrors.github_url[0] }}</span>
                </div>
              </div>

              <!-- Associated Skills Selection -->
              <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Attached Skills / Tech Stack</label>
                <div class="flex flex-wrap gap-2 p-2.5 rounded-xl bg-black/30 border border-white/5">
                  <label
                    v-for="skill in skills"
                    :key="skill.id"
                    class="flex items-center space-x-1.5 px-2.5 py-1 rounded-lg text-xs cursor-pointer transition-colors"
                    :class="projectForm.skill_ids.includes(skill.id) ? 'bg-cyan-500/20 text-cyan-300 border border-cyan-500/40' : 'bg-white/5 text-slate-400 border border-transparent hover:text-white'"
                  >
                    <input
                      type="checkbox"
                      :value="skill.id"
                      v-model="projectForm.skill_ids"
                      class="hidden"
                    />
                    <span>{{ skill.name }}</span>
                  </label>
                </div>
              </div>

              <div class="flex items-center space-x-4 pt-2">
                <label class="flex items-center space-x-2 text-xs text-slate-300 cursor-pointer">
                  <input type="checkbox" v-model="projectForm.is_featured" class="rounded accent-cyan-400" />
                  <span>Feature on Homepage (ተለይቶ እንዲታይ)</span>
                </label>
              </div>

              <div class="flex items-center space-x-3 pt-2">
                <button
                  type="submit"
                  :disabled="projectSaving"
                  class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-bold text-xs shadow-glow-cyan hover:opacity-95 transition-all disabled:opacity-50 cursor-pointer"
                >
                  {{ projectSaving ? 'በማስቀመጥ ላይ...' : (isEditingProject ? 'Update Project' : 'Save Project to Database') }}
                </button>
                <button
                  type="button"
                  @click="showProjectForm = false"
                  class="px-4 py-2.5 rounded-xl bg-white/5 text-slate-400 hover:text-white text-xs cursor-pointer"
                >
                  Cancel
                </button>
              </div>
            </form>

            <!-- Projects Table -->
            <div class="space-y-3">
              <div
                v-for="proj in projects"
                :key="proj.id"
                class="p-4 rounded-xl bg-white/[0.02] border border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:border-white/20 transition-colors"
              >
                <div>
                  <div class="flex items-center space-x-2 mb-1">
                    <span class="text-xs px-2 py-0.5 rounded bg-cyan-500/20 text-cyan-300 font-mono">{{ proj.category }}</span>
                    <span v-if="proj.is_featured" class="text-xs px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 font-mono">Featured</span>
                    <span class="text-sm font-bold text-white">{{ proj.title }}</span>
                  </div>
                  <p class="text-xs text-slate-400 line-clamp-1 max-w-xl">{{ proj.summary }}</p>
                </div>

                <div class="flex items-center space-x-2 shrink-0">
                  <button
                    @click="openProjectForm(proj)"
                    class="px-3 py-1.5 rounded-lg bg-cyan-500/10 text-xs text-cyan-400 hover:bg-cyan-500/20 transition-colors cursor-pointer"
                  >
                    Edit
                  </button>
                  <button
                    @click="deleteProj(proj.id)"
                    class="px-3 py-1.5 rounded-lg bg-rose-500/10 text-xs text-rose-400 hover:bg-rose-500/20 transition-colors cursor-pointer"
                  >
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- 3. SKILLS TAB (Manage Tech Stack) -->
          <div v-if="activeTab === 'skills'" class="space-y-6">
            <div class="flex items-center justify-between">
              <div>
                <h4 class="text-sm font-bold text-white font-mono">
                  Tech Stack & Skills ({{ skills.length }})
                </h4>
                <p class="text-xs text-slate-400">የቴክኖሎጂ ክህሎቶችን ይጨምሩ፣ የብቃት ፐርሰንቴጅ ይቀይሩ ወይም ይሰርዙ።</p>
              </div>
              <button
                @click="openSkillForm(null)"
                class="px-3 py-1.5 rounded-lg bg-cyan-500 text-black text-xs font-bold shadow-glow-cyan hover:opacity-90 transition-opacity cursor-pointer"
              >
                {{ showSkillForm ? 'Close Form' : '+ Add New Skill' }}
              </button>
            </div>

            <!-- Skill Create/Edit Form -->
            <form v-if="showSkillForm" @submit.prevent="handleSaveSkill" class="p-5 rounded-2xl bg-[#080d19] border border-cyan-500/30 space-y-4">
              <h5 class="text-xs font-mono font-bold text-cyan-300 uppercase">
                {{ isEditingSkill ? `Edit Skill: ${skillForm.name}` : 'New Skill Details' }}
              </h5>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Skill Name * (e.g. Docker)</label>
                  <input
                    v-model="skillForm.name"
                    type="text"
                    placeholder="e.g. Redis"
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                    :class="skillErrors.name ? 'border-rose-500' : 'border-white/10'"
                  />
                  <span v-if="skillErrors.name" class="text-xs text-rose-400 mt-1 block">{{ skillErrors.name[0] }}</span>
                </div>

                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Category *</label>
                  <select
                    v-model="skillForm.category"
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                    :class="skillErrors.category ? 'border-rose-500' : 'border-white/10'"
                  >
                    <option value="backend">Backend</option>
                    <option value="frontend">Frontend</option>
                    <option value="database">Database</option>
                    <option value="tools">Tools</option>
                  </select>
                  <span v-if="skillErrors.category" class="text-xs text-rose-400 mt-1 block">{{ skillErrors.category[0] }}</span>
                </div>

                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Proficiency % * (1 - 100)</label>
                  <input
                    v-model.number="skillForm.proficiency_percentage"
                    type="number"
                    min="1"
                    max="100"
                    placeholder="90"
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                    :class="skillErrors.proficiency_percentage ? 'border-rose-500' : 'border-white/10'"
                  />
                  <span v-if="skillErrors.proficiency_percentage" class="text-xs text-rose-400 mt-1 block">{{ skillErrors.proficiency_percentage[0] }}</span>
                </div>
              </div>

              <div class="flex items-center space-x-3 pt-2">
                <button
                  type="submit"
                  :disabled="skillSaving"
                  class="px-5 py-2 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-bold text-xs shadow-glow-cyan hover:opacity-95 transition-all disabled:opacity-50 cursor-pointer"
                >
                  {{ skillSaving ? 'በማስቀመጥ ላይ...' : (isEditingSkill ? 'Update Skill' : 'Save Skill') }}
                </button>
                <button
                  type="button"
                  @click="showSkillForm = false"
                  class="px-4 py-2 rounded-xl bg-white/5 text-slate-400 hover:text-white text-xs cursor-pointer"
                >
                  Cancel
                </button>
              </div>
            </form>

            <!-- Skills List Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
              <div
                v-for="s in skills"
                :key="s.id"
                class="p-3.5 rounded-xl bg-white/[0.02] border border-white/10 flex items-center justify-between"
              >
                <div>
                  <div class="flex items-center space-x-2">
                    <span class="text-xs font-bold text-white">{{ s.name }}</span>
                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-white/5 text-slate-400 uppercase font-mono">{{ s.category }}</span>
                  </div>
                  <div class="w-24 bg-white/10 h-1.5 rounded-full mt-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-400 to-emerald-400 h-full rounded-full" :style="{ width: `${s.proficiency_percentage}%` }"></div>
                  </div>
                  <span class="text-[10px] text-slate-500 mt-0.5 block font-mono">{{ s.proficiency_percentage }}% Proficiency</span>
                </div>

                <div class="flex items-center space-x-1.5">
                  <button
                    @click="openSkillForm(s)"
                    class="p-1.5 rounded bg-cyan-500/10 text-cyan-400 hover:bg-cyan-500/20 text-xs cursor-pointer"
                    title="Edit"
                  >
                    ✎
                  </button>
                  <button
                    @click="deleteSkill(s.id)"
                    class="p-1.5 rounded bg-rose-500/10 text-rose-400 hover:bg-rose-500/20 text-xs cursor-pointer"
                    title="Delete"
                  >
                    ✕
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- 4. EXPERIENCES TAB (Career & Education) -->
          <div v-if="activeTab === 'experiences'" class="space-y-6">
            <div class="flex items-center justify-between">
              <div>
                <h4 class="text-sm font-bold text-white font-mono">
                  Career & Education Timeline ({{ experiences.length }})
                </h4>
                <p class="text-xs text-slate-400">የስራ ልምድ እና የትምህርት ታሪክ ዝርዝሮችን ያስተዳድሩ።</p>
              </div>
              <button
                @click="openExpForm(null)"
                class="px-3 py-1.5 rounded-lg bg-cyan-500 text-black text-xs font-bold shadow-glow-cyan hover:opacity-90 transition-opacity cursor-pointer"
              >
                {{ showExpForm ? 'Close Form' : '+ Add Experience' }}
              </button>
            </div>

            <!-- Experience Form -->
            <form v-if="showExpForm" @submit.prevent="handleSaveExp" class="p-5 rounded-2xl bg-[#080d19] border border-cyan-500/30 space-y-4">
              <h5 class="text-xs font-mono font-bold text-cyan-300 uppercase">
                {{ isEditingExp ? `Edit Milestone: ${expForm.role_title}` : 'New Timeline Milestone' }}
              </h5>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Period * (e.g. 2022 - 2024 or Present)</label>
                  <input
                    v-model="expForm.period"
                    type="text"
                    placeholder="2022 - Present"
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                    :class="expErrors.period ? 'border-rose-500' : 'border-white/10'"
                  />
                  <span v-if="expErrors.period" class="text-xs text-rose-400 mt-1 block">{{ expErrors.period[0] }}</span>
                </div>

                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Role Title * (የስራ መደብ / ዲግሪ)</label>
                  <input
                    v-model="expForm.role_title"
                    type="text"
                    placeholder="Senior Full-Stack Engineer"
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                    :class="expErrors.role_title ? 'border-rose-500' : 'border-white/10'"
                  />
                  <span v-if="expErrors.role_title" class="text-xs text-rose-400 mt-1 block">{{ expErrors.role_title[0] }}</span>
                </div>

                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Institution / Company *</label>
                  <input
                    v-model="expForm.institution"
                    type="text"
                    placeholder="Tech Innovators Global"
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                    :class="expErrors.institution ? 'border-rose-500' : 'border-white/10'"
                  />
                  <span v-if="expErrors.institution" class="text-xs text-rose-400 mt-1 block">{{ expErrors.institution[0] }}</span>
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Type *</label>
                  <select
                    v-model="expForm.type"
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                    :class="expErrors.type ? 'border-rose-500' : 'border-white/10'"
                  >
                    <option value="career">Career (የስራ ልምድ)</option>
                    <option value="education">Education (የትምህርት ደረጃ)</option>
                  </select>
                  <span v-if="expErrors.type" class="text-xs text-rose-400 mt-1 block">{{ expErrors.type[0] }}</span>
                </div>
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Description</label>
                  <input
                    v-model="expForm.description"
                    placeholder="Short description of achievements..."
                    class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400"
                  />
                </div>
              </div>

              <div class="flex items-center space-x-3 pt-2">
                <button
                  type="submit"
                  :disabled="expSaving"
                  class="px-5 py-2 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-bold text-xs shadow-glow-cyan hover:opacity-95 transition-all disabled:opacity-50 cursor-pointer"
                >
                  {{ expSaving ? 'በማስቀመጥ ላይ...' : (isEditingExp ? 'Update Milestone' : 'Save Milestone') }}
                </button>
                <button
                  type="button"
                  @click="showExpForm = false"
                  class="px-4 py-2 rounded-xl bg-white/5 text-slate-400 hover:text-white text-xs cursor-pointer"
                >
                  Cancel
                </button>
              </div>
            </form>

            <!-- Experiences List -->
            <div class="space-y-3">
              <div
                v-for="exp in experiences"
                :key="exp.id"
                class="p-4 rounded-xl bg-white/[0.02] border border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-3"
              >
                <div>
                  <div class="flex items-center space-x-2">
                    <span class="text-xs px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 font-mono capitalize">{{ exp.type }}</span>
                    <span class="text-xs font-mono text-cyan-400">{{ exp.period }}</span>
                    <span class="text-sm font-bold text-white">{{ exp.role_title }}</span>
                  </div>
                  <div class="text-xs text-slate-300 font-mono mt-0.5">{{ exp.institution }}</div>
                  <p v-if="exp.description" class="text-xs text-slate-400 mt-1">{{ exp.description }}</p>
                </div>

                <div class="flex items-center space-x-2 shrink-0">
                  <button
                    @click="openExpForm(exp)"
                    class="px-3 py-1.5 rounded-lg bg-cyan-500/10 text-xs text-cyan-400 hover:bg-cyan-500/20 transition-colors cursor-pointer"
                  >
                    Edit
                  </button>
                  <button
                    @click="deleteExp(exp.id)"
                    class="px-3 py-1.5 rounded-lg bg-rose-500/10 text-xs text-rose-400 hover:bg-rose-500/20 transition-colors cursor-pointer"
                  >
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- 5. PROFILE SETTINGS TAB -->
          <div v-if="activeTab === 'profile'" class="space-y-4">
            <div>
              <h4 class="text-sm font-bold text-white font-mono">
                Live Profile & Content Customizer (Zero Hardcode)
              </h4>
              <p class="text-xs text-slate-400">በገጹ ላይ የሚታዩ ስሞችን፣ የጀርባ ጽሁፎችን እና ማህበራዊ አውታሮችን በቀጥታ በዳታቤዝ ያሻሽሉ።</p>
            </div>

            <div v-if="profileSaveNotice" class="p-3 rounded-lg bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs">
              {{ profileSaveNotice }}
            </div>

            <form @submit.prevent="handleSaveProfile" class="space-y-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Brand Name</label>
                  <input v-model="profileForm.brand_name" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400" />
                </div>
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Developer Name</label>
                  <input v-model="profileForm.developer_name" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400" />
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Tagline</label>
                  <input v-model="profileForm.tagline" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400" />
                </div>
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Status Badge Text</label>
                  <input v-model="profileForm.status_badge" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400" />
                </div>
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Hero Title</label>
                <input v-model="profileForm.hero_title" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400" />
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Hero Subtitle</label>
                <textarea v-model="profileForm.hero_subtitle" rows="2" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400"></textarea>
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">About Bio</label>
                <textarea v-model="profileForm.about_bio" rows="3" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400"></textarea>
              </div>

              <!-- Avatar & CV File Upload -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-semibold text-slate-300">Avatar Image</label>
                    <label class="text-[11px] text-cyan-400 hover:text-cyan-300 cursor-pointer flex items-center space-x-1">
                      <span v-if="uploadingAvatar">Uploading...</span>
                      <span v-else>📁 Upload Avatar</span>
                      <input type="file" accept="image/*" class="hidden" @change="handleUploadAvatar" :disabled="uploadingAvatar" />
                    </label>
                  </div>
                  <div class="flex items-center space-x-2">
                    <input v-model="profileForm.avatar_url" placeholder="https://... or upload" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400" />
                    <img v-if="profileForm.avatar_url" :src="profileForm.avatar_url" class="w-8 h-8 rounded-full object-cover border border-cyan-500/40 shrink-0" />
                  </div>
                </div>

                <div>
                  <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-semibold text-slate-300">CV URL / PDF Document</label>
                    <label class="text-[11px] text-emerald-400 hover:text-emerald-300 cursor-pointer flex items-center space-x-1">
                      <span v-if="uploadingCv">Uploading...</span>
                      <span v-else>📄 Upload CV (PDF)</span>
                      <input type="file" accept=".pdf" class="hidden" @change="handleUploadCv" :disabled="uploadingCv" />
                    </label>
                  </div>
                  <input v-model="profileForm.cv_url" placeholder="/api/v1/download-cv or file URL" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400" />
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Email</label>
                  <input v-model="profileForm.email" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400" />
                </div>
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">GitHub URL</label>
                  <input v-model="profileForm.github_url" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400" />
                </div>
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">LinkedIn URL</label>
                  <input v-model="profileForm.linkedin_url" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400" />
                </div>
                <div>
                  <label class="block text-xs font-semibold text-slate-300 mb-1">Telegram URL</label>
                  <input v-model="profileForm.telegram_url" class="w-full px-3 py-2 rounded-lg bg-[#080d19] border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400" />
                </div>
              </div>

              <button
                type="submit"
                :disabled="profileSaving"
                class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-bold text-xs shadow-glow-cyan hover:opacity-95 transition-all disabled:opacity-50 cursor-pointer"
              >
                {{ profileSaving ? 'በማስቀመጥ ላይ...' : 'Update Profile in MySQL' }}
              </button>
            </form>
          </div>

          <!-- 6. SECURITY & CHANGE PASSWORD TAB -->
          <div v-if="activeTab === 'security'" class="space-y-4 max-w-lg">
            <div>
              <h4 class="text-sm font-bold text-white font-mono">
                Admin Security & Change Password
              </h4>
              <p class="text-xs text-slate-400">የአስተዳዳሪውን የይለፍ ቃል በደህንነት ይቀይሩ። ቢያንስ 8 ፊደላት መሆን አለበት።</p>
            </div>

            <div v-if="securityNotice" class="p-3 rounded-lg bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs">
              {{ securityNotice }}
            </div>

            <div v-if="securityGeneralError" class="p-3 rounded-lg bg-rose-500/20 border border-rose-500/40 text-rose-300 text-xs">
              {{ securityGeneralError }}
            </div>

            <form @submit.prevent="handleChangePassword" class="space-y-4 p-5 rounded-2xl bg-[#080d19] border border-white/10">
              <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Current Password * (አሁን ያለው የይለፍ ቃል)</label>
                <input
                  v-model="passwordForm.current_password"
                  type="password"
                  placeholder="••••••••"
                  class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                  :class="passwordErrors.current_password ? 'border-rose-500' : 'border-white/10'"
                />
                <span v-if="passwordErrors.current_password" class="text-xs text-rose-400 mt-1 block">{{ passwordErrors.current_password[0] }}</span>
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">New Password * (አዲስ የይለፍ ቃል - ቢያንስ 8 ፊደላት)</label>
                <input
                  v-model="passwordForm.new_password"
                  type="password"
                  placeholder="••••••••"
                  class="w-full px-3 py-2 rounded-lg bg-black/50 border text-white text-xs focus:outline-none focus:border-cyan-400"
                  :class="passwordErrors.new_password ? 'border-rose-500' : 'border-white/10'"
                />
                <span v-if="passwordErrors.new_password" class="text-xs text-rose-400 mt-1 block">{{ passwordErrors.new_password[0] }}</span>
              </div>

              <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">Confirm New Password * (የይለፍ ቃሉን ደግመው ያረጋግጡ)</label>
                <input
                  v-model="passwordForm.new_password_confirmation"
                  type="password"
                  placeholder="••••••••"
                  class="w-full px-3 py-2 rounded-lg bg-black/50 border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-400"
                />
              </div>

              <button
                type="submit"
                :disabled="passwordSaving"
                class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-cyan-400 to-emerald-400 text-black font-bold text-xs shadow-glow-cyan hover:opacity-95 transition-all disabled:opacity-50 cursor-pointer"
              >
                {{ passwordSaving ? 'በመቀየር ላይ...' : 'Update Password' }}
              </button>
            </form>
          </div>

        </div>

      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, onUnmounted, watch } from 'vue'
import { api } from '../services/api'

const props = defineProps({
  isOpen: Boolean,
  currentProfile: Object,
  projects: {
    type: Array,
    default: () => [],
  },
  skills: {
    type: Array,
    default: () => [],
  },
  experiences: {
    type: Array,
    default: () => [],
  },
})

const emit = defineEmits(['close', 'refresh-data'])

const isAuthenticated = ref(!!localStorage.getItem('portfolio_token'))
const loginEmail = ref('admin@portfolio.com')
const loginPassword = ref('Password123!')
const loginLoading = ref(false)
const loginGeneralError = ref('')
const loginErrors = ref({})

const activeTab = ref('messages')
const adminTabs = [
  { id: 'messages', name: 'Messages' },
  { id: 'projects', name: 'Projects' },
  { id: 'skills', name: 'Skills & Tech' },
  { id: 'experiences', name: 'Journey & Experience' },
  { id: 'profile', name: 'Profile Settings' },
  { id: 'security', name: 'Security' },
]

const messages = ref([])
const unreadMessagesCount = ref(0)

// Projects State
const showProjectForm = ref(false)
const isEditingProject = ref(false)
const editingProjectId = ref(null)
const projectSaving = ref(false)
const projectGeneralError = ref('')
const projectErrors = ref({})
const projectForm = reactive({
  title: '',
  category: 'Full-Stack',
  summary: '',
  description: '',
  problem_solved: '',
  database_architecture: '',
  thumbnail_url: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1000&q=80',
  live_demo_url: '',
  github_url: '',
  is_featured: false,
  sort_order: 0,
  skill_ids: [],
})

// Skills State
const showSkillForm = ref(false)
const isEditingSkill = ref(false)
const editingSkillId = ref(null)
const skillSaving = ref(false)
const skillErrors = ref({})
const skillForm = reactive({
  name: '',
  category: 'backend',
  proficiency_percentage: 90,
  icon_class: '',
  sort_order: 0,
})

// Experiences State
const showExpForm = ref(false)
const isEditingExp = ref(false)
const editingExpId = ref(null)
const expSaving = ref(false)
const expErrors = ref({})
const expForm = reactive({
  period: '',
  role_title: '',
  institution: '',
  type: 'career',
  description: '',
  sort_order: 0,
})

// Profile State
const profileSaving = ref(false)
const profileSaveNotice = ref('')
const profileForm = reactive({ ...props.currentProfile })

// Password Security State
const passwordSaving = ref(false)
const securityNotice = ref('')
const securityGeneralError = ref('')
const passwordErrors = ref({})
const passwordForm = reactive({
  current_password: '',
  new_password: '',
  new_password_confirmation: '',
})

watch(() => props.currentProfile, (newVal) => {
  if (newVal) {
    Object.assign(profileForm, newVal)
  }
}, { deep: true, immediate: true })

// Check session validity whenever modal opens
watch(() => props.isOpen, async (isOpen) => {
  if (isOpen && isAuthenticated.value) {
    try {
      await api.getCurrentUser()
      fetchMessages()
    } catch {
      localStorage.removeItem('portfolio_token')
      isAuthenticated.value = false
    }
  }
})

// 401 Unauthorized listener
const handleUnauthorized = () => {
  isAuthenticated.value = false
  loginGeneralError.value = 'የክፍለ-ጊዜው (Session) ገደብ አልቋል፤ እባክዎ እንደገና ይግቡ (Session expired, please sign in).'
}

onMounted(() => {
  window.addEventListener('auth:unauthorized', handleUnauthorized)
  if (isAuthenticated.value) {
    fetchMessages()
  }
})

onUnmounted(() => {
  window.removeEventListener('auth:unauthorized', handleUnauthorized)
})

// 1. Authentication Handlers
const handleLogin = async () => {
  loginLoading.value = true
  loginGeneralError.value = ''
  loginErrors.value = {}

  try {
    const res = await api.login({
      email: loginEmail.value,
      password: loginPassword.value,
    })
    localStorage.setItem('portfolio_token', res.data.token)
    isAuthenticated.value = true
    await fetchMessages()
  } catch (err) {
    if (err.response?.status === 422) {
      loginErrors.value = err.response.data.errors || {}
      loginGeneralError.value = err.response.data.message || 'እባክዎ መረጃዎን በትክክል ያስገቡ።'
    } else if (err.response?.status === 429) {
      loginGeneralError.value = 'የመግባት ሙከራዎች በዝተዋል፤ እባክዎ ከ1 ደቂቃ በኋላ እንደገና ይሞክሩ (Rate limited: 5 attempts/min).'
    } else {
      loginGeneralError.value = err.response?.data?.message || 'መግባት አልተቻለም፤ መረጃውን ያረጋግጡ (Authentication failed).'
    }
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

// 2. Messages Handlers
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

// 3. Projects Handlers
const openProjectForm = (proj = null) => {
  projectGeneralError.value = ''
  projectErrors.value = {}

  if (proj) {
    isEditingProject.value = true
    editingProjectId.value = proj.id
    projectForm.title = proj.title || ''
    projectForm.category = proj.category || 'Full-Stack'
    projectForm.summary = proj.summary || ''
    projectForm.description = proj.description || ''
    projectForm.problem_solved = proj.problem_solved || ''
    projectForm.database_architecture = proj.database_architecture || ''
    projectForm.thumbnail_url = proj.thumbnail_url || ''
    projectForm.live_demo_url = proj.live_demo_url || ''
    projectForm.github_url = proj.github_url || ''
    projectForm.is_featured = !!proj.is_featured
    projectForm.sort_order = proj.sort_order || 0
    projectForm.skill_ids = proj.skills ? proj.skills.map(s => s.id) : []
    showProjectForm.value = true
  } else {
    isEditingProject.value = false
    editingProjectId.value = null
    projectForm.title = ''
    projectForm.category = 'Full-Stack'
    projectForm.summary = ''
    projectForm.description = ''
    projectForm.problem_solved = ''
    projectForm.database_architecture = ''
    projectForm.thumbnail_url = 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1000&q=80'
    projectForm.live_demo_url = ''
    projectForm.github_url = ''
    projectForm.is_featured = false
    projectForm.sort_order = 0
    projectForm.skill_ids = []
    showProjectForm.value = !showProjectForm.value
  }
}

const handleSaveProject = async () => {
  projectSaving.value = true
  projectGeneralError.value = ''
  projectErrors.value = {}

  try {
    if (isEditingProject.value) {
      await api.updateProject(editingProjectId.value, projectForm)
    } else {
      await api.createProject(projectForm)
    }
    showProjectForm.value = false
    emit('refresh-data')
  } catch (err) {
    if (err.response?.status === 422) {
      projectErrors.value = err.response.data.errors || {}
      projectGeneralError.value = 'እባክዎ በቅጹ ውስጥ የተፈጠሩ ስህተቶችን ያስተካክሉ።'
    } else {
      projectGeneralError.value = err.response?.data?.message || err.message
    }
  } finally {
    projectSaving.value = false
  }
}

const deleteProj = async (id) => {
  if (!confirm('ፕሮጀክቱ ከዳታቤዝ ይሰረዝ? (Delete this project?)')) return
  try {
    await api.deleteProject(id)
    emit('refresh-data')
  } catch (err) {
    alert('ስህተት: ' + (err.response?.data?.message || err.message))
  }
}

// 4. Skills Handlers
const openSkillForm = (skill = null) => {
  skillErrors.value = {}
  if (skill) {
    isEditingSkill.value = true
    editingSkillId.value = skill.id
    skillForm.name = skill.name
    skillForm.category = skill.category
    skillForm.proficiency_percentage = skill.proficiency_percentage
    skillForm.icon_class = skill.icon_class || ''
    skillForm.sort_order = skill.sort_order || 0
    showSkillForm.value = true
  } else {
    isEditingSkill.value = false
    editingSkillId.value = null
    skillForm.name = ''
    skillForm.category = 'backend'
    skillForm.proficiency_percentage = 90
    skillForm.icon_class = ''
    skillForm.sort_order = 0
    showSkillForm.value = !showSkillForm.value
  }
}

const handleSaveSkill = async () => {
  skillSaving.value = true
  skillErrors.value = {}

  try {
    if (isEditingSkill.value) {
      await api.updateSkill(editingSkillId.value, skillForm)
    } else {
      await api.createSkill(skillForm)
    }
    showSkillForm.value = false
    emit('refresh-data')
  } catch (err) {
    if (err.response?.status === 422) {
      skillErrors.value = err.response.data.errors || {}
    } else {
      alert('ስህተት: ' + (err.response?.data?.message || err.message))
    }
  } finally {
    skillSaving.value = false
  }
}

const deleteSkill = async (id) => {
  if (!confirm('ይህ ክህሎት ይሰረዝ? (Delete this skill?)')) return
  try {
    await api.deleteSkill(id)
    emit('refresh-data')
  } catch (err) {
    alert('ስህተት: ' + (err.response?.data?.message || err.message))
  }
}

// 5. Experiences Handlers
const openExpForm = (exp = null) => {
  expErrors.value = {}
  if (exp) {
    isEditingExp.value = true
    editingExpId.value = exp.id
    expForm.period = exp.period
    expForm.role_title = exp.role_title
    expForm.institution = exp.institution
    expForm.type = exp.type
    expForm.description = exp.description || ''
    expForm.sort_order = exp.sort_order || 0
    showExpForm.value = true
  } else {
    isEditingExp.value = false
    editingExpId.value = null
    expForm.period = ''
    expForm.role_title = ''
    expForm.institution = ''
    expForm.type = 'career'
    expForm.description = ''
    expForm.sort_order = 0
    showExpForm.value = !showExpForm.value
  }
}

const handleSaveExp = async () => {
  expSaving.value = true
  expErrors.value = {}

  try {
    if (isEditingExp.value) {
      await api.updateExperience(editingExpId.value, expForm)
    } else {
      await api.createExperience(expForm)
    }
    showExpForm.value = false
    emit('refresh-data')
  } catch (err) {
    if (err.response?.status === 422) {
      expErrors.value = err.response.data.errors || {}
    } else {
      alert('ስህተት: ' + (err.response?.data?.message || err.message))
    }
  } finally {
    expSaving.value = false
  }
}

const deleteExp = async (id) => {
  if (!confirm('ይህ የስራ ልምድ ወይም የትምህርት መረጃ ይሰረዝ? (Delete experience?)')) return
  try {
    await api.deleteExperience(id)
    emit('refresh-data')
  } catch (err) {
    alert('ስህተት: ' + (err.response?.data?.message || err.message))
  }
}

// 6. Profile Handlers
const handleSaveProfile = async () => {
  profileSaving.value = true
  profileSaveNotice.value = ''
  try {
    await api.updateProfile(profileForm)
    profileSaveNotice.value = 'መረጃዎች በMySQL ዳታቤዝ ላይ ተሻሽለዋል! (Profile updated in MySQL!)'
    emit('refresh-data')
  } catch (err) {
    alert('ስህተት: ' + (err.response?.data?.message || err.message))
  } finally {
    profileSaving.value = false
  }
}

// 7. Security Handlers
const handleChangePassword = async () => {
  passwordSaving.value = true
  securityNotice.value = ''
  securityGeneralError.value = ''
  passwordErrors.value = {}

  try {
    const res = await api.changePassword(passwordForm)
    securityNotice.value = res.data.message || 'የይለፍ ቃል በተሳካ ሁኔታ ተቀይሯል!'
    passwordForm.current_password = ''
    passwordForm.new_password = ''
    passwordForm.new_password_confirmation = ''
  } catch (err) {
    if (err.response?.status === 422) {
      passwordErrors.value = err.response.data.errors || {}
    } else {
      securityGeneralError.value = err.response?.data?.message || 'የይለፍ ቃል መቀየር አልተቻለም፤ እባክዎ እንደገና ይሞክሩ።'
    }
  } finally {
    passwordSaving.value = false
  }
}

// 8. Direct File & Image Upload Handlers
const uploadingThumbnail = ref(false)
const uploadingAvatar = ref(false)
const uploadingCv = ref(false)

const handleUploadProjectThumbnail = async (event) => {
  const file = event.target.files?.[0]
  if (!file) return
  uploadingThumbnail.value = true
  try {
    const res = await api.uploadFile(file, 'thumbnails')
    projectForm.thumbnail_url = res.data.data.url
  } catch (err) {
    alert('የምስል ጭነት ስህተት: ' + (err.response?.data?.message || err.message))
  } finally {
    uploadingThumbnail.value = false
    event.target.value = ''
  }
}

const handleUploadAvatar = async (event) => {
  const file = event.target.files?.[0]
  if (!file) return
  uploadingAvatar.value = true
  try {
    const res = await api.uploadFile(file, 'avatars')
    profileForm.avatar_url = res.data.data.url
  } catch (err) {
    alert('የአቫታር ጭነት ስህተት: ' + (err.response?.data?.message || err.message))
  } finally {
    uploadingAvatar.value = false
    event.target.value = ''
  }
}

const handleUploadCv = async (event) => {
  const file = event.target.files?.[0]
  if (!file) return
  uploadingCv.value = true
  try {
    const res = await api.uploadFile(file, 'cv')
    profileForm.cv_url = res.data.data.url
  } catch (err) {
    alert('የሲቪ ጭነት ስህተት: ' + (err.response?.data?.message || err.message))
  } finally {
    uploadingCv.value = false
    event.target.value = ''
  }
}
</script>
