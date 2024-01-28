<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create( 'customer_profiles', function ( Blueprint $table ) {
            $table->id();

            $table->string( 'cust_name', 100 );
            $table->string( 'cust_add' );
            $table->string( 'cust_city', 50 );
            $table->string( 'cust_state', 50 );
            $table->string( 'cust_postcode', 10 );
            $table->string( 'cust_country', 50 );
            $table->string( 'cust_phone', 50 );

            $table->string( 'ship_name', 100 );
            $table->string( 'ship_add' );
            $table->string( 'ship_city', 50 );
            $table->string( 'ship_state', 50 );
            $table->string( 'ship_postcode', 10 );
            $table->string( 'ship_country', 50 );
            $table->string( 'ship_phone', 50 );

            $table->unsignedBigInteger( 'user_id' )->unique();
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->restrictOnDelete()->cascadeOnUpdate();

            $table->timestamp( 'created_at' )->useCurrent();
            $table->timestamp( 'updated_at' )->useCurrent()->useCurrentOnUpdate();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists( 'customer_profiles' );
    }
};