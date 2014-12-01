<?php
include("./header.php");
require('../../ts-yt-dl-defaults/ts-yt-dl');
echo "<link rel=\"stylesheet\" href=\"./style/content_list.css\">";
?>
<body>
	<div id="content">
	<?php
	if (isset($_GET['search']) && !empty($_GET['search'])) {
		$search = $_GET['search'];
		echo "<p>Search results for <i>\"$search\"</i></p>";
		echo "<table id=\"media_table\">
				<tr>
					<th class=\"medium_cell\"><h4>TS Ref. Number</h4></th>
					<th class=\"large_cell\"><h4>Title</h4></th>
					<th class=\"medium_cell\"><h4>File Size</h4></th>
				</tr>";
		$count = 0;
		$dir = scandir("$data_path/$userid/videos/");
		foreach ($dir as $timestamp) {
			if ($timestamp != "." && $timestamp != "..") {
				$file = scandir("$data_path/$userid/videos/$timestamp");
				foreach ($file as $video) {
					if ($video != "." && $video != "..") {
						$ext = pathinfo($video, PATHINFO_EXTENSION);
						if ($ext == 'mp4') {
							if (stristr($video, $search)) {
								$count++;
								echo "<tr>";
									echo "<td class=\"medium_cell\">".$timestamp."</td>";
									echo "<td class=\"large_cell\"><a href=\"./play_media.php?timestamp=".$timestamp."&media=".$video."&page=videos\"><h4 class=\"media_title\">&#9658 ".$video."</h4></a></td>";
									echo "<td class=\"medium_cell\">". number_format(filesize("$data_path/$userid/videos/".$timestamp."/".$video) / 1024, 2) ." KB</td>";
								echo "</tr>";
							}
						}
					}
				}
			}
		}
		echo "$count results found:";
		echo "</table>";
	}
	?>
