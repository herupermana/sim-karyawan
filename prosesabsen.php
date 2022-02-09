<?php

   include 'config/koneksi.php';
   date_default_timezone_set('Asia/Jakarta');
   $nik = $_POST[nilai];
   $tanggal = date('Y-m-d');
   $tanggal2 = date('Y/m/d');
   $jam = date('H');
   $men = date('i');
   $det = date('s');
   $jam--;
   $jam = date('H:i:s', mktime($jam, $men, $det, 1, 1, 1));

   $cekpegawai = mysql_query("select * from mst_karyawan where nip not in (select nip from mutasi_karyawan) and nip = '$nik'");
   $adapegawai = mysql_num_rows($cekpegawai);

            $cut = mysql_query("Select * from t_cuti where nip in (select nip from mst_karyawan) 
								and nip = '$nik' and '$tanggal' between tanggal_awal and tanggal_akhir") or exit(mysql_error());
            $cek = mysql_fetch_array($cut);
                if (!empty($cek)) {
                    header("location:absen.php?pesan='Karyawan ini sedang cuti'");
                } else {
                    if (empty($nik)) {
                        header('location:absen.php');
                        break;
                    }
                    if ($adapegawai > 0) {
                        $tpegawai = mysql_fetch_array($cekpegawai);
                        $qcari = mysql_query("select * from t_absensi where nip = '$nik' and tanggal = '$tanggal2'");
                        $tubah = mysql_fetch_array($qcari);
                        $ada = mysql_num_rows($qcari);

                        if ($ada > 0) {
                            $jam_lewat = date('h:i:s');

                            $jampulang = $tubah[pulang];
                            if (!empty($jampulang)) {
                                header("location:absen.php?pesan3=$tpegawai[nama_lengkap] Sudah mengisi absen PULANG pada jam $jampulang");
                            } elseif ($tubah['masuk'] < $jam_lewat) {
                                header("location:absen.php?pesan='Anda telah mengisi absen masuk hari ini'");
                            //exit;
                            } elseif ($tubah['masuk'] > $jam_lewat) {
                                $jp = '17:30:00';
                                if (($tpegawai['kode_jab'] == '1') || ($tpegawai['kode_jab'] == '3') || ($tpegawai['kode_jab'] == '5')) {
                                    mysql_query("update t_absensi set pulang = '$jp' where nip = '$nik' and tanggal = '$tanggal'");
                                } else {
                                    mysql_query("update t_absensi set pulang = '$jam' where nip = '$nik' and tanggal = '$tanggal'");
                                }
                                header("location:absen.php?pesan_pulang=$tpegawai[nama_lengkap] telah mengisi absen PULANG pada jam $jam&nip=$tpegawai[nip]");
                                //}
                            }
                        } else {
                            if ($jam >= '09:30:00') {
                                $ket = 'telat';
                                //echo $ket;exit;
                                mysql_query("insert into t_absensi(nip,tanggal,masuk,keterangan) values('$nik','$tanggal','$jam','$ket')");
                            } else {
                                mysql_query("insert into t_absensi(nip,tanggal,masuk) values('$nik','$tanggal','$jam')");
                            }
                            header("location:absen.php?pesan=$tpegawai[nama_lengkap] telah mengisi absen MASUK pada jam $jam&nip=$tpegawai[nip]");
                        }
                    } else {
                        header("location:absen.php?pesan=NIK $nik Tidak ada dalam Database kami");
                    }
                }
