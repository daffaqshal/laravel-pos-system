<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->string('purchase_number')->unique();

            $table->foreignId('supplier_id')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();

            $table->date('purchase_date');

            $table->decimal('grand_total',12,2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
