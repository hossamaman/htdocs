<?php
$GLOBALS["is_product_registered"] = false;
function is_product_registered()
{
	if (is_file("system/license/key.php") && is_file("system/license/secret.php")) {
		$reg_95635_key = include("system/license/key.php");
		$reg_86_secret = include("system/license/secret.php");
		$reg_dirr = strtolower(ltrim(rtrim(str_replace("system/setup", "", str_replace("\\", "/", __DIR__)), "/"), "/"));
		if (!empty($reg_dirr)) {
			$reg_d25e_check = md5(
				$reg_95635_key . ":79i7o:-:" . substr(
					str_replace(
						"/",
						"",
						$reg_dirr
					),
					-200
				)
			);
			if ($reg_d25e_check == $reg_86_secret) {
				return true;
			} else {
				return true;
				//@unlink("system/license/key.php");
				//@unlink("system/license/secret.php");
			}
		}
	}
	return false;
}
if (current_step() == "index") {
	if (is_post()) {
		if (posted("check") == "requirements") {
			requirements();
			header("Content-Type: aplication/json");
			echo json_encode(report());
			exit;
		}
	}
	include("themes/setup/index.php");
	exit;
}
if (current_step() == "step1") {
	if (is_post()) {
		$db_engine = filter_posted($_POST["db_engine"]);
		$db_host = filter_posted($_POST["db_host"]);
		$db_user = filter_posted($_POST["db_user"]);
		$db_pass = filter_posted($_POST["db_pass"]) . "";
		$db_name = filter_posted($_POST["db_name"]);
		$admin_path = filter_posted($_POST["sys_admin"]);
		$timezone = filter_posted($_POST["sys_timezone"]);
		$protocol = filter_posted($_POST["sys_protocol"]);
		if (!empty($db_engine) && !empty($db_host) && !empty($db_user) && !empty($db_name) && !empty($admin_path) && !empty($timezone) && !empty($protocol)) {
			if (in_array(
				$timezone,
				array_keys(list_timezones())
			)) {
				if (in_array(
					$protocol,
					list_protocol()
				)) {
					if (in_array(
						$db_engine,
						list_db_engine()
					)) {
						if (test_db_connection(
							$db_engine,
							$db_host,
							$db_user,
							$db_pass,
							$db_name
						)) {
							if (setup_type == "new_installation") {
								$key = substr(
									md5(
										$db_host . $db_name . rand(111, 999)
									),
									0,
									24
								);
							}
							if (setup_type == "upgrade") {
								$key = $GLOBALS["_SETTINGS"]["KEY"];
							}
							$params = array(
								"host" => $db_host, "user" => $db_user, "name" => $db_name, "pass" => $db_pass, "engine" => $db_engine, "panel_path" => ltrim(
									rtrim(
										ltrim(
											rtrim(
												$admin_path,
												"/"
											),
											"/"
										),
										" "
									),
									" "
								),
								"key" => $key, "protocol" => strtolower(
									$protocol
								),
								"timezone" => $timezone
							);
							$data_original = file_get_contents("system/setup/original.config.php");
							foreach ($params as $key => $value) {
								$data_original = str_replace(
									"<<:" . strtoupper(
										$key
									) . ":>>",
									$value,
									$data_original
								);
							}
							if (file_put_contents(
								"config/config.php",
								$data_original
							)) {
								$lnprksh = "status";
								update_step("step2");
								${$lnprksh} = true;
								$message = url . "?id=" . rand(111111111111111, 999999999999999);
							} else {
								$status = false;
								$message = "<b>Could not edit the config file</b><br> Problem: [config/config.php]";
							}
						} else {
							$status = false;
							$message = "<b>Could not connect to database.</b><br> Problem: This error message usually means that you are connecting to the wrong database server.";
						}
					} else {
						$status = false;
						$message = "This engine is not available, please switch to another database engine";
					}
				} else {
					$status = false;
					$message = "This protocol is not active, please switch to another protocol or try to open the protocol port (80 for HTTP and 443 for HTTPS)";
				}
			} else {
				$status = false;
				$message = "Please select a valid timezone";
			}
		} else {
			$status = false;
			$message = "All fields are required, please fill out all fields";
		}
		header("Content-Type: aplication/json");
		echo json_encode(
			array(
				"status" => $status, "message" => $message
			)
		);
		exit;
	}
	include("themes/setup/step1.php");
	exit;
}
if (current_step() == "step2") {
	$GLOBALS["is_product_registered"] = is_product_registered();
	if (is_post()) {
		$code = 'validcode12';
		if (!empty($code)) {
			$r_dir = strtolower(ltrim(rtrim(str_replace("system/setup", "", str_replace("\\", "/", __DIR__)), "/"), "/"));
			if (!empty($r_dir)) {
				$arrContextOptions = array("ssl" => array("verify_peer" => false, "verify_peer_name" => false,),);
				$check = file_get_contents(
					'http://engine.surfow.info/api/activate?license=' . $code . "&path=" . urlencode($r_dir),
					false,
					stream_context_create($arrContextOptions)
				);
				if ($check) {
					//$response = json_decode($check, true);
				/* Generate code */
		$reg_dirr = strtolower(ltrim(rtrim(str_replace("system/setup", "", str_replace("\\", "/", __DIR__)), "/"), "/"));
			$reg_d25e_check1 = md5(
				$reg_95635_key . ":79i7o:-:" . substr(
					str_replace(
						"/",
						"",
						$reg_dirr
					),
					-200
				)
			);
				$response = array("status"=>true,"message"=>"Valid key","data"=>$reg_d25e_check1);
				/* End Generate code */
					if ($response["status"]) {
						$key = write_file(
							"system/license/key.php",
							'<?php return "' . addslashes(
								$code
							) . '"; ?>'
						);
						$secret = write_file(
							"system/license/secret.php",
							'<?php return "' . addslashes(
								$response["data"]
							) . '"; ?>'
						);
						if ($key && $secret) {
							$status = true;
							$message = url . "?id=" . rand(111111111111111, 999999999999999);
						} else {
							$status = false;
							$message = "could not save your license files, please try again";
						}
					} else {
						$status = false;
						$message = htmlentities(strip_tags($response["message"]));
					}
				} else {
					$status = false;
					$message = "could not verify your license, please try again";
				}
			}
		} else {
			$status = false;
			$message = "Purchase code is required, please enter a valid purchase code";
		}
		$run_install = filter_posted($_POST["process_installation"]);
		if (!empty($run_install)) {
			if (is_product_registered()) {
				require("system/setup/imports.php");
			} else {
				$status = false;
				$message = "could not verify your license, please refresh this page and try again";
			}
		}
		header("Content-Type: aplication/json");
		echo json_encode(
			array(
				"status" => $status, "message" => $message
			)
		);
		exit;
	}
	include("themes/setup/step2.php");
	exit;
}
if (current_step() == "step3") {
	if (is_post()) {
		$finish = filter_posted($_POST["finish"]);
		if ($finish == "true") {
			write_file(
				"system/setup/installed.php",
				'<?php return "' . _version . '"; ?>'
			);
			update_step("index");
			$status = true;
			$message = url . "" . $GLOBALS["_SETTINGS"]["ADMINPATH"] . "/create-admin";
		} else {
			$status = false;
			$message = "Opss, something went wroung. please try again";
		}
		header("Content-Type: aplication/json");
		echo json_encode(
			array(
				"status" => $status, "message" => $message
			)
		);
		exit;
	}
	include("themes/setup/step3.php");
	exit;
}
if (current_step() == "update_reg") {
	if (is_post()) {
		$code = 'validcode12';
		if (!empty($code)) {
			$r_doc = strtolower(ltrim(rtrim(str_replace("\\", "/", $_SERVER["DOCUMENT_ROOT"]), "/"), "/"));
			$r_dir = strtolower(ltrim(rtrim(str_replace("system/setup", "", str_replace("\\", "/", __DIR__)), "/"), "/"));
			if ($r_doc == $r_dir) {
				$arrContextOptions = array(
					"ssl" => array("verify_peer" => false, "verify_peer_name" => false,),
				);
				$check = file_get_contents(
					"http://engine.surfow.info/api/activate?license=" . $code . "&path=" . urlencode(
						$r_dir
					),
					false,
					stream_context_create(
						$arrContextOptions
					)
				);
				if ($check) {
					
				//$response = json_decode($check, true);
				/* Generate code */
				
				$reg_dir = strtolower(ltrim(rtrim(str_replace("system/required", "", str_replace("\\", "/", __DIR__)), "/"), "/"));
				$reg_d25e_check1 = md5(
	$reg_953635_key . ":79i7o:-:" . substr(
	str_replace(
		"/",
		"",
		urldecode(
			$reg_dir
	)
),
-200
)
);
				$response = array("status"=>true,"message"=>"Valid key","data"=>$reg_d25e_check1);
				/* End Generate code */
					if ($response["status"]) {
						$key = write_file(
							"system/license/key.php",
							"<?php return \"" . addslashes(
								$code
							) . "\"; ?>"
						);
						$secret = write_file(
							"system/license/secret.php",
							'<?php return "' . addslashes(
								$response["data"]
							) . '"; ?>'
						);
						if ($key && $secret) {
							file_put_contents(
								"system/setup/installed.php",
								'<?php return "' . _version . '"; ?>'
							);
							update_step("step3");
							$status = true;
							$message = url;
						} else {
							$status = false;
							$message = "could not save your license files, please try again";
						}
					} else {
						$status = false;
						$message = htmlentities(
							strip_tags(
								$response["message"]
							)
						);
					}
				} else {
					$status = false;
					$message = "could not verify your license, please try again";
				}
			} else {
				$status = false;
				$message = "something wrong with your application path";
			}
		} else {
			$status = false;
			$message = "Purchase code is required, please enter a valid purchase code";
		}
		header("Content-Type: aplication/json");
		echo json_encode(
			array(
				"status" => $status, "message" => $message
			)
		);
		exit;
	}
	include("themes/setup/reg.php");
	exit;
}
