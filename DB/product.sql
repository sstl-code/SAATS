-- Product dump

DROP TABLE IF EXISTS "t_asset_status_config_master";
DROP SEQUENCE IF EXISTS t_asset_status_config_master_asc_asset_status_config_id_seq;
CREATE SEQUENCE t_asset_status_config_master_asc_asset_status_config_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "product"."t_asset_status_config_master" (
    "asc_asset_status_config_id" integer DEFAULT nextval('t_asset_status_config_master_asc_asset_status_config_id_seq') NOT NULL,
    "asc_asset_status_config_location_type" character varying NOT NULL,
    "asc_asset_status_config_location_type_id" integer NOT NULL,
    "asc_asset_status_code" character varying NOT NULL,
    "asc_asset_status_record_status" character varying NOT NULL,
    "asc_creation_date" timestamp NOT NULL,
    "asc_created_by" character varying NOT NULL,
    "asc_effective_start_date" timestamp NOT NULL,
    "asc_last_updated_date" timestamp NOT NULL,
    "asc_last_updated_by" character varying NOT NULL,
    "asc_effective_end_date" timestamp,
    CONSTRAINT "t_asset_status_config_master_pkey" PRIMARY KEY ("asc_asset_status_config_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_asset_type_attribute_master";
DROP SEQUENCE IF EXISTS t_asset_type_attribute_master_ata_asset_type_attribute_id_seq;
CREATE SEQUENCE t_asset_type_attribute_master_ata_asset_type_attribute_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "product"."t_asset_type_attribute_master" (
    "ata_asset_type_attribute_id" integer DEFAULT nextval('t_asset_type_attribute_master_ata_asset_type_attribute_id_seq') NOT NULL,
    "ata_asset_type_attribute_code" character varying,
    "ata_asset_type_attribute_description" character varying,
    "ata_asset_type_attribute_datatype" character varying NOT NULL,
    "ata_asset_type_attribute_mandatory_flag" character varying,
    "ata_asset_type_attribute_default_value" character varying,
    "ata_asset_type_id" integer DEFAULT '0',
    "ata_creation_date" timestamp NOT NULL,
    "ata_created_by" character varying NOT NULL,
    "ata_effective_start_date" timestamp NOT NULL,
    "ata_last_updated_date" timestamp,
    "ata_last_updated_by" character varying,
    "ata_effective_end_date" timestamp,
    "ata_asset_type_attribute_name" character varying,
    "ata_flov" character varying,
    "ata_display" character varying,
    "ata_status" character varying,
    "ata_field_requiered_not_required_flag" character varying NOT NULL,
    "ata_field_editable_non_editable_flag" character varying NOT NULL,
    "attribute_catagory" smallint DEFAULT '0' NOT NULL,
    CONSTRAINT "t_asset_type_attribute_master_pkey" PRIMARY KEY ("ata_asset_type_attribute_id"),
    CONSTRAINT "t_asset_type_attribute_master_unique" UNIQUE ("ata_asset_type_attribute_code", "ata_asset_type_id", "ata_asset_type_attribute_description")
) WITH (oids = false);

INSERT INTO "t_asset_type_attribute_master" ("ata_asset_type_attribute_id", "ata_asset_type_attribute_code", "ata_asset_type_attribute_description", "ata_asset_type_attribute_datatype", "ata_asset_type_attribute_mandatory_flag", "ata_asset_type_attribute_default_value", "ata_asset_type_id", "ata_creation_date", "ata_created_by", "ata_effective_start_date", "ata_last_updated_date", "ata_last_updated_by", "ata_effective_end_date", "ata_asset_type_attribute_name", "ata_flov", "ata_display", "ata_status", "ata_field_requiered_not_required_flag", "ata_field_editable_non_editable_flag", "attribute_catagory") VALUES
(221,	NULL,	NULL,	'Numeric',	NULL,	NULL,	295,	'2023-10-05 16:24:15',	'Admin',	'2023-10-05 16:24:15',	'2023-10-05 16:24:15',	'',	NULL,	'Antenna Diameter',	NULL,	'Yes',	'Valid',	'Yes',	'Yes',	1),
(218,	NULL,	NULL,	'FLoV',	NULL,	NULL,	293,	'2023-10-05 16:22:42',	'Admin',	'2023-10-05 16:22:42',	'2023-10-05 16:22:42',	'',	NULL,	'Power Rating (KW)',	NULL,	'No',	'Valid',	'Yes',	'Yes',	1),
(261,	NULL,	NULL,	'Numeric',	NULL,	NULL,	0,	'2024-02-09 09:50:41',	'ravishankar.lingaraju@ssquarespenta.com',	'2024-02-09 09:50:41',	'2024-02-09 09:50:41',	'',	NULL,	'Absolute Depreciation',	NULL,	'No',	'Valid',	'No',	'Yes',	0),
(224,	NULL,	NULL,	'FLoV',	NULL,	NULL,	290,	'2023-10-05 16:27:31',	'Admin',	'2023-10-05 16:27:31',	'2023-10-05 16:27:31',	'',	NULL,	'Maintenance Cycle',	'6 Months,12 Months,15 Months,18 Months',	'Yes',	'Valid',	'Yes',	'Yes',	1),
(235,	NULL,	NULL,	'FLoV',	NULL,	NULL,	290,	'2023-10-06 12:56:11',	'Admin',	'2023-10-06 12:56:11',	'2023-10-06 12:56:11',	'',	NULL,	'Capacity',	'1 Ton,1.3 Ton, 1.5 Ton, 2 Ton,2.5 Ton,3 Ton',	'Yes',	'Valid',	'No',	'Yes',	1),
(234,	NULL,	NULL,	'Alphanumeric',	NULL,	NULL,	290,	'2023-10-06 12:55:17',	'Admin',	'2023-10-06 12:55:17',	'2023-10-06 12:55:17',	'',	NULL,	'Model',	NULL,	'Yes',	'Valid',	'No',	'Yes',	1),
(233,	NULL,	NULL,	'Alphanumeric',	NULL,	NULL,	290,	'2023-10-06 12:54:52',	'Admin',	'2023-10-06 12:54:52',	'2023-10-06 12:54:52',	'',	NULL,	'Supplier',	NULL,	'Yes',	'Valid',	'No',	'Yes',	1),
(225,	NULL,	NULL,	'FLoV',	NULL,	NULL,	291,	'2023-10-05 16:28:48',	'Admin',	'2023-10-05 16:28:48',	'2023-10-05 16:28:48',	'',	NULL,	'Max Current',	'5 Amp,10 Amp,15 Amp,20 Amp',	'YES',	'Valid',	'Yes',	'Yes',	1),
(260,	NULL,	NULL,	'Numeric',	NULL,	NULL,	0,	'2024-02-09 09:50:40',	'ravishankar.lingaraju@ssquarespenta.com',	'2024-02-09 09:50:40',	'2024-02-09 09:50:40',	'',	NULL,	'Absolute Depreciation',	NULL,	'Yes',	'Valid',	'No',	'Yes',	0),
(226,	NULL,	NULL,	'Free-flow',	NULL,	NULL,	292,	'2023-10-05 17:01:48',	'Admin',	'2023-10-05 17:01:48',	'2023-10-05 17:01:48',	'',	NULL,	'Maintenance Agent',	NULL,	'YES',	'Valid',	'No',	'Yes',	1),
(228,	NULL,	NULL,	'Alphanumeric',	NULL,	NULL,	292,	'2023-10-05 17:02:30',	'Admin',	'2023-10-05 17:02:30',	'2023-10-05 17:02:30',	'',	NULL,	'Owner Company',	NULL,	'YES',	'Valid',	'No',	'Yes',	1),
(232,	NULL,	NULL,	'FLoV',	'In-use',	NULL,	0,	'2024-04-24 20:41:42.794655',	'',	'2024-04-24 20:41:42.794655',	'2024-04-24 20:41:42.794655',	'',	NULL,	'status',	'Defective,Defunct,Duplicate,Idle,In-use,Missing,Scrap',	'Yes',	'Valid',	'Yes',	'Yes',	0),
(219,	NULL,	NULL,	'Numeric',	NULL,	NULL,	293,	'2023-10-05 16:23:29',	'Admin',	'2023-10-05 16:23:29',	'2023-10-05 16:23:29',	'',	NULL,	'No. of Antennae',	NULL,	'Yes',	'Valid',	'Yes',	'Yes',	1);




DROP TABLE IF EXISTS "t_datatypes";
DROP SEQUENCE IF EXISTS t_datatypes_id_seq;
CREATE SEQUENCE t_datatypes_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "product"."t_datatypes" (
    "id" integer DEFAULT nextval('t_datatypes_id_seq') NOT NULL,
    "typeName" character varying(200) NOT NULL,
    "status" boolean NOT NULL,
    CONSTRAINT "t_datatypes_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "t_datatypes" ("id", "typeName", "status") VALUES
(1,	'Alphanumeric',	't'),
(2,	'Date',	't'),
(3,	'FLoV',	't'),
(4,	'Free-flow',	't'),
(5,	'Numeric',	't');

DROP TABLE IF EXISTS "t_location_attribute_master";
DROP SEQUENCE IF EXISTS t_location_attribute_master_la_location_attribute_id_seq;
CREATE SEQUENCE t_location_attribute_master_la_location_attribute_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "product"."t_location_attribute_master" (
    "la_location_attribute_id" integer DEFAULT nextval('t_location_attribute_master_la_location_attribute_id_seq') NOT NULL,
    "la_location_attribute_location_type" character varying NOT NULL,
    "la_location_attribute_name" character varying NOT NULL,
    "la_location_attribute_description" character varying,
    "la_location_attribute_datatype" character varying NOT NULL,
    "la_location_attribute_mandatory_flag" character varying NOT NULL,
    "la_location_attribute_default_value" character varying,
    "la_location_type_id" integer,
    "la_creation_date" timestamp NOT NULL,
    "la_created_by" character varying NOT NULL,
    "la_effective_start_date" timestamp NOT NULL,
    "la_last_updated_date" timestamp NOT NULL,
    "la_last_updated_by" character varying NOT NULL,
    "la_effective_end_date" timestamp,
    "la_flov" character varying,
    "la_display" character varying,
    "la_editable" character varying,
    "la_status" character varying,
    "la_requiered_not_required_flag" character varying DEFAULT '0',
    CONSTRAINT "t_location_attribute_master_pkey" PRIMARY KEY ("la_location_attribute_id")
) WITH (oids = false);

INSERT INTO "t_location_attribute_master" ("la_location_attribute_id", "la_location_attribute_location_type", "la_location_attribute_name", "la_location_attribute_description", "la_location_attribute_datatype", "la_location_attribute_mandatory_flag", "la_location_attribute_default_value", "la_location_type_id", "la_creation_date", "la_created_by", "la_effective_start_date", "la_last_updated_date", "la_last_updated_by", "la_effective_end_date", "la_flov", "la_display", "la_editable", "la_status", "la_requiered_not_required_flag") VALUES
(144,	'SITES',	'Demo12',	NULL,	'Numeric',	'NOT REQUIRED',	NULL,	40,	'2023-11-02 13:01:56',	'Admin01',	'2023-11-02 13:01:56',	'2023-11-02 13:01:56',	'Admin01',	NULL,	NULL,	'No',	'Yes',	'Valid',	'Yes'),
(130,	'PIN Code',	'PIN Code',	NULL,	'Alphanumeric',	'REQUIRED',	NULL,	0,	'2023-10-05 17:07:38',	'Admin01',	'2023-10-05 17:07:38',	'2023-10-05 17:07:38',	'Admin01',	NULL,	NULL,	'No',	'Yes',	'Valid',	'Yes'),
(131,	'Latitude',	'Latitude',	NULL,	'Numeric',	'REQUIRED',	NULL,	0,	'2023-10-05 17:08:02',	'Admin01',	'2023-10-05 17:08:02',	'2023-10-05 17:08:02',	'Admin01',	NULL,	NULL,	'Yes',	'Yes',	'Valid',	'Yes'),
(132,	'Longitude',	'Longitude',	NULL,	'Numeric',	'REQUIRED',	NULL,	0,	'2023-10-05 17:08:21',	'Admin01',	'2023-10-05 17:08:21',	'2023-10-05 17:08:21',	'Admin01',	NULL,	NULL,	'Yes',	'Yes',	'Valid',	'Yes'),
(135,	'SITES',	'Site Activation Date',	NULL,	'Date',	'NOT REQUIRED',	NULL,	40,	'2023-10-05 17:09:48',	'Admin01',	'2023-10-05 17:09:48',	'2023-10-05 17:09:48',	'Admin01',	NULL,	NULL,	'Yes',	'Yes',	'Valid',	'Yes'),
(137,	'Region',	'Region',	NULL,	'FLoV',	'REQUIRED',	NULL,	0,	'2023-10-06 12:45:38',	'Admin01',	'2023-10-06 12:45:38',	'2023-10-06 12:45:38',	'Admin01',	NULL,	'North,South,East,West',	'Yes',	'Yes',	'Valid',	'Yes'),
(139,	'SITES',	'Max Wind Load',	NULL,	'Numeric',	'NOT REQUIRED',	NULL,	40,	'2023-10-10 15:24:59',	'Admin01',	'2023-10-10 15:24:59',	'2023-10-10 15:24:59',	'Admin01',	NULL,	NULL,	'Yes',	'Yes',	'Valid',	'Yes'),
(140,	'SITES',	'Tower Height',	NULL,	'Numeric',	'NOT REQUIRED',	NULL,	40,	'2023-10-10 15:25:25',	'Admin01',	'2023-10-10 15:25:25',	'2023-10-10 15:25:25',	'Admin01',	NULL,	NULL,	'Yes',	'Yes',	'Valid',	'Yes'),
(141,	'OFFICES',	'Distance',	NULL,	'Numeric',	'NOT REQUIRED',	NULL,	41,	'2023-10-10 16:53:11',	'Admin01',	'2023-10-10 16:53:11',	'2023-10-10 16:53:11',	'Admin01',	NULL,	NULL,	'Yes',	'Yes',	'Valid',	'Yes'),
(138,	'Status',	'Status',	NULL,	'FLoV',	'REQUIRED',	'Active',	0,	'2023-10-10 15:17:27',	'Admin01',	'2023-10-10 15:17:27',	'2023-10-10 15:17:27',	'Admin01',	NULL,	'Active,Inactive',	'Yes',	'Yes',	'Valid',	'Yes'),
(136,	'Landmark',	'Landmark',	NULL,	'Free-flow',	'REQUIRED',	NULL,	0,	'2023-10-06 12:44:44',	'Admin01',	'2023-10-06 12:44:44',	'2023-10-06 12:44:44',	'Admin01',	NULL,	NULL,	'Yes',	'Yes',	'Valid',	'No');

DROP TABLE IF EXISTS "t_location_type_master";
DROP SEQUENCE IF EXISTS t_location_type_master_lt_location_type_id_seq;
CREATE SEQUENCE t_location_type_master_lt_location_type_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "product"."t_location_type_master" (
    "lt_location_type_id" integer DEFAULT nextval('t_location_type_master_lt_location_type_id_seq') NOT NULL,
    "lt_location_type" character varying NOT NULL,
    "lt_location_type_address" character varying,
    "lt_location_type_status" character varying NOT NULL,
    "lt_creation_date" timestamp NOT NULL,
    "lt_created_by" character varying NOT NULL,
    "lt_effective_start_date" timestamp NOT NULL,
    "lt_last_updated_date" timestamp NOT NULL,
    "lt_last_updated_by" character varying NOT NULL,
    "lt_effective_end_date" timestamp,
    "lt_location_type_name" character varying,
    CONSTRAINT "t_location_type_master_pkey" PRIMARY KEY ("lt_location_type_id"),
    CONSTRAINT "t_location_type_master_unique" UNIQUE ("lt_location_type")
) WITH (oids = false);

INSERT INTO "t_location_type_master" ("lt_location_type_id", "lt_location_type", "lt_location_type_address", "lt_location_type_status", "lt_creation_date", "lt_created_by", "lt_effective_start_date", "lt_last_updated_date", "lt_last_updated_by", "lt_effective_end_date", "lt_location_type_name") VALUES
(45,	'WAREHOUSES',	NULL,	'Valid',	'2023-10-06 12:38:00',	'ADMIN',	'2023-10-06 12:38:00',	'2023-10-06 12:38:00',	'ADMIN',	NULL,	NULL),
(41,	'OFFICES',	NULL,	'Valid',	'2024-01-05 11:11:58',	'ADMIN',	'2024-01-05 11:11:58',	'2024-01-05 11:11:58',	'prustychinmaya294@gmail.com',	NULL,	NULL),
(42,	'REPAIR CENTERS',	NULL,	'Valid',	'2024-04-16 15:52:47',	'ADMIN',	'2024-04-16 15:52:47',	'2024-04-16 15:52:47',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	NULL),
(43,	'SCRAPYARDS',	NULL,	'Valid',	'2024-04-23 17:49:04',	'ADMIN',	'2024-04-23 17:49:04',	'2024-04-23 17:49:04',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	NULL),
(44,	'VENDOR LOCATION',	NULL,	'Valid',	'2024-04-24 15:33:15',	'ADMIN',	'2024-04-24 15:33:15',	'2024-04-24 15:33:15',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	NULL),
(40,	'SITES',	NULL,	'Valid',	'2024-05-16 11:37:19',	'ADMIN',	'2024-05-16 11:37:19',	'2024-05-16 11:37:19',	'ravishankar.lingaraju@ssquarespenta.com',	NULL,	NULL);

DROP TABLE IF EXISTS "t_operator";
DROP SEQUENCE IF EXISTS t_operator_op_id_seq;
CREATE SEQUENCE t_operator_op_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "product"."t_operator" (
    "op_id" integer DEFAULT nextval('t_operator_op_id_seq') NOT NULL,
    "op_operator_name" character varying NOT NULL,
    "op_creation_date" timestamp NOT NULL,
    "op_created_by" character varying NOT NULL,
    "op_effective_start_date" timestamp NOT NULL,
    "op_last_updated_date" timestamp NOT NULL,
    "op_last_updated_by" character varying NOT NULL,
    "op_effective_end_date" timestamp,
    CONSTRAINT "t_operator_pkey" PRIMARY KEY ("op_id")
) WITH (oids = false);

INSERT INTO "t_operator" ("op_id", "op_operator_name", "op_creation_date", "op_created_by", "op_effective_start_date", "op_last_updated_date", "op_last_updated_by", "op_effective_end_date") VALUES
(1,	'AIRTEL',	'2023-10-07 22:51:11.171165',	'',	'2023-10-07 22:51:11.171165',	'2023-10-07 22:51:11.171165',	'',	NULL),
(2,	'JIO',	'2023-10-07 22:51:11.171165',	'',	'2023-10-07 22:51:11.171165',	'2023-10-07 22:51:11.171165',	'',	NULL),
(3,	'BSNL',	'2023-10-07 22:51:11.171165',	'',	'2023-10-07 22:51:11.171165',	'2023-10-07 22:51:11.171165',	'',	NULL),
(4,	'VI',	'2023-10-07 22:51:11.171165',	'',	'2023-10-07 22:51:11.171165',	'2023-10-07 22:51:11.171165',	'',	NULL);

DROP TABLE IF EXISTS "t_reason_master";
DROP SEQUENCE IF EXISTS t_reason_master_rm_reason_id_seq;
CREATE SEQUENCE t_reason_master_rm_reason_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "product"."t_reason_master" (
    "rm_reason_id" integer DEFAULT nextval('t_reason_master_rm_reason_id_seq') NOT NULL,
    "rm_reason_code" character varying NOT NULL,
    "rm_reason_description" character varying,
    "rm_reason_status" character varying,
    "rm_creation_date" timestamp,
    "rm_created_by" character varying,
    "rm_effective_start_date" timestamp,
    "rm_last_updated_date" timestamp,
    "rm_last_updated_by" character varying,
    "rm_effective_end_date" timestamp,
    "rm_reason_parent_id" integer DEFAULT '0',
    CONSTRAINT "t_reason_master_pkey" PRIMARY KEY ("rm_reason_id"),
    CONSTRAINT "t_reason_master_unique" UNIQUE ("rm_reason_code")
) WITH (oids = false);

INSERT INTO "t_reason_master" ("rm_reason_id", "rm_reason_code", "rm_reason_description", "rm_reason_status", "rm_creation_date", "rm_created_by", "rm_effective_start_date", "rm_last_updated_date", "rm_last_updated_by", "rm_effective_end_date", "rm_reason_parent_id") VALUES
(101,	'Modify Asset',	'Edit Asset',	'Valid',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0),
(100,	'Add Asset',	'Add Asset operation',	'Valid',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0),
(102,	'Tag Asset',	'Asset Tagging',	'Valid',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0),
(103,	'STN',	'STN',	'Valid',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0),
(104,	'SRN',	'SRN',	'Valid',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0);

DROP TABLE IF EXISTS "t_reports";
DROP SEQUENCE IF EXISTS t_reports_id_seq;
CREATE SEQUENCE t_reports_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "product"."t_reports" (
    "id" integer DEFAULT nextval('t_reports_id_seq') NOT NULL,
    "report_name" character varying(250) NOT NULL,
    "report_description" text,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    "jasper_file" text,
    "report_params" text,
    "is_active" smallint DEFAULT '0' NOT NULL,
    CONSTRAINT "t_reports_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "t_reports" ("id", "report_name", "report_description", "created_at", "updated_at", "deleted_at", "jasper_file", "report_params", "is_active") VALUES
(11,	'Fully Tagged Site Identification',	'Fully Tagged Site Identification Report',	'2024-01-02 12:13:36.703423',	NULL,	NULL,	'fullyTaggedSite.jrxml',	NULL,	1),
(12,	'Not Found Asset',	'Not Found Asset',	'2024-01-02 12:21:06.451053',	NULL,	NULL,	'notFoundAsset.jrxml',	NULL,	1),
(14,	'Asset Audit',	'Asset Audit',	'2024-01-02 12:42:12.003926',	NULL,	NULL,	'assetAudit.jrxml',	NULL,	1),
(13,	'Inventory FAR Mismatch',	'Inventory FAR Mismatch',	'2024-01-02 12:40:40.361329',	NULL,	NULL,	'inventoryFARMismatch.jrxml',	NULL,	1),
(1,	'Sample Report',	'This is a demo report.',	'2023-12-26 16:20:57.709259',	NULL,	NULL,	'sampleReport.jrxml',	NULL,	0);

DROP TABLE IF EXISTS "t_site_settings";
DROP SEQUENCE IF EXISTS t_site_settings_id_seq;
CREATE SEQUENCE t_site_settings_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "product"."t_site_settings" (
    "id" bigint DEFAULT nextval('t_site_settings_id_seq') NOT NULL,
    "setting_key" character varying(250),
    "setting_value" character varying(250),
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    CONSTRAINT "t_site_settings_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "t_site_settings" ("id", "setting_key", "setting_value", "created_at", "updated_at", "deleted_at") VALUES
(3,	'NOTIFY_FAR_EMAIL',	'satsa616@gmail.com',	NULL,	NULL,	NULL),
(2,	'App_Version',	'1.6.0',	NULL,	NULL,	NULL),
(8,	'Web_Version',	'1.6.0',	NULL,	NULL,	NULL),
(6,	'Released_Date',	'05-Jan-2024',	NULL,	NULL,	NULL),
(1,	'Asset_Add_Radius(Meters)',	'50000000',	NULL,	NULL,	NULL),
(9,	'User_Managment',	'http://115.113.197.12/usermanagement/public/userLoginByToken/',	'2023-12-18 17:31:48.894985',	NULL,	NULL),
(5,	'SSTL_Logo',	'https://ats.esquaressquaredev.com/assets/images/SSTLLogo.png',	NULL,	NULL,	NULL),
(7,	'BASE_URL',	'https://ats.esquaressquaredev.com/',	NULL,	NULL,	NULL),
(4,	'Client_Logo',	'https://ats.esquaressquaredev.com/assets/images/clientlogo.png',	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS "t_sub_reason_master";
DROP SEQUENCE IF EXISTS t_sub_reason_master_srm_sub_reason_id_seq;
CREATE SEQUENCE t_sub_reason_master_srm_sub_reason_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "product"."t_sub_reason_master" (
    "srm_sub_reason_id" integer DEFAULT nextval('t_sub_reason_master_srm_sub_reason_id_seq') NOT NULL,
    "srm_sub_reason_code" character varying NOT NULL,
    "srm_sub_reason_description" character varying,
    "srm_sub_reason_status" character varying NOT NULL,
    "srm_reason_id" integer NOT NULL,
    "srm_creation_date" timestamp NOT NULL,
    "srm_created_by" character varying NOT NULL,
    "srm_effective_start_date" timestamp NOT NULL,
    "srm_last_updated_date" timestamp NOT NULL,
    "srm_last_updated_by" character varying NOT NULL,
    "srm_effective_end_date" timestamp,
    CONSTRAINT "t_sub_reason_master_pkey" PRIMARY KEY ("srm_sub_reason_id"),
    CONSTRAINT "t_sub_reason_master_unique" UNIQUE ("srm_sub_reason_code", "srm_reason_id")
) WITH (oids = false);


ALTER TABLE ONLY "product"."t_asset_status_config_master" ADD CONSTRAINT "t_asset_status_config_master_asc_asset_status_config_locat_fkey" FOREIGN KEY (asc_asset_status_config_location_type_id) REFERENCES t_location_type_master(lt_location_type_id) NOT DEFERRABLE;

ALTER TABLE ONLY "product"."t_sub_reason_master" ADD CONSTRAINT "t_sub_reason_master_srm_reason_id_fkey" FOREIGN KEY (srm_reason_id) REFERENCES t_reason_master(rm_reason_id) NOT DEFERRABLE;

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


