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
}
