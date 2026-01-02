-- Support private upload storage by allowing file_url to store storage path
-- (no schema change strictly required), but keep a helper index if needed.
-- This migration is intentionally minimal to avoid breaking existing installs.

-- Optional: if you want explicit column instead of overloading file_url, add:
-- ALTER TABLE uploaded_files ADD COLUMN IF NOT EXISTS storage_path VARCHAR(1024) NULL;

