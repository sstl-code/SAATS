# ProcessMaker 3 & SAATS Integration Fixes

**Date:** June 12, 2026
**Issue Summary:** The PM3 Dynaform for Asset Approval ("Add Assets") was rendering completely empty and hanging. Additionally, the asset images in the form were returning 404 errors.

## 1. The Empty Dynaform Issue
### Root Cause
The PM3 triggers and Javascript for the `Add_Assets.pmx` process were hardcoded with obsolete IP addresses:
- **PHP Trigger (Data Load):** Hardcoded to `172.16.200.25:88`, causing the server's internal cURL request to hang indefinitely.
- **Javascript (Accept/Reject):** Hardcoded to `115.113.197.12:88`, which failed due to NAT Loopback restrictions on the server.

### Fix Applied
- **Codebase:** The `Add_Assets.pmx` file in the SAATS codebase (`public/Add_Assets.pmx`) was updated via a text replacement. All instances of `172.16.200.25:88` and `115.113.197.12:88` were replaced with the correct working API endpoint: `103.239.139.109:86`.
- **Server:** The active processes in PM3 were manually updated via the PM3 Designer Web UI to use the correct `103.239.139.109:86` IP.
- **Resiliency:** Added `CURLOPT_TIMEOUT => 60` to all PM3 cURL requests in `app/Class/PMClass.php` to ensure PHP workers never hang indefinitely in the future if PM3 is unreachable.

## 2. The 404 Asset Image Issue
### Root Cause
Laravel stores images in the hidden `storage/app/public` directory. Usually, this is made accessible via a symlink at `public/storage`. However, a manual Apache VirtualHost alias was overriding this symlink and pointing to the wrong physical folder.
- **Bad Alias in `/etc/apache2/sites-enabled/ats.conf`:** 
  `Alias /storage/assetimage "/var/www/html/myproject/ats/storage/assetimage/"`

### Fix Applied
- **Server:** Corrected the Alias path in `ats.conf` to point to the actual folder (`/var/www/html/myproject/ats/storage/app/public/assetimage/`).
- **Command Used:** `sudo sed -i 's|/var/www/html/myproject/ats/storage/assetimage/|/var/www/html/myproject/ats/storage/app/public/assetimage/|g' /etc/apache2/sites-enabled/ats.conf`

## 3. Multiple Tabs Restriction (PM3)
- ProcessMaker has a security feature that destroys the session if multiple tabs are opened (`PM-Warning` cookie). This was diagnosed as a secondary reason why `ajaxListener` requests get abruptly cancelled during heavy testing. It can be bypassed by using an Incognito window or disabling `session_block_multiple_tabs` in PM3's `env.ini`.
