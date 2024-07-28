<?php
// Start the WordPress Loop. This checks if there are any posts to display.
if ( have_posts() ) :

    // The loop starts here. It will continue to loop through all posts that meet the criteria of the query.
    while ( have_posts() ) : the_post(); ?>
        
        <!-- Display the title of the post -->
        <h2><?php the_title(); ?></h2>
        
        <!-- Display the post thumbnail if it exists -->
        <?php if ( has_post_thumbnail() ) : ?>
            <div>
                <?php
                // Display the post thumbnail
                the_post_thumbnail( 'full', ['alt' => get_the_title()] );
                ?>
            </div>
        <?php endif; ?>

         <?php 
        $post_thumbnail_url = get_the_post_thumbnail_url();
        if ( !empty($post_thumbnail_url) : ?>
            <div>
                 <img src="<?php echo  $post_thumbnail_url;?>"/>
            </div>
        <?php endif; ?>
        
        <!-- Display the content of the post -->
        <div><?php the_content(); ?></div>
        
        <!-- Display the date the post was published -->
        <p>Published on: <?php the_date(); ?></p>
        
        <!-- Display the author of the post -->
        <p>Author: <?php the_author(); ?></p>
        
        <!-- Display the categories the post belongs to -->
        <p>Categories: <?php the_category(', '); ?></p>
        
        <!-- Display the tags associated with the post -->
        <p>Tags: <?php the_tags('', ', ', ''); ?></p>

    <?php
    // End the loop.
    endwhile;

// If no posts were found, this else statement will display a message to the user.
else : ?>
    <p>No posts found.</p>
<?php
// End the if statement.
endif;
?>
