<?php
function write_file($path, $content)
{
	$fileSystem = new Symfony\Component\Filesystem\Filesystem();
	try {
		$fileSystem->dumpFile(
			$path,
			$content
		);
		$status = true;
		$GLOBALS["tmp_writed_files"][$path] = $content;
	} catch (Symfony\Component\Filesystem\Exception\IOExceptionInterface$exception) {
		$status = false;
	}
	if ($status) return true;
	return false;
}
function read_file($path)
{
	if (isset($GLOBALS["tmp_writed_files"][$path])) {
		return $GLOBALS["tmp_writed_files"][$path];
	} else {
		if (is_file($path)) return file_get_contents($path);
	}
}
function update_step($step)
{
	@chmod(step_file, 0777);
	write_file(step_file, "<?php return " . $step . "; ?>");
}
