  
    </div>
    <!-- END .row-fluid -->

</div>
<!--END .wrapper -->

<div class="footer-container ">

    <div class="wrapper">

        <footer class="row-fluid">
                
                <!--Begin .copyright -->
                <div class="span4 no-bottom">                                
                    <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer 1' ) ) ?>                    
                <!--END copyright -->
                </div>

                <!--Start Zilla Social -->
                <div class="span4 no-bottom">
                    <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer 2' ) ) ?>
                </div>
                <!--END Zilla Social -->

                <!--Start Menu -->
                <div class="span4 no-bottom">
                    <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer 3' ) ) ?>
                </div>
                <!--END Menu -->

        </footer>

    </div>

</div>


        <!-- Theme Hook -->
        <?php wp_footer(); ?>
			
<!--END body-->
</body>
<!--END html-->
</html>