select a.parent_id,b.nama,a.item_code,a.item, 
c.phd, d.thd_glaze, e.thd_dgunt
from decal_items_detail a
left join decal_items b on a.parent_id = b.id
left join
   (select parent_id, item_code,
   REPLACE(FORMAT(COALESCE(sum(case when deleted = 0 THEN (jml-rusak) ELSE 0 END), 0),2),',','') phd
   from decal_phd
   where deleted = 0
   group by item_code
   ) c on a.item_code = c.item_code
left join
   (select parent_id, item_code,
   REPLACE(FORMAT(COALESCE(sum(case when deleted = 0 AND area = 4 THEN (jml-rusak) ELSE 0 END), 0),2),',','') thd_glaze
   from decal_thd
   where deleted = 0
   group by item_code
   ) d on a.item_code = d.item_code
left join
   (select parent_id, item_code,
   REPLACE(FORMAT(COALESCE(sum(case when deleted = 0 AND area = 5 THEN (jml-rusak) ELSE 0 END), 0),2),',','') thd_dgunt
   from decal_thd
   where deleted = 0
   group by item_code
   ) e on a.item_code = e.item_code	   
where a.parent_id in (select distinct parent_id from decal_ohd) or
a.parent_id in (select distinct parent_id from decal_phd) or
a.parent_id in (select distinct parent_id from decal_thd) or
a.parent_id in (select distinct parent_id from decal_uhd) or
a.parent_id in (select distinct parent_id from decal_shd) or
a.parent_id in (select distinct parent_id from decal_rhd)