<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('stage')->default('lead')->after('user_id');
            $table->string('job_title')->nullable()->after('stage');
            $table->string('source')->nullable()->after('job_title');
            $table->text('tags')->nullable()->after('source');
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete()->after('tags');
            $table->timestamp('last_contacted_at')->nullable()->after('owner_id');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropColumn([
                'stage',
                'job_title',
                'source',
                'tags',
                'owner_id',
                'last_contacted_at',
            ]);
        });
    }
};
