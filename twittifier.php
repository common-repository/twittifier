<?php
/*
Plugin Name: twittifier
Plugin URI: http://blog.dahousecat.net/twittifier/
Description: Notifica a tus Followers en Twitter cuando haz escrito un nuevo post.
Version: 2.0
Author: DaHouseCat
Author URI: http://blog.dahousecat.net/
*/

include_once('inc/JSON.php');
include_once(ABSPATH.WPINC."/class-snoopy.php");

	$refresh = $_REQUEST['refresht'];
	
	switch ($refresh) {
		case "1" : {
				echo twittifier_stats(get_option("twittifier_regstats"));
				die ();
		}
		case "2" : {
				echo twittifier_cleanStats ();
				die();				
		}
		case "3" : {
				echo twittifier_check_login ();
				die();				
		}
	}


function twittifier_panel () {
	global $wpdb;
    
	$tuser = $_POST['usuario_twitter'];
	$tpass = $_POST['pass_twitter'];
	$buser =$_POST['usuario_bitly'];
	$apikey = $_POST['API_Key'];
	$prepost = $_POST['pre_titulo'];
	$denlace = $_POST['despues_enlace'];
	$regstats = $_POST['regstats'];
	$p_info = $_POST['p_info'];
	$p_explicacion = $_POST['p_explicacion'];
	$ok = $_POST['ok'];
	$deltables = $_POST['deltables'];
	
	if (isset($tuser)) {
		$prev_tuser = get_option("twittifier_tuser");
		if ($prev_tuser != $tuser)
			$ch_tuser = 1;
		update_option("twittifier_tuser",$tuser);
		}
		
	
	if (isset($tpass)) {
		$prev_tpass = get_option("twittifier_tpass");
		if ($prev_tpass != $tpass)
			$ch_pass = 1;
		update_option("twittifier_tpass",$tpass);
	}
	
	if (isset($buser))
		update_option("twittifier_buser",$buser);	
		
	if (isset($apikey))
		update_option("twittifier_bapikey",$apikey);
		
	if (isset($prepost))
		update_option("twittifier_prepost",$prepost);
		
	if (isset($denlace))
		update_option("twittifier_denlace",$denlace);
	
	if (isset($regstats))
		update_option("twittifier_regstats",$regstats);
		
	if (isset($ok)) {
		if (isset($p_info)) {
			update_option("twittifier_p_info",$p_info);
			}
		else {
			$p_info = 0;
			update_option("twittifier_p_info",$p_info);
		}
	
		if (isset($p_explicacion)){
			update_option("twittifier_p_explicacion",$p_explicacion);
		}
		else {
			$p_explicacion = 0;
			update_option("twittifier_p_explicacion",$p_explicacion);
		}
		
		if (isset($deltables)) {
			update_option("twittifier_deltables",$deltables);
		}
		else {
			$deltables = 0;
			update_option("twittifier_deltables",$deltables);
		}
	}
?>
<div class="wrap">
<h2>Twittifier!</h2>
<br />

<div style="width:500px; margin-right:10px; float: left">
<form action="" method="post" name="twittifier">
<?php if (!get_option("twittifier_p_info")) { ?>
       <table width="450" class="widefat">
      <thead>
        <tr>
          <th><div align="left">Información importante:</div></th>
        </tr>
       </thead>
        <tr>
          <td><div align="left"><p>Este plugin requiere para funcionar, que el usuario tenga una cuenta en <a href="http://www.twitter.com/" target="_blank">Twitter</a> y una cuenta en <a href="http://bit.ly/" target="_blank">Bit.ly</a>.</p><p>Lo anterior con la finalidad de poder obtener información estadística de cuantas visitas entraron a través de <a href="http://www.twitter.com/" target="_blank">Twitter</a>.</p>

<p>Si tu cuenta de <a href="http://bit.ly/" target="_blank">Bit.ly</a> es nueva, por ello antes de poder utilizar el API, tienes que acortar una url desde tu panel, es decir; te logueas dentro de tu panel y acortas una URL cualquiera así <a href="http://bit.ly/" target="_blank">Bit.ly</a> sabe que no eres un robot intentando atacar el sistema.</p>

              <p>A partir de<strong> Twittifier!</strong> 2.0se incluyen nuevas características como: Twitteo de posts programados, estadísticas actualizadas con ajax cada 5 segundos, la posibilidad de vaciar la tabla de estadísticas, al desinstalar borrar todo rastro de <strong>Twittifier!</strong> y la ocultación de paneles de Información.</p>
              <p><strong>¡Disfrutalo!</strong></p>
          </div></td>
        </tr>
      </table><br />
<?php } ?>
      
<table width="450" class="widefat">
<thead>
<tr>
  <th colspan="2"><div align="left"><strong>Por favor, escriba sus datos de Acceso a <a href="http://www.twitter.com/" target="_blank">Twitter</a>:</strong></div></th>
</tr>
</thead>
<tr>
<td width="77"><div align="left">Usuario:</div></td>
<td width="361"><input onfocus="resetTextArea (this.id)" id="usuario_twitter" name="usuario_twitter" type="text" size="40" value="<?php echo get_option("twittifier_tuser");?>" /></td>
</tr>
<tr>
<td width="77"><div align="left">Contraseña:</div></td>
<td width="361"><input onfocus="resetTextArea (this.id)" id="pass_twitter" name="pass_twitter" size="40" type="password" value="<?php echo get_option("twittifier_tpass");?>" />
</td>
</tr>
<tr>
<td width="77"></td>
<td width="361">
<input id="checkLogin" class="button" type="button" value="Probar Login" />
<span id="statusLogin"></span>
</td>
</tr>
</table>
<br />
<table width="450" class="widefat">
<thead>
<tr>
  <th colspan="2"><div align="left"><strong>Introduzca sus datos <a href="http://bit.ly/" target="_blank">Bit.ly</a> a continuación:</strong></div></th>
</tr>
</thead>
<tr>
  <td width="70"><div align="left">Usuario:</div></td>
  <td width="368"><input onfocus="resetTextArea (this.id)" id="usuario_bitly" name="usuario_bitly" type="text" size="40" value="<?php echo get_option("twittifier_buser");?>" /></td>
  </tr>
<tr>
  <td width="70"><div align="left">API Key:</div></td>
  <td width="368"><input onfocus="resetTextArea (this.id)" id="API_Key" name="API_Key" size="40" value="<?php echo get_option("twittifier_bapikey");?>" /></td>
  </tr>
</table>
<br />

<table width="450" class="widefat">
<thead>
<tr>
  <th colspan="2"><strong>Los siguientes datos aparecerán en el Twitt:</strong></th>
  </tr>
<tr>
</thead>
  <td width="181">Antes del Titulo del Post:</td>
  <td width="257"><input onfocus="resetTextArea (this.id)" id="pre_titulo" name="pre_titulo" type="text" size="40" value="<?php echo get_option("twittifier_prepost");?>" /><br /><small>Campo Opcional</small></td>
  </tr>
<tr>
  <td width="181">Después del enlace del Post:</td>
  <td width="257"><input onfocus="resetTextArea (this.id)" id="despues_enlace" name="despues_enlace" size="40" value="<?php echo get_option("twittifier_denlace");?>" /><br /><small>Campo Opcional</small>
</td>
  </tr>
</table><br />

<table width="450" class="widefat">
<thead>
<tr>
  <th colspan="2"><div align="left"><strong>Configure algunas opciones extras:</strong></div></th>
</tr>
</thead>
<tr>
  <td width="249"><div align="left">Cantidad de Registros para Estad&iacute;sticas:</div></td>
  <td width="189"><input id="regstats" name="regstats" type="text" size="4" value="<?php echo get_option("twittifier_regstats");?>" /></td>
  </tr>
<tr>
  <td width="249"><div align="left">Ocultar Panel de Información importante:</div></td>
  <td width="189"><input type="checkbox" name="p_info" id="p_info" <?php if (get_option("twittifier_p_info")){ echo "checked=\"checked\""; }?> value="1" /></td>
  </tr>
<tr>
  <td>Ocultar Panel de Explicación:</td>
  <td><input type="checkbox" name="p_explicacion" id="p_explicacion" <?php if (get_option("twittifier_p_explicacion")){ echo "checked=\"checked\""; }?> value="1" /></td>
</tr>
<tr>
  <td>Tabla de Estadísticas:</td>
  <td><input class="button" type="button" name="limpiat" id="limpiat" value="Vaciar Ahora" /></td>
</tr>
<tr>
  <td>Eliminar Tablas al Desinstalar:</td>
  <td><input type="checkbox" name="deltables" id="deltables" <?php if (get_option("twittifier_deltables")){ echo "checked=\"checked\""; }?> value="1" /></td>
</tr>
</table>
<br />
<input class="button" name="ok" type="submit" value="Guardar Opciones" />
</form>

</div>
    <div style="float:left; width:470px;">
      <table width="467" class="widefat">
      <thead>
        <tr>
          <th width="276"><div align="left">&Uacute;ltimos <?php echo get_option("twittifier_regstats"); ?> posts twitteados</div></th>
          <th width="130"><div align="left">Bit.ly</div></th>
          <th width="45"><div align="left">Clics</div></th>
        </tr>
       </thead>
       <tbody id="table">
			 <?php echo twittifier_stats(get_option("twittifier_regstats")); ?>
        </tbody>
      </table>
      
      <br />
<?php if (!get_option("twittifier_p_explicacion")) { ?>      
<table width="467" class="widefat">
<thead>
<tr>
  <th colspan="2"><div align="left"><strong>Explicación:</strong></div></th>
  </tr>
 </thead>
<tr>
  <td colspan="2"><div align="center"><img src="../wp-content/plugins/twittifier/picts/desc-twitt.jpg" alt="Desc-Twitt" width="450" height="150" longdesc="Descripción del Twitt" /><br />
Explicación de la estructura que utiliza <strong>Twittifier</strong>!</div></td>
  </tr>
  </table><br />

  
<?php } ?>
     <div style="text-align:left">
     <table width="467" class="widefat">
    <thead>
    <tr>
      <th colspan="2"><div align="left"><strong>Créditos:</strong></div></th>
      </tr>
     </thead>
    <tr>
      <td colspan="2"><div align="center"><img src="../wp-content/plugins/twittifier/picts/twittifier-logo-175x85.png" alt="Twittifier!" longdesc="Logotipo de Twittifier!" /><p>Escrito por <a href="http://blog.dahousecat.net/">DaHouseCat</a> (carlosm@dahousecat.net)</p>
      <p>Twittifier! 2.0 es Orgullosamente Mexicano.</p>
      </div></td>
      </tr>
      </table>
     	
    </div>
</div>    

<?php
}

function post2twitter($post_ID) {
	require_once(ABSPATH.WPINC."/class-snoopy.php");
	global $wpdb;
	$table_name = $wpdb->prefix . "twittifier_stats";
	$post_title = get_the_title($post_ID);
	$longurl = get_permalink($post_ID);
	
	$original_post_status = $_POST['original_post_status'];
	$post_status = $_POST['post_status'];
	
	$sql = "SELECT * FROM $table_name WHERE post_id=$post_ID";
	$posted = $wpdb->get_var($sql);
	
	if ($original_post_status != 'publish') 
	{
	
		if (!$posted)
		{
			$snoopy = new Snoopy;
			$snoopy->agent = "DaHouseCat http://blog.dahousecat.net/";
			$login = get_option("twittifier_buser");
			$apiKey = get_option("twittifier_bapikey");	
			
			$snoopy->submit ("http://api.bit.ly/shorten",array("version" => "2.0.1","longUrl" => $longurl,"login" => $login,"apiKey" => $apiKey));
	
			$results = $snoopy->results;
	   
			$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
			$input = $json->decode($results);
			$shorturl = $input["results"][$longurl]["shortUrl"];
			
			$prepost = get_option("twittifier_prepost");
			$msg =  $prepost;
			if (strlen($post_title)>1){
				$msg .= " ";
				$msg .= "$post_title";
				$msg .= " $shorturl";
				$msg .= " ".get_option("twittifier_denlace");
				$twitterText = $msg;
				
				$sql ="INSERT INTO $table_name (post_id,short_url) VALUES ('$post_ID','$shorturl')";
				$wpdb->query($sql);
				$snoopy->user = get_option("twittifier_tuser");//"TU_USUARIO_DE_TWITTER_AQUI";
				$snoopy->pass = get_option("twittifier_tpass");//"TU_CLAVE_DE_TWITTER_AQUI";
				$snoopy->submit("http://twitter.com/statuses/update.json", array("status" => $twitterText));
			}	
		}
	}
}

function twittifier_check_login () {
	global $wpdb;
	$user = get_option("twittifier_tuser");
	$pass = get_option("twittifier_tpass");
	$twitterText = "Este es un Twitt de Prueba :)";

	$snoopy = new Snoopy;
	$snoopy->agent = "DaHouseCat http://blog.dahousecat.net/";
	$snoopy->user = get_option("twittifier_tuser");//"TU_USUARIO_DE_TWITTER_AQUI";
	$snoopy->pass = get_option("twittifier_tpass");//"TU_CLAVE_DE_TWITTER_AQUI";
	$snoopy->submit("http://twitter.com/statuses/update.json", array("status" => $twitterText));
	$codigo_respuesta = $snoopy->response_code;
	 		
	if (strstr($codigo_respuesta,"200 OK")) { 
		$results = $snoopy->results;
		$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
		$input = $json->decode($results);
		$twiitID = $input["id"];
		$msg ="Login Correcto ".$twiitID;

	} else {
		$msg = "Login Incorrecto ".$codigo_respuesta.get_option("twittifier_tpass");
	}
	
	return $msg;
}

function twittifier_stats($max) {
	global $wpdb;
	
	$snoopy = new Snoopy;
	$snoopy->agent = "DaHouseCat http://blog.dahousecat.net/";
	$login = get_option("twittifier_buser");
	$apiKey = get_option("twittifier_bapikey");	
	$table_name = $wpdb->prefix . "twittifier_stats";
	$sql ="SELECT * FROM $table_name ORDER BY id desc LIMIT 0,$max";
	
	$stats = $wpdb->get_results ($sql);
	
	$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
	
	foreach ($stats as $campo) {
	
		$shorturl = $campo->short_url;
		$snoopy->submit ("http://api.bit.ly/stats",array("version" => "2.0.1","shortUrl" => $shorturl,"login" => $login,"apiKey" => $apiKey));
	   	$results = $snoopy->results;
   
   		
		$input = $json->decode($results);
		$clics = $input["results"]["clicks"];
		
		$printStats .= "<tr><td>";
		$post_ID = $campo->post_id;
		$post_title = get_the_title($post_ID);
		$printStats .= $post_title;
		$printStats .= "</td><td>";
		$printStats .= "<a href=\"$shorturl\" target=\"_blank\">".$shorturl."</a>";
		$printStats .= "</td><td>";
		$printStats .= $clics;
		$printStats .= "</td></tr>";
	}

	return $printStats;
}

function twittifier_cleanStats() {
	global $wpdb;
	$table_name = $wpdb->prefix . "twittifier_stats";
	$conservar = get_option ("twittifier_regstats");
	$reg_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name;");
	$limit = $reg_count - $conservar;
	$sql = "DELETE FROM $table_name WHERE 1 ORDER BY id ASC LIMIT $limit";
	if ($wpdb->query ($sql)) {
		return $limit;
	} else {
		return 0;
	}	
}


function twittifier_install () {
	global $wpdb;	
	$table_name = $wpdb->prefix . "twittifier_stats";
	if($wpdb->get_var("show tables like '$table_name'") != $table_name)
	{
		$sql = "CREATE TABLE ".$table_name." (
			id int not null auto_increment primary key,
			post_id int not null,
			short_url varchar(20) not null
			);";
		add_option("twittifier_tuser","usuario-twitter");
		add_option("twittifier_tpass","123456");
		add_option("twittifier_buser","utilizame!");
		add_option("twittifier_bapikey","Escribe tu API Key");
		add_option("twittifier_prepost","Del Blog:");
		add_option("twittifier_denlace","#TrendTopic");
		add_option("twittifier_regstats","10");
		add_option("twittifier_p_info","0");
		add_option("twittifier_p_explicacion","0");
		add_option("twittifier_deltables","0");
	} 
	else
	{
		$sql = "ALTER TABLE ".$table_name." ADD id INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;";
		add_option("twittifier_regstats","10");
		add_option("twittifier_p_info","0");
		add_option("twittifier_p_explicacion","0");
		add_option("twittifier_deltables","0");
	}
	
	$wpdb->query ($sql);

}

function twittifier_uninstall () {
	if (get_option("twittifier_deltables")) {
		global $wpdb;
		$table_name = $wpdb->prefix . "twittifier_stats";
		$sql = "DROP TABLE $table_name";
		$wpdb->query ($sql);
		$opts = "SELECT option_id FROM $wpdb->options WHERE option_name LIKE '%twittifier%'";
		$options4del = $wpdb->get_col($opts);
		for ($d=0; $d<count($options4del); $d++) {
			$sql = "DELETE FROM $wpdb->options WHERE option_id='".$options4del[$d]."'";
			$wpdb->query ($sql);
		}
	}
}

function twittifier_init() {
	wp_enqueue_script('thickbox');
}

function twittifier_css() {
	echo "<link rel=\"stylesheet\" href=\"".get_settings('siteurl')."/wp-includes/js/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />";
}

function twittifier_js () {

wp_enqueue_script('twiitifier_js',
 '/' . PLUGINDIR . '/twittifier/inc/scripts.js',
 array('jquery'),
 '1.2.6' );
}

function twittifier_add_menu () {
	if (function_exists('add_options_page')) {
		$page = add_options_page('Twittifier', 'Twittifier', 8, basename(__FILE__), 'twittifier_panel');
		add_action ("admin_print_scripts-$page",'twittifier_js');
	}
}




if (function_exists('add_action')) {
	add_action('admin_menu', 'twittifier_add_menu');
	add_action('activate_twittifier/twittifier.php','twittifier_install');
	add_action('deactivate_twittifier/twittifier.php','twittifier_uninstall');
	add_action ('publish_post', 'post2twitter');
	add_action ('wp_print_scripts','twittifier_init');
	add_action ('wp_head','twittifier_css');
	
}

?>
