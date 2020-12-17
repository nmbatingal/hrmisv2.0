<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDocumentTrackingLogWithOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->table('document_tracking_logs', function (Blueprint $table) {
            $table->boolean('forSignature')->nullable()->after('action');
            $table->boolean('forCompliance')->nullable()->after('forSignature');
            $table->boolean('forInformation')->nullable()->after('forCompliance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->table('document_tracking_logs', function (Blueprint $table) {
            $table->dropColumn(['forSignature', 'forCompliance', 'forInformation']);
        });
    }
}
