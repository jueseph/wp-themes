<?php 
if(is_home()): 
    query_posts('posts_per_page=1');
    if (have_posts()): the_post();
        header('Location: '.post_permalink());
    endif;
endif;
?>
<html>
<head>
<title><?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen, print">
</head>
<body>
    <div class="bd">
        <div class="entries">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            <div class="nav">
                        <?php previous_post_link('<div class="prev-link">%link</div>','&laquo;'); ?>
                        <?php next_post_link('<div class="next-link">%link</div>','&raquo;','<div class="next-link">','</div>'); ?>
            </div>
            <div class="entry" id="post-<?php the_ID(); ?>">
                <div class="entry-hd">
<?php if (is_user_logged_in()):?>                
                    <p><a href="<?php bloginfo('url');?>/wp-admin/post.php?action=edit&post=<?php the_id();?>"><?php the_time('M d Y') ?></a></p>
<?php else:?>                    
                    <p><a href="<?php the_permalink();?>"><?php the_time('M d Y') ?></a></p>
<?php endif;
global $post;
$tmp_post = clone $post;
$myposts = get_posts('numberposts=1');
foreach($myposts as $post) :
    setup_postdata($post);?>
                    <p class="showonmouseover"><a href="<?php the_permalink();?>">Last</a></p>
<?php endforeach; 
$myposts = get_posts('numberposts=1&orderby=rand');
foreach($myposts as $post) :
    setup_postdata($post);
?>                   
                    <p class="showonmouseover"><a href="<?php the_permalink();?>">Random</a></p>
<?php endforeach;
$post = $tmp_post;
setup_postdata($post);
if (is_user_logged_in()):?>      
                    <p class="showonmouseover"><a href="<?php bloginfo('url');?>/wp-admin/post-new.php">New</a></p>
<?php endif;?>                    
                </div>
                <div class="entry-bd">                   
                    <?php if (get_the_title()): ?><h2><?php the_title();?></h2><?php endif; ?>
                    <?php the_content('Read the rest of this entry &raquo;'); ?>
                </div>
            </div>
            <?php endwhile; ?>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>