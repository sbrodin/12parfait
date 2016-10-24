<?php

if(!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
  * Classe étendue du profiler CI
  *
  * L'extension de la classe de base permet l'affichage des éléments souhaités du profiler,
  * avec l'ajout de quelques fonctionnalités (comme un bouton fermer, à contrôler séparément).
  */
class MY_Profiler extends CI_Profiler {
	function run() {
		$output = "<div id='codeigniter-profiler' style='clear:both;background-color:#fff;padding:10px;'>";

		// On ajoute le bouton pour fermer le profiler
		$output .= "<div id='profiler-close'>Fermer <span>X</span></div>";

		$output .= $this->_compile_uri_string();
		$output .= $this->_compile_controller_info();
		$output .= $this->_compile_get();
		$output .= $this->_compile_post();
		$output .= $this->_compile_benchmarks();
		$output .= $this->_compile_queries();
		$output .= $this->_compile_memory_usage();
		// $output .= $this->_compile_http_headers();
		$output .= $this->_compile_session();
		$output .= $this->_compile_session_data();
		// $output .= $this->_compile_config();

		$output .= '</div>';

		return $output;
	}

	/**
	  * Cette fonction génère le code html contenant les données en session, s'il y en a.
	  *
	  * @return Code html contenant les données en session
	  */
	function _compile_session() {
		$output  = "\n\n";
		$output .= '<fieldset style="border:1px solid #009999;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
		$output .= "\n";

		$output .= '<legend style="color:#009999;">&nbsp;&nbsp;' . 'DONNEES SESSION' . '&nbsp;&nbsp;</legend>';
		$output .= "\n";
		if (isset($this->CI->session)) {
			//	Le contenu de la session
			$output = '<table style="width:100%;" id="ci_profiler_session_data">';
			foreach ($this->CI->session->userdata() as $key => $val) {
				if (is_array($val) OR is_object($val)) {
					$val = print_r($val, TRUE);
				}

				$output .= '<tr><td style="padding:5px;vertical-align:top;color:#900;background-color:#ddd;">'
					.$key.'&nbsp;&nbsp;</td><td style="padding:5px;color:#000;background-color:#ddd;">'.htmlspecialchars($val)."</td></tr>\n";
			}
			$output .= "</table>\n";
		} else {
			//	La session est indéfinie
			$output .= "<div style='color:#009999;font-weight:normal;padding:4px 0 4px 0'>"."Aucune donnée SESSION n'existe"."</div>";
		}

		$output .= "</fieldset>";

		return $output;
	}
}