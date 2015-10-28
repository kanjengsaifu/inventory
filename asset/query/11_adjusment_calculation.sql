select a.id, a.nama, x.nama as buyer,
											
                                /*=========================================================TRANSIT========================================================*/
                                /* stok total kw1 transit */
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
                                coalesce(d.Tkw1k, 0) + coalesce(f.Rkw1k, 0))-(coalesce(e.Ukw1k, 0)+coalesce(g.Skw1kT, 0)) Tkw1_system_k,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Tkw1_opname_k,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
                                coalesce(d.Tkw1k, 0) + coalesce(f.Rkw1k, 0))-(coalesce(e.Ukw1k, 0)+coalesce(g.Skw1kT, 0))-
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Tkw1_selisih_k,
                                
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
                                coalesce(d.Tkw1s, 0) + coalesce(f.Rkw1s, 0))-(coalesce(e.Ukw1s, 0)+coalesce(g.Skw1sT, 0)) Tkw1_system_s,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Tkw1_opname_s,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
                                coalesce(d.Tkw1s, 0) + coalesce(f.Rkw1s, 0))-(coalesce(e.Ukw1s, 0)+coalesce(g.Skw1sT, 0))-
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Tkw1_selisih_s,
                                
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
                                coalesce(d.Tkw1b, 0) + coalesce(f.Rkw1b, 0))-(coalesce(e.Ukw1b, 0)+coalesce(g.Skw1bT, 0)) Tkw1_system_b,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Tkw1_opname_b,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
                                coalesce(d.Tkw1b, 0) + coalesce(f.Rkw1b, 0))-(coalesce(e.Ukw1b, 0)+coalesce(g.Skw1bT, 0))-
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Tkw1_selisih_b,
                                
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                             coalesce(d.Tkw1k, 0) + coalesce(f.Rkw1k, 0))-(coalesce(e.Ukw1k, 0)+coalesce(g.Skw1kT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                             coalesce(d.Tkw1s, 0) + coalesce(f.Rkw1s, 0))-(coalesce(e.Ukw1s, 0)+coalesce(g.Skw1sT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                             coalesce(d.Tkw1b, 0) + coalesce(f.Rkw1b, 0))-(coalesce(e.Ukw1b, 0)+coalesce(g.Skw1bT, 0)) Tkw1_system_ksb,
	                                
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Tkw1_opname_ksb,
										     
										  ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                             coalesce(d.Tkw1k, 0) + coalesce(f.Rkw1k, 0))-(coalesce(e.Ukw1k, 0)+coalesce(g.Skw1kT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                             coalesce(d.Tkw1s, 0) + coalesce(f.Rkw1s, 0))-(coalesce(e.Ukw1s, 0)+coalesce(g.Skw1sT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                             coalesce(d.Tkw1b, 0) + coalesce(f.Rkw1b, 0))-(coalesce(e.Ukw1b, 0)+coalesce(g.Skw1bT, 0)))-
	                             ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw1 else 0 end))) Tkw1_selisih_ksb,   
	                                
	                           	/* stok total kw2 transit */
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
                                coalesce(d.Tkw2k, 0) + coalesce(f.Rkw2k, 0))-(coalesce(e.Ukw2k, 0)+coalesce(g.Skw2kT, 0)) Tkw2_system_k,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Tkw2_opname_k,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
                                coalesce(d.Tkw2k, 0) + coalesce(f.Rkw2k, 0))-(coalesce(e.Ukw2k, 0)+coalesce(g.Skw2kT, 0))-
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Tkw2_selisih_k,
                                
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
                                coalesce(d.Tkw2s, 0) + coalesce(f.Rkw2s, 0))-(coalesce(e.Ukw2s, 0)+coalesce(g.Skw2sT, 0)) Tkw2_system_s,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Tkw2_opname_s,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
                                coalesce(d.Tkw2s, 0) + coalesce(f.Rkw2s, 0))-(coalesce(e.Ukw2s, 0)+coalesce(g.Skw2sT, 0))-
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Tkw2_selisih_s,
                                
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
                                coalesce(d.Tkw2b, 0) + coalesce(f.Rkw2b, 0))-(coalesce(e.Ukw2b, 0)+coalesce(g.Skw2bT, 0)) Tkw2_system_b,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Tkw2_opname_b,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
                                coalesce(d.Tkw2b, 0) + coalesce(f.Rkw2b, 0))-(coalesce(e.Ukw2b, 0)+coalesce(g.Skw2bT, 0))-
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Tkw2_selisih_b,
                                
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                             coalesce(d.Tkw2k, 0) + coalesce(f.Rkw2k, 0))-(coalesce(e.Ukw2k, 0)+coalesce(g.Skw2kT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                             coalesce(d.Tkw2s, 0) + coalesce(f.Rkw2s, 0))-(coalesce(e.Ukw2s, 0)+coalesce(g.Skw2sT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                             coalesce(d.Tkw2b, 0) + coalesce(f.Rkw2b, 0))-(coalesce(e.Ukw2b, 0)+coalesce(g.Skw2bT, 0)) Tkw2_system_ksb,
	                                
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Tkw2_opname_ksb,
										     
										  ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                             coalesce(d.Tkw2k, 0) + coalesce(f.Rkw2k, 0))-(coalesce(e.Ukw2k, 0)+coalesce(g.Skw2kT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                             coalesce(d.Tkw2s, 0) + coalesce(f.Rkw2s, 0))-(coalesce(e.Ukw2s, 0)+coalesce(g.Skw2sT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                             coalesce(d.Tkw2b, 0) + coalesce(f.Rkw2b, 0))-(coalesce(e.Ukw2b, 0)+coalesce(g.Skw2bT, 0)))-
	                             ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw2 else 0 end))) Tkw2_selisih_ksb,
                                
	                        	  /* stok total kw3 transit */
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
                                coalesce(d.Tkw3k, 0) + coalesce(f.Rkw3k, 0))-(coalesce(e.Ukw3k, 0)+coalesce(g.Skw3kT, 0)) Tkw3_system_k,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Tkw3_opname_k,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
                                coalesce(d.Tkw3k, 0) + coalesce(f.Rkw3k, 0))-(coalesce(e.Ukw3k, 0)+coalesce(g.Skw3kT, 0))-
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Tkw3_selisih_k,
                                
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
                                coalesce(d.Tkw3s, 0) + coalesce(f.Rkw3s, 0))-(coalesce(e.Ukw3s, 0)+coalesce(g.Skw3sT, 0)) Tkw3_system_s,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Tkw3_opname_s,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
                                coalesce(d.Tkw3s, 0) + coalesce(f.Rkw3s, 0))-(coalesce(e.Ukw3s, 0)+coalesce(g.Skw3sT, 0))-
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Tkw3_selisih_s,
                                
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
                                coalesce(d.Tkw3b, 0) + coalesce(f.Rkw3b, 0))-(coalesce(e.Ukw3b, 0)+coalesce(g.Skw3bT, 0)) Tkw3_system_b,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Tkw3_opname_b,
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
                                coalesce(d.Tkw3b, 0) + coalesce(f.Rkw3b, 0))-(coalesce(e.Ukw3b, 0)+coalesce(g.Skw3bT, 0))-
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Tkw3_selisih_b,
                                
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                             coalesce(d.Tkw3k, 0) + coalesce(f.Rkw3k, 0))-(coalesce(e.Ukw3k, 0)+coalesce(g.Skw3kT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                             coalesce(d.Tkw3s, 0) + coalesce(f.Rkw3s, 0))-(coalesce(e.Ukw3s, 0)+coalesce(g.Skw3sT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                             coalesce(d.Tkw3b, 0) + coalesce(f.Rkw3b, 0))-(coalesce(e.Ukw3b, 0)+coalesce(g.Skw3bT, 0)) Tkw3_system_ksb,
	                                
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Tkw3_opname_ksb,
										     
										  ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                             coalesce(d.Tkw3k, 0) + coalesce(f.Rkw3k, 0))-(coalesce(e.Ukw3k, 0)+coalesce(g.Skw3kT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                             coalesce(d.Tkw3s, 0) + coalesce(f.Rkw3s, 0))-(coalesce(e.Ukw3s, 0)+coalesce(g.Skw3sT, 0))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                             coalesce(d.Tkw3b, 0) + coalesce(f.Rkw3b, 0))-(coalesce(e.Ukw3b, 0)+coalesce(g.Skw3bT, 0)))-
	                             ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end))+
	                             (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-11-11'  then b.kw3 else 0 end))) Tkw3_selisih_ksb,
	                                
	                        	/*============================================GRAND TOTAL AREA PRODUCTION=================================================*/
	                        	((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
											  coalesce(c.Pkw1k, 0) + coalesce(f.RPkw1k, 0))-(coalesce(d.Tkw1k, 0)+coalesce(g.Skw1kP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(c.Pkw1s, 0) + coalesce(f.RPkw1s, 0))-(coalesce(d.Tkw1s, 0)+coalesce(g.Skw1sP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(c.Pkw1b, 0) + coalesce(f.RPkw1b, 0))-(coalesce(d.Tkw1b, 0)+coalesce(g.Skw1bP, 0))+
										(sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
											  coalesce(c.Pkw2k, 0) + coalesce(f.RPkw2k, 0))-(coalesce(d.Tkw2k, 0)+coalesce(g.Skw2kP, 0)) +
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(c.Pkw2s, 0) + coalesce(f.RPkw2s, 0))-(coalesce(d.Tkw2s, 0)+coalesce(g.Skw2sP, 0)) +
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(c.Pkw2b, 0) + coalesce(f.RPkw2b, 0))-(coalesce(d.Tkw2b, 0)+coalesce(g.Skw2bP, 0))+
										(sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
											  coalesce(c.Pkw3k, 0) + coalesce(f.RPkw3k, 0))-(coalesce(d.Tkw3k, 0)+coalesce(g.Skw3kP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(c.Pkw3s, 0) + coalesce(f.RPkw3s, 0))-(coalesce(d.Tkw3s, 0)+coalesce(g.Skw3sP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(c.Pkw3b, 0) + coalesce(f.RPkw3b, 0))-(coalesce(d.Tkw3b, 0)+coalesce(g.Skw3bP, 0))) GT_prod,
	                           /*=========================================================PRODUKSI================================================*/
											/* stok total kw1 produksi */
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
										  coalesce(c.Pkw1k, 0) + coalesce(f.RPkw1k, 0))-(coalesce(d.Tkw1k, 0)+coalesce(g.Skw1kP, 0)) Pkw1_system_k,
										  		/* opname total kw1 produksi */
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Pkw1_opname_k,
											   (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
										  		coalesce(c.Pkw1k, 0) + coalesce(f.RPkw1k, 0))-(coalesce(d.Tkw1k, 0)+coalesce(g.Skw1kP, 0))-
										      (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Pkw1_selisih_k,
										      
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
                                coalesce(c.Pkw1s, 0) + coalesce(f.RPkw1s, 0))-(coalesce(d.Tkw1s, 0)+coalesce(g.Skw1sP, 0)) Pkw1_system_s,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Pkw1_opname_s,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
                                   coalesce(c.Pkw1s, 0) + coalesce(f.RPkw1s, 0))-(coalesce(d.Tkw1s, 0)+coalesce(g.Skw1sP, 0))-
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Pkw1_selisih_s,
											  
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
                                coalesce(c.Pkw1b, 0) + coalesce(f.RPkw1b, 0))-(coalesce(d.Tkw1b, 0)+coalesce(g.Skw1bP, 0)) Pkw1_system_b,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Pkw1_opname_b,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
                                	  coalesce(c.Pkw1b, 0) + coalesce(f.RPkw1b, 0))-(coalesce(d.Tkw1b, 0)+coalesce(g.Skw1bP, 0))-
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Pkw1_selisih_b,
											  
	                                /* stok total kw1 ksb produksi */
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
											  coalesce(c.Pkw1k, 0) + coalesce(f.RPkw1k, 0))-(coalesce(d.Tkw1k, 0)+coalesce(g.Skw1kP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(c.Pkw1s, 0) + coalesce(f.RPkw1s, 0))-(coalesce(d.Tkw1s, 0)+coalesce(g.Skw1sP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(c.Pkw1b, 0) + coalesce(f.RPkw1b, 0))-(coalesce(d.Tkw1b, 0)+coalesce(g.Skw1bP, 0)) Pkw1_system_ksb,
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end)) Pkw1_opname_ksb,
	                                ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
											  coalesce(c.Pkw1k, 0) + coalesce(f.RPkw1k, 0))-(coalesce(d.Tkw1k, 0)+coalesce(g.Skw1kP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(c.Pkw1s, 0) + coalesce(f.RPkw1s, 0))-(coalesce(d.Tkw1s, 0)+coalesce(g.Skw1sP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(c.Pkw1b, 0) + coalesce(f.RPkw1b, 0))-(coalesce(d.Tkw1b, 0)+coalesce(g.Skw1bP, 0)))-
	                                ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw1 else 0 end))) Pkw1_selisih_ksb,
	                                
                                /* stok total kw2 produksi */
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
										  coalesce(c.Pkw2k, 0) + coalesce(f.RPkw2k, 0))-(coalesce(d.Tkw2k, 0)+coalesce(g.Skw2kP, 0)) Pkw2_system_k,
										  		/* opname total kw1 produksi */
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Pkw2_opname_k,
											   (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
										  		coalesce(c.Pkw2k, 0) + coalesce(f.RPkw2k, 0))-(coalesce(d.Tkw2k, 0)+coalesce(g.Skw2kP, 0))-
										      (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Pkw2_selisih_k,
										      
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
                                coalesce(c.Pkw2s, 0) + coalesce(f.RPkw2s, 0))-(coalesce(d.Tkw2s, 0)+coalesce(g.Skw2sP, 0)) Pkw2_system_s,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Pkw2_opname_s,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
                                   coalesce(c.Pkw2s, 0) + coalesce(f.RPkw2s, 0))-(coalesce(d.Tkw2s, 0)+coalesce(g.Skw2sP, 0))-
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Pkw2_selisih_s,
											  
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
                                coalesce(c.Pkw2b, 0) + coalesce(f.RPkw2b, 0))-(coalesce(d.Tkw2b, 0)+coalesce(g.Skw2bP, 0)) Pkw2_system_b,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Pkw2_opname_b,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
                                	  coalesce(c.Pkw2b, 0) + coalesce(f.RPkw2b, 0))-(coalesce(d.Tkw2b, 0)+coalesce(g.Skw2bP, 0))-
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Pkw2_selisih_b,
											  
	                                /* stok total kw1 ksb produksi */
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
											  coalesce(c.Pkw2k, 0) + coalesce(f.RPkw2k, 0))-(coalesce(d.Tkw2k, 0)+coalesce(g.Skw2kP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(c.Pkw2s, 0) + coalesce(f.RPkw2s, 0))-(coalesce(d.Tkw2s, 0)+coalesce(g.Skw2sP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(c.Pkw2b, 0) + coalesce(f.RPkw2b, 0))-(coalesce(d.Tkw2b, 0)+coalesce(g.Skw2bP, 0)) Pkw2_system_ksb,
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end)) Pkw2_opname_ksb,
	                                ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
											  coalesce(c.Pkw2k, 0) + coalesce(f.RPkw2k, 0))-(coalesce(d.Tkw2k, 0)+coalesce(g.Skw2kP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(c.Pkw2s, 0) + coalesce(f.RPkw2s, 0))-(coalesce(d.Tkw2s, 0)+coalesce(g.Skw2sP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(c.Pkw2b, 0) + coalesce(f.RPkw2b, 0))-(coalesce(d.Tkw2b, 0)+coalesce(g.Skw2bP, 0)))-
	                                ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw2 else 0 end))) Pkw2_selisih_ksb,
	                                
                                /* stok total kw2 produksi */
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
										  coalesce(c.Pkw3k, 0) + coalesce(f.RPkw3k, 0))-(coalesce(d.Tkw3k, 0)+coalesce(g.Skw3kP, 0)) Pkw3_system_k,
										  		/* opname total kw1 produksi */
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Pkw3_opname_k,
											   (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
										  		coalesce(c.Pkw3k, 0) + coalesce(f.RPkw3k, 0))-(coalesce(d.Tkw3k, 0)+coalesce(g.Skw3kP, 0))-
										      (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Pkw3_selisih_k,
										      
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
                                coalesce(c.Pkw3s, 0) + coalesce(f.RPkw3s, 0))-(coalesce(d.Tkw3s, 0)+coalesce(g.Skw3sP, 0)) Pkw3_system_s,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Pkw3_opname_s,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
                                   coalesce(c.Pkw3s, 0) + coalesce(f.RPkw3s, 0))-(coalesce(d.Tkw3s, 0)+coalesce(g.Skw3sP, 0))-
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Pkw3_selisih_s,
											  
                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
                                coalesce(c.Pkw3b, 0) + coalesce(f.RPkw3b, 0))-(coalesce(d.Tkw3b, 0)+coalesce(g.Skw3bP, 0)) Pkw3_system_b,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Pkw3_opname_b,
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
                                	  coalesce(c.Pkw3b, 0) + coalesce(f.RPkw3b, 0))-(coalesce(d.Tkw3b, 0)+coalesce(g.Skw3bP, 0))-
											  (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Pkw3_selisih_b,
											  
	                                /* stok total kw1 ksb produksi */
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
											  coalesce(c.Pkw3k, 0) + coalesce(f.RPkw3k, 0))-(coalesce(d.Tkw3k, 0)+coalesce(g.Skw3kP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(c.Pkw3s, 0) + coalesce(f.RPkw3s, 0))-(coalesce(d.Tkw3s, 0)+coalesce(g.Skw3sP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(c.Pkw3b, 0) + coalesce(f.RPkw3b, 0))-(coalesce(d.Tkw3b, 0)+coalesce(g.Skw3bP, 0)) Pkw3_system_ksb,
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end)) Pkw3_opname_ksb,
	                                ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
											  coalesce(c.Pkw3k, 0) + coalesce(f.RPkw3k, 0))-(coalesce(d.Tkw3k, 0)+coalesce(g.Skw3kP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(c.Pkw3s, 0) + coalesce(f.RPkw3s, 0))-(coalesce(d.Tkw3s, 0)+coalesce(g.Skw3sP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(c.Pkw3b, 0) + coalesce(f.RPkw3b, 0))-(coalesce(d.Tkw3b, 0)+coalesce(g.Skw3bP, 0)))-
	                                ((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-11-11'  then b.kw3 else 0 end))) Pkw3_selisih_ksb,     
	                        	/*============================================GRAND TOTAL AREA TRANSIT====================================================*/
	                        	((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(d.Tkw1k, 0) + coalesce(f.Rkw1k, 0))-(coalesce(e.Ukw1k, 0)+coalesce(g.Skw1kT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(d.Tkw1s, 0) + coalesce(f.Rkw1s, 0))-(coalesce(e.Ukw1s, 0)+coalesce(g.Skw1sT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(d.Tkw1b, 0) + coalesce(f.Rkw1b, 0))-(coalesce(e.Ukw1b, 0)+coalesce(g.Skw1bT, 0))+
	                           (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(d.Tkw2k, 0) + coalesce(f.Rkw2k, 0))-(coalesce(e.Ukw2k, 0)+coalesce(g.Skw2kT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(d.Tkw2s, 0) + coalesce(f.Rkw2s, 0))-(coalesce(e.Ukw2s, 0)+coalesce(g.Skw2sT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(d.Tkw2b, 0) + coalesce(f.Rkw2b, 0))-(coalesce(e.Ukw2b, 0)+coalesce(g.Skw2bT, 0))+
										(sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(d.Tkw3k, 0) + coalesce(f.Rkw3k, 0))-(coalesce(e.Ukw3k, 0)+coalesce(g.Skw3kT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(d.Tkw3s, 0) + coalesce(f.Rkw3s, 0))-(coalesce(e.Ukw3s, 0)+coalesce(g.Skw3sT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(d.Tkw3b, 0) + coalesce(f.Rkw3b, 0))-(coalesce(e.Ukw3b, 0)+coalesce(g.Skw3bT, 0))) GT_trans,
										/*============================================GRAND TOTAL AREA PRODUCTION=================================================*/
	                        	((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
											  coalesce(c.Pkw1k, 0) + coalesce(f.RPkw1k, 0))-(coalesce(d.Tkw1k, 0)+coalesce(g.Skw1kP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(c.Pkw1s, 0) + coalesce(f.RPkw1s, 0))-(coalesce(d.Tkw1s, 0)+coalesce(g.Skw1sP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(c.Pkw1b, 0) + coalesce(f.RPkw1b, 0))-(coalesce(d.Tkw1b, 0)+coalesce(g.Skw1bP, 0))+
										(sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
											  coalesce(c.Pkw2k, 0) + coalesce(f.RPkw2k, 0))-(coalesce(d.Tkw2k, 0)+coalesce(g.Skw2kP, 0)) +
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(c.Pkw2s, 0) + coalesce(f.RPkw2s, 0))-(coalesce(d.Tkw2s, 0)+coalesce(g.Skw2sP, 0)) +
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(c.Pkw2b, 0) + coalesce(f.RPkw2b, 0))-(coalesce(d.Tkw2b, 0)+coalesce(g.Skw2bP, 0))+
										(sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
											  coalesce(c.Pkw3k, 0) + coalesce(f.RPkw3k, 0))-(coalesce(d.Tkw3k, 0)+coalesce(g.Skw3kP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(c.Pkw3s, 0) + coalesce(f.RPkw3s, 0))-(coalesce(d.Tkw3s, 0)+coalesce(g.Skw3sP, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 3 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(c.Pkw3b, 0) + coalesce(f.RPkw3b, 0))-(coalesce(d.Tkw3b, 0)+coalesce(g.Skw3bP, 0)))+
	                        	((sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(d.Tkw1k, 0) + coalesce(f.Rkw1k, 0))-(coalesce(e.Ukw1k, 0)+coalesce(g.Skw1kT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(d.Tkw1s, 0) + coalesce(f.Rkw1s, 0))-(coalesce(e.Ukw1s, 0)+coalesce(g.Skw1sT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw1 else 0 end)+
	                                coalesce(d.Tkw1b, 0) + coalesce(f.Rkw1b, 0))-(coalesce(e.Ukw1b, 0)+coalesce(g.Skw1bT, 0))+
	                           (sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(d.Tkw2k, 0) + coalesce(f.Rkw2k, 0))-(coalesce(e.Ukw2k, 0)+coalesce(g.Skw2kT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(d.Tkw2s, 0) + coalesce(f.Rkw2s, 0))-(coalesce(e.Ukw2s, 0)+coalesce(g.Skw2sT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw2 else 0 end)+
	                                coalesce(d.Tkw2b, 0) + coalesce(f.Rkw2b, 0))-(coalesce(e.Ukw2b, 0)+coalesce(g.Skw2bT, 0))+
										(sum(case when b.jenis_decal = 1 and b.size_kat = 6 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(d.Tkw3k, 0) + coalesce(f.Rkw3k, 0))-(coalesce(e.Ukw3k, 0)+coalesce(g.Skw3kT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 7 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(d.Tkw3s, 0) + coalesce(f.Rkw3s, 0))-(coalesce(e.Ukw3s, 0)+coalesce(g.Skw3sT, 0))+
	                                (sum(case when b.jenis_decal = 1 and b.size_kat = 8 and b.area = 4 and b.tgli = '2015-10-11'  then b.kw3 else 0 end)+
	                                coalesce(d.Tkw3b, 0) + coalesce(f.Rkw3b, 0))-(coalesce(e.Ukw3b, 0)+coalesce(g.Skw3bT, 0))) GT_prod_trans	  	       
                              from decal_items a
                              left join global_buyer x on a.buyer = x.id
                              left join decal_ohd b
                                on a.id = b.id_decal_items
                              left join
                              (
                                select id_decal_items, 
                                sum( case when jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Pkw1k,
                                sum( case when jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Pkw1s,
                                sum( case when jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Pkw1b,
                                sum( case when jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Pkw2k,
                                sum( case when jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Pkw2s,
                                sum( case when jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Pkw2b,
                                sum( case when jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Pkw3k,
                                sum( case when jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Pkw3s,
                                sum( case when jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Pkw3b
                                from decal_phd
                                where deleted = 0
                                group by id_decal_items
                              ) c on a.id = c.id_decal_items
                              left join
                              (
                                select id_decal_items, 
                                sum( case when jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Tkw1k,
                                sum( case when jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Tkw1s,
                                sum( case when jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Tkw1b,
                                sum( case when jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Tkw2k,
                                sum( case when jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Tkw2s,
                                sum( case when jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Tkw2b,
                                sum( case when jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Tkw3k,
                                sum( case when jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Tkw3s,
                                sum( case when jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Tkw3b
                                from decal_thd
                                where deleted = 0
                                group by id_decal_items
                              ) d on a.id = d.id_decal_items
                              left join
                              (
                                select id_decal_items, 
                                sum( case when jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Ukw1k,
                                sum( case when jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Ukw1s,
                                sum( case when jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Ukw1b,
                                sum( case when jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Ukw2k,
                                sum( case when jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Ukw2s,
                                sum( case when jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Ukw2b,
                                sum( case when jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Ukw3k,
                                sum( case when jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Ukw3s,
                                sum( case when jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Ukw3b
                                from decal_uhd
                                where deleted = 0
                                group by id_decal_items
                              ) e on a.id = e.id_decal_items
                              left join
                              (
                                select id_decal_items, 
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Rkw1k,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Rkw1s,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Rkw1b,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Rkw2k,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Rkw2s,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Rkw2b,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Rkw3k,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Rkw3s,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Rkw3b,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) RPkw1k,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) RPkw1s,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) RPkw1b,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) RPkw2k,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) RPkw2s,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) RPkw2b,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) RPkw3k,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) RPkw3s,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) RPkw3b
                                from decal_rhd
                                where deleted = 0
                                group by id_decal_items
                              ) f on a.id = f.id_decal_items
                              left join
                              (
                                select id_decal_items, 
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Skw1kP,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Skw1sP,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Skw1bP,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Skw2kP,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Skw2sP,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Skw2bP,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Skw3kP,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Skw3sP,
                                sum( case when area = 3 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Skw3bP,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Skw1kT,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Skw1sT,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw1 else 0 end) Skw1bT,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Skw2kT,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Skw2sT,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw2 else 0 end) Skw2bT,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 6 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Skw3kT,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 7 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Skw3sT,
                                sum( case when area = 4 and jenis_decal = 1 and size_kat = 8 and tgli between '2015-10-12 18:00:00' and '2015-11-11 18:00:00' then kw3 else 0 end) Skw3bT
                                from decal_shd
                                where deleted = 0
                                group by id_decal_items
                              ) g on a.id = g.id_decal_items
                              where b.deleted = 0 and a.jenis = 1
                              group by a.id, a.nama, a.buyer