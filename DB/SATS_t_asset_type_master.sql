-- Adminer 4.8.1 PostgreSQL 15.3 dump

DROP TABLE IF EXISTS "t_asset_type_master";
DROP SEQUENCE IF EXISTS t_asset_type_master_at_asset_type_id_seq;
CREATE SEQUENCE t_asset_type_master_at_asset_type_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 345 CACHE 1;

CREATE TABLE "product"."t_asset_type_master" (
    "at_asset_type_id" integer DEFAULT nextval('t_asset_type_master_at_asset_type_id_seq') NOT NULL,
    "at_asset_type_code" character varying,
    "at_asset_type_description" character varying,
    "at_parent_asset_type_id" integer,
    "at_asset_type_category" character varying NOT NULL,
    "at_asset_type_status" character varying NOT NULL,
    "at_creation_date" timestamp NOT NULL,
    "at_created_by" character varying NOT NULL,
    "at_effective_start_date" timestamp NOT NULL,
    "at_last_updated_date" timestamp NOT NULL,
    "at_last_updated_by" character varying NOT NULL,
    "at_effective_end_date" timestamp,
    "at_asset_type_name" character varying NOT NULL,
    CONSTRAINT "t_asset_type_master_pkey" PRIMARY KEY ("at_asset_type_id"),
    CONSTRAINT "t_asset_type_master_unique" UNIQUE ("at_asset_type_code"),
    CONSTRAINT "t_asset_type_name_unique" UNIQUE ("at_asset_type_name")
) WITH (oids = false);

INSERT INTO "t_asset_type_master" ("at_asset_type_id", "at_asset_type_code", "at_asset_type_description", "at_parent_asset_type_id", "at_asset_type_category", "at_asset_type_status", "at_creation_date", "at_created_by", "at_effective_start_date", "at_last_updated_date", "at_last_updated_by", "at_effective_end_date", "at_asset_type_name") VALUES
(331,	NULL,	NULL,	330,	'Passive',	'Valid',	'2023-11-13 18:45:35',	'Srija',	'2023-11-13 18:45:35',	'2023-11-13 18:45:35',	'Admin',	NULL,	'DG Spares'),
(332,	NULL,	NULL,	NULL,	'Passive',	'Valid',	'2023-11-13 18:45:52',	'Srija',	'2023-11-13 18:45:52',	'2023-11-13 18:45:52',	'Admin',	NULL,	'AC'),
(333,	NULL,	NULL,	332,	'Passive',	'Valid',	'2023-11-13 18:46:07',	'Srija',	'2023-11-13 18:46:07',	'2023-11-13 18:46:07',	'Admin',	NULL,	'AC Spares'),
(334,	NULL,	NULL,	NULL,	'Passive',	'Valid',	'2023-11-13 18:46:21',	'Srija',	'2023-11-13 18:46:21',	'2023-11-13 18:46:21',	'Admin',	NULL,	'Battery Bank'),
(335,	NULL,	NULL,	334,	'Passive',	'Valid',	'2023-11-13 18:46:36',	'Srija',	'2023-11-13 18:46:36',	'2023-11-13 18:46:36',	'Admin',	NULL,	'Battery'),
(336,	NULL,	NULL,	NULL,	'Passive',	'Valid',	'2023-11-13 18:46:58',	'Srija',	'2023-11-13 18:46:58',	'2023-11-13 18:46:58',	'Admin',	NULL,	'Power Plant'),
(337,	NULL,	NULL,	336,	'Passive',	'Valid',	'2023-11-13 18:47:15',	'Srija',	'2023-11-13 18:47:15',	'2023-11-13 18:47:15',	'Admin',	NULL,	'Rectifier'),
(338,	NULL,	NULL,	NULL,	'Passive',	'Valid',	'2023-11-13 18:47:30',	'Srija',	'2023-11-13 18:47:30',	'2023-11-13 18:47:30',	'Admin',	NULL,	'Cabinet'),
(339,	NULL,	NULL,	NULL,	'Passive',	'Valid',	'2023-11-13 18:47:44',	'Srija',	'2023-11-13 18:47:44',	'2023-11-13 18:47:44',	'Admin',	NULL,	'Fire Extinguisher'),
(340,	NULL,	NULL,	NULL,	'Active',	'Valid',	'2023-11-16 13:01:58',	'Srija',	'2023-11-16 13:01:58',	'2023-11-16 13:01:58',	'Admin',	NULL,	'MW Antenna'),
(341,	NULL,	NULL,	NULL,	'Active',	'Valid',	'2023-11-16 13:03:04',	'Srija',	'2023-11-16 13:03:04',	'2023-11-16 13:03:04',	'Admin',	NULL,	'Radio Antenna'),
(344,	NULL,	NULL,	343,	'Passive',	'Valid',	'2024-01-05 13:12:51',	'ravishankar.lingaraju@ssquarespenta.com',	'2024-01-05 13:12:51',	'2024-01-05 13:12:51',	'Admin',	NULL,	'Aircon Insulation'),
(343,	NULL,	NULL,	332,	'Passive',	'Valid',	'2024-01-05 13:12:31',	'ravishankar.lingaraju@ssquarespenta.com',	'2024-01-05 13:12:31',	'2024-01-05 13:12:31',	'Admin',	NULL,	'Aircon Piping'),
(330,	NULL,	'DG Set',	NULL,	'Passive',	'Valid',	'2023-11-13 18:45:18',	'Srija',	'2023-11-13 18:45:18',	'2023-11-13 18:45:18',	'Admin',	NULL,	'DG Set'),
(342,	NULL,	'telecom wire connection',	344,	'Active',	'Invalid',	'2024-01-02 09:41:29',	'Srija',	'2024-01-02 09:41:29',	'2024-01-02 09:41:29',	'Admin',	NULL,	'chord'),
(345,	NULL,	NULL,	344,	'Passive',	'Valid',	'2024-01-05 13:13:17',	'ravishankar.lingaraju@ssquarespenta.com',	'2024-01-05 13:13:17',	'2024-01-05 13:13:17',	'Admin',	NULL,	'Aircon Vent');

-- 2024-07-02 15:07:05.676235+05:30
