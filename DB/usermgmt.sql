-- User dump

DROP TABLE IF EXISTS "activity_log";
DROP SEQUENCE IF EXISTS activity_log_id_seq;
CREATE SEQUENCE activity_log_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."activity_log" (
    "id" bigint DEFAULT nextval('activity_log_id_seq') NOT NULL,
    "log_name" character varying(255),
    "description" text NOT NULL,
    "subject_type" character varying(255),
    "subject_id" bigint,
    "causer_type" character varying(255),
    "causer_id" bigint,
    "properties" json,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "event" character varying(255),
    "batch_uuid" uuid,
    CONSTRAINT "activity_log_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "activity_log_log_name_index" ON "public"."activity_log" USING btree ("log_name");

CREATE INDEX "causer" ON "public"."activity_log" USING btree ("causer_type", "causer_id");

CREATE INDEX "subject" ON "public"."activity_log" USING btree ("subject_type", "subject_id");


DROP TABLE IF EXISTS "audits";
DROP SEQUENCE IF EXISTS audits_id_seq;
CREATE SEQUENCE audits_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."audits" (
    "id" bigint DEFAULT nextval('audits_id_seq') NOT NULL,
    "user_type" character varying(255),
    "user_id" bigint,
    "event" character varying(255) NOT NULL,
    "auditable_type" character varying(255) NOT NULL,
    "auditable_id" bigint NOT NULL,
    "old_values" text,
    "new_values" text,
    "url" text,
    "ip_address" inet,
    "user_agent" character varying(1023),
    "tags" character varying(255),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "audits_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "audits_auditable_type_auditable_id_index" ON "public"."audits" USING btree ("auditable_type", "auditable_id");

CREATE INDEX "audits_user_id_user_type_index" ON "public"."audits" USING btree ("user_id", "user_type");


DROP TABLE IF EXISTS "failed_jobs";
DROP SEQUENCE IF EXISTS failed_jobs_id_seq;
CREATE SEQUENCE failed_jobs_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."failed_jobs" (
    "id" bigint DEFAULT nextval('failed_jobs_id_seq') NOT NULL,
    "uuid" character varying(255) NOT NULL,
    "connection" text NOT NULL,
    "queue" text NOT NULL,
    "payload" text NOT NULL,
    "exception" text NOT NULL,
    "failed_at" timestamp(0) DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT "failed_jobs_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "failed_jobs_uuid_unique" UNIQUE ("uuid")
) WITH (oids = false);


DROP TABLE IF EXISTS "functions";
DROP SEQUENCE IF EXISTS functions_id_seq;
CREATE SEQUENCE functions_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."functions" (
    "id" bigint DEFAULT nextval('functions_id_seq') NOT NULL,
    "function_name" character varying(255) NOT NULL,
    "function_description" character varying(255) NOT NULL,
    "module_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "status" boolean DEFAULT true,
    "function_url" character varying(255),
    CONSTRAINT "functions_function_name" UNIQUE ("function_name"),
    CONSTRAINT "functions_function_url" UNIQUE ("function_url"),
    CONSTRAINT "functions_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "functions" ("id", "function_name", "function_description", "module_id", "created_at", "updated_at", "status", "function_url") VALUES
(7,	'UCP - View Customer Type',	'test view customer type',	2,	'2023-10-17 22:32:30',	'2023-10-17 22:32:30',	't',	'ucp1'),
(49,	'SATS-W-Update Site',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'location_update_site'),
(46,	'SATS-W-Add Site Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'congiguration_add_site'),
(8,	'UCP - Add Customer Type',	'ucp add customer test',	2,	'2023-10-17 22:34:23',	'2023-10-17 22:34:23',	't',	'ucp2'),
(9,	'UCP - Edit Customer Type',	'test edit customer type',	2,	'2023-10-17 22:35:21',	'2023-10-17 22:35:21',	't',	'ucp-3'),
(10,	'OMS - Add Management Type',	'oms add test description',	3,	'2023-10-17 22:36:34',	'2023-10-17 22:36:34',	't',	'OMS-1'),
(33,	'SATS-W-AssetHistory',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'AssetHistory'),
(29,	'SATS-Operator Site Asset View-W',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'Operator_Site_Asset_view'),
(34,	'SATS-W-Batch Upload',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'batch_upload'),
(35,	'SATS-W-Technician Supervisor Mapping',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'Operator_to_technician'),
(36,	'SATS-W-Menu Page',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'menu_page'),
(11,	'OMS - Edit Management Type',	'edit management type test',	3,	'2023-10-17 22:37:49',	'2023-10-17 22:37:49',	't',	'OMS-2'),
(12,	'OMS - View Management Type',	'test view management',	3,	'2023-10-17 22:38:44',	'2023-10-17 22:38:44',	't',	'OMS-3'),
(4,	'SATS-Edit Asset-M',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'api-edit_asset'),
(14,	'SATS-My Sites-M',	'Mysites details',	1,	'2023-10-17 18:27:32',	'2023-10-17 18:27:32',	't',	'api-my_sites'),
(3,	'SATS-Add Asset-M',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'api-add_asset'),
(40,	'SATS-W-Add Fixed Attribute Of Asset Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'configuration_fixedasstadd'),
(41,	'SATS-W-Update Fixed Attribute Of Asset Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'configuration_updfixfetch'),
(26,	'SATS-Attributes Of Asset Types-M',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'api-asset_type_attr'),
(16,	'SATS-Asset Search By Serial Number-M',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'api-fetch_asset_by_serialno'),
(25,	'SATS-SRN-M',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'api-update_srn'),
(19,	'SATS-Asset Tagging-M',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'api-asset_tagging'),
(21,	'SATS-Global Search-M',	'Mysites details',	1,	'2023-10-17 18:27:32',	'2023-10-17 18:27:32',	't',	'api-global_search_home'),
(20,	'SATS-Near By Sites-M',	'Mysites details',	1,	'2023-10-17 18:27:32',	'2023-10-17 18:27:32',	't',	'api-near_site'),
(23,	'SATS-Audit Submit-M',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'api-audit_submit'),
(52,	'SATS-W-Add Dynamic Attribute Of Site Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'configuration_dynamicadd_atr'),
(42,	'SATS-W-Add Dynamic Attribute Of Asset Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'configuration_dynamicattribute'),
(6,	'SATS-View Asset Details-M',	'View Asset Details',	1,	'2023-10-17 18:27:32',	'2023-10-17 18:27:32',	't',	'api-single_asset_details'),
(45,	'SATS-W-Update Dynamic Attribute Of Asset Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'configuration_updatedynamic'),
(15,	'SATS-Asset List Location Wise-M',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'api-assets_list_location_wise'),
(50,	'SATS-W-Add Fixed Attribute Of Site Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'configuration_fixedadd_atr'),
(51,	'SATS-W-Update Fixed Attribute Of Site Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'configuration_fixedupdate_atr'),
(53,	'SATS-W-Update Dynamic Attribute Of Site Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'configuration_dynamicupdate_atr'),
(54,	'Module Management',	'Module Management',	7,	NULL,	NULL,	't',	'module'),
(55,	'Role Management',	'Role Management',	7,	NULL,	NULL,	't',	'roleManagement'),
(56,	'User Management',	'User Management',	7,	NULL,	NULL,	't',	'userManagement'),
(57,	'User Role Mapping',	'User Role Mapping',	7,	NULL,	NULL,	't',	'userRoleMapp'),
(58,	'SATS-W-Technician To Site Mapping',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'location_user_mapping'),
(59,	'SATS-W-Add Asset/STN/SRN',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'addasset_srn_stn'),
(60,	'SATS-W-Assigning Technician to Supervisor',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'supervisor_technician_mapping'),
(61,	'SATS-W-Remove Technician ',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'technician_delete'),
(37,	'SATS-W-Add Asset Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'congiguration_assettype'),
(62,	'SATS-M-Change Password',	'SATS',	1,	NULL,	NULL,	't',	'api-changepassword'),
(28,	'SATS-W-Pending Approval',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'pendingApproval'),
(32,	'SATS-W-Configuration Management',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'Configuration_management'),
(48,	'SATS-W-Add Site',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'location_add_site'),
(31,	'SATS-W-Site Asset View',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'location_view'),
(30,	'SATS-W-Technician To Site Tagging',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'Technician_site_Worklist_view'),
(47,	'SATS-W-Update Site Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'congiguration_update_site'),
(22,	'SATS-M-Task List By Location',	'Mysites details',	1,	'2023-10-17 18:27:32',	'2023-10-17 18:27:32',	't',	'api-get_task_list_by_location'),
(2,	'SATS-W-Edit Asset Type',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'congiguration_asset_update'),
(24,	'SATS-STN-M',	'this is a test function',	1,	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	't',	'api-update_stn');

DROP TABLE IF EXISTS "logs";
DROP SEQUENCE IF EXISTS logs_id_seq;
CREATE SEQUENCE logs_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."logs" (
    "id" bigint DEFAULT nextval('logs_id_seq') NOT NULL,
    "user_id" bigint,
    "model" character varying(150),
    "action" character varying(7),
    "message" text,
    "models" json,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    CONSTRAINT "logs_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "migrations";
DROP SEQUENCE IF EXISTS migrations_id_seq;
CREATE SEQUENCE migrations_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."migrations" (
    "id" integer DEFAULT nextval('migrations_id_seq') NOT NULL,
    "migration" character varying(255) NOT NULL,
    "batch" integer NOT NULL,
    CONSTRAINT "migrations_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "modules";
DROP SEQUENCE IF EXISTS modules_id_seq;
CREATE SEQUENCE modules_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."modules" (
    "id" bigint DEFAULT nextval('modules_id_seq') NOT NULL,
    "module_name" character varying(255) NOT NULL,
    "module_description" character varying(255) NOT NULL,
    "module_icon" character varying(255),
    "status" boolean NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "url" character varying(255),
    "role_id" integer,
    "dashBoardCheck" boolean,
    CONSTRAINT "modules_module_name_unique" UNIQUE ("module_name"),
    CONSTRAINT "modules_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "oauth_access_tokens";
CREATE TABLE "public"."oauth_access_tokens" (
    "id" character varying(100) NOT NULL,
    "user_id" bigint,
    "client_id" uuid NOT NULL,
    "name" character varying(255),
    "scopes" text,
    "revoked" boolean NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "expires_at" timestamp(0),
    CONSTRAINT "oauth_access_tokens_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_access_tokens_user_id_index" ON "public"."oauth_access_tokens" USING btree ("user_id");


DROP TABLE IF EXISTS "oauth_auth_codes";
CREATE TABLE "public"."oauth_auth_codes" (
    "id" character varying(100) NOT NULL,
    "user_id" bigint NOT NULL,
    "client_id" uuid NOT NULL,
    "scopes" text,
    "revoked" boolean NOT NULL,
    "expires_at" timestamp(0),
    CONSTRAINT "oauth_auth_codes_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_auth_codes_user_id_index" ON "public"."oauth_auth_codes" USING btree ("user_id");


DROP TABLE IF EXISTS "oauth_clients";
CREATE TABLE "public"."oauth_clients" (
    "id" uuid NOT NULL,
    "user_id" bigint,
    "name" character varying(255) NOT NULL,
    "secret" character varying(100),
    "provider" character varying(255),
    "redirect" text NOT NULL,
    "personal_access_client" boolean NOT NULL,
    "password_client" boolean NOT NULL,
    "revoked" boolean NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "oauth_clients_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_clients_user_id_index" ON "public"."oauth_clients" USING btree ("user_id");

INSERT INTO "oauth_clients" ("id", "user_id", "name", "secret", "provider", "redirect", "personal_access_client", "password_client", "revoked", "created_at", "updated_at") VALUES
('9a0001d2-d7a6-41e5-ab1a-23cb48f8234b',	NULL,	'Laravel Personal Access Client',	'IgJu2tvrOUhMgc5urO2f48C7wP2LAeYWeNd3ckIg',	NULL,	'http://localhost',	't',	'f',	'f',	'2023-08-28 18:43:32',	'2023-08-28 18:43:32'),
('9a0001d2-e794-491d-97ac-412dbef72efd',	NULL,	'Laravel Password Grant Client',	't2NMxuNKjt6tPZfB6HriqiWed5B3cdL3rGQGdAX4',	'users',	'http://localhost',	'f',	't',	'f',	'2023-08-28 18:43:32',	'2023-08-28 18:43:32');

DROP TABLE IF EXISTS "oauth_personal_access_clients";
DROP SEQUENCE IF EXISTS oauth_personal_access_clients_id_seq;
CREATE SEQUENCE oauth_personal_access_clients_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."oauth_personal_access_clients" (
    "id" bigint DEFAULT nextval('oauth_personal_access_clients_id_seq') NOT NULL,
    "client_id" uuid NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "oauth_personal_access_clients_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "oauth_personal_access_clients" ("id", "client_id", "created_at", "updated_at") VALUES
(1,	'9a0001d2-d7a6-41e5-ab1a-23cb48f8234b',	'2023-08-28 18:43:32',	'2023-08-28 18:43:32');

DROP TABLE IF EXISTS "oauth_refresh_tokens";
CREATE TABLE "public"."oauth_refresh_tokens" (
    "id" character varying(100) NOT NULL,
    "access_token_id" character varying(100) NOT NULL,
    "revoked" boolean NOT NULL,
    "expires_at" timestamp(0),
    CONSTRAINT "oauth_refresh_tokens_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_refresh_tokens_access_token_id_index" ON "public"."oauth_refresh_tokens" USING btree ("access_token_id");


DROP TABLE IF EXISTS "password_policy";
DROP SEQUENCE IF EXISTS password_policy_id_seq;
CREATE SEQUENCE password_policy_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."password_policy" (
    "id" bigint DEFAULT nextval('password_policy_id_seq') NOT NULL,
    "policy_Name" character varying(255) NOT NULL,
    "policy_Value" integer,
    "policy_status" boolean NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "password_policy_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "password_policy" ("id", "policy_Name", "policy_Value", "policy_status", "created_at", "updated_at") VALUES
(2,	'Max Length of Password',	32,	't',	'2023-11-21 00:19:50',	'2024-01-06 05:15:02'),
(6,	'Min Number of Special characters',	1,	't',	'2023-11-21 00:19:50',	'2024-01-06 05:15:49'),
(4,	'Min Number of uppercase alphabet',	1,	't',	'2023-11-21 00:19:50',	'2024-03-28 06:46:59'),
(3,	'Min Number of lowercase alphabet',	1,	't',	'2023-11-21 00:19:50',	'2024-04-30 11:10:41'),
(1,	'Min length of Password',	9,	't',	'2023-11-21 00:19:50',	'2024-05-13 12:35:26'),
(5,	'Min Number of digits',	1,	't',	'2023-11-21 00:19:50',	'2024-05-13 12:35:29');

DROP TABLE IF EXISTS "password_reset_tokens";
CREATE TABLE "public"."password_reset_tokens" (
    "email" character varying(255) NOT NULL,
    "token" character varying(255) NOT NULL,
    "created_at" timestamp(0),
    CONSTRAINT "password_reset_tokens_pkey" PRIMARY KEY ("email")
) WITH (oids = false);



DROP TABLE IF EXISTS "password_resets";
CREATE TABLE "public"."password_resets" (
    "email" character varying(255) NOT NULL,
    "token" character varying(255) NOT NULL,
    "created_at" timestamp(0)
) WITH (oids = false);

CREATE INDEX "password_resets_email_index" ON "public"."password_resets" USING btree ("email");


DROP TABLE IF EXISTS "personal_access_tokens";
DROP SEQUENCE IF EXISTS personal_access_tokens_id_seq;
CREATE SEQUENCE personal_access_tokens_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."personal_access_tokens" (
    "id" bigint DEFAULT nextval('personal_access_tokens_id_seq') NOT NULL,
    "tokenable_type" character varying(255) NOT NULL,
    "tokenable_id" bigint NOT NULL,
    "name" character varying(255) NOT NULL,
    "token" character varying(64) NOT NULL,
    "abilities" text,
    "last_used_at" timestamp(0),
    "expires_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "personal_access_tokens_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "personal_access_tokens_token_unique" UNIQUE ("token")
) WITH (oids = false);

CREATE INDEX "personal_access_tokens_tokenable_type_tokenable_id_index" ON "public"."personal_access_tokens" USING btree ("tokenable_type", "tokenable_id");


DROP TABLE IF EXISTS "role_module_function_mapper";
DROP SEQUENCE IF EXISTS role_module_function_mapper_id_seq;
CREATE SEQUENCE role_module_function_mapper_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."role_module_function_mapper" (
    "id" bigint DEFAULT nextval('role_module_function_mapper_id_seq') NOT NULL,
    "role_id" integer NOT NULL,
    "role_name" character varying(255) NOT NULL,
    "module_id" integer NOT NULL,
    "function_id" integer NOT NULL,
    "status" boolean NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "role_module_function_mapper_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

DROP TABLE IF EXISTS "role_user_mapper";
DROP SEQUENCE IF EXISTS role_user_mapper_id_seq;
CREATE SEQUENCE role_user_mapper_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."role_user_mapper" (
    "id" bigint DEFAULT nextval('role_user_mapper_id_seq') NOT NULL,
    "role_id" integer NOT NULL,
    "user_id" integer NOT NULL,
    "user_name" character varying(255) NOT NULL,
    "user_role_mapper_status" boolean NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "role_user_mapper_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "roles";
DROP SEQUENCE IF EXISTS roles_id_seq;
CREATE SEQUENCE roles_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."roles" (
    "id" bigint DEFAULT nextval('roles_id_seq') NOT NULL,
    "role_name" character varying(255) NOT NULL,
    "role_description" character varying(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "roles_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "roles_role_name" UNIQUE ("role_name")
) WITH (oids = false);

INSERT INTO "roles" ("id", "role_name", "role_description", "created_at", "updated_at") VALUES
(2,	'Technician',	'Technician',	'2023-09-25 20:15:03',	'2023-10-25 12:08:54'),
(3,	'Supervisor',	'Supervisor',	'2023-09-25 20:15:03',	'2023-09-25 20:15:03'),
(4,	'Super User',	'Super User manages Admin users',	'2023-10-31 14:24:00',	'2023-10-31 14:24:00'),
(5,	'Business Devlopment manager',	'Business Development',	'2024-03-06 15:29:30',	'2024-03-06 15:29:30'),
(1,	'Administrator',	'Administrator Use',	'2023-09-25 20:15:03',	'2024-05-07 14:37:10');

DROP TABLE IF EXISTS "users";
DROP SEQUENCE IF EXISTS users_id_seq;
CREATE SEQUENCE users_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "public"."users" (
    "id" bigint DEFAULT nextval('users_id_seq') NOT NULL,
    "name" character varying(255) NOT NULL,
    "email" character varying(255) NOT NULL,
    "email_verified_at" timestamp(0),
    "password" character varying(255),
    "remember_token" character varying(100),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "is_supervisor" boolean DEFAULT false NOT NULL,
    "mobile_number" character varying,
    "user_address" character varying(255),
    "gender" character varying(255),
    "status" character varying(255),
    "otp" character varying,
    "is_admin" boolean DEFAULT false NOT NULL,
    CONSTRAINT "users_email_unique" UNIQUE ("email"),
    CONSTRAINT "users_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "users" ("id", "name", "email", "email_verified_at", "password", "remember_token", "created_at", "updated_at", "is_supervisor", "mobile_number", "user_address", "gender", "status", "otp", "is_admin") VALUES
(1,	'Administrator',	'satsa616@gmail.com',	NULL,	'$2y$10$Y9o0r4vGNmSXX29t.hrih.jp8viO/e3h27I1wG0/Gb8Xo3V4SI552',	NULL,	'2023-10-19 19:33:58',	'2024-04-29 11:27:51',	'f',	'1234567890',	NULL,	'male',	'active',	NULL,	't');
