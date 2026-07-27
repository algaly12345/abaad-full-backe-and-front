<?php

namespace Tests\Feature;

use App\Enums\ProviderPermission;
use App\Enums\ProviderRole;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\ProviderPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProviderPermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(ProviderPermissionsSeeder::class);
    }

    private function makeProvider(array $overrides = []): User
    {
        return User::create(array_merge([
            'name'      => 'Test Provider',
            'email'     => 'provider' . uniqid() . '@example.com',
            'phone'     => '+9665' . random_int(10000000, 99999999),
            'password'  => bcrypt('password'),
            'user_type' => User::TYPE_PROVIDER,
            'is_active' => 1,
        ], $overrides));
    }

    private function makeCustomer(): User
    {
        return User::create([
            'name'      => 'Test Customer',
            'email'     => 'customer' . uniqid() . '@example.com',
            'phone'     => '+9665' . random_int(10000000, 99999999),
            'password'  => bcrypt('password'),
            'user_type' => User::TYPE_CUSTOMER,
            'is_active' => 1,
        ]);
    }

    /** @test */
    public function provider_role_is_auto_assigned_on_creation(): void
    {
        $provider = $this->makeProvider();

        $this->assertTrue($provider->hasRole(ProviderRole::PROVIDER));
        $this->assertTrue($provider->hasPermissionTo(ProviderPermission::SERVICES_CREATE));
        $this->assertTrue($provider->hasPermissionTo(ProviderPermission::SERVICES_VIEW));
        $this->assertTrue($provider->hasPermissionTo(ProviderPermission::SERVICES_UPDATE));
        $this->assertTrue($provider->hasPermissionTo(ProviderPermission::SERVICES_DELETE));
        $this->assertTrue($provider->hasPermissionTo(ProviderPermission::SERVICES_TOGGLE_STATUS));
    }

    /** @test */
    public function provider_does_not_get_plans_manage_permission_by_default(): void
    {
        $provider = $this->makeProvider();

        $this->assertFalse($provider->hasPermissionTo(ProviderPermission::PLANS_MANAGE_GLOBAL));
    }

    /** @test */
    public function customer_does_not_get_provider_role(): void
    {
        $customer = $this->makeCustomer();

        $this->assertFalse($customer->hasRole(ProviderRole::PROVIDER));
    }

    /** @test */
    public function provider_can_view_own_permissions_endpoint(): void
    {
        $provider = $this->makeProvider();

        Passport::actingAs($provider, [], 'api');

        $response = $this->getJson('/api/v1/service-provider/permissions');

        $response->assertStatus(200)
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.roles', [ProviderRole::PROVIDER])
            ->assertJsonPath('data.permissions', [
                ProviderPermission::SERVICES_VIEW,
                ProviderPermission::SERVICES_CREATE,
                ProviderPermission::SERVICES_UPDATE,
                ProviderPermission::SERVICES_DELETE,
                ProviderPermission::SERVICES_TOGGLE_STATUS,
            ]);
    }

    /** @test */
    public function provider_with_permission_can_create_service(): void
    {
        Storage::fake('public');

        $provider = $this->makeProvider();
        Passport::actingAs($provider, [], 'api');

        $category = Category::create(['name' => 'تجريبي']);

        $response = $this->postJson('/api/v1/services', [
            'title'         => 'خدمة تجريبية',
            'service_type'  => 'صيانة',
            'offer_type'    => 'price',
            'service_price' => 100,
            'description'   => 'وصف تجريبي',
            'expiry_date'   => now()->addMonth()->toDateString(),
            'image'         => UploadedFile::fake()->image('service.jpg'),
            'categories'    => [$category->id],
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('status', 'success');
    }

    /** @test */
    public function provider_without_create_permission_is_blocked(): void
    {
        $provider = $this->makeProvider();
        Passport::actingAs($provider, [], 'api');

        // نزع صلاحية الإنشاء فقط، دون لمس الصلاحيات الأخرى.
        $provider->revokePermissionTo(ProviderPermission::SERVICES_CREATE);

        $response = $this->postJson('/api/v1/services', [
            'title' => 'خدمة تجريبية',
        ]);

        $response->assertStatus(403)
            ->assertJsonPath('status', 'error');
    }

    /** @test */
    public function non_provider_account_is_blocked_even_with_role_manually_granted(): void
    {
        $customer = $this->makeCustomer();
        $customer->assignRole(ProviderRole::PROVIDER);

        Passport::actingAs($customer, [], 'api');

        $response = $this->postJson('/api/v1/services', [
            'title' => 'خدمة تجريبية',
        ]);

        // يجب أن يُرفض بسبب EnsureIsServiceProviderApi (نوع الحساب) قبل
        // الوصول لطبقة فحص الصلاحيات أصلًا.
        $response->assertStatus(403);
    }

    /** @test */
    public function provider_cannot_manage_global_plans_by_default(): void
    {
        $provider = $this->makeProvider();
        Passport::actingAs($provider, [], 'api');

        $response = $this->getJson('/api/v1/service-plans');

        $response->assertStatus(403);
    }

    /** @test */
    public function granting_plans_permission_explicitly_unlocks_access(): void
    {
        $provider = $this->makeProvider();
        $provider->givePermissionTo(ProviderPermission::PLANS_MANAGE_GLOBAL);

        Passport::actingAs($provider, [], 'api');

        $response = $this->getJson('/api/v1/service-plans');

        $response->assertStatus(200);
    }
}