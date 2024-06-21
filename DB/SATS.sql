-- SATS dump

DROP TABLE IF EXISTS "mail_log";
DROP SEQUENCE IF EXISTS mail_log_id_seq;
CREATE SEQUENCE mail_log_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "ats"."mail_log" (
    "id" bigint DEFAULT nextval('mail_log_id_seq') NOT NULL,
    "subject" character varying(500),
    "mail_body" text,
    "mail_to" character varying(300) NOT NULL,
    "mail_type" character varying(250) NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    "is_sent" boolean DEFAULT false,
    CONSTRAINT "mail_log_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "site_media";
DROP SEQUENCE IF EXISTS site_media_id_seq;
CREATE SEQUENCE site_media_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "ats"."site_media" (
    "id" bigint DEFAULT nextval('site_media_id_seq') NOT NULL,
    "site_id" bigint NOT NULL,
    "media_type" character varying(10) DEFAULT 'Video' NOT NULL,
    "thumb_image" text,
    "file_url" text,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    CONSTRAINT "site_media_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_asset";
DROP SEQUENCE IF EXISTS t_asset_ta_asset_id_seq;
CREATE SEQUENCE t_asset_ta_asset_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_asset" (
    "ta_asset_id" integer DEFAULT nextval('t_asset_ta_asset_id_seq') NOT NULL,
    "ta_asset_type_master_id" integer,
    "ta_asset_type_code" character varying,
    "ta_asset_manufacture_serial_no" character varying,
    "ta_asset_name" character varying,
    "ta_asset_description" character varying,
    "ta_asset_tag_number" character varying,
    "ta_asset_catagory" character varying,
    "ta_creation_date" timestamp,
    "ta_created_by" character varying,
    "ta_effective_start_date" timestamp,
    "ta_last_updated_date" timestamp,
    "ta_last_updated_by" character varying,
    "ta_effective_end_date" timestamp,
    "ta_asset_last_tag_scan_date" timestamp,
    "ta_asset_reason" character varying,
    "ta_asset_image" character varying,
    "ta_asset_active_inactive_status" character varying DEFAULT 'Active',
    "ta_last_audit_date" timestamp,
    "is_shown" boolean DEFAULT true,
    "ta_asset_parent_id" integer DEFAULT '0',
    "operator_id" integer,
    "asset_image_lat" character varying,
    "asset_image_long" character varying,
    "ta_asset_location_id" integer,
    "pm_project_id" character varying(250),
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    CONSTRAINT "t_asset_pkey" PRIMARY KEY ("ta_asset_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_asset_attribute";
DROP SEQUENCE IF EXISTS t_asset_attribute_at_asset_attribute_id_seq;
CREATE SEQUENCE t_asset_attribute_at_asset_attribute_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_asset_attribute" (
    "at_asset_attribute_id" integer DEFAULT nextval('t_asset_attribute_at_asset_attribute_id_seq') NOT NULL,
    "at_asset_type_attribute_master_id" integer,
    "at_asset_id" integer,
    "at_asset_attribute_code" character varying,
    "at_asset_attribute_description" character varying,
    "at_creation_date" timestamp,
    "at_created_by" character varying,
    "at_effective_start_date" timestamp,
    "at_last_updated_date" timestamp,
    "at_last_updated_by" character varying,
    "at_effective_end_date" timestamp,
    "at_asset_attribute_value_text" character varying,
    "at_asset_attribute_name" character varying,
    CONSTRAINT "t_asset_attribute_pkey" PRIMARY KEY ("at_asset_attribute_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_asset_audit";
DROP SEQUENCE IF EXISTS t_asset_audit_aa_audit_id_seq;
CREATE SEQUENCE t_asset_audit_aa_audit_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_asset_audit" (
    "aa_audit_id" integer DEFAULT nextval('t_asset_audit_aa_audit_id_seq') NOT NULL,
    "aa_location_id" integer NOT NULL,
    "aa_created_date" timestamp,
    "aa_created_by" character varying,
    "aa_effective_start_date" timestamp,
    "aa_technician_id" integer NOT NULL,
    "aa_last_updated_date" timestamp,
    "aa_last_updated_by" character varying,
    "aa_effective_end_date" timestamp,
    "aa_approve_reject" character varying,
    "aa_approve_reject_remarks" character varying,
    "aa_approved_rejected_by" character varying,
    CONSTRAINT "t_asset_audit_pkey" PRIMARY KEY ("aa_audit_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_asset_audit_details";
DROP SEQUENCE IF EXISTS t_asset_audit_details_ad_asset_audit_details_id_seq;
CREATE SEQUENCE t_asset_audit_details_ad_asset_audit_details_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_asset_audit_details" (
    "ad_asset_audit_details_id" integer DEFAULT nextval('t_asset_audit_details_ad_asset_audit_details_id_seq') NOT NULL,
    "ad_audit_id" integer NOT NULL,
    "ad_asset_id" integer NOT NULL,
    "ad_asset_tag_number" character varying,
    "ad_scan_date" timestamp,
    "ad_status" character varying,
    "ad_remarks" character varying,
    "ad_missing_status" character varying,
    CONSTRAINT "t_asset_audit_details_pkey" PRIMARY KEY ("ad_asset_audit_details_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_asset_dump";
DROP SEQUENCE IF EXISTS t_asset_dump_tad_asset_id_seq;
CREATE SEQUENCE t_asset_dump_tad_asset_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_asset_dump" (
    "id" integer DEFAULT nextval('t_asset_dump_tad_asset_id_seq') NOT NULL,
    "tad_asset_manufacture_serial_no" character varying NOT NULL,
    "tad_location_id" integer NOT NULL,
    "tad_creation_date" timestamp NOT NULL,
    "tad_created_by" character varying NOT NULL,
    "tad_asset_active_inactive_status" character varying NOT NULL,
    "tad_validation_status" character varying,
    "tad_approve_reject" character varying,
    "tad_approve_reject_remarks" character varying,
    "tad_approved_rejected_by" character varying,
    "tad_effective_end_date" timestamp,
    "tad_asset_id" integer,
    "tad_transactional_direction" character varying,
    "tad_asset_name" character varying NOT NULL,
    "tad_asset_type_status" character varying NOT NULL,
    "tad_asset_type_code" character varying NOT NULL,
    CONSTRAINT "t_asset_dump_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_asset_edit";
DROP SEQUENCE IF EXISTS t_asset_edit_id_seq;
CREATE SEQUENCE t_asset_edit_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_asset_edit" (
    "id" integer DEFAULT nextval('t_asset_edit_id_seq') NOT NULL,
    "ta_asset_type_master_id" integer,
    "ta_asset_type_code" character varying,
    "ta_asset_manufacture_serial_no" character varying,
    "ta_asset_name" character varying,
    "ta_asset_description" character varying,
    "ta_asset_tag_number" character varying,
    "ta_asset_catagory" character varying,
    "ta_creation_date" timestamp,
    "ta_created_by" character varying,
    "ta_effective_start_date" timestamp,
    "ta_last_updated_date" timestamp,
    "ta_last_updated_by" character varying,
    "ta_effective_end_date" timestamp,
    "ta_asset_last_tag_scan_date" timestamp,
    "ta_asset_reason" character varying,
    "ta_asset_image" character varying,
    "ta_asset_active_inactive_status" character varying,
    "ta_last_audit_date" timestamp,
    "is_shown" boolean DEFAULT true,
    "ta_asset_parent_id" integer,
    "operator_id" integer,
    "asset_image_lat" character varying,
    "asset_image_long" character varying,
    "ta_asset_location_id" integer,
    "pm_project_id" character varying(250),
    "ta_asset_id" integer,
    CONSTRAINT "t_asset_edit_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_asset_edit_attribute";
DROP SEQUENCE IF EXISTS t_asset_attribute_at_asset_edit_attribute_id_seq;
CREATE SEQUENCE t_asset_attribute_at_asset_edit_attribute_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_asset_edit_attribute" (
    "id" bigint DEFAULT nextval('t_asset_attribute_at_asset_edit_attribute_id_seq') NOT NULL,
    "at_asset_type_attribute_master_id" integer,
    "at_asset_id" integer,
    "at_asset_attribute_code" character varying,
    "at_asset_attribute_description" character varying,
    "at_creation_date" timestamp,
    "at_created_by" character varying,
    "at_effective_start_date" timestamp,
    "at_last_updated_date" timestamp,
    "at_last_updated_by" character varying,
    "at_effective_end_date" timestamp,
    "at_asset_attribute_value_text" character varying,
    "at_asset_attribute_name" character varying,
    "at_asset_edit_id" bigint,
    CONSTRAINT "t_asset_edit_attribute_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_asset_history";
DROP SEQUENCE IF EXISTS t_asset_history_id_seq;
CREATE SEQUENCE t_asset_history_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_asset_history" (
    "id" integer DEFAULT nextval('t_asset_history_id_seq') NOT NULL,
    "location_id" integer,
    "asset_id" integer NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    "moveout_date" timestamp,
    "movein_date" timestamp,
    "reason" text,
    "status" integer DEFAULT '1' NOT NULL,
    "asset_data" json,
    "deployment_date" timestamp,
    "usage" character varying,
    "last_pm_date" timestamp,
    "next_pm_date" timestamp,
    CONSTRAINT "t_asset_history_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_ats_to_far";
CREATE TABLE "ats"."t_ats_to_far" (
    "a2f_id" integer NOT NULL,
    "a2f_sync_date" timestamp,
    "a2f_file_name" character varying,
    "a2f_asset_type" character varying,
    "a2f_asset_name" character varying,
    "a2f_manufacture_serial_no" character varying,
    "a2f_description" character varying,
    "a2f_site_id" integer,
    "a2f_site_type" character varying,
    "a2f_site_name" character varying,
    "a2f_address" character varying,
    "a2f_status" character varying,
    "a2f_reason" character varying,
    "a2f_image" character varying,
    "a2f_asset_attribute" character varying,
    "a2f_creation_date" timestamp,
    "a2f_created_by" character varying,
    "a2f_last_updated_date" timestamp,
    "a2f_last_updated_by" character varying,
    "a2f_end_date" timestamp,
    "proj_id" character varying(250),
    CONSTRAINT "t_ats_to_far_pkey" PRIMARY KEY ("a2f_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_audit_insert";
DROP SEQUENCE IF EXISTS t_audit_insert_ai_id_seq;
CREATE SEQUENCE t_audit_insert_ai_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "ats"."t_audit_insert" (
    "ai_id" bigint DEFAULT nextval('t_audit_insert_ai_id_seq') NOT NULL,
    "ai_location_id" integer NOT NULL,
    "ai_location_code" character varying NOT NULL,
    "ai_created_by" character varying NOT NULL,
    "ai_creation_date" timestamp NOT NULL,
    "ai_last_updated_date" timestamp NOT NULL,
    "ai_assigned_user_id" integer NOT NULL,
    "ai_assigned_user_name" character varying NOT NULL,
    "ai_effective_end_date" timestamp,
    "ai_completion_date" timestamp,
    "ai_validation_status" character varying NOT NULL,
    "ai_remarks" character varying,
    "ai_assigned_user_email" character varying NOT NULL,
    CONSTRAINT "t_audit_insert_pkey" PRIMARY KEY ("ai_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_audit_trail";
DROP SEQUENCE IF EXISTS t_audit_trail_at_event_id_seq;
CREATE SEQUENCE t_audit_trail_at_event_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_audit_trail" (
    "at_user_id" integer NOT NULL,
    "at_module_id" integer NOT NULL,
    "at_event_id" integer DEFAULT nextval('t_audit_trail_at_event_id_seq') NOT NULL,
    "at_event_name" character varying NOT NULL,
    "at_modified_date" timestamp NOT NULL,
    "at_reason_code" character varying NOT NULL,
    "at_sub_reason_code" character varying NOT NULL,
    "at_name_value_pair" character varying NOT NULL,
    "at_creation_date" timestamp NOT NULL,
    "at_created_by" character varying NOT NULL,
    "at_last_updated_date" timestamp NOT NULL,
    "at_last_updated_by" character varying NOT NULL,
    "at_effective_start_date" timestamp NOT NULL,
    "at_effective_end_date" timestamp,
    CONSTRAINT "t_audit_trail_pkey" PRIMARY KEY ("at_event_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_far_sync_log";
DROP SEQUENCE IF EXISTS t_far_sync_log_fsl_sync_log_id_seq;
CREATE SEQUENCE t_far_sync_log_fsl_sync_log_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_far_sync_log" (
    "fsl_sync_log_id" integer DEFAULT nextval('t_far_sync_log_fsl_sync_log_id_seq') NOT NULL,
    "fsl_sync_date" timestamp NOT NULL,
    "fsl_file_name" character varying NOT NULL,
    "fsl_asset_type_code" integer NOT NULL,
    "fsl_manufacture_serial_no" character varying NOT NULL,
    "fsl_asset_name" character varying NOT NULL,
    "fsl_description" character varying,
    "fsl_loaction_id" integer NOT NULL,
    "fsl_loaction_type" character varying NOT NULL,
    "fsl_location_name" character varying NOT NULL,
    "fsl_address" character varying NOT NULL,
    "fsl_status" character varying NOT NULL,
    "fsl_reason" character varying NOT NULL,
    "fsl_image" bytea NOT NULL,
    "fsl_asset_attributes" jsonb NOT NULL,
    "fsl_creation_date" timestamp NOT NULL,
    "fsl_created_by" character varying NOT NULL,
    "fsl_effective_start_date" timestamp NOT NULL,
    "fsl_last_updated_date" timestamp NOT NULL,
    "fsl_last_updated_by" character varying NOT NULL,
    "fsl_effective_end_date" timestamp,
    CONSTRAINT "far_sync_log_pkey" PRIMARY KEY ("fsl_sync_log_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_far_to_ats";
DROP SEQUENCE IF EXISTS t_far_to_ats_id_seq;
CREATE SEQUENCE t_far_to_ats_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_far_to_ats" (
    "f2a_sync_date" timestamp,
    "f2a_file_name" character varying,
    "f2a_asset_type" character varying,
    "f2a_asset_name" character varying,
    "f2a_manufacture_serial_no" character varying,
    "f2a_description" character varying,
    "f2a_site_id" integer DEFAULT '0',
    "f2a_site_type" character varying,
    "f2a_site_name" character varying,
    "f2a_address" character varying,
    "f2a_status" character varying,
    "f2a_reason" character varying,
    "f2a_image" character varying,
    "f2a_asset_attribute" character varying,
    "f2a_creation_date" timestamp,
    "f2a_created_by" character varying,
    "f2a_last_updated_date" timestamp,
    "f2a_last_updated_by" character varying,
    "f2a_end_date" timestamp,
    "f2a_type" character varying,
    "f2a_site_code" character varying,
    "id" integer DEFAULT nextval('t_far_to_ats_id_seq') NOT NULL,
    "f2a_Parent_id" integer DEFAULT '0',
    "f2a_operator_id" integer DEFAULT '0',
    "f2a_category" character varying,
    "f2a_comment" character varying,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    "proj_id" character varying,
    CONSTRAINT "t_far_to_ats_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_file_upload";
DROP SEQUENCE IF EXISTS t_file_upload_id_seq;
CREATE SEQUENCE t_file_upload_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_file_upload" (
    "id" integer DEFAULT nextval('t_file_upload_id_seq') NOT NULL,
    "file_name" character varying,
    "created_at" character varying,
    "file_name_output" character varying,
    "updated_at" character varying,
    CONSTRAINT "t_file_upload_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_location";
DROP SEQUENCE IF EXISTS t_location_tl_location_id_seq;
CREATE SEQUENCE t_location_tl_location_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_location" (
    "tl_location_id" integer DEFAULT nextval('t_location_tl_location_id_seq') NOT NULL,
    "tl_location_type_master_id" integer NOT NULL,
    "tl_location_type" character varying NOT NULL,
    "tl_location_code" character varying NOT NULL,
    "tl_location_address" character varying,
    "tl_location_description" character varying,
    "tl_location_status" character varying,
    "tl_location_region" character varying,
    "tl_location_latitude" character varying,
    "tl_location_longitude" character varying,
    "tl_creation_date" timestamp,
    "tl_created_by" character varying,
    "tl_effective_start_date" timestamp,
    "tl_last_updated_date" timestamp,
    "tl_last_updated_by" character varying,
    "tl_effective_end_date" timestamp,
    "tl_location_name" character varying,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    "tagging_status" smallint,
    "last_audit_date" timestamp,
    CONSTRAINT "t_location_pkey" PRIMARY KEY ("tl_location_id"),
    CONSTRAINT "t_location_ukey" UNIQUE ("tl_location_code")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_location_attribute";
DROP SEQUENCE IF EXISTS t_location_attribute_tla_location_attribute_id_seq;
CREATE SEQUENCE t_location_attribute_tla_location_attribute_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_location_attribute" (
    "tla_location_attribute_id" integer DEFAULT nextval('t_location_attribute_tla_location_attribute_id_seq') NOT NULL,
    "tla_location_attribute_master_id" integer NOT NULL,
    "tla_location_id" integer NOT NULL,
    "tla_location_attribute_name" character varying NOT NULL,
    "tla_location_attribute_description" character varying,
    "tla_creation_date" timestamp,
    "tla_created_by" character varying,
    "tla_effective_start_date" timestamp,
    "tla_last_updated_date" timestamp,
    "tla_last_updated_by" character varying,
    "tla_effective_end_date" timestamp,
    "tla_location_attribute_value_text" character varying,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    CONSTRAINT "t_location_attribute_pkey" PRIMARY KEY ("tla_location_attribute_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_location_operators";
DROP SEQUENCE IF EXISTS t_location_operators_id_seq;
CREATE SEQUENCE t_location_operators_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "ats"."t_location_operators" (
    "id" bigint DEFAULT nextval('t_location_operators_id_seq') NOT NULL,
    "location_id" bigint NOT NULL,
    "operator_id" bigint NOT NULL,
    "created_at" timestamp NOT NULL,
    "updated_at" timestamp NOT NULL,
    "deleted_at" timestamp NOT NULL,
    CONSTRAINT "t_location_operators_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_otp_table";
DROP SEQUENCE IF EXISTS otp_table_id_seq;
CREATE SEQUENCE otp_table_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_otp_table" (
    "ot_id" integer DEFAULT nextval('otp_table_id_seq') NOT NULL,
    "ot_user_id" integer NOT NULL,
    "ot_otp" integer NOT NULL,
    "ot_status" integer NOT NULL,
    "ot_effective_start_date_time" timestamp NOT NULL,
    "ot_effective_end_date_time" timestamp,
    CONSTRAINT "otp_table_pkey" PRIMARY KEY ("ot_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_pm_approval";
DROP SEQUENCE IF EXISTS t_pm_approval_id_seq;
CREATE SEQUENCE t_pm_approval_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_pm_approval" (
    "tpm_asset_id" integer NOT NULL,
    "tpm_asset_type_master_id" integer,
    "tpm_asset_type_code" character varying,
    "tpm_asset_manufacture_serial_no" character varying,
    "tpm_asset_name" character varying,
    "tpm_asset_description" character varying,
    "tpm_asset_tag_number" character varying,
    "tpm_asset_parent_id" integer,
    "tpm_asset_site_id" integer,
    "tpm_asset_status" character varying,
    "tpm_end_date" timestamp,
    "tpm_asset_last_tag_scan_date" timestamp,
    "tpm_remarks" character varying,
    "tpm_supervisor_id" integer,
    "tpm_technician_id" integer,
    "pm_project_id" character varying(250),
    "pm_task_id" integer,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    "id" integer DEFAULT nextval('t_pm_approval_id_seq') NOT NULL,
    "technician_name" character varying(255),
    "site_code" text,
    "task_title" character varying(255),
    "case_no" character varying(245),
    "approver_name" character varying(255),
    "asset_data" json,
    "output_file_generated" boolean DEFAULT false,
    "task_status" character varying(50),
    CONSTRAINT "t_pm_approval_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_srn_insert";
DROP SEQUENCE IF EXISTS t_srn_insert_id_seq;
CREATE SEQUENCE t_srn_insert_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_srn_insert" (
    "far_to_ats_id" character varying,
    "srn_asset_id" character varying,
    "srn_remarks" character varying,
    "srn_creation_date" timestamp,
    "srn_created_by" character varying,
    "srn_projectt_id" character varying,
    "srn_comment" character varying,
    "srn_image" text,
    "id" integer DEFAULT nextval('t_srn_insert_id_seq') NOT NULL,
    CONSTRAINT "t_srn_insert_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_stn_insert";
DROP SEQUENCE IF EXISTS t_stn_insert_id_seq;
CREATE SEQUENCE t_stn_insert_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_stn_insert" (
    "stn_asset_id" integer,
    "stn_remarks" character varying,
    "stn_creation_date" timestamp,
    "stn_created_by" character varying,
    "stn_projectt_id" character varying,
    "stn_comment" character varying,
    "stn_image" character varying,
    "far_to_ats_id" character varying,
    "id" integer DEFAULT nextval('t_stn_insert_id_seq') NOT NULL,
    CONSTRAINT "t_stn_insert_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_tagging_history";
DROP SEQUENCE IF EXISTS t_tagging_history_th_history_id_seq;
CREATE SEQUENCE t_tagging_history_th_history_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_tagging_history" (
    "id" integer DEFAULT nextval('t_tagging_history_th_history_id_seq') NOT NULL,
    "th_location_id" integer NOT NULL,
    "th_asset_id" integer NOT NULL,
    "th_asset_type" character varying,
    "th_asset_name" character varying,
    "th_asset_manufacture_serial_no" character varying,
    "th_asset_tag_number" character varying,
    "th_asset_tagged_by" character varying,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    CONSTRAINT "t_tagging_history_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_task_history";
DROP SEQUENCE IF EXISTS t_task_history_th_task_history_id_seq;
CREATE SEQUENCE t_task_history_th_task_history_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_task_history" (
    "th_task_history_id" integer DEFAULT nextval('t_task_history_th_task_history_id_seq') NOT NULL,
    "th_task_id" integer NOT NULL,
    "th_task_name" character varying NOT NULL,
    "th_location_id" integer NOT NULL,
    "th_location_name" character varying NOT NULL,
    "th_location_address" character varying NOT NULL,
    "th_source_id" integer NOT NULL,
    "th_asset_id" integer NOT NULL,
    "th_asset_type_code" character varying NOT NULL,
    "th_asset_name" character varying NOT NULL,
    "th_asset_manufacture_serial_no" character varying NOT NULL,
    "th_asset_tag_number" character varying NOT NULL,
    "th_creation_date" timestamp NOT NULL,
    "th_created_by" character varying NOT NULL,
    "th_effective_start_date" timestamp NOT NULL,
    "th_user_id" integer NOT NULL,
    "th_last_updated_date" timestamp NOT NULL,
    "th_last_updated_by" character varying NOT NULL,
    "th_effective_end_date" timestamp,
    "th_task_status" character varying NOT NULL,
    "th_approved_date" timestamp NOT NULL,
    "th_approved_by" character varying NOT NULL,
    "th_remarks" character varying,
    CONSTRAINT "t_task_history_pkey" PRIMARY KEY ("th_task_history_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_technician_supervisor_mappinng";
DROP SEQUENCE IF EXISTS t_technician_supervisor_mappinng_id_seq;
CREATE SEQUENCE t_technician_supervisor_mappinng_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1;

CREATE TABLE "ats"."t_technician_supervisor_mappinng" (
    "id" bigint DEFAULT nextval('t_technician_supervisor_mappinng_id_seq') NOT NULL,
    "technician_id" integer NOT NULL,
    "supervisor_id" integer NOT NULL,
    "pm_user_id" character varying NOT NULL,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    CONSTRAINT "t_technician_supervisor_mappinng_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_user_location";
DROP SEQUENCE IF EXISTS t_user_location_ul_user_location_id_seq;
CREATE SEQUENCE t_user_location_ul_user_location_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_user_location" (
    "ul_user_location_id" integer DEFAULT nextval('t_user_location_ul_user_location_id_seq') NOT NULL,
    "ul_location_id" integer,
    "ul_user_id" integer,
    "ul_user_role_id" integer,
    "ul_creation_date" timestamp,
    "ul_created_by" character varying,
    "ul_effective_start_date" timestamp,
    "ul_last_updated_date" timestamp,
    "ul_last_updated_by" character varying,
    "ul_effective_end_date" timestamp,
    "created_at" timestamp,
    "updated_at" timestamp,
    "deleted_at" timestamp,
    "status" character varying,
    "reason" character varying,
    CONSTRAINT "t_user_location_pkey" PRIMARY KEY ("ul_user_location_id")
) WITH (oids = false);


DROP TABLE IF EXISTS "t_user_task";
DROP SEQUENCE IF EXISTS t_user_task_ut_user_task_id_seq;
CREATE SEQUENCE t_user_task_ut_user_task_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "ats"."t_user_task" (
    "ut_user_task_id" integer DEFAULT nextval('t_user_task_ut_user_task_id_seq') NOT NULL,
    "ut_user_task_code" character varying NOT NULL,
    "ut_user_task_description" character varying NOT NULL,
    "ut_user_id" integer NOT NULL,
    "ut_asset_id" integer NOT NULL,
    "ut_asset_type_id" character varying NOT NULL,
    "ut_asset_type" character varying NOT NULL,
    "ut_user_role_id" integer NOT NULL,
    "ut_user_task_completion_date" timestamp,
    "ut_user_task_assigned_by" character varying NOT NULL,
    "ut_creation_date" timestamp NOT NULL,
    "ut_created_by" character varying NOT NULL,
    "ut_effective_start_date" timestamp NOT NULL,
    "ut_last_updated_date" timestamp NOT NULL,
    "ut_last_updated_by" character varying NOT NULL,
    "ut_effective_end_date" timestamp,
    "ut_location_id" integer NOT NULL,
    "ut_task_number" character varying NOT NULL,
    "ut_location_name" character varying NOT NULL,
    "ut_location_address" character varying NOT NULL,
    "ut_source_id" integer NOT NULL,
    "ut_asset_name" character varying NOT NULL,
    "ut_asset_manufacture_serial_no" character varying NOT NULL,
    "ut_asset_tag_number" character varying NOT NULL,
    "ut_task_status" character varying NOT NULL,
    "ut_remarks" character varying,
    CONSTRAINT "t_user_task_pkey" PRIMARY KEY ("ut_user_task_id")
) WITH (oids = false);


ALTER TABLE ONLY "ats"."t_asset_attribute" ADD CONSTRAINT "t_asset_attribute_at_asset_id_fkey" FOREIGN KEY (at_asset_id) REFERENCES t_asset(ta_asset_id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "ats"."t_asset_audit" ADD CONSTRAINT "t_asset_audit_aa_location_id_fkey" FOREIGN KEY (aa_location_id) REFERENCES t_location(tl_location_id) NOT DEFERRABLE;

ALTER TABLE ONLY "ats"."t_location_attribute" ADD CONSTRAINT "t_location_attribute_tla_location_id_fkey" FOREIGN KEY (tla_location_id) REFERENCES t_location(tl_location_id) NOT DEFERRABLE;

ALTER TABLE ONLY "ats"."t_tagging_history" ADD CONSTRAINT "t_tagging_history_th_asset_id_fkey" FOREIGN KEY (th_asset_id) REFERENCES t_asset(ta_asset_id) NOT DEFERRABLE;
ALTER TABLE ONLY "ats"."t_tagging_history" ADD CONSTRAINT "t_tagging_history_th_loaction_id_fkey" FOREIGN KEY (th_location_id) REFERENCES t_location(tl_location_id) NOT DEFERRABLE;

ALTER TABLE ONLY "ats"."t_task_history" ADD CONSTRAINT "t_task_history_th_asset_id_fkey" FOREIGN KEY (th_asset_id) REFERENCES t_asset(ta_asset_id) NOT DEFERRABLE;
ALTER TABLE ONLY "ats"."t_task_history" ADD CONSTRAINT "t_task_history_th_location_id_fkey" FOREIGN KEY (th_location_id) REFERENCES t_location(tl_location_id) NOT DEFERRABLE;
ALTER TABLE ONLY "ats"."t_task_history" ADD CONSTRAINT "t_task_history_th_task_id_fkey" FOREIGN KEY (th_task_id) REFERENCES t_user_task(ut_user_task_id) NOT DEFERRABLE;

ALTER TABLE ONLY "ats"."t_user_location" ADD CONSTRAINT "t_user_location_ul_location_id_fkey" FOREIGN KEY (ul_location_id) REFERENCES t_location(tl_location_id) ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "ats"."t_user_task" ADD CONSTRAINT "t_user_task_ut_asset_id_fkey" FOREIGN KEY (ut_asset_id) REFERENCES t_asset(ta_asset_id) NOT DEFERRABLE;
ALTER TABLE ONLY "ats"."t_user_task" ADD CONSTRAINT "t_user_task_ut_location_id_fkey" FOREIGN KEY (ut_location_id) REFERENCES t_location(tl_location_id) NOT DEFERRABLE;

-- 2024-06-21 12:01:29.618317+05:30
