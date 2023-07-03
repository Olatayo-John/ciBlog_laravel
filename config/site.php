<?php

return [
	'userSettings' => [
		[
			'title' => 'Notify me by',
			'meta_key' => 'notify_me_by',
			'meta_value' => ['Mail', 'In-app', 'Slack', 'Telegram'],
			'meta_value_default' => 'In-app',
			'is_array' => true
		],
		[
			'title' => 'Default Profile Image',
			'meta_key' => 'default_profile_image',
			'meta_value' => ['Male', 'Female', 'No Image'],
			'meta_value_default' => 'No Image',
			'is_array' => true
		]
	],
	'postSettings' => [
		[
			'title' => 'Allow comment',
			'meta_key' => 'allow_comment',
			'meta_value' => ['Yes', 'No'],
			'meta_value_default' => 'Yes',
			'is_array' => true
		],
		[
			'title' => 'Show to guest',
			'meta_key' => 'show_to_guest',
			'meta_value' => ['Yes', 'No'],
			'meta_value_default' => 'Yes',
			'is_array' => true
		]
	],
	'roles' => ['Admin', 'User', 'Staff'],
	'permissions' => [
		[
			'title' => 'Post Create',
			'name' => 'post_create',
			'roles' => ['Admin', 'User'],
		],
		[
			'title' => 'Post Edit',
			'name' => 'post_edit',
			'roles' => ['Admin', 'User'],
		],
		[
			'title' => 'Post Update',
			'name' => 'post_update',
			'roles' => ['Admin', 'User'],
		],
		[
			'title' => 'Post Delete',
			'name' => 'post_delete',
			'roles' => ['Admin', 'User'],
		],
		[
			'title' => 'Comment Create',
			'name' => 'comment_create',
			'roles' => ['Admin', 'User'],
		],
		[
			'title' => 'Comment Edit',
			'name' => 'comment_edit',
			'roles' => ['Admin', 'User'],
		],
		[
			'title' => 'Comment Update',
			'name' => 'comment_update',
			'roles' => ['Admin', 'User'],
		],
		[
			'title' => 'Comment Delete',
			'name' => 'comment_delete',
			'roles' => ['Admin', 'User', 'Staff'],
		],
		[
			'title' => 'Profile',
			'name' => 'profile',
			'roles' => ['Admin', 'User', 'Staff'],
		],
		[
			'title' => 'Profile Edit',
			'name' => 'profile_edit',
			'roles' => ['Admin', 'User', 'Staff'],
		],
		[
			'title' => 'Profile Update',
			'name' => 'profile_update',
			'roles' => ['Admin', 'User', 'Staff'],
		],
		[
			'title' => 'Profile Delete',
			'name' => 'profile_delete',
			'roles' => ['User', 'Staff'],
		]
	],
	'genders' => ['Male', 'Female', 'Others'],
	'postImages' => [''],
];
