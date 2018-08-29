<?php  get_header(); ?>
      <?php get_template_part("breadcrumbs"); ?>
      <article><div class="article">
        <div id="error404">
          <p class="bold">404エラーページ</p>
          <p>すみません。お探しのページは見つかりませんでした。</p>
          <p>再度検索をお願いします。</p>
          <?php get_search_form(); ?>
          <br>
          <a href="javascript:history.back();" class="bg-danger">&lt;前のページに戻る&gt;</a>
        </div>
      </div></article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>