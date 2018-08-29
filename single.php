<?php get_header(); ?>
    <?php if (have_posts()):
      while (have_posts()):
        the_post(); ?>
      <?php get_template_part("breadcrumbs"); ?>
      <article>
        <div class="post-discription">
          <h3><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
          <div class="post-meta"><span class="post-date"><?php the_date('Y-m-d'); ?></span><?php the_category(); ?></div>
        </div>
        <div class="post-article clearfix">
          <?php the_content(); ?>
        </div>
      </article>
      <div class="pager"><?php next_post_link('%link', '&laquo;&ensp;%title'); previous_post_link('%link', '%title&ensp;&raquo;'); ?></div>
      <?php comments_template(); ?>
    <?php endwhile; else: ?>
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