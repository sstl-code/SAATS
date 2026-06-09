# Database Validation & Troubleshooting Guide: Staging and Pending Approval Flow

This guide provides SQL queries and verification steps to diagnose why an asset uploaded by a technician is not showing up in their supervisor's **Pending Approval** list. 

### Why the Cross-DB Reference Error Occurs
The application uses two separate PostgreSQL databases:
1. **User Database (`user_db_connection`)**: Stores user profiles, authentication data, and role assignments (`public.users`, `public.role_user_mapper`, `public.roles`).
2. **ATS Database (`pgsql`)**: Stores assets, sites, relationships, and staging tables (`ats.t_technician_supervisor_mappinng`, `ats.t_asset_edit`, `ats.t_pm_approval`).

Because PostgreSQL does not support direct cross-database queries/joins without `dblink` or Foreign Data Wrappers (FDW), **you must execute the queries below in their respective databases.**

---

## Phase 1: Queries for the USER Database (`user_db_connection`)

Run these queries on the **User Management Database** connection in DBeaver to inspect account status and roles.

```sql
-- 1. Check user details, supervisor status, and active status
-- Note: Replace with the actual email addresses of the technician and supervisor
SELECT 
    id AS user_id, 
    name, 
    email, 
    status, 
    is_supervisor, 
    is_admin
FROM public.users
WHERE email IN ('technician_email@example.com', 'supervisor_email@example.com');

-- 2. Verify Role Mapping in the System
-- Note: Replace the IDs below with the "user_id" values obtained from Query 1 above
SELECT 
    rum.id AS mapper_id,
    rum.user_id,
    rum.role_id,
    r.role_name,
    rum.user_role_mapper_status AS is_role_active
FROM public.role_user_mapper rum
JOIN public.roles r ON r.id = rum.role_id
WHERE rum.user_id IN (123, 456); -- Insert Technician and Supervisor IDs here
```

> [!IMPORTANT]
> - The Technician must have `is_supervisor = false` (or `f`) and be mapped to `role_id = 2` (Technician).
> - The Supervisor must have `is_supervisor = true` (or `t`) and be mapped to `role_id = 3` (Supervisor).
> - Both users must have `status = 'active'` and `is_role_active = true`.

---

## Phase 2: Queries for the ATS Database (`pgsql`)

Run these queries on the **ATS Database** connection in DBeaver to inspect relationship mapping, staging state, and approvals.

### 1. Verify Technician-Supervisor Relationship
Verify that the technician is linked to the supervisor and that the supervisor's ProcessMaker User ID (`pm_user_id`) is correctly configured.
```sql
-- Check relationship mapping and ProcessMaker user ID
-- Note: Replace 'technician_user_id' with the Technician's user ID from Phase 1
SELECT 
    id AS mapping_id,
    technician_id,
    supervisor_id,
    pm_user_id AS supervisor_pm_user_id,
    deleted_at AS mapping_deleted_at
FROM ats.t_technician_supervisor_mappinng
WHERE technician_id = 123; -- Replace with Technician's user_id from Phase 1
```

> [!WARNING]
> - **`supervisor_pm_user_id` (pm_user_id)** is critical. If it is null, empty, or incorrect, ProcessMaker will not receive the assignment, and the case won't show up in the supervisor's drafts.
> - Ensure `mapping_deleted_at` is `NULL` (meaning the mapping is active).

### 2. Verify Asset Staging
Check if the uploaded asset was written to the staging table `ats.t_asset_edit` and has a generated `pm_project_id`.
```sql
-- Query by Manufacture Serial Number or scanned Tag Number
SELECT 
    id AS staging_id,
    ta_asset_id AS original_asset_id,
    ta_asset_manufacture_serial_no AS serial_no,
    ta_asset_name AS asset_name,
    ta_asset_tag_number AS tag_number,
    pm_project_id,
    ta_created_by AS technician_user_id,
    ta_creation_date,
    is_shown
FROM ats.t_asset_edit
WHERE ta_asset_manufacture_serial_no = 'SERIAL_NUMBER_HERE'
   OR ta_asset_tag_number = 'TAG_NUMBER_HERE';
```

### 3. Verify Pending Approval Record
A record must exist in `ats.t_pm_approval` connecting the staged asset, supervisor, technician, and the ProcessMaker project ID with a status of `'Pending'`.
```sql
-- Check the approval record details and assignment status
-- Note: Use the 'pm_project_id' from the staging query above
SELECT 
    id AS approval_id,
    tpm_asset_id AS asset_id,
    tpm_asset_site_id AS site_id,
    site_code,
    pm_project_id,
    tpm_technician_id AS technician_id,
    technician_name,
    tpm_supervisor_id AS supervisor_id,
    approver_name,
    task_title,
    task_status,
    created_at
FROM ats.t_pm_approval
WHERE pm_project_id = 'INSERT_PM_PROJECT_ID_FROM_STEP_2'
   OR (tpm_technician_id = 123 AND task_status = 'Pending'); -- Replace with Technician's user_id from Phase 1
```

---

## Phase 3: ProcessMaker & Web Portal Integration

If all the database records in Phases 1 & 2 are correct, the issue lies in the ProcessMaker assignment API call or the supervisor session token:

1. **Verify Token Validity**: The web portal retrieves cases from ProcessMaker's draft endpoint (`/api/1.0/workflow/cases/draft`) using the supervisor's active session token. If the token is expired, no cases will load.
2. **Task Assignment Failure**: Look at the PHP/Laravel backend logs (`storage/logs/laravel.log`) around the time of the upload. Check if `PMClass::assign_task_users` failed due to ProcessMaker credentials issues or communication timeouts.
