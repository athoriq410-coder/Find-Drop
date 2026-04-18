<!--begin::Javascript-->
<div id="modal_preview_all" class="preview_modal">
  <span class="preview_close">&times;</span>
  <img class="preview-modal-content showin" id="preview_image">
  <iframe class="preview-modal-content hidin" id="preview_embed" width="656" height="369" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
  <div id="preview_caption"></div>
</div>

<script>
    
    var BASE_URL = '<?= base_url('',true); ?>';
    var hostUrl = "<?= assets_url(); ?>admin/";
    var css_btn_confirm = 'btn btn-primary';
    var css_btn_cancel = 'btn btn-danger';

    var base_foto = '<?= image_check('notfound.jpg','default') ?>';
    var user_base_foto = '<?= image_check('user.jpg','default') ?>';
    addEventListener('keypress', function(e) {
        if (e.keyCode === 13 || e.which === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>

<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="<?= assets_url(); ?>public/plugins/global/plugins.bundle.js"></script>
<script src="<?= assets_url(); ?>public/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="<?= assets_url(); ?>public/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="<?= assets_url(); ?>public/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
<!--end::Vendors Javascript-->

<!--begin::Custom Javascript(used for this page only)-->
<!-- <script src="<?= assets_url(); ?>admin/js/custom/widgets.js"></script> -->
<script src="<?= assets_url(); ?>admin/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="<?= assets_url(); ?>admin/js/custom/utilities/modals/create-campaign.js"></script>
<script src="<?= assets_url(); ?>admin/js/custom/utilities/modals/users-search.js"></script>
    <script type="text/javascript" src="<?= assets_url(); ?>public/plugins/ckeditor5/ckeditor.js"></script>
<script src="<?= assets_url(); ?>public/js/function.js"></script>
<script src="<?= assets_url(); ?>admin/js/modul/mekanik.js"></script>
<script src="<?= assets_url(); ?>admin/js/custom/javascript_pribadi.js"></script>



<!--end::Custom Javascript-->
<?php

if (isset($js) && is_array($js)) {
    foreach ($js as $jss) {
        echo $jss;
    }
} else {
    echo (isset($js) && ($js != "") ? $js : "");
}

?>
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>