select a.id_glasir, a.periode, a.inputer, a.petugas, a.tgli, a.jam, a.shift, a.tgl_input, a.tgl_start, a.jam_start, a.tgl_end, a.jam_end, 
format(a.bgps_acc,2)bgps_acc, format(a.sply_acc,2)sply_acc
from glasir_ahd a 
left join glasir b on a.id_glasir = b.id_glasir
where a.periode <> 1
order by a.id_glasir