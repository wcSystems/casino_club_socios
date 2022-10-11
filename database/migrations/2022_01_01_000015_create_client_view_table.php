<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* DB::statement("
            CREATE OR REPLACE VIEW count_client_club_vip_views AS
            (
                SELECT IF(club_vip=1,'Si',IF(club_vip=0,'No','Otros')) AS name, COUNT(*) AS total
                FROM clients 
                GROUP BY club_vip
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_referido_views AS
            (
                SELECT IF(referido=1,'Si',IF(referido=0,'No','Otros')) AS name, COUNT(*) AS total
                FROM clients 
                GROUP BY referido
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_vive_cerca_views AS
            (
                SELECT IF(vive_cerca=1,'Si',IF(vive_cerca=0,'No','Otros')) AS name, COUNT(*) AS total
                FROM clients 
                GROUP BY vive_cerca
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_trabaja_cerca_views AS
            (
                SELECT IF(trabaja_cerca=1,'Si',IF(trabaja_cerca=0,'No','Otros')) AS name, COUNT(*) AS total
                FROM clients 
                GROUP BY trabaja_cerca
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_solo_de_paso_views AS
            (
                SELECT IF(solo_de_paso=1,'Si',IF(solo_de_paso=0,'No','Otros')) AS name, COUNT(*) AS total
                FROM clients 
                GROUP BY solo_de_paso
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_descuento_views AS
            (
                SELECT IF(descuento=1,'Si',IF(descuento=0,'No','Otros')) AS name, COUNT(*) AS total
                FROM clients 
                GROUP BY descuento
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_puntos_por_canje_views AS
            (
                SELECT IF(puntos_por_canje=1,'Si',IF(puntos_por_canje=0,'No','Otros')) AS name, COUNT(*) AS total
                FROM clients 
                GROUP BY puntos_por_canje
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_ticket_souvenirs_views AS
            (
                SELECT IF(ticket_souvenirs=1,'Si',IF(ticket_souvenirs=0,'No','Otros')) AS name, COUNT(*) AS total
                FROM clients 
                GROUP BY ticket_souvenirs
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_transportation_views AS
            (
                SELECT transportations.name, COUNT(*) AS total
                FROM clients 
                JOIN transportations
                ON clients.transportation_id = transportations.id
                GROUP BY transportation_id
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_machine_views AS
            (
                SELECT machines.name, COUNT(*) AS total
                FROM client_machines 
                JOIN machines
                ON client_machines.machine_id = machines.id
                GROUP BY machine_id
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_table_views AS
            (
                SELECT tables.name, COUNT(*) AS total
                FROM client_tables 
                JOIN tables
                ON client_tables.table_id = tables.id
                GROUP BY table_id
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_food_views AS
            (
                SELECT foods.name, COUNT(*) AS total
                FROM client_foods 
                JOIN foods
                ON client_foods.food_id = foods.id
                GROUP BY food_id
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_juice_views AS
            (
                SELECT juices.name, COUNT(*) AS total
                FROM client_juices 
                JOIN juices
                ON client_juices.juice_id = juices.id
                GROUP BY juice_id
            )
        ");
        DB::statement("
            CREATE OR REPLACE VIEW count_client_drink_views AS
            (
                SELECT drinks.name, COUNT(*) AS total
                FROM client_drinks 
                JOIN drinks
                ON client_drinks.drink_id = drinks.id
                GROUP BY drink_id
            )
        "); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS client_views');
        DB::statement('DROP VIEW IF EXISTS count_client_club_vip_views');
        DB::statement('DROP VIEW IF EXISTS count_client_referido_views');
        DB::statement('DROP VIEW IF EXISTS count_client_vive_cerca_views');
        DB::statement('DROP VIEW IF EXISTS count_client_trabaja_cerca_views');
        DB::statement('DROP VIEW IF EXISTS count_client_solo_de_paso_views');
        DB::statement('DROP VIEW IF EXISTS count_client_descuento_views');
        DB::statement('DROP VIEW IF EXISTS count_client_puntos_por_canje_views');
        DB::statement('DROP VIEW IF EXISTS count_client_ticket_souvenirs_views');
        DB::statement('DROP VIEW IF EXISTS count_client_transportation_views');
        DB::statement('DROP VIEW IF EXISTS count_client_machine_views');
        DB::statement('DROP VIEW IF EXISTS count_client_table_views');
        DB::statement('DROP VIEW IF EXISTS count_client_food_views');
        DB::statement('DROP VIEW IF EXISTS count_client_juice_views');
        DB::statement('DROP VIEW IF EXISTS count_client_drink_views');
    }
}
