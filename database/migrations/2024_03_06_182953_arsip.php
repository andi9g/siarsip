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
        Schema::create('guru', function (Blueprint $table) {
            $table->bigIncrements('idguru');
            $table->integer("iduser")->unique();
            $table->integer("idjabatan")->default(0)->nullable();
            $table->String("namalengkap")->nullable();
            $table->String("email")->nullable();
            $table->enum("jk", ["P", "L"])->default("L");
            $table->enum("agama", ["Islam", "Kristen Protestan", "Katolik", "Hindu", "Buddha", "Konghucu"]);
            $table->enum("akses", ["guru", "kepsek", "superadmin"]);
            $table->String("gambar")->default("user.png");
            $table->timestamps();
        });

        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('idsiswa');
            $table->integer("iduser");
            $table->integer("idkelas");
            $table->integer("idjurusan");
            // $table->char("nisn", 11)->unique();
            $table->char("nis")->nullable();
            $table->String("namalengkap")->nullable();
            $table->String("tempatlahir")->nullable();
            $table->date("tanggallahir")->nullable();
            $table->String("email")->nullable();
            $table->enum("jk", ["P", "L"])->default("L");
            $table->enum("agama", ["Islam", "Kristen Protestan", "Katolik", "Hindu", "Buddha", "Konghucu"]);
            $table->String("gambar")->default("user.png");
            $table->timestamps();
        });

        Schema::create('jurusan', function (Blueprint $table) {
            $table->bigIncrements('idjurusan');
            $table->String("jurusan")->unique();
            $table->String("namajurusan");
            $table->timestamps();
        });

        DB::table('jurusan')->insert([
            "jurusan" => "RPL",
            "namajurusan" => "Rekayasa Perangkat Lunak",
        ]);

        Schema::create('kelas', function (Blueprint $table) {
            $table->bigIncrements('idkelas');
            $table->String("namakelas")->unique();
            $table->timestamps();
        });

        Schema::create('modulajar', function (Blueprint $table) {
            $table->bigIncrements('idmodulajar');
            $table->String("namamodulajar");
            $table->String("mimetype");
            $table->integer("iduser");
            $table->integer("idmapel");
            $table->date("tanggal");
            $table->String("links");
            $table->timestamps();
        });

        Schema::create('bagikanmodulajar', function (Blueprint $table) {
            $table->bigIncrements('idbagikanmodulajar');
            $table->integer("idmodulajar");
            $table->integer("idjurusan");
            $table->integer("iduser");
            $table->integer("idkelas");
            $table->timestamps();
        });

        Schema::create('mapel', function (Blueprint $table) {
            $table->bigIncrements('idmapel');
            $table->integer("iduser");
            $table->String("namamapel");
            $table->timestamps();
        });

        $kelas = [
            "X",
            "XI",
            "XII",
        ];
        foreach ($kelas as $k) {
            DB::table('kelas')->insert([
                "namakelas" => $k,
            ]);
        }

        DB::table('user')->insert([
            "iduser" => "404",
            "username" => "superadmin",
            "password" => Hash::make("admin2023!@#"),
        ]);

        DB::table('guru')->insert([
            "iduser" => "404",
            "idjabatan" => 0,
            "namalengkap" => "superadmin",
            "email" => "superadmin@gmail.com",
            "jk" => "L",
            "agama" => "1",
            "akses" => "superadmin",
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
