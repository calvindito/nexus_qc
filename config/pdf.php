<?php

return [
	'mode'             => 'utf-8',
	'format'           => 'A4',
    'margin_left'      => 10,
	'margin_right'     => 10,
	'margin_top'       => 10,
	'margin_bottom'    => 10,
	'margin_header'    => 0,
	'margin_footer'    => 0,
    'orientation'      => 'L',
	'creator'          => 'Nexus Quality Control',
	'display_mode'     => 'fullwidth',
	'tempDir'          => base_path('../temp/'),
	'pdf_a'            => false,
	'pdf_a_auto'       => false,
	'continue'         => true,
    'paging'           => true,
    'footer'           => '{PAGENO}',
	'icc_profile_path' => ''
];
