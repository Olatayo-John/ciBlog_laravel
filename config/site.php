<?php

return [
	'userSettings' => [
		[
			'title' => 'Notify me by',
			'meta_key' => 'notify_me_by',
			'meta_value' => ['Mail', 'In-app', 'Slack', 'Telegram'],
			'meta_value_default' => 'Mail',
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
	'newUserRole' => ['User', 'Staff'],
	'permissions' => [
		[
			'title' => 'Post Create',
			'name' => 'post_create',
			'roles' => ['Admin', 'User', 'Staff'],
		],
		[
			'title' => 'Post Edit',
			'name' => 'post_edit',
			'roles' => ['Admin', 'User', 'Staff'],
		],
		[
			'title' => 'Post Update',
			'name' => 'post_update',
			'roles' => ['Admin', 'User', 'Staff'],
		],
		[
			'title' => 'Post Delete',
			'name' => 'post_delete',
			'roles' => ['Admin', 'User', 'Staff'],
		],
		[
			'title' => 'Comment Create',
			'name' => 'comment_create',
			'roles' => ['Admin', 'User', 'Staff'],
		],
		[
			'title' => 'Comment Edit',
			'name' => 'comment_edit',
			'roles' => ['Admin', 'User', 'Staff'],
		],
		[
			'title' => 'Comment Update',
			'name' => 'comment_update',
			'roles' => ['Admin', 'User', 'Staff'],
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
		],
		[
			'title' => 'Admin Dashboard',
			'name' => 'admin_dashboard',
			'roles' => ['Admin', 'Staff'],
		],
		[
			'title' => 'Authorization',
			'name' => 'authorization',
			'roles' => ['Admin', 'Staff'],
		],
		[
			'title' => 'Users',
			'name' => 'users',
			'roles' => ['Admin', 'Staff'],
		],
		[
			'title' => 'User Create',
			'name' => 'user_create',
			'roles' => ['Admin', 'Staff'],
		],
		[
			'title' => 'User View',
			'name' => 'user_view',
			'roles' => ['Admin', 'Staff'],
		],
		[
			'title' => 'User Edit',
			'name' => 'user_edit',
			'roles' => ['Admin', 'Staff'],
		],
		[
			'title' => 'User Update',
			'name' => 'user_update',
			'roles' => ['Admin', 'Staff'],
		],
		[
			'title' => 'User Delete',
			'name' => 'user_delete',
			'roles' => ['Admin', 'Staff'],
		],
		[
			'title' => 'User Role Update',
			'name' => 'user_role_update',
			'roles' => ['Admin', 'Staff'],
		]
	],
	'genders' => ['Male', 'Female', 'Others'],
	'postImages' => [''],
];
