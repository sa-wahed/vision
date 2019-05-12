<?php

$config = 
[
'admin_login' =>
    [
        [
        'field' => 'username',
        'label' => 'User Name',
        'rules' => 'required|trim',
        'errors' => 
            [
                'required' => 'Please input your Username',
            ]
        ],
        
        [
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required',
        'errors' =>
            [
                'required' => 'You must input Password',
            ]
         ]
    ],
    
'foote_validition' =>
    [
        [
        'field' => 'footer_text',
        'label' => 'Footer Text',
        'rules' => 'required|trim',
        'errors' => 
            [
                'required' => 'Footer Filled can not be empty',
            ]
        ],
        
    ],   
    
'post_validation' =>
    [
        [
        'field' => 'post_title',
        'label' => 'Titel',
        'rules' => 'required|trim',
       
        ],
        [
        'field' => 'post_description',
        'label' => 'Description',
        'rules' => 'required|trim',
       
        ],
        [
        'field' => 'post_category',
        'label' => 'Category',
        'rules' => 'required|trim',
       
        ],
        [
        'field' => 'post_tags[]',
        'label' => 'Tag',
        'rules' => 'trim',
       
        ],
        [
        'field' => 'post_seo',
        'label' => 'Post SEO',
        'rules' => 'trim',
       
        ],

    ], 
'post_search' =>
    [
        [
        'field' => 'post_title',
        'label' => 'Title',
        'rules' => 'required',
       
        ],

    ],
 // Start category   
'category_insert' =>
    [
        [
        'field' => 'cat_name',
        'label' => 'Category Name',
        'rules' => 'required|trim|is_unique[tbl_category.cat_name]',
       
        ],
        [
        'field' => 'cat_status',
        'label' => 'Status',
        'rules' => 'required|trim|max_length[1]',
       
        ],

    ],   
'category_search' =>
    [
        [
        'field' => 'cat_name',
        'label' => 'Category Name',
        'rules' => 'required',
       
        ],

    ],   
'category_edit' =>
    [
        [
        'field' => 'cat_name',
        'label' => 'Category Name',
        'rules' => 'required|trim|is_unique[tbl_category.cat_name]',
        'errors' => 
            [
                'required' => 'Category Edit filled can not be empty',
            ]
        ],
        [
        'field' => 'cat_unid',
        'label' => ' ',
        'rules' => 'required|trim',
        
        ],

    ],   
// end category //


// start tag //    
'tag_insert' =>
    [
        [
        'field' => 'tag_name',
        'label' => 'Tag Name',
        'rules' => 'required|trim|is_unique[tbl_tag.tag_name]',
       
        ],
        [
        'field' => 'tag_status',
        'label' => 'Status',
        'rules' => 'required|trim|max_length[1]',
       
        ],

    ],   
'tag_search' =>
    [
        [
        'field' => 'tag_name',
        'label' => 'Tag Name',
        'rules' => 'required',
       
        ],

    ],   
'tag_edit' =>
    [
        [
        'field' => 'tag_name',
        'label' => 'Tag Name',
        'rules' => 'required|trim|is_unique[tbl_tag.tag_name]',
        'errors' => 
            [
                'required' => 'Tag Edit filled can not be empty',
            ]
        ],
        [
        'field' => 'tag_unid',
        'label' => ' ',
        'rules' => 'required|trim',
        
        ],

    ],       
// End Tag 
    
// Start Navigation
'navigation_insert' =>
    [
        [
        'field' => 'nav_name',
        'label' => 'Navigation Name',
        'rules' => 'required|trim|is_unique[tbl_navigation.nav_name]',
       
        ],
    ],   
   
'navigation_edit' =>
    [
        [
        'field' => 'nav_name',
        'label' => 'Navigation Name',
        'rules' => 'required|trim|is_unique[tbl_navigation.nav_name]',
        'errors' => 
            [
                'required' => 'Navigation Edit filled can not be empty',
            ]
        ],
        [
        'field' => 'nav_unid',
        'label' => ' ',
        'rules' => 'required|trim',
        
        ],

    ],    
    
// END Navigation //

// START ATTACH Menu //
    
'attach_menu' =>
    [
        [
        'field' => 'nav_id',
        'label' => ' ',
        'rules' => 'required|trim',
        ],
        [
        'field' => 'cat_unid',
        'label' => ' ',
        'rules' => 'required|trim',
        
        ],

    ],   

// END ATTACH Menu //   
  
// START PASSWORD Menu //    
'password_validation' =>
    [
        [
        'field' => 'current_pass',
        'label' => 'Current Password',
        'rules' => 'required|trim',
        ],
        [
        'field' => 'new_pass',
        'label' => 'New Password',
        'rules' => 'required|trim',
        
        ],
        [
        'field' => 'confirm_pass',
        'label' => 'Confirm Password',
        'rules' => 'required|trim',
        ],

    ],    
 // END PASSWORD Menu // 
 
 // PROFILE PASSWORD Menu // 
'profile_validation' =>
    [
        [
        'field' => 'admin_name',
        'label' => 'Admai Name',
        'rules' => 'required|trim',
        ],
        [
        'field' => 'admin_email',
        'label' => 'Email',
        'rules' => 'required|trim|valid_email|is_unique[tbl_admin.admin_email]',
        
        ],
        [
        'field' => 'admin_fb',
        'label' => 'Facebook ID',
        'rules' => 'trim',
        ],

    ],       
 // PROFILE PASSWORD Menu //    
 
 // USER PASSWORD Menu // 
'user_validition' =>
    [
        [
        'field' => 'password',
        'label' => 'Admai Password',
        'rules' => 'required|trim',
        ],
        [
        'field' => 'username',
        'label' => 'User Name',
        'rules' => 'required|trim|is_unique[tbl_admin.username]',
        
        ],
        [
        'field' => 'user_pass',
        'label' => 'User Password',
        'rules' => 'trim|required',
        ],
        [
        'field' => 'confirm_pass',
        'label' => 'Confirm Password',
        'rules' => 'trim|required',
        ],

    ],       
 // USER PASSWORD Menu //    
    
 // User update //  
'user_update' =>
    [
        [
        'field' => 'update',
        'label' => ' ',
        'rules' => 'required|trim',
        ],
        [
        'field' => 'admin_role',
        'label' => 'Admin Role',
        'rules' => 'required|trim',
        ],
    ]
 // User update //   
    
    
    
    
    
    
    
];
?>