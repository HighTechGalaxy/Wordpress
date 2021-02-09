How to change the XML sitemap URL using Yoast Plugin

To custom sitemap name you can do step by step:
1. Go to inc\sitemaps in plugin folder
2. Edit file class-sitemaps-router.php
3. /**
	 * Redirects sitemap.xml to sitemap_index.xml.
	 */
	public function template_redirect() {
		if ( ! $this->needs_sitemap_index_redirect() ) {
			return;
		}

		wp_safe_redirect( home_url( '/sitemap_index.xml' ), 301, 'Yoast SEO' );
		exit;
	}





