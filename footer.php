<footer class="footer">
                        <div class="container">
                           <div class="row">
                             
                              <?php  

                                  if(is_active_sidebar('footer-left')) {
                                    dynamic_sidebar('footer-left');
                                  }
                                  if(is_active_sidebar('footer-middle')) {
                                    dynamic_sidebar('footer-middle');
                                  }
                                  if(is_active_sidebar('footer-right')) {
                                    dynamic_sidebar('footer-right');
                                  }

                              ?>

                           </div>
                        </div>

                        <div class="footer__bottom-footer">
                          <p>Made with &hearts; by Weight Loss Reviews &copy; 2019</p>
                        </div>
                    </footer>

                    <?php wp_footer(); ?>
        
        
    </body>
</html>