<?php
defined('BASEPATH') or exit();

class Mymodel extends CI_Model{

    function tahunajaran(){

        $this->db->select('*')->from('ta');
        $this->db->where('ta_aktif', 1);
        $this->db->order_by('ta_tahun', 'desc');

        $pengaturan = $this->db->get()->result();

        return $pengaturan[0]->ta_tahun.'-'.$pengaturan[0]->ta_semester;
    }
	
	function getpengaturan($pengaturan_name){
		
		$pengaturan = $this->db->get_where('pengaturan',array(
			'pengaturan_name'=>$pengaturan_name
		))->result();

		if(!$pengaturan) return null;
		
		return $pengaturan[0]->pengaturan_value;
	}
	
	function getta($pengaturan_key){
		
		$ta = $this->db->get_where('ta',array(
			'ta_aktif'=>1
		))->result();
		
		return $ta[0];
	}
	
	function getdata($tabel){
		return $this->db->get($tabel)->result();
	}
	
	function tambahdata($data,$tabel){
		$this->db->insert($tabel,$data);
	}
	
	function ambilbyid($where,$tabel){
		return $this->db->get_where($tabel,$where);
	}
	
	function simpanbyid($data,$where,$tabel){
		$this->db->where($where);
		$this->db->update($tabel,$data);
	}
	
	function hapusbyid($where,$tabel){
		$this->db->where($where);		
		$this->db->delete($tabel);
	}
	
	function getRows($params,$args){
        $this->db->select('*');
        $this->db->from($args['tabel']);
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like($args['sortByTitle'],$params['search']['keywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by($args['sortByTitle'],$params['search']['sortBy']);
        }else{
            $this->db->order_by($args['orderby'],'desc');
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return $query->result_array();
    }




    function splitName($name) {
        $name = str_replace(',',' ',$name);

        $parts = explode(' ', $name);
        return array(
            'firstname' => array_shift($parts),
            'lastname' => array_pop($parts),
            'middlename' => join(' ', $parts)
        );
    }

	function tanggalhari($tanggal, $cetak_hari = false){
		$hari = array ( 1 =>    'Senin',
					'Selasa',
					'Rabu',
					'Kamis',
					'Jumat',
					'Sabtu',
					'Minggu'
				);

		$bulan = array (1 =>   'Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
		$split1 	  = explode(' ', $tanggal);
		$split2 	  = explode('-', $split1[0]);
		$tgl_indo = $split2[2].' '.$bulan[ (int)$split2[1] ] . ' ' . $split2[0];
		$waktu = 'Pukul '.$split1[1];

		if ($cetak_hari) {
			$num = date('N', strtotime($tanggal));
			return $hari[$num] . ', ' . $tgl_indo.' '.$waktu;
		}
		return $tgl_indo;
	}

    function tanggalhari2($tanggal, $cetak_hari = false){
	    if($tanggal == '0000-00-00'){
	        return '0000-00-00';
        }

        $hari = array ( 1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $bulan = array (1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $split2 	  = explode('-', $tanggal);
        $tgl_indo     = $split2[2].' '.$bulan[ (int)$split2[1] ] . ' ' . $split2[0];

        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }


    function _remove_accent($str){
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        return str_replace($a, $b, $str);
    }

    function post_slug($str){
        $a  = strtolower(
            preg_replace(
                array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
                array('', '-', ''),
                $this->_remove_accent($str)
            )
        );

        $a = str_replace('-','',$a);

        return $a;
    }



    function html_media_player($file,$width="320px",$height="240px") {
        $ret = '';

        $pc_file = explode(".", $file);
        $eks = end($pc_file);

        $eks_video = array("mp4","flv","mpeg");
        $eks_audio = array("mp3","acc");
        $eks_image = array("jpeg","jpg","gif","bmp","png");


        if (!in_array($eks, $eks_video) && !in_array($eks, $eks_audio) && !in_array($eks, $eks_image)) {
            $ret .= '';
        } else {
            if (in_array($eks, $eks_video)) {
                if (is_file("./uploads/files/".$file)) {
                    $ret .= '<p><video width="'.$width.'" height="'.$height.'" controls>
				  <source src="'.base_url()."uploads/files/".$file.'" type="video/mp4">
				  <source src="'.base_url()."uploads/files/".$file.'" type="application/octet-stream">Browser tidak support</video></p>';
                } else {
                    $ret .= '';
                }
            }

            if (in_array($eks, $eks_audio)) {
                if (is_file("./uploads/files/".$file)) {
                    $ret .= '<p><audio width="'.$width.'" height="'.$height.'" controls>
				<source src="'.base_url()."uploads/files/".$file.'" type="audio/mpeg">
				<source src="'.base_url()."uploads/files/".$file.'" type="audio/wav">Browser tidak support</audio></p>';
                } else {
                    $ret .= '';
                }
            }

            if (in_array($eks, $eks_image)) {
                if (is_file("./uploads/files/".$file)) {
                    $ret .= '<div class="gambar"><img src="'.base_url()."uploads/files/".$file.'" style="width: '.$width.'; height: '.$height.'; display: inline; float: left"></div>';
                } else {
                    $ret .= '';
                }
            }
        }


        return $ret;
    }
}

?>