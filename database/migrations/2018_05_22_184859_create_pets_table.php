<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->text('origin')->nullable();
            $table->double('origin_longitude')->nullable();
            $table->double('origin_latitude')->nullable();
            $table->enum('ownership', ['household', 'community']);
            $table->enum('habitat', ['caged', 'leashed', 'roaming', 'house_only']);
            $table->enum('species', ['dog', 'cat', 'others']);
            $table->string('pet_name');
            $table->string('breed')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('color');
            $table->enum('sex', ['male', 'female']);
            $table->enum('female_sex_extra', ['intact', 'spayed', 'pregnant', 'lactating'])->nullable();
            $table->integer('num_puppies')->nullable();
            $table->enum('tag', ['collar', 'microchip', 'tattoo_code', 'others'])->nullable();
            $table->string('other_tag_extra')->nullable();
            $table->enum('other_animal_contact', ['frequent', 'seldom', 'never']);
            $table->date('date_vaccinated')->nullable();
            $table->string('vaccinated_by')->nullable();
            $table->enum('vaccination_source', ['BAI', 'DARFO', 'PLGU', 'MLGU', 'DOH', 'NGO', 'OIE'])->nullable();
            $table->enum('vaccination_type', ['anti_rabies', 'others'])->nullable();
            $table->string('vaccination_remarks')->nullable();
            $table->string('vaccine_stock_number')->nullable();
            $table->enum('routine_service_activity', ['castration', 'deworming', 'spaying', 'vitamin_injection', 'others'])->nullable();
            $table->string('other_routine_service_activity_extra')->nullable();
            $table->string('routine_service_remarks')->nullable();

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
        Schema::dropIfExists('pets');
    }
}
