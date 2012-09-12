<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">$(function(){
	// Accordion
	$("#accordion-3").accordion({ header: "h3",autoHeight: false});
});
</script><!-- accordion-3 --><div id="accordion-3"><div><h3><a href="#">未做过的题目</a></h3><ul class='pages'><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li title="进入第<?php echo ($i); ?>页" onclick="gettiku('31',<?php echo ($vo["pageid"]); ?>);"><?php echo ($vo["pageid"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?></ul></div></div>