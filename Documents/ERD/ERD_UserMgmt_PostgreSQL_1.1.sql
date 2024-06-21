CREATE TABLE "t_user" (
  "user_id" varchar,
  "user_name" varchar,
  "user_category" varchar, --Administrator or Supervisor or Technician
  "user_address" varchar,
  "user_mobile_no" varchar,
  "user_alternate_mobile_no" varchar,
  "user_authentication_source" varchar,
  "status" varchar, --Active, Pending, Blocked, Terminated
  "creation_date" datetime,
  "created_by" varchar,
  "updated_date" datetime,
  "updated_by" varchar,
  "end_date" datetime,
  "number_of_failed_login" int,
  "last_failed_login_time" datetime,
  "last_successful_login_time" datetime,
  PRIMARY KEY ("user_id")
);

CREATE TABLE "t_role" (
  "role_id" int,
  "role_name" varchar,
  "role_description" varchar,
  "module_id" int,
  "function_id" int,
  "status" int check(0,1),
  "creation_date" datetime,
  "created_by" varchar,
  "updated_date" datetime,
  "updated_by" varchar,
  PRIMARY KEY ("role_id")
);

CREATE TABLE "t_module" (
  "module_id" int,
  "module_code" varchar,
  "module_description" varchar,
  "status" int check(0,1),
  PRIMARY KEY ("module_id")
);

CREATE TABLE "t_module_function" (
  "module_id" int,
  "function_id" int,
  "function_code" varchar,
  "function_description" varchar,
  "status" int check(0,1),
  PRIMARY KEY ("module_id,function_id")
);

CREATE TABLE "t_user_password_tracker" (
  "user_id" varchar,
  "password" varchar,
  "date" datetime,
  PRIMARY KEY ("user_id,password") 
);

CREATE TABLE "t_user_role" (
  "user_id" varchar,
  "role_id" int,
  "status" int check(0,1),
  "creation_date" datetime,
  "created_by" varchar,
  "updated_date" datetime,
  "updated_by" varchar,
  PRIMARY KEY ("user_id","role_id")
);

ALTER TABLE "t_module_function" ADD FOREIGN KEY ("module_id") REFERENCES "t_module" ("module_id");
ALTER TABLE "t_role" ADD FOREIGN KEY ("module_id") REFERENCES "t_module_function" ("module_id");
ALTER TABLE "t_role" ADD FOREIGN KEY ("function_id") REFERENCES "t_module_function" ("function_id");
ALTER TABLE "t_user_password_tracker" ADD FOREIGN KEY ("user_id") REFERENCES "t_user" ("user_id");
ALTER TABLE "t_user_role" ADD FOREIGN KEY ("user_id") REFERENCES "t_user" ("user_id");
ALTER TABLE "t_user_role" ADD FOREIGN KEY ("role_id") REFERENCES "t_role" ("role_id");
