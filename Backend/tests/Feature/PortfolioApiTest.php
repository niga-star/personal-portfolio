<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }
    public function test_can_fetch_public_profile(): void
    {
        $response = $this->getJson('/api/v1/profile');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'profile' => [
                        'brand_name',
                        'developer_name',
                        'status_badge',
                        'tagline',
                        'hero_title',
                        'hero_subtitle',
                        'stats',
                    ],
                    'experiences',
                ],
            ]);
    }

    /**
     * Test public projects listing and reactive category filter (FR-01)
     */
    public function test_can_fetch_projects_with_category_filter(): void
    {
        $response = $this->getJson('/api/v1/projects?category=Full-Stack');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'count',
                'data',
            ]);
    }

    /**
     * Test single project case study modal endpoint (FR-02)
     */
    public function test_can_fetch_single_project_case_study(): void
    {
        $response = $this->getJson('/api/v1/projects/saas-analytics-dashboard');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'title',
                    'slug',
                    'problem_solved',
                    'database_architecture',
                    'skills',
                ],
            ]);
    }

    /**
     * Test public skills listing (SRS 5.1)
     */
    public function test_can_fetch_skills_grouped_by_category(): void
    {
        $response = $this->getJson('/api/v1/skills');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'grouped' => [
                    'backend',
                    'frontend',
                    'database',
                    'tools',
                ],
            ]);
    }

    /**
     * Test contact form submission with validation and 201 Created (FR-03 & SRS 6.2)
     */
    public function test_can_submit_contact_message_successfully(): void
    {
        $payload = [
            'name' => 'Sara Connor',
            'email' => 'sara@example.com',
            'project_type' => 'Full-Stack Architecture',
            'budget_range' => '$10,000+',
            'message' => 'Hello! We need a high-scale portfolio and API application designed with Vue 3 and Laravel.',
        ];

        $response = $this->postJson('/api/v1/contact', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => ['id'],
            ]);

        $this->assertDatabaseHas('messages', [
            'sender_email' => 'sara@example.com',
            'sender_name' => 'Sara Connor',
        ]);
    }

    /**
     * Test contact validation failure with 422 Unprocessable (SRS 6.2)
     */
    public function test_contact_submission_fails_with_validation_errors(): void
    {
        $response = $this->postJson('/api/v1/contact', [
            'name' => '',
            'email' => 'invalid-email',
            'message' => 'short',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }

    /**
     * Test protected admin endpoints require authentication with 401 Unauthorized (SRS 6.2)
     */
    public function test_protected_admin_routes_reject_unauthenticated_requests(): void
    {
        $response = $this->getJson('/api/v1/admin/messages');
        $response->assertStatus(401);
    }

    /**
     * Test admin login and token authorization (FR-05 & SRS 5.2)
     */
    public function test_admin_can_login_and_access_protected_endpoints(): void
    {
        $loginResponse = $this->postJson('/api/v1/auth/login', [
            'email' => 'admin@portfolio.com',
            'password' => 'Password123!',
        ]);

        $loginResponse->assertStatus(200)
            ->assertJsonStructure(['token', 'user']);

        $token = $loginResponse->json('token');

        // Access protected messages route with Bearer token
        $messagesResponse = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/v1/admin/messages');

        $messagesResponse->assertStatus(200)
            ->assertJsonStructure(['status', 'data']);
    }

    /**
     * Test login validation failure (SRS 6.2)
     */
    public function test_login_fails_with_validation_errors(): void
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'not-an-email',
            'password' => '123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }

    /**
     * Test admin can change password
     */
    public function test_admin_can_change_password(): void
    {
        $user = User::where('email', 'admin@portfolio.com')->first();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/v1/admin/change-password', [
            'current_password' => 'Password123!',
            'new_password' => 'NewStrongPass2026!',
            'new_password_confirmation' => 'NewStrongPass2026!',
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'የይለፍ ቃል በተሳካ ሁኔታ ተቀይሯል (Password updated successfully)']);
    }

    /**
     * Test admin can create, update and delete a skill
     */
    public function test_admin_can_manage_skills(): void
    {
        $user = User::where('email', 'admin@portfolio.com')->first();

        // Create
        $createRes = $this->actingAs($user, 'sanctum')->postJson('/api/v1/admin/skills', [
            'name' => 'GraphQL',
            'category' => 'backend',
            'proficiency_percentage' => 88,
        ]);

        $createRes->assertStatus(201);
        $skillId = $createRes->json('data.id');

        // Update
        $updateRes = $this->actingAs($user, 'sanctum')->putJson("/api/v1/admin/skills/{$skillId}", [
            'proficiency_percentage' => 95,
        ]);
        $updateRes->assertStatus(200);

        // Delete
        $deleteRes = $this->actingAs($user, 'sanctum')->deleteJson("/api/v1/admin/skills/{$skillId}");
        $deleteRes->assertStatus(200);
    }

    /**
     * Test admin can create, update and delete an experience
     */
    public function test_admin_can_manage_experiences(): void
    {
        $user = User::where('email', 'admin@portfolio.com')->first();

        // Create
        $createRes = $this->actingAs($user, 'sanctum')->postJson('/api/v1/admin/experiences', [
            'period' => '2024 - 2026',
            'role_title' => 'Staff Platform Engineer',
            'institution' => 'Fintech Next',
            'type' => 'career',
            'description' => 'Architecting real-time payment systems.',
        ]);

        $createRes->assertStatus(201);
        $expId = $createRes->json('data.id');

        // Delete
        $deleteRes = $this->actingAs($user, 'sanctum')->deleteJson("/api/v1/admin/experiences/{$expId}");
        $deleteRes->assertStatus(200);
    }
}

