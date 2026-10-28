<template>
  <section id="projects" class="py-20 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center mb-12">
        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-cyan-950/40 border border-cyan-500/30 text-cyan-400 font-mono text-xs uppercase tracking-wider mb-3">
          <span>PORTFOLIO WORK</span>
        </div>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
          Featured Projects
        </h2>
        <p class="text-slate-400 text-sm sm:text-base mt-2 max-w-xl mx-auto">
          High-fidelity production systems, cloud microservices, and interactive web apps.
        </p>

        <!-- Reactive Filter Tabs (FR-01: Instant reactive filtering) -->
        <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
          <button
            v-for="cat in categories"
            :key="cat"
            type="button"
            @click="activeCategory = cat"
            class="px-4 sm:px-5 py-2 rounded-full text-xs sm:text-sm font-medium transition-all duration-200 capitalize cursor-pointer"
            :class="activeCategory === cat ? 'bg-cyan-500 text-black font-semibold shadow-glow-cyan scale-105' : 'bg-white/[0.04] text-slate-400 border border-white/5 hover:text-white hover:bg-white/[0.08]'"
          >
            {{ cat }}
          </button>
        </div>
      </div>

      <!-- Projects Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        <div
          v-for="proj in filteredProjects"
          :key="proj.id || proj.slug"
          class="glass-card rounded-2xl overflow-hidden group flex flex-col justify-between border border-white/10 hover:border-cyan-500/40 transition-all duration-300"
        >
          <div>
            <!-- Card Thumbnail with Case Study Overlay -->
            <div
              class="relative h-48 sm:h-52 w-full overflow-hidden bg-slate-900 cursor-pointer"
              @click="$emit('open-case-study', proj)"
            >
              <img
                :src="proj.thumbnail_url"
                :alt="proj.title"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                loading="lazy"
                decoding="async"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-[#0E1424] via-transparent to-transparent opacity-85"></div>
              
              <!-- Category Badge -->
              <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-black/60 border border-white/10 text-cyan-400 text-xs font-mono backdrop-blur-md">
                {{ proj.category }}
              </span>

              <!-- Featured Star -->
              <span v-if="proj.is_featured" class="absolute top-3 right-3 px-2.5 py-0.5 rounded-full bg-amber-500/20 border border-amber-500/40 text-amber-400 text-[10px] font-mono flex items-center space-x-1 backdrop-blur-md">
                <span>★ Featured</span>
              </span>
            </div>

            <!-- Card Content -->
            <div class="p-5 sm:p-6">
              <h3
                @click="$emit('open-case-study', proj)"
                class="text-lg sm:text-xl font-bold text-white tracking-wide group-hover:text-cyan-300 transition-colors cursor-pointer mb-2"
              >
                {{ proj.title }}
              </h3>

              <p class="text-slate-400 text-xs sm:text-sm line-clamp-2 mb-4 leading-relaxed">
                {{ proj.summary }}
              </p>

              <!-- Skills Tech Pills -->
              <div class="flex flex-wrap gap-1.5 mb-2">
                <span
                  v-for="skill in (proj.skills || [])"
                  :key="typeof skill === 'object' ? skill.id : skill"
                  class="px-2.5 py-1 rounded-md bg-white/[0.04] border border-white/10 text-[11px] font-mono text-slate-300"
                >
                  {{ typeof skill === 'object' ? skill.name : skill }}
                </span>
              </div>
            </div>
          </div>

          <!-- Card Footer (Case Study link and external action buttons) -->
          <div class="p-5 sm:p-6 pt-0 border-t border-white/5 flex items-center justify-between mt-auto">
            <button
              type="button"
              @click="$emit('open-case-study', proj)"
              class="text-xs sm:text-sm font-semibold text-cyan-400 hover:text-cyan-300 flex items-center space-x-1.5 group-hover:translate-x-1 transition-transform cursor-pointer"
            >
              <span>Case Study</span>
              <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
            </button>

            <!-- External links -->
            <div class="flex items-center space-x-2">
              <a
                v-if="proj.github_url"
                :href="proj.github_url"
                target="_blank"
                rel="noopener noreferrer"
                class="p-2 rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-colors"
                title="View Code on GitHub"
              >
                <TechIcons name="github" custom-class="w-4 h-4" />
              </a>
              <a
                v-if="proj.live_demo_url"
                :href="proj.live_demo_url"
                target="_blank"
                rel="noopener noreferrer"
                class="p-2 rounded-lg text-slate-400 hover:text-cyan-400 hover:bg-white/5 transition-colors"
                title="Open Live Demo"
              >
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/>
                </svg>
              </a>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import TechIcons from './TechIcons.vue'

const props = defineProps({
  projects: {
    type: Array,
    default: () => [],
  }
})

defineEmits(['open-case-study'])

const activeCategory = ref('All')

const categories = ['All', 'Full-Stack', 'Backend', 'Frontend', 'Tools']

// Fallback sample projects if backend is still starting or returns empty
const defaultProjects = [
  {
    id: 1,
    title: 'Enterprise Cloud Architecture & Analytics Engine',
    category: 'Full-Stack',
    slug: 'enterprise-cloud-analytics-engine',
    summary: 'High-concurrency microservices processing 50M+ requests monthly with sub-45ms average response times.',
    description: 'An enterprise cloud analytics platform handling distributed transaction logging, automated metric aggregation, and interactive Vue 3 telemetry dashboards.',
    problem_solved: 'Legacy monolithic architecture suffered from frequent database locks during peak ETL jobs. Migrated to decoupled Laravel services with Redis queuing.',
    database_architecture: 'MySQL partitioned relational tables with composite indexation and read/write splitting.',
    thumbnail_url: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1000&q=80',
    live_demo_url: 'https://demo.devcraft.io',
    github_url: 'https://github.com/developer/cloud-analytics',
    is_featured: true,
    skills: [{ id: 1, name: 'Laravel' }, { id: 2, name: 'Vue.js' }, { id: 3, name: 'MySQL' }, { id: 4, name: 'Tailwind CSS' }],
  },
  {
    id: 2,
    title: 'Omnichannel E-Commerce & Payment Engine',
    category: 'Full-Stack',
    slug: 'omnichannel-ecommerce-payment-engine',
    summary: 'PCI-DSS compliant transactional API backend with multi-vendor storefront and real-time inventory synchronization.',
    description: 'A multi-vendor retail platform with automated invoice generation, webhooks for Stripe/PayPal, and an administrative dashboard.',
    problem_solved: 'Overselling during flash sales due to non-atomic inventory decrements. Solved using Redis distributed locks and MySQL row-level locking.',
    database_architecture: 'Strict foreign-key constraints, InnoDB transactional safety, and index optimization.',
    thumbnail_url: 'https://images.unsplash.com/photo-1556742049-0a67e557224d?auto=format&fit=crop&w=1000&q=80',
    live_demo_url: 'https://shop.devcraft.io',
    github_url: 'https://github.com/developer/ecommerce-engine',
    is_featured: true,
    skills: [{ id: 1, name: 'Laravel' }, { id: 2, name: 'Vue.js' }, { id: 3, name: 'MySQL' }, { id: 4, name: 'TypeScript' }],
  },
  {
    id: 3,
    title: 'Distributed RESTful Banking API Gateway',
    category: 'Backend',
    slug: 'distributed-banking-api-gateway',
    summary: 'Secure financial transaction ledger with idempotent idempotency keys and cryptographic payload signing.',
    description: 'A financial services API engine built with Laravel 11 and PHP 8, supporting double-entry accounting and Sanctum token validation.',
    problem_solved: 'Network timeout retries created duplicate billing debits. Implemented RFC-compliant idempotency caching.',
    database_architecture: 'ACID double-entry ledger with immutable transaction logs.',
    thumbnail_url: 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?auto=format&fit=crop&w=1000&q=80',
    live_demo_url: 'https://api.devcraft.io',
    github_url: 'https://github.com/developer/banking-gateway',
    is_featured: true,
    skills: [{ id: 1, name: 'Laravel' }, { id: 3, name: 'MySQL' }, { id: 5, name: 'PHP' }],
  },
  {
    id: 4,
    title: 'DevOps Cloud Infrastructure Orchestrator',
    category: 'Tools',
    slug: 'devops-cloud-orchestrator',
    summary: 'Automated deployment pipelines and server health monitoring daemon with proactive alerting.',
    description: 'Self-hosted DevOps management tool for spinning up staging environments and managing containerized services.',
    problem_solved: 'Manual server setup took 3+ hours per project with human errors. Automated containerized provisions reduced setup time to 2 minutes.',
    database_architecture: 'Schema recording deployment history and server node heartbeats.',
    thumbnail_url: 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1000&q=80',
    live_demo_url: 'https://infra.devcraft.io',
    github_url: 'https://github.com/developer/devops-orchestrator',
    is_featured: false,
    skills: [{ id: 6, name: 'Docker' }, { id: 7, name: 'Node.js' }, { id: 8, name: 'PostgreSQL' }],
  },
  {
    id: 5,
    title: 'Pixel-Perfect Modern Design System',
    category: 'Frontend',
    slug: 'pixel-perfect-design-system',
    summary: 'Glassmorphic, accessible, dark-mode first Vue 3 component library built with Tailwind CSS.',
    description: 'A comprehensive UI kit implementing glassmorphism, glow borders, interactive card tilts, and smooth spring animations.',
    problem_solved: 'Inconsistent UI and excessive CSS bloat across multiple team apps. Replaced 80KB bespoke styles with modular atomic components.',
    database_architecture: 'Static and dynamic theme token configurations stored with JSON schemas.',
    thumbnail_url: 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1000&q=80',
    live_demo_url: 'https://design.devcraft.io',
    github_url: 'https://github.com/developer/modern-glass-ui',
    is_featured: false,
    skills: [{ id: 2, name: 'Vue.js' }, { id: 4, name: 'Tailwind CSS' }, { id: 9, name: 'TypeScript' }],
  },
]

const displayProjects = computed(() => {
  return (props.projects && props.projects.length > 0) ? props.projects : defaultProjects
})

// Reactive Filtering (FR-01: Instant reactive filtering without page reload)
const filteredProjects = computed(() => {
  if (activeCategory.value === 'All') {
    return displayProjects.value
  }
  return displayProjects.value.filter(p => p.category?.toLowerCase() === activeCategory.value.toLowerCase())
})
</script>
