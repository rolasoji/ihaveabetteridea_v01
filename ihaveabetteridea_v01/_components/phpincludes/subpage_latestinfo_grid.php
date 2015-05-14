<!-- latest blog posts -- get the posts -->
<?php
//echo $havepost."/".have_posts()."<br/>";
//print_r($posts);
// get the latest 3 ...
//$posts = get_posts('numberposts=10&order=ASC&orderby=post_title');
$posts = get_posts('numberposts=3&order=DESC&orderby=post_date');
?>
<article class="latestinfo media">
    <h2>Latest information / events</h2>
    <div class="media-body">
        <!-- check if there are blog contents and set display -->
        <?php if ($posts) : ?> 
            <img class="img-responsive pull-left hidden-sx" data-toggle="tooltip" data-placement="top" title="Image courtesy of Scott Bauer via Wikimedia Commons" src="http://www.balancewellness.co.uk/zNEWsite_idea/images/sweetner_Runny_hunny_128px.jpg" alt="Running honey" />
            <?php 
            $postcount = 0;
            foreach ($posts as $post) : 
                setup_postdata( $post );
                ?>
                <article id="latestposts<?php echo $postcount; ?>">
                    <h3><?php the_title(); ?> <small>Posted on <?php the_date(); ?></small></h3>
                    <div><?php the_excerpt(); ?><span><a class="btn btn-primary btn-sm inline pull-right" href="<?php the_permalink(); ?>" target="_blank" rel="bookmark" title="More details for <?php the_title_attribute(); ?>">More &hellip;</a></span></div>
                </article>
                <?php 
                $postcount++;
            endforeach;
            //wp_reset_postdata();  // restore global post data
            ?> 
        <?php else : ?> 
            <a class="pull-right" href="#"><img src="http://www.balancewellness.co.uk/zNEWsite_idea/images/facebook_image.png" alt="Wellness sections - placeholder" /></a>
            <p>Watch this space for latest blog posts &hellip; coming soon.</p>
            <p>xxx<?php echo $havepost."/".have_posts(); ?></p>
        <?php endif; ?> 
    </div><!-- /.media-body -->
</article><!-- /.latestinfo -->
