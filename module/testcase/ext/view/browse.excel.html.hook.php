<script>
$(function()
{
    $("#featurebar #exportActionMenu li a[href*='exportTemplet']").attr('href', '<?php echo $this->createLink('testcase', 'exportTemplet', "productID=$productID&branch=$branch")?>');
})
</script>
