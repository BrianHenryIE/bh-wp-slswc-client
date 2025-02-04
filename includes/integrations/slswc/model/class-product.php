<?php

// "product": {
// "software": 1,
// "software_type": "plugin",
// "allow_staging": "yes",
// "renewal_period": "annual",
// "software_slug": "a-plugin",
// "version": "",
// "author": "",
// "required_wp": "",
// "compatible_to": "",
// "updated": "",
// "activations": "1",
// "staging_activations": "3",
// "description": "",
// "change_log": "",
// "installation": "",
// "documentation_link": "",
// "banner_low": "",
// "banner_high": "",
// "update_file_id": "40bb2001-48c3-4633-995a-447aa82b491d",
// "update_file_url": "https:\/\/updatestest.bhwp.ie\/wp-content\/uploads\/woocommerce_uploads\/2024\/05\/bh-wp-autologin-urls.2.3.0-alozbb.zip",
// "update_file_name": "bh-wp-autologin-urls.2.3.0-alozbb.zip",
// "update_file": {
// "id": "40bb2001-48c3-4633-995a-447aa82b491d",
// "file": "https:\/\/updatestest.bhwp.ie\/wp-content\/uploads\/woocommerce_uploads\/2024\/05\/bh-wp-autologin-urls.2.3.0-alozbb.zip",
// "name": "bh-wp-autologin-urls.2.3.0-alozbb.zip"
// },
// "thumbnail": false
// }

namespace BrianHenryIE\WP_Plugin_Updater\Integrations\SLSWC\Model;

use BrianHenryIE\WP_Plugin_Updater\Model\Plugin_Info_Interface;

class Product implements Plugin_Info_Interface {

	public function __construct(
		protected int $software,
		protected string $software_type,
		protected string $allow_staging,
		protected string $renewal_period,
		protected string $software_slug,
		protected string $version,
		protected string $author,
		protected string $required_wp,
		protected string $compatible_to,
		protected string $updated,
		protected string $activations,
		protected string $staging_activations,
		protected string $description,
		protected string $change_log,
		protected string $installation,
		protected string $documentation_link,
		protected string $banner_low,
		protected string $banner_high,
		protected string $update_file_id,
		protected string $update_file_url,
		protected string $update_file_name,
		protected Update_File $update_file,
		protected bool $thumbnail // TODO: this looks wrong.
	) {
	}

	public function get_software(): int {
		return $this->software;
	}

	public function get_software_type(): string {
		return $this->software_type;
	}

	public function get_allow_staging(): string {
		return $this->allow_staging;
	}

	public function get_renewal_period(): string {
		return $this->renewal_period;
	}

	public function get_software_slug(): string {
		return $this->software_slug;
	}

	public function get_version(): string {
		return $this->version;
	}

	public function get_author(): string {
		return $this->author;
	}

	public function get_required_wp(): string {
		return $this->required_wp;
	}

	public function get_compatible_to(): string {
		return $this->compatible_to;
	}

	public function get_updated(): string {
		return $this->updated;
	}

	public function get_activations(): string {
		return $this->activations;
	}

	public function get_staging_activations(): string {
		return $this->staging_activations;
	}

	public function get_description(): string {
		return $this->description;
	}

	public function get_change_log(): string {
		return $this->change_log;
	}

	public function get_installation(): string {
		return $this->installation;
	}

	public function get_documentation_link(): string {
		return $this->documentation_link;
	}

	public function get_banner_low(): string {
		return $this->banner_low;
	}

	public function get_banner_high(): string {
		return $this->banner_high;
	}

	public function get_update_file_id(): string {
		return $this->update_file_id;
	}

	public function get_update_file_url(): ?string {
		return $this->update_file_url;
	}

	public function get_update_file_name(): string {
		return $this->update_file_name;
	}

	public function get_update_file(): Update_File {
		return $this->update_file;
	}

	public function is_thumbnail(): bool {
		return $this->thumbnail;
	}

	public function get_sections(): array {
		return array(
			'changelog' => $this->get_change_log(),
		);
	}

	public function get_name(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_slug(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_author_profile(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_contributors(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_requires(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_tested(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_requires_php(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_requires_plugins(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_compatibility(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_rating(): int {
		throw new \Exception( 'not implemented' );
	}

	public function get_ratings(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_num_ratings(): int {
		throw new \Exception( 'not implemented' );
	}

	public function get_support_url(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_support_threads(): int {
		throw new \Exception( 'not implemented' );
	}

	public function get_support_threads_resolved(): int {
		throw new \Exception( 'not implemented' );
	}

	public function get_active_installs(): int {
		throw new \Exception( 'not implemented' );
	}

	public function get_downloaded(): int {
		throw new \Exception( 'not implemented' );
	}

	public function get_last_updated(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_added(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_homepage(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_short_description(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_download_link(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_upgrade_notice(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_screenshots(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_tags(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_stable_tag(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_versions(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_business_model(): ?string {
		throw new \Exception( 'not implemented' );
	}

	public function get_repository_url(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_commercial_support_url(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_donate_link(): string {
		throw new \Exception( 'not implemented' );
	}

	public function get_banners(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_icons(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_blocks(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_block_assets(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_author_block_count(): int {
		throw new \Exception( 'not implemented' );
	}

	public function get_author_block_rating(): int {
		throw new \Exception( 'not implemented' );
	}

	public function get_blueprints(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_preview_link(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_language_packs(): array {
		throw new \Exception( 'not implemented' );
	}

	public function get_block_translations(): array {
		throw new \Exception( 'not implemented' );
	}
}
