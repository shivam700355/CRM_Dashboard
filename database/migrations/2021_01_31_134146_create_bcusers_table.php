<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBcusersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bcusers', function (Blueprint $table) {

            $table->id();
            $table->string('user_id');
            $table->text('fe_name');
            $table->text('bc_name');
            $table->string('phone');
            $table->text('district');
            $table->text('state');
            $table->text('bank_name');
            $table->string('ko_code');
            $table->string('region');
            $table->string('pan');
            $table->string('alternate_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('bcusers');
    }
}
