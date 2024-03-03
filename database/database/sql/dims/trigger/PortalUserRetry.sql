DROP TRIGGER IF EXISTS PortalUserRetry;

DELIMITER $$

    CREATE TRIGGER PortalUserRetry BEFORE UPDATE ON `portal_users`
    FOR EACH ROW BEGIN
      IF (NEW.retry = 4) THEN
            SET NEW.status = '2';
      END IF;
      IF (NEW.retry >= 5) THEN
            SET NEW.status = '0';
      END IF;
      IF (NEW.retry = 0) THEN
            SET NEW.status = '1';
      END IF;
    END$$

DELIMITER ;