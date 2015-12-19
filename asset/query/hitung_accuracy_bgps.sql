DROP TABLE IF EXISTS glasir_acc_bgps;
SET @sql = NULL;
SELECT
  GROUP_CONCAT(DISTINCT
    CONCAT(
      'MAX(IF(pa.periode = ''',periode,''', FORMAT(pa.bgps_acc*100,2), 0)) AS ', concat('P',periode)
    )
  ) INTO @sql
FROM glasir_ahd
;

SET @sql = CONCAT('SELECT p.id_glasir
                    , p.nama_glasir , ',@sql, ' ,p.status
                   FROM glasir p
                   JOIN glasir_ahd AS pa 
                    ON p.id_glasir = pa.id_glasir
                   GROUP BY p.id_glasir');

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

set @sql := concat( 'create table glasir_acc_bgps as ', @sql );

select @sql;

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

desc glasir_acc_bgps;
show create table glasir_acc_bgps;
select * from glasir_acc_bgps;