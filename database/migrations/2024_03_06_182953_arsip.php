<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Arsip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitas', function (Blueprint $table) {
            $table->bigIncrements('ididentitas');
            $table->integer("iduser");
            $table->integer("idjabatan")->default(0)->nullable();
            $table->String("namalengkap")->nullable();
            $table->String("email")->nullable();
            $table->enum("jk", ["P", "L"])->default("L");
            $table->enum("agama", ["Islam", "Kristen Protestan", "Katolik", "Hindu", "Buddha", "Konghucu"]);
            $table->enum("akses", ["user", "admin"]);
            $table->String("gambar")->default("user.png");
            $table->timestamps();
        });

        DB::connection('mysql2')->table('user')->insert([
            "iduser" => "404",
            "name" => "superadmin",
            "username" => "superadmin",
            "password" => Hash::make("admin2023!@#"),
        ]);

        DB::table('identitas')->insert([
            "iduser" => "404",
            "idjabatan" => 0,
            "namalengkap" => "superadmin",
            "email" => "superadmin@gmail.com",
            "jk" => "L",
            "agama" => "1",
            "akses" => "admin",
        ]);


        Schema::create('jabatan', function (Blueprint $table) {
            $table->bigIncrements('idjabatan');
            $table->string("jabatan")->unique();
            $table->timestamps();
        });

        $jabatan = [
            "guru",
            "kepala sekolah",
            "tata usaha",
            "pustakawan",
        ];

        foreach ($jabatan as $j) {
            DB::table("jabatan")->insert([
                "jabatan" => $j,
            ]);
        }

        Schema::create('arsip', function (Blueprint $table) {
            $table->bigIncrements('idarsip');
            $table->String("namaarsip");
            $table->String("mimetype");
            $table->integer("iduser");
            $table->integer("idketerangan");
            $table->date("tanggal");
            $table->String("links");
            $table->timestamps();
        });

        Schema::create('bagikan', function (Blueprint $table) {
            $table->bigIncrements('idbagikan');
            $table->integer("idarsip");
            $table->integer("iduser");
            $table->boolean("ket")->default(0);
            $table->timestamps();
        });

        Schema::create('keterangan', function (Blueprint $table) {
            $table->bigIncrements('idketerangan');
            $table->string("keterangan")->unique();
            $table->timestamps();
        });

        $keterangan = [
            "Modul Ajar/RPP",
            "Surat Masuk",
        ];

        foreach ($keterangan as $k) {
            DB::table("keterangan")->insert([
                "keterangan" => $k,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
