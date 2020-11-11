<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends CI_Model
{
	
	function __construct(){
		parent::__construct();

	}

	public function ingresar($user,$psw){
		$this->db->select('user,clave,permiso,idPersona');
		$this->db->FROM('usuario');
		$this->db->WHERE('user',$user);
		$this->db->WHERE('clave',$psw);

		$resultado = $this->db->get();

		if ($resultado->num_rows() == 1) {
				$r = $resultado->row();
				//echo $r->respuesta;
				$this->db->select("concat_ws(' ',nombres,ApellidoPaterno,ApellidoMaterno) as Nombre,ci,idPersona,foto,cargo");
				$this->db->FROM('persona');
				$this->db->WHERE('idPersona',$r->idPersona);
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
	}
}

