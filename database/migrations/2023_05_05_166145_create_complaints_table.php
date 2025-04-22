<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->integer('bcu_id');
            $table->integer('user_id');
            $table->integer('ko_code');
            $table->string('ticket_no');
            $table->string('issue');
            $table->string('call_status');
            $table->string('attend_by');
            $table->string('call_close');
            $table->string('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
}
