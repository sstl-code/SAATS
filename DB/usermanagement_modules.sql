-- Adminer 4.8.1 PostgreSQL 15.3 dump

DROP TABLE IF EXISTS "modules";
DROP SEQUENCE IF EXISTS modules_id_seq;
CREATE SEQUENCE modules_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 7 CACHE 1;

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

INSERT INTO "modules" ("id", "module_name", "module_description", "module_icon", "status", "created_at", "updated_at", "url", "role_id", "dashBoardCheck") VALUES
(7,	'User Management System',	'User Management',	'/build/assets/img/usermanagement-icon.svg',	't',	NULL,	NULL,	'',	NULL,	NULL),
(3,	'OMS (Order Management System)',	'this is a test module',	'/build/assets/img/dash-card3.svg',	't',	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	NULL,	NULL,	't'),
(2,	'UCP (Unified Customer Portal)',	'this is a test module',	'/build/assets/img/dash-card-2.svg',	't',	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	NULL,	NULL,	't'),
(1,	'ATS (Asset Tagging and Tracking)',	'this is a test module',	'/build/assets/img/dash-card1-logo.svg',	't',	'2023-09-25 20:14:21',	'2023-09-25 20:14:21',	'https://ats.esquaressquaredev.com/authorize_user',	NULL,	't');

-- 2024-07-01 22:43:26.302529+05:30
