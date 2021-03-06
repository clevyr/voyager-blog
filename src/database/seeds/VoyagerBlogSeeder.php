<?php

namespace Clevyr\VoyagerBlog\Database\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Permission;

class VoyagerBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Blog Menu */

        $blog_menu = DB::table('menu_items')->insertGetId([
            'menu_id' => 1,
            'title' => 'Blog',
            'url' => '',
            'target' => '_self',
            'icon_class' => 'voyager-file-text',
            'color' => null,
            'parent_id' => null,
            'order' => 15,
            'created_at' => Carbon::now()->toDateTime(),
            'updated_at' => Carbon::now()->toDateTime(),
            'route' => null,
            'parameters' => null
        ]);

        /* Blog Posts */

        // Data Types Posts
        $post_id = DB::table('data_types')->insertGetId([
            'name' => 'blog_posts',
            'slug' => 'blog-posts',
            'display_name_singular' => 'Blog Post',
            'display_name_plural' => 'Blog Posts',
            'icon' => 'voyager-pen',
            'model_name' => 'App\BlogPost',
            'description' => 'Blog Posts Management',
            'generate_permissions' => true,
            'created_at' => Carbon::now()->toDateTime(),
            'updated_at' => Carbon::now()->toDateTime(),
            'server_side' => false,
            'controller' => 'App\Http\Controllers\VoyagerBlogController'
        ]);

        // Permissions
        Permission::generateFor('blog_posts');

        // Data Rows
        DB::table('data_rows')->insert([
            [
                'data_type_id' => $post_id,
                'field'        => 'id',
                'type'         => 'number',
                'display_name' => 'ID',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ],
            [
                'data_type_id' => $post_id,
                'field'        => 'title',
                'type'         => 'text',
                'display_name' => 'Title',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ],
            [
                'data_type_id' => $post_id,
                'field'        => 'slug',
                'type'         => 'text',
                'display_name' => 'Slug',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'       => json_encode([
                    'slugify' => [
                        'origin' => 'title'
                    ]
                ]),
                'order' => 3,
            ],
            [
                'data_type_id' => $post_id,
                'field'        => 'author',
                'type'         => 'number',
                'display_name' => 'Author',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'       => '',
                'order' => 4,
            ],
            [
                'data_type_id' => $post_id,
                'field'        => 'blog_post_belongsto_user_relationship',
                'type'         => 'relationship',
                'display_name' => 'Author',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => json_encode([
                    'model' => 'App\\User',
                    'table' => 'users',
                    'type' => 'belongsTo',
                    'column' => 'author',
                    'key' => 'id',
                    'label' => 'name',
                    'pivot_table' => 'migrations',
                    'pivot' => '0',
                    'taggable' => '0',
                    'display' => [
                        'width' => '5'
                    ]
                ]),
                'order' => 5,
            ],
            [
                'data_type_id' => $post_id,
                'field'        => 'published_at',
                'type'         => 'date',
                'display_name' => 'Publish Post on',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => json_encode([
                    'format' => '%Y-%m-%d',
                    'display' => [
                        'width' => '5'
                    ]
                ]),
                'order' => 6
            ],
            [
                'data_type_id' => $post_id,
                'field'        => 'published',
                'type'         => 'checkbox',
                'display_name' => 'Published',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => json_encode([
                    "on"  => "Published",
                    "off" => "Draft",
                    "checked" => false,
                    'display' => [
                        'width' => '2'
                    ]
                ]),
                'order' => 7
            ],
            [
                'data_type_id' => $post_id,
                'field'        => 'blog_post_belongstomany_blog_tag_relationship',
                'type'         => 'relationship',
                'display_name' => 'Tags',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => json_encode([
                    'model' => 'App\\BlogTag',
                    'table' => 'blog_tags',
                    'type' => 'belongsToMany',
                    'column' => 'id',
                    'key' => 'id',
                    'label' => 'title',
                    'pivot_table' => 'blog_post_tags',
                    'pivot' => '1',
                    'taggable' => 'on'
                ]),
                'order'        => 8
            ],
            [
                'data_type_id' => $post_id,
                'field'        => 'summary',
                'type'         => 'text_area',
                'display_name' => 'Summary',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ],
            [
                'data_type_id' => $post_id,
                'field'        => 'lb_content',
                'type'         => 'Gutenburg',
                'display_name' => 'Content',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 9,
            ],
            [
                'data_type_id' => $post_id,
                'field'        => 'created_at',
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => json_encode([
                    'format' => '%Y-%m-%d'
                ]),
                'order' => 10,
            ],
            [
                'data_type_id' => $post_id,
                'field'        => 'updated_at',
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => json_encode([
                    'format' => '%Y-%m-%d'
                ]),
                'order' => 11,
            ]
        ]);

        // Menu
        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'title' => 'Posts',
            'url' => '',
            'target' => '_self',
            'icon_class' => 'voyager-pen',
            'color' => null,
            'parent_id' => $blog_menu,
            'order' => 1,
            'created_at' => Carbon::now()->toDateTime(),
            'updated_at' => Carbon::now()->toDateTime(),
            'route' => 'voyager.blog-posts.index',
            'parameters' => null
        ]);

        /* Blog Tags */

        // Data Types Tags
        $tags_id = DB::table('data_types')->insertGetId([
            'name' => 'blog_tags',
            'slug' => 'blog-tags',
            'display_name_singular' => 'Blog Tag',
            'display_name_plural' => 'Blog Tags',
            'icon' => 'voyager-categories',
            'model_name' => 'App\BlogTag',
            'description' => 'Blog Tag Management',
            'generate_permissions' => true,
            'created_at' => Carbon::now()->toDateTime(),
            'updated_at' => Carbon::now()->toDateTime(),
            'server_side' => false,
            'controller' => 'App\Http\Controllers\VoyagerBlogTagsController'
        ]);

        // Permissions
        Permission::generateFor('blog_tags');

        // Data Rows
        DB::table('data_rows')->insert([
            [
                'data_type_id' => $tags_id,
                'field'        => 'id',
                'type'         => 'number',
                'display_name' => 'ID',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ],
            [
                'data_type_id' => $tags_id,
                'field'        => 'title',
                'type'         => 'text',
                'display_name' => 'Title',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ],
            [
                'data_type_id' => $tags_id,
                'field'        => 'slug',
                'type'         => 'text',
                'display_name' => 'Slug',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'       => json_encode([
                    'slugify' => [
                        'origin' => 'title'
                    ]
                ]),
                'order' => 3,
            ],
            [
                'data_type_id' => $tags_id,
                'field'        => 'created_at',
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => json_encode([
                    'format' => '%Y-%m-%d'
                ]),
                'order' => 4,
            ],
            [
                'data_type_id' => $tags_id,
                'field'        => 'updated_at',
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => json_encode([
                    'format' => '%Y-%m-%d'
                ]),
                'order' => 5,
            ]
        ]);

        // Menu
        DB::table('menu_items')->insert([
            'menu_id' => 1,
            'title' => 'Tags',
            'url' => '',
            'target' => '_self',
            'icon_class' => 'voyager-categories',
            'color' => null,
            'parent_id' => $blog_menu,
            'order' => 2,
            'created_at' => Carbon::now()->toDateTime(),
            'updated_at' => Carbon::now()->toDateTime(),
            'route' => 'voyager.blog-tags.index',
            'parameters' => null
        ]);

        // Get base menu
        $menu = DB::table('menus')->where('id', 1)->first();

        if ($menu) {
            // Clear cache
            Cache::forget('voyager_menu_' . $menu->name);
        }
    }
}
