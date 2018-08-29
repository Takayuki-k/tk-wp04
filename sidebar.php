    </main>
    <aside id="sidebar" class="col-3_md-12">
        <div class="sidebar__sticky">
        <?php if ( is_active_sidebar( 'sidebar' ) ) :
          dynamic_sidebar( 'sidebar' );
        endif; ?>
        <p class="text-right">
          <a href="#top-body" class="back-to-top"><i class="fa fa-hand-o-up"></i>&ensp;へ戻る</a>
        </p>
      </div>
    </aside>
