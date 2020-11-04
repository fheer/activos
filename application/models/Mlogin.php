<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends CI_Model
{
	
	function __construct(){
		parent::__construct();

	}

	public function ingresar($user,$psw){
		$query = "IFNULL(uf_login('". $user. "','".$psw."'),0) AS respuesta";
		$this->db->select($query);
		$resultado = $this->db->get();
		if ($resultado->num_rows() == 1) {
				$r = $resultado->row();
				//echo $r->respuesta;
				$this->db->select("concat_ws(' ',nombres,ApellidoPaterno,ApellidoMaterno) as Nombre,ci,idPersona,foto,cargo,idPersona");
				$this->db->FROM('persona');
				$this->db->WHERE('idPersona',$r->respuesta);
				$resultado = $this->db->get();

				if ($resultado->num_rows() == 1) {
					$r = $resultado->row();
					$s_user = array(
						's_idPersona' => $r->idPersona,
						's_ci' => $r->ci,
						's_nomUser' => $r->Nombre,
						's_foto' => $r->foto,
						's_cargo' => $r->cargo,
						's_logueado' => TRUE
					);
					$this->session->set_userdata($s_user);
					return 1;
				}else{
					return 0;
				}
		}
		/*if ($idUser != Null) {
			$this->db->select("concat_ws(' ',nombres,ApellidoPaterno,ApellidoMaterno,foto,p.ci,p.cargo) as Nombre,ci,idPersona,foto,cargo,idUsuario");
			$this->db->FROM('persona');
			$this->db->WHERE('idUsuario',$idUser);
			$resultado = $this->db->get();

			if ($resultado->num_rows() == 1) {
				$r = $resultado->row();
				$s_user = array(
					's_idPersonal' => $r->idUsuario,
					's_ci' => $r->ci,
					's_nomUser' => $r->Nombre,
					's_foto' => $r->foto,
					's_cargo' => $r->cargo,
					's_logueado' => TRUE
				);
				$this->session->set_userdata($s_user);
				return 1;
			}else{
				return 0;
			}
		}
		else{
			echo "Null";
		} */
	}
}

