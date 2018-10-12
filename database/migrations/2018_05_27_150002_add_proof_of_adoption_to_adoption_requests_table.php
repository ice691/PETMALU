<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProofOfAdoptionToAdoptionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adoption_requests', function (Blueprint $table) {
            $table->text('proof_of_adoption')->nullable()->after('adoption_purpose');
            $table->text('adoption_remarks')->nullable()->after('proof_of_adoption');
            $table->timestamp('adopted_at')->nullable()->after('adoption_remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adoption_requests', function (Blueprint $table) {
            $table->dropColumn(['proof_of_adoption', 'adoption_remarks', 'adopted_at']);
        });
    }
}
