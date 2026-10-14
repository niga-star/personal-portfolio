<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Message;
use App\Models\ProfileSetting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User (SRS 4.1 & FR-05)
        User::firstOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name' => 'Portfolio Administrator',
                'password' => Hash::make('Password123!'),
            ]
        );

        // 2. Seed Skills (SRS 4.3 & Design Tech Stack Grid)
        $skillsData = [
            // Backend
            [
                'name' => 'Laravel',
                'category' => 'backend',
                'proficiency_percentage' => 95,
                'icon_class' => 'si-laravel',
                'sort_order' => 1,
            ],
            [
                'name' => 'Node.js',
                'category' => 'backend',
                'proficiency_percentage' => 90,
                'icon_class' => 'si-nodedotjs',
                'sort_order' => 2,
            ],
            [
                'name' => 'PHP',
                'category' => 'backend',
                'proficiency_percentage' => 95,
                'icon_class' => 'si-php',
                'sort_order' => 3,
            ],
            // Frontend
            [
                'name' => 'Vue.js',
                'category' => 'frontend',
                'proficiency_percentage' => 92,
                'icon_class' => 'si-vuedotjs',
                'sort_order' => 4,
            ],
            [
                'name' => 'React',
                'category' => 'frontend',
                'proficiency_percentage' => 88,
                'icon_class' => 'si-react',
                'sort_order' => 5,
            ],
            [
                'name' => 'Next.js',
                'category' => 'frontend',
                'proficiency_percentage' => 85,
                'icon_class' => 'si-nextdotjs',
                'sort_order' => 6,
            ],
            [
                'name' => 'TypeScript',
                'category' => 'frontend',
                'proficiency_percentage' => 89,
                'icon_class' => 'si-typescript',
                'sort_order' => 7,
            ],
            [
                'name' => 'Tailwind CSS',
                'category' => 'frontend',
                'proficiency_percentage' => 96,
                'icon_class' => 'si-tailwindcss',
                'sort_order' => 8,
            ],
            // Database
            [
                'name' => 'MySQL',
                'category' => 'database',
                'proficiency_percentage' => 94,
                'icon_class' => 'si-mysql',
                'sort_order' => 9,
            ],
            [
                'name' => 'PostgreSQL',
                'category' => 'database',
                'proficiency_percentage' => 91,
                'icon_class' => 'si-postgresql',
                'sort_order' => 10,
            ],
            [
                'name' => 'Redis',
                'category' => 'database',
                'proficiency_percentage' => 88,
                'icon_class' => 'si-redis',
                'sort_order' => 11,
            ],
            // Tools & Cloud
            [
                'name' => 'AWS',
                'category' => 'tools',
                'proficiency_percentage' => 84,
                'icon_class' => 'si-amazonaws',
                'sort_order' => 12,
            ],
            [
                'name' => 'Docker',
                'category' => 'tools',
                'proficiency_percentage' => 87,
                'icon_class' => 'si-docker',
                'sort_order' => 13,
            ],
            [
                'name' => 'Git & GitHub',
                'category' => 'tools',
                'proficiency_percentage' => 95,
                'icon_class' => 'si-git',
                'sort_order' => 14,
            ],
        ];

        $skillModels = [];
        foreach ($skillsData as $s) {
            $skillModels[$s['name']] = Skill::updateOrCreate(
                ['name' => $s['name']],
                $s
            );
        }

        // 3. Seed Projects (SRS 4.2 & Case Study Modal FR-02)
        $projectsData = [
            [
                'title' => 'SaaS Analytics Dashboard',
                'category' => 'Full-Stack',
                'slug' => 'saas-analytics-dashboard',
                'summary' => 'High-fidelity telemetry and performance metrics visualizer with real-time reactive charting.',
                'description' => 'A comprehensive SaaS multi-tenant analytics dashboard delivering high-throughput metric aggregations, subscription billing management, and user lifecycle analytics. Built for modern microservice architectures.',
                'problem_solved' => 'Legacy analytics software lagged with over 500k daily telemetry events. We redesigned the pipeline with queued database write-buffering and Redis caching, slashing page response latency to under 75ms and providing real-time SVG charting.',
                'database_architecture' => 'Normalized MySQL schema with composite indexation on (tenant_id, created_at, metric_type), time-bucketed aggregation tables, and partitioned historical event logs.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1000&q=80',
                'live_demo_url' => 'https://analytics-demo.devcraft.io',
                'github_url' => 'https://github.com/developer/saas-analytics-dashboard',
                'is_featured' => true,
                'sort_order' => 1,
                'skills' => ['Vue.js', 'Laravel', 'MySQL', 'Tailwind CSS', 'Redis'],
            ],
            [
                'title' => 'FinTech Core Banking API',
                'category' => 'Backend',
                'slug' => 'fintech-core-banking-api',
                'summary' => 'Mission-critical double-entry ledger financial transactions API with ACID compliance.',
                'description' => 'A resilient banking ledger API architected with Laravel and MySQL. Features strict idempotency keys, tokenized OAuth2/Sanctum authentication, asynchronous settlement queues, and automated webhook dispatching.',
                'problem_solved' => 'Eliminated financial race conditions and phantom reads during concurrent account transfers by implementing strict pessimistic locking (SELECT FOR UPDATE) and distributed transaction monitors.',
                'database_architecture' => 'Rigid double-entry ledger architecture where every transaction consists of matching debit and credit journal entries. Immutable audit trails with cryptographically signed hashes.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=1000&q=80',
                'live_demo_url' => 'https://api-sandbox.devcraft.io/docs',
                'github_url' => 'https://github.com/developer/fintech-core-ledger',
                'is_featured' => true,
                'sort_order' => 2,
                'skills' => ['Laravel', 'MySQL', 'Redis', 'Docker'],
            ],
            [
                'title' => 'E-Commerce Multi-Vendor Engine',
                'category' => 'Full-Stack',
                'slug' => 'ecommerce-multi-vendor-engine',
                'summary' => 'High-conversion modular e-commerce platform with reactive product filtering and checkout.',
                'description' => 'Full-featured digital commerce marketplace supporting multi-merchant stores, live inventory tracking, stripe integration, and granular role-based administrative dashboards.',
                'problem_solved' => 'Standard relational search was creating slow joins across millions of SKU attributes. Implemented indexed faceted filtering combined with Vue 3 reactive state for instantaneous client-side navigation.',
                'database_architecture' => 'Optimized EAV (Entity-Attribute-Value) relational design with foreign key constraints, denormalized search helper tables, and cascading stock management triggers.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1000&q=80',
                'live_demo_url' => 'https://store-demo.devcraft.io',
                'github_url' => 'https://github.com/developer/ecommerce-engine',
                'is_featured' => true,
                'sort_order' => 3,
                'skills' => ['Vue.js', 'Laravel', 'MySQL', 'Tailwind CSS', 'TypeScript'],
            ],
            [
                'title' => 'DevOps Cloud Infrastructure Orchestrator',
                'category' => 'Tools',
                'slug' => 'devops-cloud-orchestrator',
                'summary' => 'Automated deployment pipelines and server health monitoring daemon with proactive alerting.',
                'description' => 'Self-hosted DevOps management tool for spinning up staging environments, managing containerized services, viewing real-time memory/CPU metrics, and zero-downtime rolling deploys.',
                'problem_solved' => 'Manual server setup took 3+ hours per project with human errors. Automated containerized provisions reduced deployment setup time to 2 minutes with reproducible infrastructure.',
                'database_architecture' => 'Schema recording deployment history, environment variable revisions, server node heartbeats, and alert thresholds with foreign key relationship cascades.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1000&q=80',
                'live_demo_url' => 'https://infra.devcraft.io',
                'github_url' => 'https://github.com/developer/devops-orchestrator',
                'is_featured' => false,
                'sort_order' => 4,
                'skills' => ['Docker', 'AWS', 'Node.js', 'PostgreSQL'],
            ],
            [
                'title' => 'Pixel-Perfect Modern Design System',
                'category' => 'Frontend',
                'slug' => 'pixel-perfect-design-system',
                'summary' => 'Glassmorphic, accessible, dark-mode first Vue 3 component library built with Tailwind CSS.',
                'description' => 'A comprehensive UI kit implementing glassmorphism, glow borders, interactive card tilts, smooth spring animations, and WCAG AA accessibility standards for modern web applications.',
                'problem_solved' => 'Inconsistent UI and excessive CSS bloat across multiple team apps. Replaced 80KB of bespoke stylesheet rules with modular atomic Tailwind components and uniform theming.',
                'database_architecture' => 'Static and dynamic theme token configurations stored with JSON schemas for runtime customizable client presets.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1000&q=80',
                'live_demo_url' => 'https://design.devcraft.io',
                'github_url' => 'https://github.com/developer/modern-glass-ui',
                'is_featured' => false,
                'sort_order' => 5,
                'skills' => ['Vue.js', 'Tailwind CSS', 'TypeScript'],
            ],
        ];

        foreach ($projectsData as $pData) {
            $skills = $pData['skills'];
            unset($pData['skills']);

            $project = Project::updateOrCreate(
                ['slug' => $pData['slug']],
                $pData
            );

            $skillIds = [];
            foreach ($skills as $sName) {
                if (isset($skillModels[$sName])) {
                    $skillIds[] = $skillModels[$sName]->id;
                }
            }
            $project->skills()->sync($skillIds);
        }

        // 4. Seed Experiences / Career Journey (Image 4 & SRS FR-05)
        $experiencesData = [
            [
                'period' => 'Present',
                'role_title' => 'Senior Full-Stack Engineer',
                'institution' => 'Tech Innovators Global',
                'type' => 'career',
                'description' => 'Architecting scalable cloud microservices, high-traffic Laravel APIs, and high-performance Vue.js SPA interfaces for over 1M+ active users.',
                'sort_order' => 1,
            ],
            [
                'period' => '2022 - 2024',
                'role_title' => 'Full-Stack Lead',
                'institution' => 'Fintech Cloud Solutions',
                'type' => 'career',
                'description' => 'Led a team of 6 engineers delivering enterprise banking systems, automated CI/CD pipelines, and relational database tuning.',
                'sort_order' => 2,
            ],
            [
                'period' => '2020 - 2022',
                'role_title' => 'Backend Software Engineer',
                'institution' => 'Modern Web Labs',
                'type' => 'career',
                'description' => 'Built high-throughput RESTful APIs with Laravel and MySQL, optimizing database indexing and transaction safety.',
                'sort_order' => 3,
            ],
            [
                'period' => '2016 - 2020',
                'role_title' => 'B.S. in Computer Science',
                'institution' => 'Faculty of Informatics & Software Engineering',
                'type' => 'education',
                'description' => 'Graduated with Magna Cum Laude honors. Focused on Distributed Systems, Relational Database Theory, and Software Architecture.',
                'sort_order' => 4,
            ],
        ];

        foreach ($experiencesData as $exp) {
            Experience::updateOrCreate(
                [
                    'role_title' => $exp['role_title'],
                    'institution' => $exp['institution'],
                ],
                $exp
            );
        }

        // 5. Seed Profile Settings & Stats (Image 1, 2, 3, 4 - ZERO HARDCODE)
        ProfileSetting::updateOrCreate(
            ['id' => 1],
            [
                'brand_name' => 'DEV.CRAFT',
                'developer_name' => 'Alex Rivera',
                'status_badge' => 'Available for freelance & full-time',
                'tagline' => 'FULL-STACK DEVELOPER // SPECIALIST',
                'hero_title' => 'Building Scalable Full-Stack Solutions',
                'hero_subtitle' => "Hi, I'm a developer who crafts robust backend architectures and dynamic user interfaces using Laravel, Vue.js, and MySQL. Let's turn your vision into high-performance applications.",
                'about_heading' => 'About Me',
                'about_lead' => 'My passion for bridging robust back-end systems with pixel-perfect interfaces.',
                'about_bio' => 'As a Senior Full-Stack Developer, I specialize in crafting high-concurrency Laravel APIs, resilient MySQL database schemas, and reactive, glassmorphic Vue 3 user interfaces. I believe software engineering is an art that blends airtight backend security, clean design patterns, and memorable user experiences.',
                'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80',
                'cv_url' => '/api/v1/download-cv',
                'email' => 'hello@developer.com',
                'github_url' => 'https://github.com/developer',
                'linkedin_url' => 'https://linkedin.com/in/developer',
                'telegram_url' => 'https://t.me/developer',
                'twitter_url' => 'https://x.com/developer',
                'stats' => [
                    [
                        'value' => '50+',
                        'label' => 'Projects Completed',
                        'accent' => 'cyan',
                    ],
                    [
                        'value' => '99.9%',
                        'label' => 'Uptime Architected',
                        'accent' => 'emerald',
                    ],
                    [
                        'value' => '5+',
                        'label' => 'Years Experience',
                        'accent' => 'purple',
                    ],
                    [
                        'value' => '100%',
                        'label' => 'Client Satisfaction',
                        'accent' => 'pink',
                    ],
                ],
            ]
        );

        // 6. Seed Sample Message (SRS 4.5)
        Message::firstOrCreate(
            ['sender_email' => 'partner@enterprise.com'],
            [
                'sender_name' => 'Marcus Vance',
                'project_type' => 'Full-Stack Web App',
                'budget_range' => '$5,000 - $10,000',
                'message' => 'Hello! We love your portfolio and would like to collaborate on building a high-scale Laravel and Vue 3 customer dashboard.',
                'is_read' => false,
                'ip_address' => '127.0.0.1',
            ]
        );
    }
}
