<?php
// https://whereisscihub.now.sh
define( 'SCI_HUB', 'https://sci-hub.se' );
class SciHubIfy extends Plugin {
	private $host;

	function about() {
		return array("1.0.0",
			"Convert DOI and other links to Sci-Hub links",
			"joshu@unfettered.net");
	}

	function init($host) {
		$this->host = $host;
		$host->add_hook($host::HOOK_ARTICLE_BUTTON, $this);
	}

	function hook_article_button($line) {

		$img = "<img id=\"SciHubIfy\" src=\"plugins.local/scihubify/raven.grey.jpg\"
			title='".__('Sci-Hub Unavailable')."'>";

		$walls = array( 'doi.org',
						'onlinelibrary.wiley.com',
						'link.springer.com',
						'www.sciencedirect.com',
						'tandfonline.com'
					);

		$link = $line['link'];
		foreach ( $walls as $wall ) {
			if (strpos($link, $wall) !== false) {
				$img = "<img id=\"SciHubIfy\" src=\"plugins.local/scihubify/raven.black.jpg\"
						class='tagsPic' style=\"cursor: pointer;\"
						onclick=\"window.open('".SCI_HUB."/$link', '_blank')\"
						title='".__('Sci-Hub Available')."'>";
				break;
			}
		}

		return $img;
	}

	function api_version() {
		return 2;
	}
}
?>
