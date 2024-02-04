<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('purchaser_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->mediumText('items')->nullable();
            $table->string('purpose')->nullable();
            $table->date('requested_on')->nullable();
            $table->string('receiving_company_name')->nullable();
            $table->string('receiving_company_telephone')->nullable();
            $table->string('receiving_company_email')->nullable();
            $table->string('method_of_payment')->nullable();
            $table->string('why_cash_cheque')->nullable();
            $table->string('purchaser_note')->nullable();
            $table->string('place_of_use')->nullable();
            $table->string('reason_for_purchase')->nullable();

            //these fields are for the HOD
            $table->date('permitted_on')->nullable();
            $table->string('hod_status')->nullable()->default('Received');
            $table->string('hod_note')->nullable();

            //Supervisor
            $table->string('type')->nullable();
            $table->string('type_of_expenditure')->nullable();
            $table->string('revised_status')->nullable()->default('Received');
            $table->integer('revised_by')->nullable();
            $table->integer('revised_on')->nullable();
            $table->mediumText('supervisor_note')->nullable();
            $table->string('type_of_financial_document')->nullable();
            $table->string('type_of_transaction')->nullable();
            $table->string('type_of_expediture')->nullable();
            $table->string('title')->nullable();
            $table->string('mask');

            $table->integer('department_head_id')->nullable();

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
        Schema::dropIfExists('purchase_requests');
    }
}
