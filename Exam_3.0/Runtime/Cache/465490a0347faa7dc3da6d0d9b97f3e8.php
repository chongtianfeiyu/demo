<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">$(function(){
	// Accordion
	$("#accordion-4").accordion({ header: "h3",autoHeight: false});
});
</script><!-- accordion-3 --><div id="accordion-4"><div><h3><a href="#">做过且有错的题[忽略冷宫]</a></h3><ul class='pages'><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li title="进入第<?php echo ($i); ?>页" onclick="gettiku('41',<?php echo ($vo["pageid"]); ?>);"><?php echo ($vo["pageid"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?></ul></div></div>