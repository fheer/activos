<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends CI_Model
{
	
	function __construct(){
		parent::__construct();

	}

	public function ingresar($user,$psw){
		$this->db->select('idUsuario,user,clave,permiso,idPersona,nuevo');
		$this->db->FROM('usuario');
		$this->db->WHERE('user',$user);
		$resultado = $this->db->get();
		$r = $resultado->row();
		$clave = $r->clave;
		if (password_verify($psw, $clave))
		{
			echo 'verifico la clave'.'<br>';
			if ($resultado->num_rows() == 1) {
				$r = $resultado->row();
				$nuevo = $r->nuevo;
				$idUsuario = $r->idUsuario;
				$this->db->select("concat_ws(' ',nombres,ApellidoPaterno,ApellidoMaterno) as Nombre,ci,idPersona,foto,idCargo");
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
						's_nuevo' => $nuevo,
						's_idUsuario' => $idUsuario,
						's_logueado' => TRUE
					);
					$this->session->set_userdata($s_user);
					return 1;
				}else{
					return 0;
				}
			}
		}
		else{
			return 0;
		}
		/*$resultado = $this->db->get();

		*/
	}
}

