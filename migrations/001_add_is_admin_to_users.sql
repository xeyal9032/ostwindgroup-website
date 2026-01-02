-- Add role flag for admin authorization
-- Safe to run multiple times (IF NOT EXISTS)

ALTER TABLE users
  ADD COLUMN IF NOT EXISTS is_admin TINYINT(1) NOT NULL DEFAULT 0;

-- Optional: mark existing 'admin' user as admin (adjust as needed)
UPDATE users
SET is_admin = 1
WHERE username = 'admin' OR email = 'admin@ostwindgroup.com' OR email = 'admin@example.com';

