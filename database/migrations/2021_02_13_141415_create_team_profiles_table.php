<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('team_name');
            $table->string('college_name');
            $table->foreignId('ketua_id')->constrained('team_members');
            $table->foreignId('anggota1_id')->nullable()->constrained('team_members');
            $table->foreignId('anggota2_id')->nullable()->constrained('team_members');
            $table->foreignId('competition_id')->constrained('competitions');
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
        Schema::dropIfExists('team_profiles');
    }
}
