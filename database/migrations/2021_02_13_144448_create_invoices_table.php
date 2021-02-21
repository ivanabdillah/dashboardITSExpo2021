<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('team_profiles');
            $table->timestamp('payment_timestamp')->nullable(); //date when payment is done
            $table->string('payment_proof')->nullable();
//            $table->foreignId('promo_id')->nullable()->constrained('promos');
            $table->foreignId('approver_id')->nullable()->constrained('internal_profiles');
            $table->timestamp('approved_at')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
