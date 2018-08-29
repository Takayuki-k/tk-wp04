<?php get_header(); ?>
    <p class="theme-category"><?php single_cat_title(); ?><span class="small">-category</span></p>
  <?php if (is_category() && !is_paged() && category_description()) : ?>
    <div class="theme-category-description"><?php echo category_description(); ?></div>
  <?php endif;
    if (have_posts()):
      while (have_posts()):
        the_post(); ?>
    <section class="post">
      <a href="<?php the_permalink(); ?>" class="thumbnail"><?php thumbnail_check( $post->ID ); ?></a>
      <div class="post-discription">
        <h3><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
        <div class="post-meta"><span class="post-date"><?php the_date('Y-m-d'); ?></span><?php the_category(); ?></div>
          <?php the_excerpt(); ?>
      </div>
    </section>
    <?php endwhile; ?>
    <!-- pager -->
    <?php get_template_part("pagination"); ?>
    <!-- /pager -->
  <?php else: ?>
  <div id="error404">
    <p class="bold">404エラーページ</p>
    <p>すみません。お探しのページは見つかりませんでした。</p>
    <p>再度検索をお願いします。</p>
    <?php get_search_form(); ?>
    <br>
    <a href="javascript:history.back();" class="bg-danger">&lt;前のページに戻る</a>
  </div>
  <?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>