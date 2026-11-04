<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Order;

class ProductShopTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_shows_products_section(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('NanoHub');
        $response->assertSee('Produk Digital');
        $response->assertSee('149.000');
    }

    public function test_products_listing_page(): void
    {
        $response = $this->get('/produk');
        $response->assertStatus(200);
        $response->assertSee('Produk Digital NPDI');
        $response->assertSee('NanoHub');
        $response->assertSee('SaaS');
    }

    public function test_nanohub_detail_page(): void
    {
        $response = $this->get('/produk/nanohub');
        $response->assertStatus(200);
        $response->assertSee('NanoHub');
        $response->assertSee('Pilih Paket yang Tepat');
        $response->assertSee('Starter');
        $response->assertSee('Growth');
        $response->assertSee('Pro');
        $response->assertSee('Agency');
        $response->assertSee('149.000');
        $response->assertSee('349.000');
        $response->assertSee('749.000');
        $response->assertSee('1.499.000');
    }

    public function test_unknown_product_returns_404(): void
    {
        $this->get('/produk/tidak-ada')->assertStatus(404);
    }

    public function test_checkout_page_loads_for_valid_plan(): void
    {
        foreach (['starter', 'growth', 'pro', 'agency'] as $plan) {
            $response = $this->get("/checkout/nanohub/{$plan}");
            $response->assertStatus(200);
            $response->assertSee('Detail Pembeli');
            $response->assertSee('Lanjutkan ke Pembayaran');
        }
    }

    public function test_checkout_invalid_product_returns_404(): void
    {
        $this->get('/checkout/invalid/starter')->assertStatus(404);
    }

    public function test_checkout_invalid_plan_returns_404(): void
    {
        $this->get('/checkout/nanohub/invalid-plan')->assertStatus(404);
    }

    public function test_checkout_form_validates_required_fields(): void
    {
        $this->post('/checkout/nanohub/growth', [])
            ->assertSessionHasErrors(['name', 'email']);
    }

    public function test_checkout_form_validates_email_format(): void
    {
        $this->post('/checkout/nanohub/growth', [
                'name' => 'Test User',
                'email' => 'bukan-email',
            ])
            ->assertSessionHasErrors(['email']);
    }

    public function test_payment_success_page(): void
    {
        $response = $this->get('/payment/success');
        $response->assertStatus(200);
        $response->assertSee('Pembayaran Berhasil');
        $response->assertSee('Buka Dashboard NanoHub');
    }

    public function test_webhook_rejects_invalid_token(): void
    {
        $response = $this->withHeaders([
            'x-callback-token' => 'wrong-token',
        ])->postJson('/payment/webhook/xendit', [
            'external_id' => 'NPDI-TEST',
            'status' => 'PAID',
        ]);
        $response->assertStatus(401);
    }

    public function test_webhook_handles_paid_status(): void
    {
        Order::create([
            'order_id' => 'NPDI-TEST-001',
            'product_slug' => 'nanohub',
            'plan_slug' => 'growth',
            'customer_name' => 'Test User',
            'customer_email' => 'test@example.com',
            'amount' => 349000,
            'status' => 'pending',
        ]);

        $response = $this->withHeaders([
            'x-callback-token' => config('services.xendit.webhook_token'),
        ])->postJson('/payment/webhook/xendit', [
            'external_id' => 'NPDI-TEST-001',
            'status' => 'PAID',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('orders', [
            'order_id' => 'NPDI-TEST-001',
            'status' => 'paid',
        ]);
    }

    public function test_webhook_handles_expired_status(): void
    {
        Order::create([
            'order_id' => 'NPDI-TEST-002',
            'product_slug' => 'nanohub',
            'plan_slug' => 'starter',
            'customer_name' => 'Test User',
            'customer_email' => 'test@example.com',
            'amount' => 149000,
            'status' => 'pending',
        ]);

        $this->withHeaders([
            'x-callback-token' => config('services.xendit.webhook_token'),
        ])->postJson('/payment/webhook/xendit', [
            'external_id' => 'NPDI-TEST-002',
            'status' => 'EXPIRED',
        ])->assertStatus(200);

        $this->assertDatabaseHas('orders', [
            'order_id' => 'NPDI-TEST-002',
            'status' => 'expired',
        ]);
    }

    public function test_navbar_contains_products_link(): void
    {
        $response = $this->get('/');
        $response->assertSee('/produk');
        $response->assertSee('Produk');
    }
}
