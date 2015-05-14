<!-- latest blog posts -- get the posts -->
<?php
// get the latest 10 ...
//$posts = get_posts('numberposts=10&order=ASC&orderby=post_title');
$posts = get_posts('numberposts=10&order=DESC&orderby=post_date');
?>
<article class="blogposts">
    <div class="content row">
        <!-- scrollspy overlaps text on inner window size smaller than 1201 (width) -->
        <!-- check if there are blog contents using a variable set in parent page -->
        <?php if ($posts) : ?> 
            <div class="scrollspydata col col-lg-3 hidden-xs">
                <!-- placeholder -->
                <ul class="nav nav-list affix">
                    <?php 
                    $postcount = 0;
                    foreach ($posts as $post) : 
                        setup_postdata( $post );
                        ?> 
                        <li><a href="#latestposts<?php echo $postcount; ?>">Post #<?php the_ID(); ?></a></li>
                        <?php 
                        $postcount++;
                    endforeach; 
                    ?> 
                </ul>
            </div><!-- /.scrollspy -->
            <div class="postcontent col col-lg-9">
                <section class="media-body">
                    <?php 
                    $postcount = 0;
                    foreach ($posts as $post) : 
                        setup_postdata( $post );
                        ?>
                        <article id="latestposts<?php echo $postcount; ?>">
                            <h3><?php the_title(); ?> <small>Posted on <?php the_date(); ?></small></h3>
                            <p><?php the_excerpt(); ?>&nbsp;<a class="btn btn-primary btn-sm pull-right" href="<?php the_permalink(); ?>" target="_blank" rel="bookmark" title="More details for <?php the_title_attribute(); ?>">More &hellip;</a></p>
                        </article>
                        <?php 
                        $postcount++;
                    endforeach; 
                    //wp_reset_postdata();  // restore global post data
                    ?> 
                </section><!-- /.media-body -->
            </div><!-- /.postcontent -->
        <?php else : ?> 
            <div class="scrollspydata col col-lg-3 hidden-xs">
                <!-- placeholder -->
                <ul class="nav nav-list affix">
                    <li><a href="#latestposts00">Latest posts</a></li>
                </ul>
            </div><!-- /.scrollspy -->
            <div class="postcontent col col-lg-9">
                <div class="media-body">
                    <h2>Latest blog posts  &hellip;</h2>
                    <p>Watch this space for latest blog posts &hellip; coming soon.</p>
                </div><!-- /.media-body -->
            </div><!-- /.postcontent -->
        <?php endif; ?> 
    </div><!-- /.content -->
</article>
