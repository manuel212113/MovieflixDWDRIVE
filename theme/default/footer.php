<footer class="footer">
   <div class="row">
      <div class="col-sm-6 text-center text-sm-right order-sm-1">
         <ul class="text-gray">
            <li>Version v<?=VERSION?></li>
         </ul>
      </div>
      <div class="col-sm-6 text-center text-sm-left mt-3 mt-sm-0">
         <small class="text-muted d-block">Gerador de player  <a href="https://mercadophp.com/" target="_blank">MERCADOPHP</a>. Todos os direitos reservados</small>
      </div>
   </div>
</footer>
</div>
<!-- page content ends -->
</div>
<!--page body ends -->
<!-- plugins:js -->
<script src="<?=getThemeURI()?>/assets/vendors/js/core.js"></script>
<script src="<?=getThemeURI()?>/assets/vendors/js/vendor.addons.js"></script>
<!-- endinject -->
<!-- build:js -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?=getThemeURI()?>/assets/js/template.js?v2.1"></script>
<script src="<?=getThemeURI()?>/assets/js/data-table.js"></script>
<script src="<?=getThemeURI()?>/assets/js/notifications.js"></script>
<script src="<?=getThemeURI()?>/assets/vendors/summernote/dist/summernote-lite.min.js"></script>
<script>
   PROOT  = '<?=PROOT?>';
</script>
<script src="<?=getThemeURI()?>/assets/js/custom.js?v2.1"></script>
<!-- endbuild -->
<script>
   $( function() {
     $( "#subList" ).sortable();
     $( "#subList" ).disableSelection();
   } );
</script>
</body>
</html>