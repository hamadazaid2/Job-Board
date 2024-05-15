<?php

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            // foreignIdFor means that it is an foreign attribute in User Model
            $table->foreignIdFor(User::class)
                ->nullabale()
                ->constrained();
            $table->timestamps();
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->foreignIdFor(Employer::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeignIdFor(Employer::class);
        });
        Schema::dropIfExists('employers');
    }
};