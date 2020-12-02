<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_distributions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('course_offering_uuid')->nullable();
            $table->integer('section_number')->nullable();
            $table->integer('a_count')->nullable();
            $table->integer('ab_count')->nullable();
            $table->integer('b_count')->nullable();
            $table->integer('bc_count')->nullable();
            $table->integer('c_count')->nullable();
            $table->integer('d_count')->nullable();
            $table->integer('f_count')->nullable();
            $table->integer('s_count')->nullable();
            $table->integer('u_count')->nullable();
            $table->integer('cr_count')->nullable();
            $table->integer('n_count')->nullable();
            $table->integer('p_count')->nullable();
            $table->integer('i_count')->nullable();
            $table->integer('nw_count')->nullable();
            $table->integer('nr_count')->nullable();
            $table->integer('other_count')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_distributions');
    }
}
