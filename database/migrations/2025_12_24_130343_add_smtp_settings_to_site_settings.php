<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $settings = [
            ['key' => 'mail_host', 'value' => 'smtp.gmail.com', 'group' => 'mail', 'type' => 'text'],
            ['key' => 'mail_port', 'value' => '587', 'group' => 'mail', 'type' => 'text'],
            ['key' => 'mail_username', 'value' => '', 'group' => 'mail', 'type' => 'text'],
            ['key' => 'mail_password', 'value' => '', 'group' => 'mail', 'type' => 'text'],
            ['key' => 'mail_encryption', 'value' => 'tls', 'group' => 'mail', 'type' => 'text'],
            ['key' => 'mail_from_address', 'value' => 'noreply@mgfoodevent.com', 'group' => 'mail', 'type' => 'text'],
            ['key' => 'mail_from_name', 'value' => 'MG Food & Event Planners', 'group' => 'mail', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            DB::table('site_settings')->updateOrInsert(
                ['key' => $setting['key']],
                array_merge($setting, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to remove specifically
    }
};
