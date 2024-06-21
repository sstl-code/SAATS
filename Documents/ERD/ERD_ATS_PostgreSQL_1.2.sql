CREATE TABLE "t_far_to_ats" (
  "f2a_id" int,
  "f2a_sync_date" datetime,
  "f2a_file_name" varchar,
  "f2a_asset_type" varchar,
  "f2a_asset_name" varchar,
  "f2a_manufacture_serial_no" varchar,
  "f2a_description" varchar,
  "f2a_site_id" int,
  "f2a_site_type" varchar,
  "f2a_site_name" varchar,
  "f2a_address" varchar,
  "f2a_status" varchar,
  "f2a_reason" varchar,
  "f2a_image" varchar,
  "f2a_asset_attribute" varchar,
  "f2a_creation_date" datetime,
  "f2a_created_by" varchar,
  "f2a_last_updated_date" datetime,
  "f2a_last_updated_by" varchar,
  "f2a_end_date" datetime,
  PRIMARY KEY ("f2a_id")
);

CREATE TABLE "t_asset" (
  "ta_asset_id" int,
  "ta_asset_type_master_id" int,
  "ta_asset_type_code" varchar,
  "ta_asset_manufacture_serial_no" varchar,
  "ta_asset_name" varchar,
  "ta_asset_description" varchar,
  "ta_asset_tag_number" varchar,
  "ta_asset_parent_id" int,
  "ta_asset_site_id" int,
  "ta_asset_status" varchar,
  "ta_creation_date" datetime,
  "ta_created_by" varchar,
  "ta_last_updated_date" datetime,
  "ta_end_date" datetime,
  "ta_asset_last_tag_scan_date" datetime,
  PRIMARY KEY ("ta_asset_id")
);

CREATE TABLE "t_asset_attribute" (
  "at_asset_attribute_id" int,
  "at_asset_type_attribute_master_id" int,
  "at_asset_id" int,
  "at_asset_attribute_code" varchar,
  "at_asset_attribute_description" varchar,
  "at_creation_date" datetime,
  "at_created_by" varchar,
  "at_last_updated_date" datetime,
  "at_last_updated_by" varchar,
  "at_end_date" datetime,
  PRIMARY KEY ("at_asset_attribute_id")
);

CREATE TABLE "t_pm_approval" (
  "tpm_asset_id" int,
  "tpm_asset_type_master_id" int,
  "tpm_asset_type_code" varchar,
  "tpm_asset_manufacture_serial_no" varchar,
  "tpm_asset_name" varchar,
  "tpm_asset_description" varchar,
  "tpm_asset_tag_number" varchar,
  "tpm_asset_parent_id" int,
  "tpm_asset_site_id" int,
  "tpm_asset_status" varchar,
  "tpm_creation_date" datetime,
  "tpm_created_by" varchar,
  "tpm_last_updated_date" datetime,
  "tpm_end_date" datetime,
  "tpm_asset_last_tag_scan_date" datetime,
  "tpm_remarks" varchar,
  PRIMARY KEY ("tpm_asset_id")
);

CREATE TABLE "t_ats_to_far" (
  "a2f_id" int,
  "a2f_sync_date" datetime,
  "a2f_file_name" varchar,
  "a2f_asset_type" varchar,
  "a2f_asset_name" varchar,
  "a2f_manufacture_serial_no" varchar,
  "a2f_description" varchar,
  "a2f_site_id" int,
  "a2f_site_type" varchar,
  "a2f_site_name" varchar,
  "a2f_address" varchar,
  "a2f_status" varchar,
  "a2f_reason" varchar,
  "a2f_image" varchar,
  "a2f_asset_attribute" varchar,
  "a2f_creation_date" datetime,
  "a2f_created_by" varchar,
  "a2f_last_updated_date" datetime,
  "a2f_last_updated_by" varchar,
  "a2f_end_date" datetime,
  PRIMARY KEY ("a2f_id")
);

CREATE TABLE "t_site" (
  "ts_site_id" int,
  "ts_site_type_master_id" int,
  "ts_site_type" varchar,
  "ts_site_code" varchar,
  "ts_site_address" varchar,
  "ts_site_description" varchar,
  "ts_site_status" varchar,
  "ts_site_region" varchar,
  "ts_site_latitude" varchar,
  "ts_site_longitude" varchar,
  "ts_creation_date" datetime,
  "tS_created_by" varchar,
  "ts_last_updated_date" datetime,
  "ts_last_updated_by" varchar,
  "ts_end_date" datetime,
  PRIMARY KEY ("ts_site_id")
);

CREATE TABLE "t_site_attribute" (
  "tsa_site_attribute_id" int,
  "tsa_site_attribute_master_id" int,
  "tsa_site_id" int,
  "tsa_site_type" varchar,
  "tsa_site_attribute_name" varchar,
  "tsa_site_attribute_description" varchar,
  "tsa_creation_date" datetime,
  "tsa_created_by" varchar,
  "tsa_last_updated_date" datetime,
  "tsa_last_updated_by" varchar,
  "tsa_end_date" datetime,
  PRIMARY KEY ("tsa_site_attribute_id")
);

CREATE TABLE "t_user_task" (
  "ut_user_task_id" int,
  "ut_task_name" varchar,
  "ut_site_id" int,
  "ut_site_name" varchar,
  "ut_site_address" varchar,
  "ut_user_task_code" varchar,
  "ut_user_task_description" varchar,
  "ut_user_id" int,
  "ut_asset_id" int,
  "ut_asset_name" varchar,
  "ut_manufactur_serial_no" varchar,
  "ut_asset_tag" varchar,
  "ut_asset_type_id" varchar,
  "ut_asset_type" varchar,
  "ut_user_role_id" int,
  "ut_assigned_date" datetime,
  "ut_initiation_date" datetime,
  "ut_status" varchar,
  "ut_approved_by" varchar,
  "ut_approved_date" datetime,
  "ut_user_task_completion_date" datetime,
  "ut_user_task_assigned_by" varchar,
  "ut_remarks" varchar,
  "ut_creation_date" datetime,
  "ut_created_by" varchar,
  "ut_last_updated_date" datetime,
  "ut_last_updated_by" varchar,
  "ut_end_date" datetime,
  PRIMARY KEY ("ut_user_task_id")
);

CREATE TABLE "t_user_site" (
  "us_user_site_id" int,
  "us_site_id" int,
  "us_user_id" int,
  "us_user_role_id" int,
  "us_creation_date" datetime,
  "us_created_by" varchar,
  "us_last_updated_date" datetime,
  "us_last_updated_by" varchar,
  "us_end_date" datetime,
  PRIMARY KEY ("ul_user_site_id")
);

CREATE TABLE "t_tagging_history" (
  "th_history_id" int,
  "th_site_id" int,
  "th_asset_id" int,
  "th_asset_type" varchar,
  "th_asset_name" varchar,
  "th_manufacture_serial_no" varchar,
  "th_asset_tag" varchar,
  "th_tagging_date" datetime,
  "th_tagged_by" varchar,
  "th_creation_date" datetime,
  "th_created_by" varchar,
  "th_last_updated_date" datetime,
  "th_last_updated_by" varchar,
  "th_end_date" datetime,
  PRIMARY KEY ("th_history_id")
);

CREATE TABLE "t_Stn" (
  "tst_stn_id" int,
  "tst_site_id" int,
  "tst_site_name" varchar,
  "tst_site_address" varchar,
  "tst_asset_type" varchar,
  "tst_asset_name" varchar,
  "tst_manufacture_serial_no" varchar,
  "tst_status" varchar,
  "tst_user_task_id" int,
  "tst_asset_id" int,
  "tst_asset_tag" varchar,
  "tst_remarks" varchar,
  "tst_creation_date" datetime,
  "tst_created_by" varchar,
  "tst_last_updated_date" datetime,
  "tst_last_updated_by" varchar,
  "tst_end_date" datetime,
  PRIMARY KEY ("tst_stn_id")
);

CREATE TABLE "t_srn" (
  "tsr_id" int,
  "tsr_user_task_id" int,
  "tsr_site_id" int,
  "tsr_site_name" varchar,
  "tsr_file_name" varchar,
  "tsr_site_address" varchar,
  "tsr_asset_type" varchar,
  "tsr_asset_name" varchar,
  "tsr_manufacture_serial_no" varchar,
  "tsr_status" varchar,
  "tsr_asset_id" int,
  "tsr_asset_tag" varchar,
  "tsr_remarks" varchar,
  "tsr_creation_date" datetime,
  "tsr_created_by" varchar,
  "tsr_last_updated_date" datetime,
  "tsr_last_updated_by" varchar,
  "tsr_end_date" datetime,
  PRIMARY KEY ("tsr_id")
);

CREATE TABLE "t_task_history" (
  "tkh_history_id" int,
  "tkh_user_task_id" int,
  "tkh_user_id" int,
  "tkh_task_name" varchar,
  "tkh_site_id" int,
  "tkh_site_name" varchar,
  "tkh_site_address" varchar,
  "tkh_source_id" int,
  "tkh_asset_id" int,
  "tkh_asset_type" varchar,
  "tkh_asset_name" varchar,
  "tkh_manufacture_serial_no" varchar,
  "tkh_status" varchar,
  "tkh_asset_tag" varchar,
  "tkh_assigned_date" datetime,
  "tkh_initiation_date" datetime,
  "tkh_submission_date" datetime,
  "tkh_approved_by" varchar,
  "tkh_approved_date" datetime,
  "tkh_remarks" varchar,
  "tkh_creation_date" datetime,
  "tkh_created_by" varchar,
  "tkh_last_updated_date" datetime,
  "tkh_last_updated_by" varchar,
  "tkh_end_date" datetime,
  PRIMARY KEY ("tkh_history_id")
);

CREATE TABLE "t_asset_audit" (
  "taa_audit_id" int,
  "taa_user_task_id" int,
  "taa_site_id" int,
  "taa_site_name" varchar,
  "taa_site_address" varchar,
  "taa_user_id" int,
  "taa_role_id" int,
  "taa_status" varchar,
  "taa_remarks" varchar,
  "taa_creation_date" datetime,
  "taa_created_by" varchar,
  "taa_last_updated_date" datetime,
  "taa_last_updated_by" varchar,
  "taa_end_date" datetime,
  PRIMARY KEY ("taa_audit_id")
);

CREATE TABLE "t_asset_audit_details" (
  "aad_audit_details_id" int,
  "aad_audit_id" int,
  "aad_asset_id" int,
  "aad_asset_type" varchar,
  "aad_asset_name" varchar,
  "aad_manufacture_serial_no" varchar,
  "aad_user_id" int,
  "aad_role_id" int,
  "aad_asset_tag" varchar,
  "aad_scan_date" datetime,
  "aad_status" varchar,
  "aad_remarks" varchar,
  "aad_creation_date" datetime,
  "aad_created_by" varchar,
  "aad_last_updated_date" datetime,
  "aad_last_updated_by" varchar,
  "aad_end_date" datetime,
  PRIMARY KEY ("aad_audit_details_id")
);

ALTER TABLE "t_asset_attribute" ADD FOREIGN KEY ("at_asset_id") REFERENCES "t_asset" ("ta_asset_id");
ALTER TABLE "t_asset" ADD FOREIGN KEY ("ta_asset_site_id") REFERENCES "t_site" ("ts_site_id");
ALTER TABLE "t_user_site" ADD FOREIGN KEY ("us_site_id") REFERENCES "t_site" ("ts_site_id");
ALTER TABLE "t_site_attribute" ADD FOREIGN KEY ("tsa_site_id") REFERENCES "t_site" ("ts_site_id");
ALTER TABLE "t_tagging_history" ADD FOREIGN KEY ("th_asset_id") REFERENCES "t_asset" ("ta_asset_id");
ALTER TABLE "t_Stn" ADD FOREIGN KEY ("tst_user_task_id") REFERENCES "t_user_task" ("ut_user_task_id");
ALTER TABLE "t_Stn" ADD FOREIGN KEY ("tst_asset_id") REFERENCES "t_asset" ("ta_asset_id");
ALTER TABLE "t_srn" ADD FOREIGN KEY ("tsr_user_task_id") REFERENCES "t_user_task" ("ut_user_task_id");
ALTER TABLE "t_srn" ADD FOREIGN KEY ("tsr_asset_id") REFERENCES "t_asset" ("ta_asset_id");
ALTER TABLE "t_task_history" ADD FOREIGN KEY ("tkh_user_task_id") REFERENCES "t_user_task" ("ut_user_task_id");
ALTER TABLE "t_task_history" ADD FOREIGN KEY ("tkh_asset_id") REFERENCES "t_asset" ("ta_asset_id");
ALTER TABLE "t_asset_audit" ADD FOREIGN KEY ("taa_user_task_id") REFERENCES "t_user_task" ("ut_user_task_id");
ALTER TABLE "t_asset_audit_details" ADD FOREIGN KEY ("aad_audit_id") REFERENCES "t_asset_audit" ("taa_audit_id");
