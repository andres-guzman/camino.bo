﻿<?php
$lf_name = "views.txt";
$monthly = 0;
$monthly_path = "oldfiles";
$type = 0;
$beforeTotalText = "Views: ";
$beforeUniqueText = "Unique Visits: ";
$display = 1;
$separator = "<br \>";
$log_file = dirname(__FILE__) . '/' . $lf_name;

if ($_GET['display'] == "true") {
	die("<pre>&#60;? include(\"" . dirname(__FILE__) . '/' . basename(__FILE__) . "\"); ?&#62;</pre>");

} else {
	$uIP = $_SERVER['REMOTE_ADDR'];

	if (file_exists($log_file)) {
		$log = file_get_contents($log_file);

		if ($monthly) {
			if (date('j') == 1) {
				if (!file_exists($monthly_path)) {
					mkdir($monthly_path);
				}
				$prev_name = $monthly_path . '/' . date("n-Y", strtotime("-1 month")) . '.txt';
				if (!file_exists($prev_name)) {
					copy($log_file, $prev_name);

					if ($type == 0) {
						$toWrite = "1";
						$info = $beforeTotalText . "1";
					} else if ($type == 1) {
						$toWrite = "1;" . $uIP . ",";
						$info = $beforeUniqueText . "1";
					} else if ($type == 2) {
						$toWrite = "1;1;" . $uIP . ",";
						$info = $beforeTotalText . "1" . $separator . $beforeUniqueText . "1";
					}
					write_logfile($toWrite, $info);
				}

			} else {
				if ($type == 0) {
					$toWrite = intval($log) + 1;
					$info = $beforeTotalText . $toWrite;

				} else if ($type == 1) {

					$hits = reset(explode(";", $log));
					$IPs = end(explode(";", $log));
					$IPArray = explode(",", $IPs);
					if (array_search($uIP, $IPArray, true) === false) {
						$hits = intval($hits) + 1;
						$toWrite = $hits . ";" . $IPs . $uIP . ",";
					} else {
						$toWrite = $log;
					}

					$info = $beforeUniqueText . $hits;

				} else if ($type == 2) {
					$pieces = explode(";", $log);
					$totalHits = $pieces[0];
					$uniqueHits = $pieces[1];
					$IPs = $pieces[2];
					$IPArray = explode(",", $IPs);
					$totalHits = intval($totalHits) + 1;

					if (array_search($uIP, $IPArray, true) === false) {

						$uniqueHits = intval($uniqueHits) + 1;
						$toWrite = $totalHits . ";" . $uniqueHits . ";" . $IPs . $uIP . ",";
					} else {

						$toWrite = $totalHits . ";" . $uniqueHits . ";" . $IPs;
					}
					$info = $beforeTotalText . $totalHits . $separator . $beforeUniqueText . $uniqueHits;
				}
				write_logfile($toWrite, $info);
			}
		} else {

			if ($type == 0) {
				$toWrite = intval($log) + 1;
				$info = $beforeTotalText . $toWrite;

			} else if ($type == 1) {

				$hits = reset(explode(";", $log));
				$IPs = end(explode(";", $log));
				$IPArray = explode(",", $IPs);

				if (array_search($uIP, $IPArray, true) === false) {

					$hits = intval($hits) + 1;
					$toWrite = $hits . ";" . $IPs . $uIP . ",";
				} else {

					$toWrite = $log;
				}

				$info = $beforeUniqueText . $hits;

			} else if ($type == 2) {

				$pieces = explode(";", $log);
				$totalHits = $pieces[0];
				$uniqueHits = $pieces[1];
				$IPs = $pieces[2];
				$IPArray = explode(",", $IPs);
				$totalHits = intval($totalHits) + 1;

				if (array_search($uIP, $IPArray, true) === false) {
					$uniqueHits = intval($uniqueHits) + 1;
					$toWrite = $totalHits . ";" . $uniqueHits . ";" . $IPs . $uIP . ",";
				} else {

					$toWrite = $totalHits . ";" . $uniqueHits . ";" . $IPs;
				}
				$info = $beforeTotalText . $totalHits . $separator . $beforeUniqueText . $uniqueHits;
			}
			write_logfile($toWrite, $info);
		}
	} else {
		$fp = fopen($log_file, "w");
		fclose($fp);

		if ($type == 0) {
			$toWrite = "1";
			$info = $beforeTotxalText . "1";
		} else if ($type == 1) {
			$toWrite = "1;" . $uIP . ",";
			$info = $beforeUniqueText . "1";
		} else if ($type == 2) {
			$toWrite = "1;1;" . $uIP . ",";
			$info = $beforeTotalText . "1" . $separator . $beforeUniqueText . "1";
		}
		write_logfile($toWrite, $info);
	}
}

function write_logfile($data, $output) {
	global $log_file;

	file_put_contents($log_file, $data);

	if ($display == 1) {
		echo $output;
	}
}
?>
<div id="project-view-modal">
    <div id="project-view-frame">
        <div id="project-view-image">
            <img src="../proyectos/simple-email-interface/full.png" />
        </div>
        
        <div id="project-view-description">
            <div id="project-view-header">
                <h1>Simple email interface</h1>
                <h2>Interface design</h2>
            </div>

            <div id="project-view-text">
				Simple desing of an email client application. I personally like the colors and the fonts used.
            </div>

            <div id="project-view-date">
                January, 2014
            </div>

            <div id="project-view-counter">
                <?php echo $info; ?>
            </div>

            <div id="project-view-download">
                <a href="../proyectos/simple-email-interface/full.png" target="_blank">Download / Full view</a>
            </div>
        </div>
    </div>
	<a class="project-view-close" href="javascript:;" onClick="parent.jQuery.fancybox.close();">
		<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
			<line class="icon_close" x1="1.7" y1="1.7" x2="98.3" y2="98.3" />
			<line class="icon_close" x1="98.3" y1="1.7" x2="1.7" y2="98.3" />
		</svg>
	</a>
</div>