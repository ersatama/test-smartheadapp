<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class WidgetTest extends TestCase
{
    /** @test */
    public function widget_page_is_accessible()
    {
        $response = $this->get('/widget');
        $response->assertStatus(200);
        $response->assertSee('Отправить заявку');
    }
}