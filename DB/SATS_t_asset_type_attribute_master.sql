-- Adminer 4.8.1 PostgreSQL 15.3 dump

DROP TABLE IF EXISTS "t_asset_type_attribute_master";
DROP SEQUENCE IF EXISTS t_asset_type_attribute_master_ata_asset_type_attribute_id_seq;
CREATE SEQUENCE t_asset_type_attribute_master_ata_asset_type_attribute_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 315 CACHE 1;

CREATE TABLE "product"."t_asset_type_attribute_master" (
    "ata_asset_type_attribute_id" integer DEFAULT nextval('t_asset_type_attribute_master_ata_asset_type_attribute_id_seq') NOT NULL,
    "ata_asset_type_attribute_code" character varying,
    "ata_asset_type_attribute_description" character varying,
    "ata_asset_type_attribute_datatype" character varying NOT NULL,
    "ata_asset_type_attribute_mandatory_flag" character varying,
    "ata_asset_type_attribute_default_value" character varying,
    "ata_asset_type_id" integer DEFAULT '0',
    "ata_creation_date" timestamp,
    "ata_created_by" character varying,
    "ata_effective_start_date" timestamp,
    "ata_last_updated_date" timestamp,
    "ata_last_updated_by" character varying,
    "ata_effective_end_date" timestamp,
    "ata_asset_type_attribute_name" character varying,
    "ata_flov" character varying,
    "ata_display" character varying,
    "ata_status" character varying,
    "ata_field_requiered_not_required_flag" character varying,
    "ata_field_editable_non_editable_flag" character varying,
    "attribute_catagory" smallint DEFAULT '0',
    CONSTRAINT "t_asset_type_attribute_master_pkey" PRIMARY KEY ("ata_asset_type_attribute_id"),
    CONSTRAINT "t_asset_type_attribute_master_unique" UNIQUE ("ata_asset_type_attribute_code", "ata_asset_type_id", "ata_asset_type_attribute_description")
) WITH (oids = false);

INSERT INTO "t_asset_type_attribute_master" ("ata_asset_type_attribute_id", "ata_asset_type_attribute_code", "ata_asset_type_attribute_description", "ata_asset_type_attribute_datatype", "ata_asset_type_attribute_mandatory_flag", "ata_asset_type_attribute_default_value", "ata_asset_type_id", "ata_creation_date", "ata_created_by", "ata_effective_start_date", "ata_last_updated_date", "ata_last_updated_by", "ata_effective_end_date", "ata_asset_type_attribute_name", "ata_flov", "ata_display", "ata_status", "ata_field_requiered_not_required_flag", "ata_field_editable_non_editable_flag", "attribute_catagory") VALUES
(257,	NULL,	NULL,	'Alphanumeric',	NULL,	NULL,	0,	'2023-11-13 19:02:21',	'Admin',	'2023-11-13 19:02:21',	'2023-11-13 19:02:21',	'Admin',	NULL,	'Manufacturer Name',	NULL,	'Yes',	'Valid',	'Yes',	'Yes',	0),
(267,	NULL,	NULL,	'Alphanumeric',	NULL,	NULL,	0,	'2023-11-13 19:28:23',	'Admin',	'2023-11-13 19:28:23',	'2023-11-13 19:28:23',	'Admin',	NULL,	'Preventive Maintenance Cycle',	NULL,	'No',	'Valid',	'No',	'Yes',	0),
(269,	NULL,	NULL,	'Date',	NULL,	NULL,	0,	'2023-11-13 19:30:39',	'Admin',	'2023-11-13 19:30:39',	'2023-11-13 19:30:39',	'Admin',	NULL,	'Last Tag scanned date',	NULL,	'No',	'Valid',	'No',	'Yes',	0),
(271,	NULL,	NULL,	'Numeric',	NULL,	NULL,	340,	'2023-11-16 13:04:41',	'Admin',	'2023-11-16 13:04:41',	'2023-11-16 13:04:41',	'Admin',	NULL,	'Antenna Diameter (m)',	NULL,	'Yes',	'Valid',	'Yes',	'Yes',	1),
(272,	NULL,	NULL,	'Numeric',	NULL,	NULL,	341,	'2023-11-16 13:05:34',	'Admin',	'2023-11-16 13:05:34',	'2023-11-16 13:05:34',	'Admin',	NULL,	'Antenna Height (m)',	NULL,	'Yes',	'Valid',	'Yes',	'Yes',	1),
(270,	NULL,	NULL,	'FLoV',	NULL,	'In-use',	0,	'2023-11-13 19:33:17',	'Admin',	'2023-11-13 19:33:17',	'2023-11-13 19:33:17',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'Status',	'Defective,Defunct,Duplicate,Idle,In-use,Missing,Scrap',	'Yes',	'Valid',	'Yes',	'Yes',	0),
(262,	NULL,	NULL,	'Numeric',	NULL,	NULL,	0,	'2023-11-13 19:17:19',	'Admin',	'2023-11-13 19:17:19',	'2023-11-13 19:17:19',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'Depreciation Percentage',	NULL,	'No',	'Valid',	'No',	'Yes',	0),
(256,	NULL,	NULL,	'Alphanumeric',	NULL,	NULL,	0,	'2023-11-13 19:01:34',	'Admin',	'2023-11-13 19:01:34',	'2023-11-13 19:01:34',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'Descriptions',	NULL,	'Yes',	'Valid',	'Yes',	'Yes',	0),
(264,	NULL,	NULL,	'Numeric',	NULL,	NULL,	0,	'2023-11-13 19:19:18',	'Admin',	'2023-11-13 19:19:18',	'2023-11-13 19:19:18',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'NPV',	NULL,	'No',	'Valid',	'No',	'Yes',	0),
(260,	NULL,	NULL,	'Numeric',	NULL,	NULL,	0,	'2023-11-13 19:10:47',	'Admin',	'2023-11-13 19:10:47',	'2023-11-13 19:10:47',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'Cost [in INR]',	NULL,	'No',	'Valid',	'No',	'Yes',	0),
(261,	NULL,	NULL,	'Numeric',	NULL,	NULL,	0,	'2023-11-13 19:12:18',	'Admin',	'2023-11-13 19:12:18',	'2023-11-13 19:12:18',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'Absolute Depreciation',	NULL,	'No',	'Valid',	'No',	'Yes',	0),
(268,	NULL,	NULL,	'Numeric',	NULL,	NULL,	0,	'2023-11-13 19:29:31',	'Admin',	'2023-11-13 19:29:31',	'2023-11-13 19:29:31',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'Number of times parent changed',	NULL,	'No',	'Valid',	'No',	'Yes',	0),
(258,	NULL,	NULL,	'Alphanumeric',	NULL,	NULL,	0,	'2023-11-13 19:03:16',	'Admin',	'2023-11-13 19:03:16',	'2023-11-13 19:03:16',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'Make and Model',	NULL,	'Yes',	'Valid',	'No',	'Yes',	0),
(259,	NULL,	NULL,	'Alphanumeric',	NULL,	NULL,	0,	'2023-11-13 19:07:11',	'Admin',	'2023-11-13 19:07:11',	'2023-11-13 19:07:11',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'Manufactured On [YYYYMMM]',	NULL,	'No',	'Valid',	'No',	'Yes',	0),
(265,	NULL,	NULL,	'Numeric',	NULL,	NULL,	0,	'2023-11-13 19:20:20',	'Admin',	'2023-11-13 19:20:20',	'2023-11-13 19:20:20',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'Installed On [YYMM]',	NULL,	'No',	'Valid',	'Yes',	'Yes',	0),
(315,	NULL,	'Manufacture serial number of the product',	'Alphanumeric',	NULL,	NULL,	0,	'2024-02-22 17:50:53',	'ramesh.prasanna@ssquarespenta.com',	'2024-02-22 17:50:53',	'2024-02-22 17:50:53',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'MANUFACTURER SERIAL No.',	NULL,	'No',	'Valid',	'No',	'Yes',	0),
(266,	NULL,	NULL,	'Alphanumeric',	NULL,	NULL,	0,	'2023-11-13 19:21:41',	'Admin',	'2023-11-13 19:21:41',	'2023-11-13 19:21:41',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	'Capacity',	NULL,	'Yes',	'Valid',	'Yes',	'Yes',	0);

-- 2024-07-02 14:50:04.880114+05:30
