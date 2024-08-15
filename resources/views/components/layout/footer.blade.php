<div class="footer">
    <!-- <div class="copyright">
        <p>Copyright © Designed &amp; Developed by <a href="http://dexignlab.com/" target="_blank">DexignLab</a> 2023
        </p>
    </div> -->
</div>



<script src="<?php echo asset('/'); ?>vendor/global/global.min.js"></script>
<script src="<?php echo asset('/'); ?>vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<!-- Datatable -->
<script src="<?php echo asset('/'); ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo asset('/'); ?>js/pluginsinit/datatables.init.js"></script>

<!-- Svganimation scripts -->
<script src="<?php echo asset('/'); ?>vendor/svganimation/vivus.min.js"></script>
<script src="<?php echo asset('/'); ?>vendor/svganimation/svg.animation.js"></script>

<script src="<?php echo asset('/'); ?>js/custom.min.js"></script>
<script src="<?php echo asset('/'); ?>js/dlabnav-init.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<style> 
.direct-chat-text::selection {
  background: #e74c3c;
}

.direct-chat-text a::selection {
  background: #e74c3c;
}
</style>
<script> 
function ltrim(str) {
  if(!str) return str;
    str = str.replace(/(\r\n|\n|\r)/gm, "");
   str = str.replace(/^\s+/g, '');
   alert('--'+str+'___');
   return str;
}
$(document).ready(function(){
    $( ".direct-chat-text" ).find('a').removeAttr('href')
});
$( ".direct-chat-text" ).on( "dblclick", function(e) {
    var span = e.target;
    window.getSelection().selectAllChildren(e.target);
    document.execCommand("copy");
});
</script>
<!-- JS confirm Override -->
</body>
</html>
