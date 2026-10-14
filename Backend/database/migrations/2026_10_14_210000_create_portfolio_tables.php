<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Skills table (SRS 4.3)
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('category', ['backend', 'frontend', 'database', 'tools'])->default('backend');
            $table->unsignedTinyInteger('proficiency_percentage')->default(90);
            $table->string('icon_class', 100)->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 2. Projects table (SRS 4.2 & Case Study Modal FR-02)
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('category', 100)->default('Full-Stack'); // Full-Stack, Backend, Frontend
            $table->string('slug', 255)->unique()->index();
            $table->string('summary', 500);
            $table->text('description');
            $table->text('problem_solved')->nullable(); // Case Study details
            $table->text('database_architecture')->nullable(); // Database schema & relation details
            $table->string('thumbnail_url', 255)->nullable();
            $table->string('live_demo_url', 255)->nullable();
            $table->string('github_url', 255)->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 3. Pivot table project_skill (SRS 4.4)
        Schema::create('project_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained('skills')->cascadeOnDelete();
            $table->timestamps();
        });

        // 4. Messages table (SRS 4.5)
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name', 150);
            $table->string('sender_email', 150)->index();
            $table->string('project_type', 100)->nullable();
            $table->string('budget_range', 100)->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        // 5. Experiences / Career Journey table
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('period', 100);
            $table->string('role_title', 255);
            $table->string('institution', 255);
            $table->enum('type', ['career', 'education'])->default('career');
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 6. Profile Settings table (ensuring zero hardcoding for hero, about, socials, stats)
        Schema::create('profile_settings', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name', 100)->default('DEV.CRAFT');
            $table->string('developer_name', 255)->default('Full-Stack Specialist');
            $table->string('status_badge', 255)->default('Available for freelance & full-time');
            $table->string('tagline', 255)->default('FULL-STACK DEVELOPER // SPECIALIST');
            $table->string('hero_title', 255)->default('Building Scalable Full-Stack Solutions');
            $table->text('hero_subtitle')->nullable();
            $table->string('about_heading', 255)->default('About Me');
            $table->text('about_lead')->nullable();
            $table->text('about_bio')->nullable();
            $table->string('avatar_url', 500)->nullable();
            $table->string('cv_url', 500)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('github_url', 255)->nullable();
            $table->string('linkedin_url', 255)->nullable();
            $table->string('telegram_url', 255)->nullable();
            $table->string('twitter_url', 255)->nullable();
            $table->json('stats')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_settings');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('project_skill');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('skills');
    }
};
