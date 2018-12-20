<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixerApiResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixer_api_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('endpoint', 255);
            $table->text('payload_sent')->nullable();
            $table->text('payload_received')->nullable();
            $table->unsignedInteger('status_code')->default(0);
            $table->unsignedInteger('hits')->default(1);
            // Indexes
            $table->index('endpoint');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixer_api_responses');
    }
}
