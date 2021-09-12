<?php
${"GLOBALS"}["sbgoyfs"] = "prurl";
${"GLOBALS"}["svscundrd"] = "timenow";
${"GLOBALS"}["rrvriaym"] = "function_name";
${"GLOBALS"}["oqdxkhyesnul"] = "exptime";
${"GLOBALS"}["ifvcuxvd"] = "resp";
${"GLOBALS"}["yiieuov"] = "privatekey";
${"GLOBALS"}["qlvtpvm"] = "reCAPTCHA";
${"GLOBALS"}["gmgysbc"] = "code";
${"GLOBALS"}["bmtyntglvr"] = "format";
${"GLOBALS"}["wfjgitnotw"] = "time";
${"GLOBALS"}["fesjolelfl"] = "name";
${"GLOBALS"}["yzxisn"] = "avatarRating";
${"GLOBALS"}["houxwpkb"] = "gravatarURL";
${"GLOBALS"}["oseoygyeepg"] = "size";
${"GLOBALS"}["tpmhkbnxu"] = "defaultImage";
${"GLOBALS"}["fngcufxbuvf"] = "email";
${"GLOBALS"}["hnihwig"] = "file";
${"GLOBALS"}["uwrxagga"] = "table";
${"GLOBALS"}["gdorjr"] = "info";
${"GLOBALS"}["yubhqwktvou"] = "op";
${"GLOBALS"}["qqrpgrdg"] = "infos";
${"GLOBALS"}["mlxuvofds"] = "url";
${"GLOBALS"}["mpwcgzxyib"] = "inside";
${"GLOBALS"}["sjnocyr"] = "mixed";
${"GLOBALS"}["wnnphfgooj"] = "params";
${"GLOBALS"}["lzkjnwg"] = "u_id";
${"GLOBALS"}["ycebmiqkdbee"] = "data";
${"GLOBALS"}["pwktidrmfv"] = "reg_dir";
${"GLOBALS"}["dicfpgfqh"] = "reg_953635_key";
${"GLOBALS"}["nbsggigkqx"] = "reg_896_secret";
${"GLOBALS"}["tlgsfjexspfe"] = "path";
${"GLOBALS"}["jxqdcpyf"] = "status";
${"GLOBALS"}["yjmxdcnrnpe"] = "content";
${"GLOBALS"}["cgfkkmdo"] = "fileSystem";
${"GLOBALS"}["tpmpmyr"] = "value";
${"GLOBALS"}["kyofigoisu"] = "key";
${"GLOBALS"}["pdhmcdlbi"] = "route";
use Jenssegers\Date\Date;
Date::setLocale(Languages::current_language());
function is_routed($route)
{
	return Check::is_routed(
		${${"GLOBALS"}["pdhmcdlbi"]
	}
);
}
function set($key = "", $value = "")
{
	Sys::set(
		${${"GLOBALS"}["kyofigoisu"]
	},
	${${"GLOBALS"}["tpmpmyr"]
}
);
}
function get($key)
{
	${"GLOBALS"}["dtrzmq"] = "key";
	return Sys::get(
		${${"GLOBALS"}["dtrzmq"]
	}
);
}
function _get($key)
{
	echo Sys::get(
		${${"GLOBALS"}["kyofigoisu"]
	}
);
}
function write_file($path, $content)
{
	${${"GLOBALS"}["cgfkkmdo"]
} = new Symfony\Component\Filesystem\Filesystem();
try {
	${"GLOBALS"}["ugcmftsxxhdp"] = "path";
	$ofskrqiw = "status";
	$fileSystem->dumpFile(
		${${"GLOBALS"}["ugcmftsxxhdp"]
	},
	${${"GLOBALS"}["yjmxdcnrnpe"]
}
);
$qomcolnyd = "path";
${$ofskrqiw} = true;
$GLOBALS["tmp_writed_files"][${$qomcolnyd}] = ${${"GLOBALS"}["yjmxdcnrnpe"]
};
} catch (Symfony\Component\Filesystem\Exception\IOExceptionInterface$exception) {
	${${"GLOBALS"}["jxqdcpyf"]
} = false;
}
if (${${"GLOBALS"}["jxqdcpyf"]
}) return true;
return false;
}
${"GLOBALS"}["ucloyc"] = "reg_dir";
function read_file($path)
{
	if (isset($GLOBALS["tmp_writed_files"][${${"GLOBALS"}["tlgsfjexspfe"]
}])) {
	${"GLOBALS"}["ulckjtgncrgg"] = "path";
	return $GLOBALS["tmp_writed_files"][${${"GLOBALS"}["ulckjtgncrgg"]
}];
} else {
	$kwulwx = "path";
	$ahvsefoswgms = "path";
	if (is_file(${$ahvsefoswgms})) return file_get_contents(${$kwulwx});
}
}
if (is_file("system/license/key.php") && is_file("system/license/secret.php")) {
	${"GLOBALS"}["fburcevukgt"] = "reg_953635_key";
	${${"GLOBALS"}["fburcevukgt"]
} = include("system/license/key.php");
${${"GLOBALS"}["nbsggigkqx"]
} = include("system/license/secret.php");
} else {
	$qtsjwfoqg = "reg_896_secret";
	${${"GLOBALS"}["dicfpgfqh"]
} = rand(100000, 999999999);
${$qtsjwfoqg} = rand(100000, 999999999);
}
${${"GLOBALS"}["pwktidrmfv"]
} = strtolower(ltrim(rtrim(str_replace("system/required", "", str_replace("\\", "/", __DIR__)), "/"), "/"));
if (!empty(${${"GLOBALS"}["ucloyc"]
})) {
	$GLOBALS[base64_decode("c3VyZm93")] = base64_decode("c3VyZm93");
	${"GLOBALS"}["nlbyrui"] = "reg_d3s25e_check";
	$GLOBALS[base64_decode("aW5zdGFsbGF0aW9u")] = base64_decode("aW5zdGFsbGF0aW9u");
	$GLOBALS[base64_decode("Y29uZmlndXJl")] = base64_decode("Y29uZmlndXJl");
	$GLOBALS[base64_decode("c2V0dGluZ3Nfc3RhdHVz")] = base64_decode("bG9hZGVk");
	$dmiivmwvk = "reg_d3s25e_check";
	function filter_route($data)
	{
		return ${${"GLOBALS"}["ycebmiqkdbee"]
	};
}
$hixprbds = "reg_896_secret";
${${"GLOBALS"}["nlbyrui"]
} = md5(
	${${"GLOBALS"}["dicfpgfqh"]
} . ":79i7o:-:" . substr(
	str_replace(
		"/",
		"",
		urldecode(
			${${"GLOBALS"}["pwktidrmfv"]
		}
	)
),
-200
)
);
if (${$dmiivmwvk} == ${$hixprbds}) {
	write_file(
		"system/setup/config/current.php",
		'<?php return "' . update_reg .'"; ?>'
	);
	@unlink("system/setup/installed.php");
	header("location: " . Sys::url() . "?id=" . rand(111111111111111, 999999999999999));
	exit;
} else {
	function auth_web_s($u_id, $s_id)
	{
		$xodygwsxpn = "s_id";
		return Exchange::authorize_web_session(
			${${"GLOBALS"}["lzkjnwg"]
		},
		${$xodygwsxpn}
	);
}
}
} else {
	exit("INVALID PATH");
}
function router($route, $params = "", $mixed = false, $inside = false)
{
	${"GLOBALS"}["vernjxonx"] = "params";
	$crxjdsfobo = "inside";
	$vghlifhvs = "params";
	${"GLOBALS"}["pjpdfkjksb"] = "params";
	if (!empty(${$vghlifhvs}) && !is_array(
		${${"GLOBALS"}["pjpdfkjksb"]
	}
)) {
	$uficwsespb = "params";
	${"GLOBALS"}["zypgkmgrdce"] = "params";
	${${"GLOBALS"}["zypgkmgrdce"]
} = json_decode(${$uficwsespb}, true);
}
if (empty(${${"GLOBALS"}["wnnphfgooj"]
})) ${${"GLOBALS"}["wnnphfgooj"]
} = array();
${"GLOBALS"}["vpdpvzmyckkq"] = "mixed";
return Template::route(
	${${"GLOBALS"}["pdhmcdlbi"]
},
${${"GLOBALS"}["vernjxonx"]
},
${${"GLOBALS"}["vpdpvzmyckkq"]
},
${$crxjdsfobo}
);
}
function _router($route, $params = array (), $mixed = false, $inside = false)
{
	$mvbreespumm = "route";
	echo router(
		${$mvbreespumm},
		${${"GLOBALS"}["wnnphfgooj"]
	},
	${${"GLOBALS"}["sjnocyr"]
},
${${"GLOBALS"}["mpwcgzxyib"]
}
);
}
function to_router($route, $params = array ())
{
	$mbvhtms = "route";
	${${"GLOBALS"}["mlxuvofds"]
} = Template::route(
	${$mbvhtms},
	${${"GLOBALS"}["wnnphfgooj"]
}
);
header(
	"location: " . ${${"GLOBALS"}["mlxuvofds"]
}
);
}
function l($key, $value = "")
{
	$ytbjkck = "key";
	${$ytbjkck} = strip_tags(
		${${"GLOBALS"}["kyofigoisu"]
	}
);
if (!empty($GLOBALS["\x5fLN\x47"][${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["k\x79\x6f\x66i\x67o\x69\x73\x75"]
}])) {
	${"G\x4c\x4f\x42\x41L\x53"}["\x70\x71\x75\x6f\x69e\x79\x62\x64"] = "\x6b\x65\x79";
	return $GLOBALS["_\x4c\x4e\x47"][${${"\x47\x4c\x4fB\x41\x4c\x53"}["\x70\x71\x75oi\x65\x79\x62\x64"]
}];
} else {
	return ${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x74pm\x70\x6dy\x72"]
};
}
}
function _l($key, $value = "")
{
	${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x69\x66\x62y\x64t\x6f\x68\x66\x69j"] = "va\x6c\x75\x65";
	echo l(
		${${"\x47\x4c\x4f\x42AL\x53"}["\x6by\x6f\x66\x69\x67\x6f\x69\x73\x75"]
	},
	${${"\x47\x4cOB\x41L\x53"}["\x69\x66\x62\x79d\x74\x6f\x68\x66ij"]
}
);
}
function _s($key)
{
	echo Settings::get(
		${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x6byo\x66igo\x69\x73\x75"]
	}
);
}
function s($key)
{
	return Settings::get(
		${${"\x47\x4c\x4fB\x41\x4c\x53"}["\x6b\x79\x6f\x66\x69\x67\x6fis\x75"]
	}
);
}
function af($key)
{
	$mtsccfkjcpet = "key";
	$xdzfmpug = "\x69\x6e\x66o\x73";
	${$xdzfmpug} = Auth::user_settings("\x61\x66f\x69l\x69a\x74\x65");
	return ${${"\x47L\x4f\x42A\x4c\x53"}["\x71\x71rpg\x72dg"]
}
[${$mtsccfkjcpet}];
}
function _af($key)
{
	$fkkbrrm = "\x6b\x65\x79";
	echo af(${$fkkbrrm});
}
function w($key)
{
	$ybbjkub = "\x69\x6e\x66\x6fs";
	${"G\x4cO\x42\x41\x4c\x53"}["\x79\x6d\x64\x76\x6a\x78\x66\x6e\x6f\x68\x6d"] = "\x6be\x79";
	${"\x47\x4c\x4f\x42A\x4c\x53"}["\x64\x6c\x62\x62\x72q"] = "\x69n\x66\x6f\x73";
	${$ybbjkub} = Auth::user_settings("\x77a\x6c\x6cet");
	return ${${"G\x4c\x4fB\x41\x4c\x53"}["\x64\x6c\x62\x62r\x71"]
}
[
	${${"\x47\x4c\x4f\x42\x41L\x53"}["\x79\x6ddv\x6a\x78\x66\x6e\x6f\x68\x6d"]
}
];
}
function _w($key)
{
	echo w(
		${${"\x47LO\x42\x41\x4c\x53"}["\x6byo\x66\x69\x67oisu"]
	}
);
}
function _old($name = "")
{
	$ontsmqqz = "\x6e\x61m\x65";
	echo Request::old(${$ontsmqqz});
}
function url($op = "", $prtcl = "", $mixed = false, $inside = false)
{
	${"GLO\x42\x41L\x53"}["rk\x6cn\x69f\x76\x65\x73"] = "p\x72\x74cl";
	return Sys::url(
		${${"G\x4c\x4fBA\x4cS"}["\x79u\x62\x68q\x77\x6b\x74\x76\x6fu"]
	},
	${${"\x47\x4c\x4f\x42\x41L\x53"}["\x72\x6bln\x69\x66v\x65s"]
},
${${"G\x4c\x4f\x42\x41\x4c\x53"}["\x73\x6a\x6eo\x63\x79\x72"]
},
${${"G\x4cO\x42\x41LS"}["m\x70\x77\x63\x67\x7ax\x79\x69b"]
}
);
}
function _url($op = "", $prtcl = "", $mixed = false, $inside = false)
{
	$wbhjokzbvr = "\x6f\x70";
	${"\x47\x4cO\x42AL\x53"}["\x66\x76p\x73n\x6a\x77r"] = "pr\x74\x63\x6c";
	echo url(
		${$wbhjokzbvr},
		${${"\x47LOB\x41\x4cS"}["\x66vp\x73\x6ej\x77\x72"]
	},
	${${"\x47L\x4f\x42\x41\x4c\x53"}["sj\x6e\x6fc\x79\x72"]
},
${${"\x47\x4cOB\x41LS"}["\x6dp\x77c\x67\x7a\x78y\x69\x62"]
}
);
}
function turl()
{
	return Template::url();
}
function _turl()
{
	echo turl();
}
function u($key = "")
{
	$ckdocrzb = "i\x6ef\x6f";
	${${"GL\x4f\x42\x41\x4cS"}["g\x64\x6fr\x6ar"]
} = Auth::info();
return ${$ckdocrzb}[
	${${"G\x4cO\x42\x41\x4c\x53"}["\x6byof\x69\x67\x6f\x69\x73u"]
}
];
}
function _u($key = "")
{
	$kbxbueqk = "\x6b\x65y";
	echo u(${$kbxbueqk});
}
function auth($table = "users")
{
	return Auth::check(
		${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x75\x77\x72xa\x67g\x61"]
	}
);
}
function storage($file)
{
	$vlfyniil = "\x66i\x6c\x65";
	return Sys::url() . "/u\x70\x6co\x61\x64s/" . ${$vlfyniil};
}
function _storage($file)
{
	echo Sys::url() . "/\x75pl\x6fads/" . ${${"\x47LO\x42\x41\x4c\x53"}["\x68\x6e\x69\x68w\x69\x67"]
};
}
function gravatar($email, $size = 200)
{
	$unanfrukef = "\x75\x73\x65\x72s\x45\x6d\x61i\x6c";
	${$unanfrukef} = strip_tags(
		${${"\x47L\x4f\x42\x41\x4c\x53"}["f\x6e\x67\x63u\x66\x78bu\x76\x66"]
	}
);
${"\x47\x4c\x4f\x42\x41L\x53"}["t\x77\x74\x6f\x76\x76\x6d\x75\x6e"] = "a\x76\x61\x74a\x72\x52\x61\x74\x69n\x67";
${"G\x4c\x4f\x42A\x4cS"}["\x75\x6e\x69m\x65v\x6b\x67\x6e\x6f\x6f"] = "de\x66\x61ul\x74Im\x61\x67\x65";
${${"GL\x4fB\x41\x4c\x53"}["\x74\x70m\x68\x6b\x62\x6exu"]
} = urlencode(
	"\x68\x74tp://w\x77w\x2egrava\x74\x61r\x2eco\x6d/\x61v\x61tar/ad\x3516503\x61\x311cd\x35ca\x343\x35\x61\x63\x639b\x62652\x3353\x36?\x73\x69\x7ae=" . ${${"GL\x4fBA\x4c\x53"}["\x6fs\x65\x6f\x79\x67\x79\x65\x65\x70g"]
}
);
${${"G\x4cO\x42\x41L\x53"}["\x74\x77t\x6f\x76\x76\x6d\x75n"]
} = "G";
$metjttreiaoa = "\x75s\x65r\x73\x45\x6d\x61i\x6c";
${${"\x47LO\x42\x41\x4c\x53"}["h\x6f\x75x\x77p\x6b\x62"]
} = "\x68tt\x70://\x77ww.\x67rava\x74\x61\x72.c\x6fm/\x61\x76\x61\x74a\x72.php?\x67r\x61\x76\x61t\x61r_i\x64=" . md5(${$metjttreiaoa}) . "&\x64\x65\x66au\x6ct=" . ${${"\x47\x4c\x4fB\x41LS"}["u\x6e\x69\x6d\x65v\x6b\x67n\x6f\x6f"]
} . "\x26si\x7a\x65\x3d" . ${${"\x47\x4c\x4fB\x41LS"}["\x6f\x73\x65o\x79\x67\x79\x65epg"]
} . "\x26r\x61\x74\x69\x6eg=" . ${${"G\x4c\x4f\x42A\x4cS"}["\x79zx\x69s\x6e"]
};
${"\x47\x4c\x4f\x42\x41LS"}["\x74rbh\x62\x6ab"] = "g\x72\x61\x76\x61\x74\x61\x72\x55R\x4c";
return ${${"\x47\x4cO\x42\x41\x4c\x53"}["\x74r\x62h\x62j\x62"]
};
}
function _gravatar($email, $size = 200)
{
	echo gravatar(
		${${"\x47\x4cO\x42\x41\x4c\x53"}["\x66\x6e\x67c\x75\x66\x78\x62\x75vf"]
	},
	${${"\x47LO\x42\x41LS"}["\x6f\x73\x65\x6fy\x67yee\x70\x67"]
}
);
}
function avatar($file = "", $email = "", $size = 200)
{
	${"\x47L\x4fBA\x4c\x53"}["k\x77\x6d\x69n\x66\x65hx\x6d"] = "\x66\x69le";
	${"G\x4c\x4f\x42\x41\x4c\x53"}["w\x6a\x66\x6a\x68\x6d\x63"] = "e\x6d\x61\x69\x6c";
	${${"\x47\x4cOB\x41\x4c\x53"}["\x77j\x66\x6ah\x6d\x63"]
} = strip_tags(
	${${"\x47L\x4f\x42\x41\x4cS"}["\x66\x6e\x67\x63u\x66\x78bu\x76\x66"]
}
);
${${"\x47\x4c\x4f\x42A\x4c\x53"}["\x68\x6ei\x68wig"]
} = strip_tags(
	${${"\x47\x4cOB\x41L\x53"}["\x6bwmi\x6efe\x68x\x6d"]
}
);
if (!empty(${${"\x47L\x4f\x42A\x4c\x53"}["\x68\x6eih\x77ig"]
})) {
	${"\x47\x4cOB\x41L\x53"}["\x6d\x6eyg\x69gdl\x6b"] = "\x66\x69\x6ce";
	return Sys::urlfile(
		${${"\x47\x4c\x4f\x42\x41L\x53"}["mn\x79\x67\x69g\x64\x6c\x6b"]
	}
);
} else {
	return gravatar(
		${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["f\x6e\x67\x63\x75\x66\x78\x62u\x76\x66"]
	},
	${${"GL\x4f\x42A\x4c\x53"}["\x6f\x73eo\x79g\x79eep\x67"]
}
);
}
}
function _avatar($file = "", $email = "", $size = 200)
{
	${"G\x4c\x4f\x42\x41\x4c\x53"}["\x71\x66\x6d\x6b\x72\x78\x6b"] = "\x73\x69z\x65";
	echo avatar(
		${${"\x47\x4c\x4f\x42\x41L\x53"}["\x68\x6e\x69h\x77\x69g"]
	},
	${${"\x47\x4cO\x42\x41\x4c\x53"}["\x66\x6eg\x63ufx\x62\x75\x76f"]
},
${${"G\x4cOB\x41\x4cS"}["q\x66m\x6b\x72xk"]
}
);
}
function event($name)
{
	$wqegkih = "\x6e\x61\x6d\x65";
	Events::add_event(${$wqegkih});
}
function do_action($name, $on)
{
	$lmwvpkcr = "on";
	Events::do_action(
		${${"\x47\x4cOB\x41L\x53"}["f\x65s\x6a\x6f\x6c\x65\x6c\x66\x6c"]
	},
	${$lmwvpkcr}
);
}
function cdate($format, $time = "")
{
	${"\x47\x4c\x4f\x42\x41\x4cS"}["\x6ay\x68\x6ar\x66\x71\x74\x6f"] = "\x74\x69\x6d\x65";
	if (empty(${${"\x47\x4cOBAL\x53"}["\x6a\x79\x68\x6a\x72\x66\x71t\x6f"]
})) ${${"G\x4c\x4fB\x41L\x53"}["w\x66j\x67i\x74\x6e\x6ft\x77"]
} = time();
return Date::parse(
	${${"\x47\x4c\x4f\x42\x41L\x53"}["wfj\x67it\x6e\x6f\x74\x77"]
},
$GLOBALS["\x5f\x53\x45\x54T\x49NG\x53"]["\x54\x49\x4dEZON\x45"]
)->format(
	${${"\x47\x4c\x4f\x42A\x4c\x53"}["\x62mty\x6et\x67\x6c\x76\x72"]
}
);
}
function time_ago($time)
{
	$vxcmunzsnft = "\x74\x69\x6d\x65";
	return Date::parse(floor(${$vxcmunzsnft}-time()) . " \x73ec\x6fn\x64", $GLOBALS["\x5f\x53\x45T\x54\x49\x4eG\x53"]["TI\x4dE\x5aON\x45"])->diffForHumans();
}
function put_recaptcha()
{
	echo "\x3c\x64\x69v\x20c\x6c\x61s\x73\x3d\"g-r\x65captcha\x22\x20\x64ata-\x73ite\x6be\x79\x3d\"" . s("reca\x70t\x63\x68a/publi\x63key") . "\x22\x3e</di\x76\x3e\x3csc\x72i\x70t \x74y\x70\x65=\x22\x74\x65x\x74/j\x61\x76\x61s\x63\x72i\x70t\x22 src=\x22https://\x77\x77w.\x67\x6f\x6fgle.\x63\x6f\x6d/\x72\x65c\x61\x70t\x63\x68\x61/\x61\x70\x69\x2e\x6a\x73?\x68\x6c\x3d" . Languages::current_language() . "\x22>\x3c/scr\x69pt>";
}
function check_recaptcha()
{
	$tkxtpeyonon = "c\x6fd\x65";
	${${"\x47LOBA\x4cS"}["\x67\x6d\x67\x79\x73\x62c"]
} = Request::post("\x67-\x72ec\x61p\x74ch\x61-respons\x65");
$ecgmtmuxb = "\x70\x72\x69\x76\x61\x74\x65\x6b\x65y";
${"\x47\x4cO\x42\x41LS"}["\x74\x6d\x64\x77\x68k\x69\x65\x70\x72"] = "\x63\x6f\x64e";
if (empty(${$tkxtpeyonon})) return false;
${$ecgmtmuxb} = s("\x72ecap\x74\x63h\x61/\x70r\x69vatekey");
${${"\x47\x4c\x4f\x42A\x4c\x53"}["\x71\x6cv\x74\x70\x76m"]
} = new \ReCaptcha\ReCaptcha(
	${${"G\x4c\x4f\x42A\x4c\x53"}["\x79\x69\x69e\x75o\x76"]
}
);
${${"\x47\x4c\x4f\x42AL\x53"}["i\x66\x76\x63\x75\x78\x76\x64"]
} = $reCAPTCHA->verify(
	${${"G\x4c\x4f\x42\x41LS"}["\x74\x6d\x64\x77\x68\x6bi\x65pr"]
},
Sys::ip()
);
if ($resp->isSuccess()) {
	return true;
} else {
	return false;
}
}
function put_session_key()
{
	$jbfylnbc = "\x65\x78\x70\x74\x69\x6d\x65";
	${${"G\x4c\x4fB\x41L\x53"}["\x6fq\x64\x78\x6bh\x79\x65sn\x75\x6c"]
} = Encryption::encode(time() + 1000);
${${"\x47\x4cO\x42\x41\x4c\x53"}["\x72\x72\x76\x72i\x61\x79m"]
} = "\x53" . str_replace(array("_", "/", "-"), "", Encryption::randomstring(8));
${${"\x47L\x4fBALS"}["\x79c\x65\x62\x6diq\x6b\x64\x62\x65e"]
} = "\x3csc\x72ipt\x3ef\x75\x6ect\x69on " . ${${"G\x4c\x4f\x42\x41\x4c\x53"}["r\x72\x76\x72\x69\x61y\x6d"]
} . "(n,v,x) { \x76\x61\x72 d \x3d\x20ne\x77\x20D\x61t\x65();\x20\x64\x2e\x73e\x74\x54im\x65(\x64.\x67\x65\x74\x54ime()\x20+ (\x78*24*60*\x36\x30*1\x300\x30));\x20v\x61\x72 ex =\x20\"exp\x69r\x65\x73=\x22+d\x2e\x74o\x55\x54\x43S\x74rin\x67()\x3b do\x63\x75m\x65n\x74\x2ec\x6fo\x6bi\x65\x20\x3d\x20n + \"\x3d\"\x20+\x20v\x20+\x20\x22\x3b\x20\x70at\x68\x3d/\x3b \"\x20+\x20ex\x3b} \x73e\x74Ti\x6deout(\x66u\x6e\x63\x74i\x6fn(){ " . ${${"\x47\x4cO\x42\x41\x4c\x53"}["r\x72v\x72\x69\x61\x79m"]
} . "(\"s\x65ss\x69\x6f\x6e_\x65\x78\x70ti\x6d\x65\", \"" . ${$jbfylnbc} . "\x22, 1)\x3b\x20},\x2010\x30\x30)\x3b\x3c/\x73\x63\x72i\x70t>";
echo ${${"GL\x4f\x42\x41L\x53"}["\x79\x63ebm\x69qk\x64b\x65\x65"]
};
}
function check_session_key()
{
	${${"\x47L\x4fB\x41\x4cS"}["\x6f\x71\x64x\x6bhy\x65\x73nu\x6c"]
} = Cookie::get("\x73\x65ss\x69\x6f\x6e_e\x78\x70t\x69\x6d\x65");
$pwofviljhy = "\x65x\x70\x74i\x6de";
${${"\x47\x4cO\x42ALS"}["\x73\x76\x73\x63\x75nd\x72d"]
} = time();
${"\x47\x4cO\x42\x41\x4cS"}["\x76\x66\x63y\x63\x77\x64\x73"] = "t\x69\x6de\x6e\x6f\x77";
if (!empty(${${"GL\x4f\x42\x41\x4c\x53"}["\x6f\x71\x64\x78\x6b\x68y\x65\x73\x6e\x75\x6c"]
}) && ${$pwofviljhy} > ${${"G\x4c\x4fB\x41\x4c\x53"}["\x76f\x63\x79\x63\x77\x64\x73"]
}) {
	return true;
}
return false;
}
function current_language()
{
	return Languages::current_language();
}
function langauge_align()
{
	return Languages::text_align();
}
function direction()
{
	return Languages::direction();
}
function fv($url)
{
	${${"\x47LOB\x41L\x53"}["\x73b\x67\x6f\x79\x66\x73"]
} = parse_url(
	${${"\x47LO\x42\x41L\x53"}["m\x6cx\x75\x76o\x66ds"]
}
);
${"\x47\x4cO\x42\x41\x4c\x53"}["g\x66\x72\x73\x77\x6ct"] = "\x70\x72\x75r\x6c";
$host = ${${"\x47\x4c\x4fB\x41\x4cS"}["\x67\x66rs\x77\x6ct"]
}
["ho\x73t"];
if (!empty($host)) {
	${${"\x47\x4cO\x42A\x4c\x53"}["m\x6c\x78\x75v\x6f\x66\x64s"]
} = "\x68\x74\x74p\x73://\x77\x77\x77.\x67o\x6f\x67\x6c\x65\x2e\x63\x6f\x6d/s2/\x66avi\x63o\x6e\x73?domai\x6e\x3d" . $host;
$yfmbnpjd = "\x75r\x6c";
return ${$yfmbnpjd};
} else {
	return Sys::urlfile("\x75\x70lo\x61d\x73/\x64e\x66a\x75\x6c\x74\x66\x61v\x69c\x6fn\x2esv\x67");
}
}
function _fv($url)
{
	echo fv(
		${${"G\x4c\x4fBA\x4cS"}["\x6d\x6c\x78\x75\x76o\x66\x64s"]
	}
);
}
