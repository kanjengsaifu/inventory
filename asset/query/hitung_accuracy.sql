select a.id_glasir, b.nama_glasir, a.bgps_system, a.bgps_opname, format(a.bgps_opname/a.bgps_system,2) as bgps_acc, a.sply_system, a.sply_opname, format(a.sply_opname/a.sply_system,2) as sply_acc
from glasir_ahd a
left join glasir b on a.id_glasir = b.id_glasir
where periode = 3 