<?php get_header(); ?>
    <p class="archive">
      <?php if(is_month()): ?>
        <span><?php echo get_query_var('year'); ?>年</span>
        <span><?php echo get_query_var('monthnum'); ?>月</span>
      <?php elseif(is_year()): ?>
        <?php echo get_query_var('year'); ?>年
      <?php endif; ?>
    </p>
    <?php if (have_posts()):
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