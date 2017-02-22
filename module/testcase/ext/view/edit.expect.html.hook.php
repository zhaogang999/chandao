<script language='Javascript'>
//console.log($('.w-40px').parent().parent().parent().find('tr'));
$('.w-40px').parent().parent().parent().find('tr').each(function () {
    _this = $(this);
   var step = _this.children('.strong').text();
    var sid  = 'expects' + step;
    _this.find('textarea:last').attr('id', sid);
    _this.find('textarea:first').attr('rows', '8');
});
</script>
